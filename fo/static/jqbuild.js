  $("#SubButtonAddBuild").click(function(){
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "/callback",
      data: "&objectToCall=Dbuild"+
	    "&methodToCall=callBackAddBuild"+
	    "&_param_idbuild="+ $("#SelectBuild").val()+
	    "&_param_idcity="+$("#SelectCity").val()+
	    "&_param_number="+ $("#numberofbuild").val(),
      processData: false,
      error:function(msg){
	alert('ERRORMESSAGE:'+msg.responseText);
      },
      success:function(data){
	if(data['returntype']=='ok'){
	  if(data['lastid']>0){
	    window.location.reload();
	  }
	}else if(data['returntype']=='ko'){
	  $("#errormessage").html(data['message']);
	}
      }
    });
  });
