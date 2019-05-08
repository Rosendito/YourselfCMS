<?php

namespace App\Http\Controllers\Admin\Resources;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Resources\ResourceController;
use Illuminate\Support\Facades\Storage;

class UserController extends ResourceController
{
    public function index (Request $request)
    {
        $users = User::all();

        return $this->showAll($users);
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'     => 'required|max:180',
            'email'    => 'required|email',
            'password' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $requst->all();

        $data['password'] = bcrypt($request->password);
        $data['admin']    = User::REGULAR;

        if ($request->has('image_url')) {
            $data['image'] = $request->image_url;
        }

        if ($request->hasFile('image_file')) {
            $data['image'] = $request->image_file->store('');
        }

        $user->save();

        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name'  => 'max:180',
            'email' => 'email',
        ];

        $this->validate($request, $rules);

        $user->fill($request->only([
            'name',
            'email'
        ]));

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('image_url')) {
            $user->image = $request->image_url;
        }

        if ($request->hasFile('image_file')) {
            Storage::delete($user->image);

            $user->image = $request->image_file->store('');
        }

        $user->save();

        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::delete($user->image);

        $user->delete();

        return $this->showOne($user);
    }
}
