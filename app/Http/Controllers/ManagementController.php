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
     * creates a new user with the passed up information
     *
     * @param UserRequest $request
     * @return void
     */
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

    /**
     * updates the matching user with all parameters passed up
     *
     * @param UserRequest $request
     * @return void
     */
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
