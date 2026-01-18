<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function create()
    {
        return view('admin.users.create');
    }

    public function index()
    {
        $users = User::with('doctor')->orderBy('id')->get();
        $doctors = Doctor::orderBy('name')->get();
        return view('admin.users.index', compact('users', 'doctors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','string','min:8','confirmed'],
            'role' => ['required','in:admin,doctor,user'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        return redirect()->route('admin.users.create')->with('status', 'User berhasil dibuat.');
    }

    public function updateRole(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => ['required','in:admin,doctor,user'],
        ]);

        $user->role = $data['role'];
        $user->save();

        return back()->with('status', 'Role user diperbarui.');
    }

    public function updateDoctor(Request $request, User $user)
    {
        $data = $request->validate([
            'doctor_id' => ['nullable', 'integer', 'exists:doctors,id'],
        ]);

        $user->doctor_id = $data['doctor_id'] ?? null;
        $user->save();

        return back()->with('status', 'Dokter untuk user diperbarui.');
    }
}
