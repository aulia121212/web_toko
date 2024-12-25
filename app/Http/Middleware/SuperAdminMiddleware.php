// app/Http/Middleware/SuperAdminMiddleware.php

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->level === 'super_admin') {
            return $next($request);
        }

        // Redirect ke route yang TIDAK memerlukan autentikasi
        return redirect('/'); //  Atau route lain yang tidak dilindungi 'auth'
    }
}


