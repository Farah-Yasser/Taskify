<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class VerificationController extends Controller
{
public function verify(Request $request)
{
    $request->validate([
        'code' => ['required', 'string'],
    ]);

    $user = auth('web')->user();
    if ($user->verification_code == $request->code && $user->code_expires_at > now()) {
        $user->update([
            'is_verified'=> true,
            'verification_code'=> null,
            'code_expires_at'=> null
        ]);

        return redirect()->route('dashboard')->with('success', 'Your email has been verified.');
    }

return back()->withErrors(['code' => 'Invalid or expired verification code.']);
}

//     public function verify(Request $request)
// {
//     $request->validate([
//         'code' => ['required', 'string'],
//     ]);

//     $user = auth('web')->user();

//     dd($user);
// }
}
