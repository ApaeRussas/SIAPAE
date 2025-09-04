<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use IPLib\Factory;
use IPLib\Range\Subnet;

class RestrictIPMiddleware
{
    private $allowedIps = [
        '187.19.149.0/24',
        '2804:29b8:5004:bda::/64',
        '2804:29b8:5004:792e::/64',
    ];

    private $allowedSingleIps = [
        '127.0.0.1',
        '187.19.149.22',
    ];

    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // 🔹 Libera automaticamente para admins
        if ($user && method_exists($user, 'isAdmin') && $user->isAdmin()) {
            return $next($request);
        }

        $clientIp = $request->ip();

        // Verifica se o IP está na lista de IPs únicos permitidos
        if (in_array($clientIp, $this->allowedSingleIps)) {
            return $next($request);
        }

        // Verifica se o IP está dentro das faixas permitidas
        foreach ($this->allowedIps as $allowedIp) {
            if ($this->ipInRange($clientIp, $allowedIp)) {
                return $next($request);
            }
        }

        // Se o IP não for permitido, retorna erro 403
        return response()->view('errors.403-IP', ['error' => 'Access denied']);
    }

    private function ipInRange($ip, $range)
    {
        $subnet = Subnet::fromString($range);
        $address = Factory::addressFromString($ip);

        if ($subnet && $address) {
            return $subnet->contains($address);
        }

        return false;
    }
}
