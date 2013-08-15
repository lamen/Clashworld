$(document).ready(function(){
  $("#registerbutton").click(function(){
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "/callback",
      data: "&objectToCall=Dregister"+
	    "&methodToCall=callBackRegisterCheck"+
	    "&_param_email="+ $("#email").val()+
	    "&_param_password="+$("#password").val()+
	    "&_param_confirmpass="+$("#confirmpass").val()+
	    "&_param_pseudo="+$("#pseudo").val()+
	    "&_param_recaptcha_challenge_field="+$("#recaptcha_challenge_field").val()+
	    "&_param_recaptcha_response_field="+$("#recaptcha_response_field").val()+
		"&_param_faction="+$("#faction").val(),
      processData: false,
      error:function(msg){
	alert('ERRORMESSAGE:'+msg.responseText);
      },
      success:function(data){
	 
	if(data['returntype']=='ok'){
	  if(data['userid']>0){
	    window.location = "http://"+window.location.host+"/homegame";
	  }
	}else if(data['returntype']=='ko'){
	  $("#errormessage").html(data['message']);
	  Recaptcha.reload();
	}
      }
    });
  });
	//to define the recaptcha language
	var strstr=location.host;
	var searchstr=strstr.match(".fr");
	var recaptchalanguage='';
	if(searchstr=='.fr')
	{
		recaptchalanguage='fr';
	}
	else
	{
		recaptchalanguage='en';
	}
	//show recaptcha
	Recaptcha.create("6LcEytASAAAAAFInTT5LGHww__jYFldKBNWtkGd6", recaptcha_div, {
	theme: "red",lang : recaptchalanguage
	});
});