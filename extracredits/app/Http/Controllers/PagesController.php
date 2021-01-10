<?php

namespace App\Http\Controllers;
use App\Subject;
use App\User;
use App\Lesson;
use App\Subcategory;
use App\Topic;
use App\Transaction;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Stripe\Stripe;

class PagesController extends Controller
{
    public function home() {
        $subjects = Subject::all();
        return view('index', ['subjects' => $subjects]);
    }

    public function dashboard() {
        $active_students = count(User::role('student')->get());
        $user = Auth::user();
        $subjects = Subject::all();
        $unlocked_lessons = Lesson::has('user')->get();
        $best_lessons = Lesson::withCount('user')->orderBy('user_count', 'desc')->paginate(25);
        $lessons_number = DB::table('lessons')->count();
        $users = User::all();
        $transactions_number = DB::table('transactions')->count();
        $transactions = Transaction::all();
        return view('dashboard', compact('user', 'unlocked_lessons', 'subjects', 'active_students', 'transactions_number', 'transactions', 'lessons_number', 'best_lessons'));
    }

    public function dashboard_lessons() {
        $user = Auth::user();
        $lessons = Lesson::paginate(25);
        $subjects = DB::table('subjects')->orderBy('name', 'asc')->get();
        $subcategories = DB::table('subcategories')->orderBy('name', 'asc')->get();
        return view('dashboard.lessons', compact( "user", "subjects", "lessons", "subcategories"));
    }

    public function dashboard_lessons_search(Request $request) {
        $search_query = $request->get('searchInput');
        $lessons = Lesson::where('title', 'like', '%' . $search_query . '%')->orWhere('description', 'like', '%' . $search_query . '%' )->get();
        $subjects = DB::table('subjects')->orderBy('name', 'asc')->get();
        $subcategories = DB::table('subcategories')->orderBy('name', 'asc')->get();
        return view('dashboard.lessons', compact("lessons", "search_query", "subjects", "subcategories"));
    }

    public function dashboard_lessons_filter (Request $request) {
        $filter = $request->get('selectFilter');
        if (strpos($filter, 'sub-' ) !== false) {
            $subject = (int)substr($filter, 4);
            $lessons = Lesson::where('subject_id', $subject)->get();
            $subjects = DB::table('subjects')->orderBy('name', 'asc')->get();
            $subcategories = DB::table('subcategories')->orderBy('name', 'asc')->get();
            $selected_subject = Subject::find($subject);
            return view('dashboard.lessons', compact("lessons", "subjects", "subcategories", "selected_subject"));
        } else {
            $category = (int)substr($filter, 9);
            // $subject = (int)
            $lessons = Lesson::whereHas('topic', function ($builder) use ($category) {
                $builder->where('subcategory_id', $category);
            })->get();
            $subjects = DB::table('subjects')->orderBy('name', 'asc')->get();
            $subcategories = DB::table('subcategories')->orderBy('name', 'asc')->get();
            $selected_category = Subcategory::find($category);
            // dd($lessons);
            return view('dashboard.lessons', compact("lessons", "subjects", "subcategories", "selected_category"));
        }


    }

    public function lesson_view($subject, $subcategory, $topic, $lesson_slug) {
        $lesson = Lesson::where('slug', $lesson_slug)->first();
        $unlocked = "Doesn't work";
        if ($lesson->user()->exists(Auth::id())) {
            $unlocked = true;
        }
        else {
            $unlocked = false;
        }

        return view('lessons.show', ['lesson' => $lesson, 'unlocked' => $unlocked]);
    }

    public function dashboard_students() {
        $students = User::role('student')->paginate(25);

        return view('dashboard.students', compact("students"));
    }

    public function dashboard_student_panel($id) {
        $user = User::where('id',$id)->first();
        $lessons = User::find($id)->lesson()->get();
        $today = Carbon::now();
        $transactions = Transaction::where('user_id', $user->id)->get();
        if (Carbon::parse($user->expiry_date)->greaterThan($today) ) {
            $valid = Carbon::parse($user->expiry_date)->diffInDays($today);
        }
        else {
            $valid = "Expired";
        }
        return view('dashboard.student_panel', compact("user", "lessons", "transactions", "valid"));
    }

    public function dashboard_student_add_credits(Request $request) {
        $user = User::where('id', (int)$request->input('student_id'))->first();
        $user->credits = $user->credits + $request->input('creditTopupRadio');
        $user->save();

        return redirect()->back();
    }

