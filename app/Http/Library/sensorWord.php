<?php

namespace App\Http\Library;

use App\Http\Library\DictionaryLib;

class SensorWord 
{
    /**
     * @var DictionaryLib
     */
    // private $dictionaryLib;

    /**
    * function for search word
    */
    public function whereWords()
    {
        $dictionaryLib = $this->app->make('App\Http\Library\DictionaryLib');
        if (in_array('anjing',$dictionaryLib->dicLib()->harsh)) {
            echo "ok";
        } else {
            echo "fail";
        }
    }
}