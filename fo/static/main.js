WebFontConfig = {
google: { families: [ 'Simonetta::latin' ] }
};
(function() {
var wf = document.createElement('script');
wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
wf.type = 'text/javascript';
wf.async = 'true';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(wf, s);
})();

//hide show message div
$("#hidediv").click(function(){
$("#divpopup").hide();
});

$("#showdivmsg").click(function(){
$(".msgdiv").show();
$(".msgbackground").show();
});
//end

//hide show send:receive:trash box
$("#writebutton").click(function(){
$("#readbox").hide();
$("#writebox").show();
$("#trashbox").hide();
});

$("#readbutton").click(function(){
$("#readbox").show();
$("#writebox").hide();
$("#trashbox").hide();
});

$("#trashbutton").click(function(){
$("#readbox").hide();
$("#writebox").hide();
$("#trashbox").show();
});
//end

//logout button
$("#logout").click(function(){
$.ajax({
type: "POST",
dataType: "json",
url: "/callback",
data: "&objectToCall=Dheader"+
"&methodToCall=callBackLogOut",
processData: false,
error:function(msg){
alert('ERRORMESSAGE:'+msg.responseText);
},
success:function(data){
window.location = "http://"+window.location.host+"/homegame";
}
});
});
//end