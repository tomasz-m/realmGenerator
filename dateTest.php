
<?php

$formats = array(
        "Y-m-d",
        "Y-m-d H:i",
        "Y-m-d H:i:s",
        "Y-m-d H:iZ",
        'Y-m-d\TH:i:s.uO', //ok
        'Y-m-d\TH:i:s', //ok
        'Y-m-d\TH:i:s.u', //ok
        'Y-m-d\TH:i:s.O', //ok
        "m/d/Y H:i:s",
        "d/m/Y H:i:s",
        "d/m/Y H:i",
        "d/m/Y",
        "d.m.Y", 
        "d.m.Y H:i:s",
        "d.m.Y H:i",
        "d-m-Y",
        "d-m-Y H:i:s",
        "d-m-Y H:i");

function isDate($dateString) {


   if(IsNullOrEmptyString($dateString))
       return FALSE;
   if(!is_numeric (substr($dateString,0,1)))
       return FALSE;

   global $formats;
   foreach ($formats as $format)
   {
      $date = DateTime::createFromFormat($format, $dateString);
      if ($date == false){
          
      }else{
         return TRUE;
      }
   }
   return FALSE;
}

function IsNullOrEmptyString($question){
    return (!isset($question) || trim($question)==='');
}

?>
