<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Menampilkan semua pengguna
    public function index()
    {

        $title = 'User Management Page';

        $users = User::all();

        $totals = $users->count();

        return view('pages.admin.user', compact('users', 'totals', 'title'));
    }

    // Menampilkan formulir untuk menambah pengguna
    public function create()
    {

        $title = 'Add User Page';

        $unit = Unit::all();

        return view('pages.admin.addUser', compact('unit', 'title'));
    }

    // Menyimpan pengguna baru ke dalam database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'unit' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $validatedData = $validator->validated();

        User::create($validatedData);

        return redirect()->route('users')->with('success', 'User created successfully.');
    }

    // Menampilkan formulir untuk mengedit pengguna
    public function edit($id)
    {
        $title = 'Edit User Page';

        $data = User::findOrFail($id);

        $unit = Unit::all();

        return view('pages.admin.editUser', compact('data', 'title', 'unit'));
    }

    // Mengupdate pengguna ke dalam database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'unit' => 'required|string',
        ]);

        $validatedData = $validator->validated();

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        User::where('id', $id)->update($validatedData);

        return redirect()->route('users')->with('success', 'User updated successfully.');
    }

    // Menghapus pengguna dari database
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }
}
