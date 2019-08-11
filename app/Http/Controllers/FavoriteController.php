<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Reply;
use Illuminate\Support\Facades\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
        $reply->addToFavorite();

        return redirect()->back()->with('flash', 'Successfully add to favorite');
    }
}
