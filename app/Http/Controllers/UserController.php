<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNull('approved_at')->get();

        return view('users', compact('users'));
    }
    
    public function getAllUsers(Request $request)
    {
        $users = User::where('id', '>', 1)->get();
        if( count($users) > 0 ){
            return $users;
        }
        return 0;
    }

    public function approve(Request $request)
    {
        $user = User::findOrFail($request->input('userId'));


        if ($request->input('addRight') && $request->input('searchRight')) {
            $user->update(
                ['approved_at' => now(), 'canAdd' => true, 'canSearch' => true]
            );
        } else {
            if ($request->input('addRight')) {
                $user->update(
                    ['approved_at' => now(), 'canAdd' => true]
                );
            }

            if ($request->input('searchRight')) {
                $user->update(
                    ['approved_at' => now(), 'canSearch' => true]
                );
            }
        }

        return redirect()->route('admin.users.index')->withMessage('User approved successfully');
    }
}
