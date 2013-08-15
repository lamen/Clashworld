<?php

  class Jsonresponse{

    function __construct(){
      header('Content-type: application/json');
    }

    public function response($sValueToRespond){
      echo(json_encode($sValueToRespond));
    }

  }

?>