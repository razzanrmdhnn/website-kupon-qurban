<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ManajemenAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::orderBy('created_at', 'desc')->get();
        return view('admin.manajemen-admin.index', compact('admins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'admin', // Semua admin baru adalah admin biasa
        ]);

        return redirect()->route('manajemen-admin.index')
            ->with('success', 'Admin berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $manajemen_admin)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $manajemen_admin->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $manajemen_admin->update([
            'name' => $request->name,
            'username' => $request->username,
        ]);

        if ($request->filled('password')) {
            $manajemen_admin->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('manajemen-admin.index')
            ->with('success', 'Admin berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $manajemen_admin)
    {
        if ($manajemen_admin->id === auth()->id()) {
            return redirect()->route('manajemen-admin.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $manajemen_admin->delete();

        return redirect()->route('manajemen-admin.index')
            ->with('success', 'Admin berhasil dihapus!');
    }
}
