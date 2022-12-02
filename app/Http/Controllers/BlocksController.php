<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Block;
use Auth;

class BlocksController extends Controller
{
    // favoriteList
    public function block()
    {
        $users = Auth::user()
            ->join('blocks', 'users.id', 'blocks.blocked_userId')
            ->get();
        return view('users.block', compact('users'));
    }
}
