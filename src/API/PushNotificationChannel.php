<?php

namespace Scoutium\RMC\API;

use Illuminate\Support\Facades\Http;
use Scoutium\RMC\API\RMCMessage;

class PushNotificationChannel extends RMCMessage
{
    private const SEND_PUSH_NOTIFICATION_PATH = '/api/PostPush/PostTransactionalPush';

    public static function sendPushNotification(
        $classificationName,
        $memberKey,
        $memberValue,
        $pushMessage,
        $applicationAlias = null,
    )
    {
        $applicationAlias = $applicationAlias ?? config('rmc.push_notification.application_alias');
        $serviceTicket = self::getAuthToken();

        $pnRequestUrl = config('rmc.platform') . self::SEND_PUSH_NOTIFICATION_PATH;
        Http::withHeaders([
            'Authorization' => $serviceTicket,
        ])->post($pnRequestUrl, [
            'ApplicationAlias' => $applicationAlias,
            'ClassificationName' => $classificationName,
            'MemberKey' => $memberKey,
            'MemberValue' => $memberValue,
            'PushMessage' => $pushMessage,
        ]);
    }
}