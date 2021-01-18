<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        $users = User::query();
        return datatables()->eloquent($users)->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        return view('users.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => [
                'required'
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore(Auth::id(), 'id')
            ],
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ]
        ]);

        $user = new User;

        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return back()->with('status', 'User telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $user = User::findOrFail($id);
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $user = User::findOrFail($id);

        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'fullname' => [
                'required'
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($id, 'id')
            ],
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'username')->ignore($id, 'id')
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed'
            ]
        ]);

        $user = User::findOrFail($id);

        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->email    = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->newpassword);
        }

        $user->save();

        return back()->with('status', 'Data user telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        if ($id == Auth::id()) {
            abort(403);
        }

        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('status', 'Profil telah dihapus');
    }

    /**
     * Show the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('users.profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'fullname' => [
                'required'
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore(Auth::id(), 'id')
            ],
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'username')->ignore(Auth::id(), 'id')
            ],
        ]);

        $user = User::findOrFail(Auth::id());

        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->email    = $request->email;

        $user->save();

        return back()->with('status', 'Profil telah diubah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfilePassword(Request $request)
    {
        $request->validate([
            'oldpassword' => [
                'required',
                'string',
                'min:8',
            ],
            'newpassword' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ]
        ]);

        $user = User::findOrFail(Auth::id());

        $user->password = Hash::make($request->newpassword);

        $user->save();

        return back()->with('status', 'Kata sandi telah diubah');
    }
}
