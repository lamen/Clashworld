$("#logout").click(function(){
	$.ajax({
	type: "POST",
	dataType: "json",
	url: "/callback",
	data: "&objectToCall=Dregister"+
		"&methodToCall=callBackRegisterCheck",
	processData: false,
	error:function(msg){
		alert('ERRORMESSAGE:'+msg.responseText);
	},
	success:function(data){
			if(data['returntype']=='ok'){
				if(data['userid']>0){
					window.location = "http://"+window.location.host";
				}
			}else if(data['returntype']=='ko'){
				$("#errormessage").html(data['message']);
			}
		}
	});
});
