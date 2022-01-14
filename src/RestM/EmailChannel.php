<?php

namespace Scoutium\RMC\RestM;

use Illuminate\Support\Facades\Http;
use Scoutium\RMC\API\RMCMessage;

class EmailChannel extends RMCMessage
{
    private const SEND_EMAIL_PATH = '/api/post/PostHtml';

    public static function sendEmail(
        $subject,
        $htmlBody,
        $toName,
        $toEmailAddress,
        $fromName = null,
        $fromAddress = null,
        $replyAddress = null,
        $charSet = null,
        $postType = null,
        $keyId = null,
        $customParams = null,
    )
    {
        $fromName = $fromName ?? config('rmc.email.from.name');
        $fromAddress = $fromAddress ?? config('rmc.email.from.address');
        $replyAddress = $replyAddress ?? config('rmc.email.reply_address');
        $charSet = $charSet ?? config('rmc.email.char_set');
        $postType = $postType ?? config('rmc.email.post_type');
        $keyId = $keyId ?? config('rmc.email.key_id');
        $customParams = $customParams ?? config('rmc.email.custom_params');

        $serviceTicket = self::getAuthToken();

        $emailRequestUrl = config('rmc.platform') . self::SEND_EMAIL_PATH;
        Http::withHeaders([
            'Authorization' => $serviceTicket,
        ])->post($emailRequestUrl, [
            'FromName' => $fromName,
            'FromAddress' => $fromAddress,
            'ReplyAddress' => $replyAddress,
            'Subject' => $subject,
            'HtmlBody' => $htmlBody,
            'Charset' => $charSet,
            'ToName' => $toName,
            'ToEmailAddress' => $toEmailAddress,
            'PostType' => $postType,
            'KeyId' => $keyId,
            'CustomParams' => $customParams
        ]);
    }
}