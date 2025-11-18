<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class Role
{
 /**
 * Handle an incoming request.
 */
 public function handle(Request $request, Closure $next, $role): Response
 {
 if (!Auth::check()) {
 return redirect('/login');
 }
if ($request->user()->role !== $role) {
 abort(403, 'Unauthorized'); // jangan redirect ke /dashboard
 }
return $next($request);
 }
}