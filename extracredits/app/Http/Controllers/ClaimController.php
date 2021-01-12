<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ClaimController extends Controller
{
    public function claim($id) {
        $user = User::find($id);
        if ($user->claim == 0) {
            $user->credits = $user->credits + 5;
            $user->claim = 1;
            $user->save();

            return back()->with('message', "You've got 5 extra credits on your account. Enjoy!");
        }
    }
}
