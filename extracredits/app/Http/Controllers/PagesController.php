<?php

namespace App\Http\Controllers;
use App\Subject;
use App\User;
use App\Lesson;
use App\Subcategory;
use App\Topic;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // dd(json_decode($request->input('amount'), true));
        $amount = json_decode($request->input('amount'), true);

        $credit = 0;

        switch ($amount) {
            case 499:
                $credit = 1;
                break;
            case 1999:
                $credit = 5;
                break;
            case 4999:
                $credit = 15;
                break;
            case 14999:
                $credit = 50;
                break;
            case 24999:
                $credit = 100;
                break;
            case 49999:
                $credit = 999;
                break;
            default:
                $credit = 5;
        }

        $description = "Credit Top Up x ".$credit;

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => Auth::user()->email,
            'line_items' => [[
              'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                  'name' => $description,
                ],
                'unit_amount' => $amount,
              ],
              'quantity' => 1,
            ]],
            'metadata' => [
                'customer_name' => Auth::user()->name,
            ],
            'mode' => 'payment',
            'success_url' => env('STRIPE_SUCCESS'),
            'cancel_url' => env('STRIPE_CANCEL'),
          ]);

          return response()->json([ 'id' => $session->id ], 200);

    }

    public function webhook(Request $request, Response $response) {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object; // contains a StripePaymentIntent
                $user = User::where('email', $paymentIntent->charges->data[0]->billing_details->email)->first();
                $amount = $paymentIntent->charges->data[0]->amount;

                $credit = 0;

                switch ($amount) {
                    case 499:
                        $credit = 1;
                        break;
                    case 1999:
                        $credit = 5;
                        break;
                    case 4999:
                        $credit = 15;
                        break;
                    case 14999:
                        $credit = 50;
                        break;
                    case 24999:
                        $credit = 100;
                        break;
                    case 49999:
                        $credit = 999;
                        break;
                    default:
                        $credit = 5;
                }

                $user->credits = $user->credits + $credit;
                $user->save();

                // Adding unlimited if selected
                if ($credit == 999) {
                    $user->unlimited = 1;
                    $user->save();
                    $request->session()->flash('success_message', 'Thank you for the purchase, you have now unlimited access to all current and future videos');
                } else {
                    $request->session()->flash('success_message', 'Thank you for the purchase, the credits has been added to your account');
                }
                $transaction = new Transaction();
                $transaction->amount = $paymentIntent->charges->data[0]->amount / 100;
                $transaction->name_on_card = $paymentIntent->charges->data[0]->billing_details->name;
                $transaction->stripeToken = $paymentIntent->charges->data[0]->id;
                $transaction->credit_topup = $credit;
                $transaction->user_id = $user->id;

                $transaction->save();

                break;
            case 'payment_method.attached':
                $paymentMethod = $event->data->object; // contains a StripePaymentMethod
                break;
            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return http_response_code(200);
    }

    public function thankyou() {
       return view('pages.thankyou');
    }

    public function handlePaymentIntentSucceeded($paymentIntent) {
        return print_r($paymentIntent);
    }
}
