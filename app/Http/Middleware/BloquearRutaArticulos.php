<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class BloquearRutaArticulos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Definir la fecha y hora de bloqueo y desbloqueo
        $fechaHoraBloqueo = Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-27 21:30:00');
        $fechaHoraDesbloqueo = Carbon::createFromFormat('Y-m-d H:i:s', '2024-02-29 09:59:00');

        // Obtener la fecha y hora actual
        $fechaHoraActual = Carbon::now();

        // Verificar si la fecha y hora actual está dentro del rango de bloqueo
        if ($fechaHoraActual->between($fechaHoraBloqueo, $fechaHoraDesbloqueo)) {
            // Si la fecha y hora actual está dentro del rango de bloqueo, devuelve un mensaje de bloqueo temporal más profesional y visualmente mejorado
            return response('<div style="text-align: center; background-color: #ffcccb; padding: 10px; border: 1px solid #f00;">Acceso temporalmente bloqueado. Por favor, inténtalo de nuevo más tarde.</div>', 403);
        }

        // Si la fecha y hora actual no está dentro del rango de bloqueo, permite el acceso a la ruta
        return $next($request);
    }
}