    public function dashboard_categories() {
        // $subjects = DB::table('subjects')
        //     ->orderBy('name', 'asc')
        //     ->get();
        $subjects = Subject::with('subcategory')->orderby('name', 'asc')->get();
        $subcategories = Subcategory::withCount('subject')->get();
        $topics = Topic::with('subcategory')->get();
        return view('dashboard.categories', compact("subjects", "subcategories", "topics"));
    }

    public function dashboard_subjects($subject_name) {
        $subjects = Subject::all();
        $selected_subject = Subject::where('name', $subject_name)->first();
        $subcategories = Subcategory::where('subject_id', $selected_subject->id)->orderby('order_position', 'asc')->get();
        $topics = Topic::orderby('order_position', 'asc')->get();

        return view('dashboard.subjects', compact("subjects", "selected_subject", "subcategories", "topics"));

    }

    public function dashboard_transactions() {
        $transactions = Transaction::paginate(25);

        return view('dashboard.transactions', compact("transactions"));
    }

    public function dashboard_emails() {


        return view('dashboard.emails');
    }

    public function user_panel($id) {
        if ( $id != Auth::id() ) {
            return response("<h2>You are not authorised to view this page.</h2>", 403);
        }
        else {
            $user = User::where('id',$id)->first();
            // $lessons = Lesson::withCount('user')->get();
            // $lessons = Lesson::where('user_id', $id)->get();
            $lessons = User::find($id)->lesson()->get();
            $transactions = Transaction::where('user_id', $id)->get();
            $today = Carbon::now();
            if (Carbon::parse($user->expiry_date)->greaterThan($today) ) {
                $valid = Carbon::parse($user->expiry_date)->diffInDays($today);
            }
            else {
                $valid = "Expired";
            }
            return view('user_panel', compact("user", "lessons", "transactions", "valid"));
        }
    }

    public function buy_credits() {
        return view('buycredits');
    }

    public function topup(Request $request) {
        $user = Auth::user();
        $topup = (int)$request->get('topup');
        $credit = $user->credits;
        $new_credit = $credit + $topup;
        $user->credits = $new_credit;
        $user->save();

        $transactions = Transaction::has('user')->get();
        $lessons = Lesson::withCount('user')->get();

        return view('user_panel', compact("user", "lessons", "transactions"));
    }

    public function subjects() {
        $subjects = Subject::orderby('name', 'asc')->get();
        return view('pages.subjects', compact('subjects'));
    }

    public function myvideos() {
        $user = Auth::user();
        $lessons = User::find($user->id)->lesson()->orderby('subject_id', 'asc')->get();

        return view('pages.myvideos', compact('lessons'));

    }

    public function checkout() {
        return view ('pages.checkout');
    }

    public function stripeSession(Request $request, Response $response) {
        \Stripe\Stripe::setApiKey('sk_test_0qpl1hs9SHkT9UB8MH9X1R43');
        // dd(json_decode($request->input('amount'), true));
        $amount = json_decode($request->input('amount'), true);

        switch ($amount) {
            case 4.99:
                $credit = 1;
                break;
            case 19.99:
                $credit = 5;
                break;
            case 49.99:
                $credit = 15;
                break;
            case 149.99:
                $credit = 50;
                break;
            case 249.99:
                $credit = 100;
                break;
            case 499.99:
                $credit = 999;
                break;
            default:
                $credit = 19.99;
        }

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                  'name' => 'Credit Topup',
                ],
                'unit_amount' => $amount,
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'https://examsmadeeasy.ie/thankyou?session={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'https://examsmadeeasy.ie/checkout',
          ]);

          return response()->json([ 'id' => $session->id ], 200);

    }

    public function webhook(Request $request, Response $response) {
        \Stripe\Stripe::setApiKey('sk_test_0qpl1hs9SHkT9UB8MH9X1R43');

        $payload = @file_get_contents('php://input');
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object; // contains a StripePaymentIntent
                handlePaymentIntentSucceeded($paymentIntent);
                echo("Payment intent");
                break;
            case 'payment_method.attached':
                $paymentMethod = $event->data->object; // contains a StripePaymentMethod
                handlePaymentMethodAttached($paymentMethod);
                break;
            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return http_response_code(200);
    }
}
