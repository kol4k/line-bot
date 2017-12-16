<?php

namespace App\Http\Library;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use Illuminate\Support\Facades\Cache;
use Storage;

class LineRepository
{
    /**
     * @var LINEBot
     */
    protected $bot;
    /**
     * @var HTTPClient
     */
    protected $client;

    public function __construct(Images $image)
    {
        $this->client = new CurlHTTPClient(env('LINE_BOT_ACCESS_TOKEN'));
        $this->bot = new LINEBot($this->client, ['channelSecret' => env('LINE_BOT_SECRET')]);
    }
}