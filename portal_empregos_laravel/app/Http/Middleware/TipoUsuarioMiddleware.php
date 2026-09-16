<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TipoUsuarioMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $tipo)
    {
        $usuario = Auth::user();

        // Verifica se o usuário está autenticado (caso contrário, redireciona ele para a página de login)
        if (!$usuario) {
            return redirect()->route('login');
        }

        // Verifica se o tipo de usuário autenticado é diferente do tipo informado.
        if ($usuario->idTipoUsuario != $tipo) {
            abort(403, 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
