<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function destroy(Request $request)
    {
        $user = Auth::user();

        Auth::logout(); // keluar dulu

        $user->delete(); // hapus data user dari PostgreSQL

        return redirect('/register')->with('success', 'Akun berhasil dihapus.');
    }
}
