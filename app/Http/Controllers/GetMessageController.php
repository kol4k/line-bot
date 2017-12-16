<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetMessageRequest;
use App\Http\Services\GetMessageService;
use App\Http\Library\SensorWord;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;


class GetMessageController
{
    /**
     * @var GetMessageService
     */
    private $messageService;
    
    /**
     * GetMessageController constructor.
     * @param GetMessageService $messageService
     */
    public function __construct(GetMessageService $messageService)
    {
        $this->messageService = $messageService;
    }
    
    public function getMessage(GetMessageRequest $request)
    {
        //logger("request : ", $request->all());
        $this->messageService->replySend($request->json()->all());
    }

    public function test()
    {
        $api = 'trnsl.1.1.20171216T092715Z.18943ca79fdb501d.84c04771f13b9fc5fad54f2d9084479cb942eb7a';
        $service_url = 'https://translate.yandex.net/api/v1.5/tr.json/translate?lang=id-en&key='.$api.'&text=apa';
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }

        curl_close($curl);
        echo 'test'.$curl_response[0]->text;
      echo print_r($curl_response);
    }
}