<?php

namespace App\Http\Services;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class GetMessageService
{
    /**
     * @var LINEBot
     */
    private $bot;
    /**
     * @var HTTPClient
     */
    private $client;
    
    
    public function replySend($formData)
    {
        $class_helper = new \App\Http\Library\SensorWord;
        $replyToken = $formData['events']['0']['replyToken'];
        
        $this->client = new CurlHTTPClient(env('LINE_BOT_ACCESS_TOKEN'));
        $this->bot = new LINEBot($this->client, ['channelSecret' => env('LINE_BOT_SECRET')]);
        
        if (in_array($replyToken, $class_helper->whereWords()->harsh)) {
            $response = $this->bot->replyText($replyToken, $);
        }
        if ($response->isSucceeded()) {
            logger("reply success!!");
            return;
        }
    }
}