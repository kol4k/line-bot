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
    protected $apiUrl = 'https://translate.yandex.net/api/v1.5/tr.json/translate?lang=id-id&key=trnsl.1.1.20171216T092715Z.18943ca79fdb501d.84c04771f13b9fc5fad54f2d9084479cb942eb7a&text=';
    
    public function replySend($formData)
    {
        $client = new Client(); 
        $replyToken = $formData['events']['0']['replyToken'];
        $response = $client->get($apiUrl.$replyToken);
        
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