<?php

namespace App\Http\Services;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

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
     * @var TranslatorAPI
     */
    protected $apiUrl = 'https://translate.yandex.net/api/v1.5/tr.json/translate?lang=in-id&key='.env('YANDEX_TRNSLTE').'&text=';
    
    public function replySend($formData)
    {
        $client = new Client(); 
        $replyToken = $formData['events']['0']['replyToken'];
        $response = $client->get($apiUrl.$replyToken);
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
        
        $client = new Client(); 
        $response = $client->get($apiUrl.'hanya');
        echo $response;
    }
}