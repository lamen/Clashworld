$(document).ready(function(){
  $("#SubButton").click(function(){
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "/callback",
      data: "&objectToCall=Vlogin"+
	    "&methodToCall=callBackLoginCheck"+
	    "&_param_email="+ $("#email").val()+
	    "&_param_password="+$("#password").val(),
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
	}
      }
    });
  });
});