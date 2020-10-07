<?php

namespace App\Http\Controllers;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use App\Transaction;
use App\Lesson;
use Illuminate\Http\Request;
use Auth;

class TransactionController extends Controller
{
    public function store(Request $request) {
        $credit = (int)$request->get('credit_topup');
        $transaction = new Transaction($request->all());
        switch ($credit) {
            case 1:
                $amount = 9.99;
                break;
            case 5:
                $amount = 39.99;
                break;
            case 15:
                $amount = 99.99;
                break;
            case 50:
                $amount = 249.99;
                break;
            case 100:
                $amount = 349.99;
                break;
            default:
                $amount = 39.99;
        }

        try {
            $stripe = Stripe::make();
            $charge = $stripe->charges()->create([
                'amount' => $amount,
                'currency' => 'EUR',
                'source' => $request->stripeToken,
                'description' => 'Exams Made Easy',
                'receipt_email' => $request->email,
            ]);

                // Adding purchased credits to user account
                $user = Auth::user();
                $existing_credits = $user->credits;
                $user->credits = $existing_credits + $credit;
                $user->save();

                //Saving transaction details
                $transaction->user_id = Auth::id();
                $transaction->amount = $amount;
                $transaction->save();

                // session(['success_message' => 'Thank you for the purchase, the credits has been added to your account']);
                $request->session()->flash('success_message', 'Thank you for the purchase, the credits has been added to your account');
                $transactions = Transaction::where('user_id', Auth::id())->get();
                $lessons = User::find(Auth::id())->lesson()->get();
                return view('user_panel', ['user' => $user, 'lessons' => $lessons, 'transactions' => $transactions]);
            // return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        } catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }

    }
}
