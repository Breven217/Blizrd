<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserSearchRequest;
use App\Models\User;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;

class ManagementController extends Controller
{
    public function addUser(UserRequest $request)
    {
        $validated = $request->validated();
        return User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'phone_number' => $validated['phone_number'],
            'email_address' => $validated['email_address'],
            'recieves_alerts' => $validated['recieves_alerts']
        ]);
    }

    public function editUser(UserRequest $request)
    {
        if (!filled($request->user)){
            throw new Exception('user_id is required to edit user');
        }

        $validated = $request->validated();

        $request->user->update([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'phone_number' => $validated['phone_number'],
            'email_address' => $validated['email_address'],
            'recieves_alerts' => $validated['recieves_alerts']
        ]);

        return $request->user;
    }

    public function deleteUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:user,id'
        ]);

        $user = User::find($request->input('user_id'));
        $user->delete();
    }

    public function searchUsers(UserSearchRequest $request) 
    {
        $name = $request->input('name');
        $phone = $request->input('phone_number');
        $email = $request->input('email_address');

        return User::query()
            ->when(filled($name), function ($query, $name) {
                $query
                ->where('name', 'like', '%'.$name.'%')
                ->orderByRaw('name like ? desc', [$name]);
            })
            ->when(filled($phone), function ($query, $name) {
                $query
                ->where('name', 'like', '%'.$name.'%')
                ->orderByRaw('name like ? desc', [$name]);
            })
            ->when(filled($email), function ($query, $name) {
                $query
                ->where('name', 'like', '%'.$name.'%')
                ->orderByRaw('name like ? desc', [$name]);
            })
        ->toSql();
    }
}
