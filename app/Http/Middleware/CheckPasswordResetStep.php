<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;

// class CheckPasswordResetStep
// {
//     public function handle(Request $request, Closure $next, $step)
//     {
//         $expectedStep = $step;

//         $previousSteps = ['lupapassword1', 'lupapassword2'];

//         if (in_array($expectedStep, $previousSteps)) {
//             foreach ($previousSteps as $previousStep) {
//                 if ($request->session()->has('password_reset_' . $previousStep)) {
//                     return $next($request);
//                 }
//             }
//         }

//         // Jika belum, arahkan mereka kembali ke halaman awal yang sesuai
//         return redirect()->route('login');
//     }
// }
