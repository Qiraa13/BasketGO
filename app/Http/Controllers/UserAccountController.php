<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function destroy(Request $request)
{
    $user = $request->user();

    auth()->logout();

    $user->delete();

    return redirect('/')->with('success', 'Akun berhasil dihapus.');
}

}
