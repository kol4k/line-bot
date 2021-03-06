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
    public $apiUrl = 'https://translate.yandex.net/api/v1.5/tr.json/translate?lang=id-en&key=trnsl.1.1.20171216T092715Z.18943ca79fdb501d.84c04771f13b9fc5fad54f2d9084479cb942eb7a&text=';
    
    public function replySend($formData)
    {
        $replyToken = $formData['events']['0']['replyToken'];
        $api = 'trnsl.1.1.20171216T092715Z.18943ca79fdb501d.84c04771f13b9fc5fad54f2d9084479cb942eb7a';
        $service_url = 'https://translate.yandex.net/api/v1.5/tr.json/translate?lang=id-en&key='.$api.'&text='.$replyToken;
        $json = file_get_contents($service_url);
        $obj = json_decode($json); 
        $text = $obj->text; 
        
        
        $this->client = new CurlHTTPClient(env('LINE_BOT_ACCESS_TOKEN'));
        $this->bot = new LINEBot($this->client, ['channelSecret' => env('LINE_BOT_SECRET')]);
        
        $response = $this->bot->replyText($replyToken, $text[0]);
        
        if ($response->isSucceeded()) {
            logger("reply success!!");
            return;
        }
      echo $text; 
    }
}