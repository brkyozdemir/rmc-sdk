<?php

namespace Scoutium\RMC\API;

use Illuminate\Support\Facades\Http;
use Scoutium\RMC\API\RMCMessage;

class SMSChannel extends RMCMessage
{
    const SEND_SINGLE_SHOT_SMS_PATH = '/api/PostSms/SingleShotSms';

    const SINGLE_SHOT = 'single_shot';

    const SMS_CHANNELS = [
        self::SINGLE_SHOT => self::SEND_SINGLE_SHOT_SMS_PATH,
    ];

    public static function sendPushNotification(
        $originator,
        $numberMessagePair,
        $beginTime,
        $smsChannel = null,
    )
    {
        $smsChannel = $smsChannel ?? self::SINGLE_SHOT;
        $originator = $originator ?? config('rmc.sms.originator');
        $serviceTicket = self::getAuthToken();

        $pnRequestUrl = config('rmc.platform') . self::SMS_CHANNELS[$smsChannel];
        Http::withHeaders([
            'Authorization' => $serviceTicket,
        ])->post($pnRequestUrl, [
            'Originator' => $originator,
            'NumberMessagePair' => $numberMessagePair,
            'BeginTime' => $beginTime,
        ]);
    }
}