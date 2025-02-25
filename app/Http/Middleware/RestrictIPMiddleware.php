<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use IPLib\Factory;
use IPLib\Range\Subnet;

class RestrictIPMiddleware
{
    /**
     * Endereços de IP permitidos
     *
     * @var array
     */
    private $allowedIps = [
        '187.19.149.0/24', // IPv4 da APAE e outras 254 redes
        '2804:29b8:5004:bda::/64', // IPv6 da APAE que pode mudar
        '2804:29b8:5004:792e::/64',
    ];

    private $allowedSingleIps = [
        '127.0.0.1', // IPv4 localhost
        '187.19.149.22', 
    ];

    public function handle(Request $request, Closure $next)
    {
        $clientIp = $request->ip();
        // dd($clientIp); // Validação
        
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

    /**
     * Verifica se um IP está dentro de uma faixa permitida.
     */
    private function ipInRange($ip, $range)
    {
        $subnet = Subnet::fromString($range); // Correção aqui
        $address = Factory::addressFromString($ip);

        if ($subnet && $address) {
            return $subnet->contains($address);
        }

        return false;
    }
}