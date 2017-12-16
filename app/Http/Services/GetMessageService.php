<?php

namespace App\Http\Services;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use App\Http\Library\DictionaryLib;

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
    /**
     * @var DictionaryLib
     */
    private $dicLib;
    
    public function __construct(DictionaryLib $dicLib)
    {
        $this->dicLib = $dicLib;
    }
    
    public function replySend($formData)
    {
        $replyToken = $formData['events']['0']['replyToken'];
        
        $harsh = ['anjing','goblok','setan','siamah','anju'];

        $this->client = new CurlHTTPClient(env('LINE_BOT_ACCESS_TOKEN'));
        $this->bot = new LINEBot($this->client, ['channelSecret' => env('LINE_BOT_SECRET')]);
        if (in_array($replyToken, $harsh)) {
            $response = $this->bot->replyText($replyToken, 'sia tong ngomong kasar!');
            return $response;
        }
        if ($response->isSucceeded()) {
            logger("reply success!!");
            return;
        }
        return $response;
    }
}