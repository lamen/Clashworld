<?php

class Recaptcha{

  private $_recaptchaResponse=array();

  const RECAPTCHA_API_SERVER = 'http://www.google.com/recaptcha/api';
  const RECAPTCHA_API_SECURE_SERVER = 'https://www.google.com/recaptcha/api';
  const RECAPTCHA_VERIFY_SERVER = 'www.google.com';
  const PUB_KEY = '6LcEytASAAAAAFInTT5LGHww__jYFldKBNWtkGd6';
  const PRIV_KEY = '6LcEytASAAAAAHKrf1DQErCmRMzem-ZASsrwwHkD';

  /**
    * Calls an HTTP POST function to verify if the user's guess was correct
    * @param string $privkey
    * @param string $remoteip
    * @param string $challenge
    * @param string $response
    * @param array $extra_params an array of extra variables to post to the server
    * @return ReCaptchaResponse
    */
  public function recaptchaCheckAnswer($remoteip, $challenge, $response, $extra_params = array())
  {

	  if ($remoteip == null || $remoteip == '') {
		  die ("For security reasons, you must pass the remote ip to reCAPTCHA");
	  }
	  
	  //discard spam submissions
	  if ($challenge == null || strlen($challenge) == 0 || $response == null || strlen($response) == 0) {
		  $this->_recaptchaResponse['is_valid']=false;
		  $this->_recaptchaResponse['error']='incorrect-captcha-sol';
		  return $this->_recaptchaResponse;
	  }

	  $response = $this->_recaptchaHttpPost(self::RECAPTCHA_VERIFY_SERVER, "/recaptcha/api/verify",
					    array (
						  'privatekey' => self::PRIV_KEY,
						  'remoteip' => $remoteip,
						  'challenge' => $challenge,
						  'response' => $response
						  ) + $extra_params
					    );

	  $answers = explode ("\n", $response [1]);

	  if (trim ($answers [0]) == 'true') {
		  $this->_recaptchaResponse['is_valid']=true;
	  }
	  else {
		  $this->_recaptchaResponse['is_valid']=false;
		  $this->_recaptchaResponse['error'] = $answers[1];
	  }
	  return $this->_recaptchaResponse;

  }

  /**
  * Submits an HTTP POST to a reCAPTCHA server
  * @param string $host
  * @param string $path
  * @param array $data
  * @param int port
  * @return array response
  */
  private function _recaptchaHttpPost($host, $path, $data, $port = 80) {

	  $req = $this->_recaptchaQsencode($data);

	  $http_request  = "POST $path HTTP/1.0\r\n";
	  $http_request .= "Host: $host\r\n";
	  $http_request .= "Content-Type: application/x-www-form-urlencoded;\r\n";
	  $http_request .= "Content-Length: " . strlen($req) . "\r\n";
	  $http_request .= "User-Agent: reCAPTCHA/PHP\r\n";
	  $http_request .= "\r\n";
	  $http_request .= $req;

	  $response = '';
	  if( false == ( $fs = @fsockopen($host, $port, $errno, $errstr, 10) ) ) {
		  die ('Could not open socket');
	  }

	  fwrite($fs, $http_request);

	  while ( !feof($fs) )
		  $response .= fgets($fs, 1160); // One TCP-IP packet
	  fclose($fs);
	  $response = explode("\r\n\r\n", $response, 2);

	  return $response;
  }

  /**
  * Encodes the given data into a query string format
  * @param $data - array of string elements to be encoded
  * @return string - encoded request
  */
  private function _recaptchaQsencode($data) {
	  $req = "";
	  foreach ( $data as $key => $value )
		  $req .= $key . '=' . urlencode( stripslashes($value) ) . '&';

	  // Cut the last '&'
	  $req=substr($req,0,strlen($req)-1);
	  return $req;
  }

  /**
  * Gets the challenge HTML (javascript and non-javascript version).
  * This is called from the browser, and the resulting reCAPTCHA HTML widget
  * is embedded within the HTML form it was called from.
  * @param string $pubkey A public key for reCAPTCHA
  * @param string $error The error given by reCAPTCHA (optional, default is null)
  * @param boolean $use_ssl Should the request be made over ssl? (optional, default is false)

  * @return string - The HTML to be embedded in the user's form.
  */
  public function recaptchaGetHtml($error = null, $use_ssl = false)
  {

	  if ($use_ssl) {
		  $server = self::RECAPTCHA_API_SECURE_SERVER;
	  } else {
		  $server = self::RECAPTCHA_API_SERVER;
	  }

	  $errorpart = "";
	  if ($error) {
	    $errorpart = "&amp;error=" . $error;
	  }
	  return '<script type="text/javascript" src="'. $server . '/challenge?k=' . self::PUB_KEY . $errorpart . '"></script>

	  <noscript>
		  <iframe src="'. $server . '/noscript?k=' . self::PUB_KEY . $errorpart . '" height="300" width="500" frameborder="0"></iframe><br/>
		  <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
		  <input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
	  </noscript>';
  }

}

?>