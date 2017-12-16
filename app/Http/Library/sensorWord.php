<?php

namespace App\Library;

use App\Http\Library\DictionaryLib;

class sensorWord 
{
    /**
     * @var DictionaryLib
     */
    private $dictionaryLib

    public function __construct(DictionaryLib $dictionaryLib)
    {
        $this->dictionaryLib = $dictionaryLib;
    }

    /**
    * function for search word
    */
    public function whereWords()
    {
        if (in_array('anjing', $this->dictionaryLib()->harsh)) {
            echo "ok";
        } else {
            echo "fail";
        }
    }
}