<?php

namespace Scoutium\RMC\API;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

abstract class RMCMessage
{
    private const RETRIEVE_SERVICE_TICKET_PATH = '/api/auth/login';
    private const RMC_SERVICE_TICKET_CACHE_KEY = 'service:rmc:service_ticket';

    protected static function getAuthToken()
    {
        return Cache::remember(self::RMC_SERVICE_TICKET_CACHE_KEY, now()->addDay(), function () {
            $loginUrl = config('rmc.platform') . self::RETRIEVE_SERVICE_TICKET_PATH;
            return Http::post($loginUrl, [
                'UserName' => config('rmc.username'),
                'Password' => config('rmc.password'),
            ])->json('ServiceTicket');
        });
    }
}