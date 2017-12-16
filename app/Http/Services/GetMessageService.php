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
            $response = $this->bot->replyText($replyToken, "Sesungguhnya tidak ada sesuatu apapun yang paling berat ditimbangan kebaikan seorang mu'min pada hari kiamat seperti akhlaq yang mulia, dan sungguh-sungguh (benar-benar) Allāh benci dengan orang yang lisānnya kotor dan kasar.(Hadīts Riwayat At Tirmidzi nomor 2002, hadīts ini hasan shahīh, lafazh ini milik At Tirmidzi, lihat Silsilatul Ahādīts Ash Shahīhah no 876)");
        }
        if ($response->isSucceeded()) {
            logger("reply success!!");
            return;
        }
    }
    
    public function test()
    {
        $class_helper = new \App\Http\Library\SensorWord;
        return $class_helper->whereWords()->harsh;
    }
}