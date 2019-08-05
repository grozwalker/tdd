<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $activities = $user->activities()->with('subject')->latest()->get()->groupBy(function ($active) {
            return $active->created_at->format('d-m-Y');
        });

        //return $activities;

        return view('profile.show', [
            'userProfile' => $user,
            'activities' => $activities,
        ]);
    }
}
