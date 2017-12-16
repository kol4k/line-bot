<?php

namespace App\Http\Library;

use App\Http\Library\DictionaryLib;

class SensorWord 
{
    /**
     * @var DictionaryLib
     */
    private $dictionaryLib;

    /**
    * function for search word
    */
    public function whereWords($request)
    {
        $harsh = ['anjing','goblok','setan','siamah','anju'];
        $soft = [
            "Sesungguhnya tidak ada sesuatu apapun yang paling berat ditimbangan kebaikan seorang mu'min pada hari kiamat seperti akhlaq yang mulia, dan sungguh-sungguh (benar-benar) Allāh benci dengan orang yang lisānnya kotor dan kasar.(Hadīts Riwayat At Tirmidzi nomor 2002, hadīts ini hasan shahīh, lafazh ini milik At Tirmidzi, lihat Silsilatul Ahādīts Ash Shahīhah no 876)"
        ];

        if (in_array($request, $harsh)) {
            return;
        }
    }
}