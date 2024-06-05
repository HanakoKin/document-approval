<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Menampilkan semua pengguna
    public function index()
    {

        $title = 'User Management Page';
        $users = User::orderBy('created_at', 'desc')->get();
        $totals = $users->count();

        return view('pages.admin.index', compact('users', 'totals', 'title'));
    }

    // Menampilkan formulir untuk menambah pengguna
    public function create()
    {

        $title = 'Add User Page';
        $data = new User();
        $page_meta = [
            // 'title' => 'Add User Page',
            'function' => 'create',
            'method' => 'POST',
            'url' => route('users.store')
        ];

        return view('pages.admin.form', compact('title', 'data', 'page_meta'));
    }

    // Menyimpan pengguna baru ke dalam database
    public function store(Request $request)
    {

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'NIK' => 'required|string|unique:users|min:3',
            'jabatan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $validatedData = $validator->validated();

        User::create($validatedData);

        return to_route('users.index')->with('success', 'User created successfully.');
    }

    // Menampilkan formulir untuk mengedit pengguna
    public function edit($id)
    {

        $title = 'Edit User Page';
        $data = User::findOrFail($id);
        $page_meta = [
            // 'title' => 'Add User Page',
            'function' => 'edit',
            'method' => 'PUT',
            'url' => route('users.update', $data->id)
        ];

        return view('pages.admin.form', compact('title', 'data', 'page_meta'));
    }

    // Mengupdate pengguna ke dalam database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'jabatan' => 'required|string',
        ]);

        $validatedData = $validator->validated();

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        User::where('id', $id)->update($validatedData);

        return to_route('users.index')->with('success', 'User updated successfully.');
    }

    // Menghapus pengguna dari database
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return to_route('users.index')->with('success', 'User deleted successfully.');
    }
}
