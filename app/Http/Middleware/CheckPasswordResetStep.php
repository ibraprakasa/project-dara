<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;

// class CheckPasswordResetStep
// {
//     public function handle(Request $request, Closure $next)
//     {
//         // Tentukan langkah-langkah yang valid dalam proses reset password
//         $validSteps = ['lupapassword1', 'lupapassword2', 'lupapassword3'];

//         // Dapatkan langkah saat ini dari URL
//         $currentStep = $request->segment(1); // Ini akan mengambil bagian pertama dari URL

//         // Periksa apakah langkah saat ini adalah langkah yang valid
//         if (in_array($currentStep, $validSteps)) {
//             // Periksa apakah pengguna telah melalui langkah-langkah sebelumnya
//             $currentStepIndex = array_search($currentStep, $validSteps);

//             for ($i = 0; $i < $currentStepIndex; $i++) {
//                 $step = $validSteps[$i];

//                 if (!$request->session()->has('password_reset_' . $step)) {
//                     // Jika langkah sebelumnya belum selesai, arahkan ke halaman login
//                     return redirect()->route('login');
//                 }
//             }
//         } else {
//             // Jika langkah saat ini tidak valid, arahkan ke halaman login
//             return redirect()->route('login');
//         }

//         // Lanjutkan ke langkah berikutnya jika semuanya valid
//         return $next($request);
//     }

