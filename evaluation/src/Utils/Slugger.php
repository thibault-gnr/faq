<?php

 namespace App\Utils;

 class Slugger{

     public function sluggify($strToConvert){

         $convertedString = preg_replace( '/[^a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*/', '-', strtolower(trim(strip_tags($strToConvert))));

         return $convertedString;
     }
 }