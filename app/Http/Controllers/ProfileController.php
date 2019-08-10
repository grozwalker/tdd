<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        //dd($user);
        return view('profile.show', [
            'userProfile' => $user,
            'activities' => Activity::feed($user),
        ]);
    }
}
