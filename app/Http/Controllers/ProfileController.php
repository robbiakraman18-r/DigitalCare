<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->load('pasien');

        return view('pasien.profile', compact('user'));
    }

    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->load('pasien');

        return view('pasien.edit-profil', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->update([
            'nama'    => 'required|string|max:100',
            'nik'     => 'required|string|max:20',
            'email'   => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'   => 'required|string|max:20',
            'address' => 'required|string|min:5',
            'gender'  => 'required|in:Male,Female',
        ]);

        $user->update([
            'nama'  => $request->nama,
            'email' => $request->email,
        ]);

        $user->pasien()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'nik'          => $request->nik,
                'phone_number' => $request->phone,
                'address'      => $request->address,
                'gender'       => $request->gender,
            ]
        );

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}