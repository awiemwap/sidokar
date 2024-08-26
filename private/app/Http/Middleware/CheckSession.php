<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Alert;

class CheckSession
{
    public function handle($request, Closure $next)
    {
        $sessionStart = Session::get('session_start_time');

        if ($sessionStart && now()->diffInMinutes($sessionStart) > 10) {
            // Sesuatu yang perlu dilakukan jika batas waktu sesi terlampaui
            // Contohnya, keluarkan pengguna atau lakukan tindakan lainnya
            Session::flush();
            Alert::warning('Selesai','Sesi Anda telah berakhir');
            return redirect('/login');//->with('error', 'Sesi Anda telah berakhir.');
        }

        // Perbarui waktu sesi
        Session::put('session_start_time', now());

        return $next($request);
    }
}

