<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserSearchRequest;
use App\Models\User;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;

class ManagementController extends Controller
{
    /**
     * updates the matching user with all parameters passed up or creates a new user
     *
     * @param UserRequest $request
     * @return void
     */
    public function updateUser(UserRequest $request)
    {
        $validated = $request->validated(); 
throw new Exception($validated['name']);
        if (filled($request->user)){
            $request->user->name = $validated['name'];
            $request->user->username = $validated['username'];
            if (filled($validated['password']))
            {
                $request->user->password = $validated['password'];
            }
            $request->user->phone_number = $validated['phone_number'];
            $request->user->email_address = $validated['email_address'];
            $request->user->recieves_alerts = $validated['receives_alerts'];
            $request->user->save();

            return $request->user;
        }
        else{
            return User::create([
                'name' => $validated['name'],
                'username' => $validated['username'],
                'password' => $validated['password'],
                'phone_number' => $validated['phone_number'],
                'email_address' => $validated['email_address'],
                'receives_alerts' => $validated['receives_alerts']
            ]);   
        }
    }

    /**
     * deletes the user matching the passed in user_id
     *
     * @param Request $request
     * @return void
     */
    public function deleteUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:user,id'
        ]);

        $user = User::find($request->input('user_id'));
        $user->delete();
    }

    /**
     * searchs the user table by the passed in parameters
     *
     * @param UserSearchRequest $request
     * @return void
     */
    public function searchUsers(UserSearchRequest $request) 
    {
        $name = $request->input('name');
        $phone = $request->input('phone_number');
        $email = $request->input('email_address');

        return User::query()
            ->when($name, function ($query, $name) {
                $query
                ->where('name', 'like', '%'.$name.'%')
                ->orderByRaw('name like ? desc', [$name]);
            })
            ->when($phone, function ($query, $phone) {
                $query
                ->where('phone_number', 'like', '%'.$phone.'%')
                ->orderByRaw('phone_number like ? desc', [$phone]);
            })
            ->when($email, function ($query, $email) {
                $query
                ->where('email_address', 'like', '%'.$email.'%')
                ->orderByRaw('email_address like ? desc', [$email]);
            })
        ->get();
    }

    /**
     * return the user associated with a passed up user_id
     *
     * @param Request $request
     * @return void
     */
    public function getUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:user,id'
        ]);

        return User::find($request->input('user_id'));
    }
}
