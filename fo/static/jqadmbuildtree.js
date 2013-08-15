$(document).ready(function(){
  $("#menubutton").click(function(){
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "/callback",
      data: "&objectToCall=Vadmbuildtree"+
            "&methodToCall=callBackGetBuildArray"+
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

});
