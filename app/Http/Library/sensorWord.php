<?php

namespace App\Http\Library;

use App\Http\Library\DictionaryLib;

class SensorWord 
{
    /**
     * @var DictionaryLib
     */
    private $dictionaryLib;

    public function __construct(DictionaryLib $dictionaryLib)
    {
        $this->dictionaryLib = $dictionaryLib;
    }

    /**
    * function for search word
    */
    public function whereWords()
    {
        if (in_array('anjing', $this->dictionaryLib->dicLib->harsh)) {
            echo "ok";
        } else {
            echo "fail";
        }
    }
}