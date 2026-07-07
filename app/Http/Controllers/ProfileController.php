<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $request->validate([
            'nama'         => 'required|string|max:60',
            'email'        => 'required|email|max:255|unique:users,email,' . $user->id,

            'nik'          => 'required|string|max:20|unique:pasiens,nik,' . optional($user->pasien)->id_pasien . ',id_pasien',
            'birth_date'   => 'required|date',
            'gender'       => 'required|in:Male,Female',
            'phone_number' => 'required|string|max:20',
            'address'      => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $user) {

            $user->update([
                'nama'  => $request->nama,
                'email' => $request->email,
            ]);

            $user->pasien()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nik'          => $request->nik,
                    'birth_date'   => $request->birth_date,
                    'gender'       => $request->gender,
                    'phone_number' => $request->phone_number,
                    'address'      => $request->address,
                ]
            );

        });

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}