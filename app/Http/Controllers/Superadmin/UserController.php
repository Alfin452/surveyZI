<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // DITAMBAHKAN: Import fasad Auth
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        $query = User::with(['role', 'unitKerja'])->filter($request->only('search', 'role'));
        $users = $query->latest()->paginate(10)->withQueryString();

        return view('superadmin.users.index', compact('users', 'roles'));
    }

    /**
     * Menampilkan form untuk membuat pengguna baru.
     */
    public function create()
    {
        $user = new User();
        $roles = Role::where('role_name', '!=', 'User')->get(); // Hanya tampilkan Superadmin & Admin
        $unitKerjas = UnitKerja::orderBy('unit_kerja_name')->get();
        return view('superadmin.users.create', compact('user', 'roles', 'unitKerjas'));
    }

    /**
     * Menyimpan pengguna baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'exists:roles,id'],
            'unit_kerja_id' => ['nullable', 'exists:unit_kerjas,id', 'required_if:role_id,2'], // Wajib jika rolenya Admin
            'is_active' => ['nullable', 'boolean'],
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'unit_kerja_id' => $request->role_id == 2 ? $request->unit_kerja_id : null,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('superadmin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit pengguna.
     */
    public function edit(User $user)
    {
        $roles = Role::where('role_name', '!=', 'User')->get();
        $unitKerjas = UnitKerja::orderBy('unit_kerja_name')->get();
        return view('superadmin.users.edit', compact('user', 'roles', 'unitKerjas'));
    }

    /**
     * Memperbarui pengguna di database.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'exists:roles,id'],
            'unit_kerja_id' => ['nullable', 'exists:unit_kerjas,id', 'required_if:role_id,2'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'unit_kerja_id' => $request->role_id == 2 ? $request->unit_kerja_id : null,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('superadmin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna.
     */
    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('superadmin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
