<?php

namespace App\Http\Services;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use Yandex\Translate\Translator;
use Yandex\Translate\Exception;

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
     * @var Translator
     */
    
    
    public function replySend($formData)
    {
        $translator = new Translator(env('YANDEX_TRNSLTE'));
        $replyToken = $formData['events']['0']['replyToken'];
        $msgResponse = $translator->translate($replyToken, 'id-en');
        
        $this->client = new CurlHTTPClient(env('LINE_BOT_ACCESS_TOKEN'));
        $this->bot = new LINEBot($this->client, ['channelSecret' => env('LINE_BOT_SECRET')]);
        
        $response = $this->bot->replyText($replyToken, $msgResponse);
        
        if ($response->isSucceeded()) {
            logger("reply success!!");
            return;
        }
    }

    public function test()
    {
        $translator = new Translator(env('YANDEX_TRNSLTE'));
        $msgResponse = $translator->translate('ini hanya test', 'id-en');
        echo $msgResponse.'ok';
    }
}