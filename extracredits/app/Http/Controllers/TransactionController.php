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
        $user_id = Auth::id();
        $transaction = new Transaction($request->all());
        switch ($credit) {
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
            $charge = Stripe::charges()->create([
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
                $transaction->amount = $amount;
                $transaction->save();

                $lessons = Lesson::withCount('user')->get();
                return view('user_panel', ['user' => $user, 'lessons' => $lessons]);
            // return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        } catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }

    }
}
