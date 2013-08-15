<?php

  $homepage = file_get_contents(dirname(dirname(__FILE__))."/include/language/login.trad");
  //echo $homepage;

  $oTestJson=json_decode($homepage);
  
  if( $oTestJson === FALSE) 'ca deconne !';
  else{
    var_dump($oTestJson);
    var_dump($oTestJson->mail->en);
  }

?>