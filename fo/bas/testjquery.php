<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Demo</title>
	
<style>
    a.test { font-weight: bold; }
</style>
	
	
  </head>
  <body>
    <a href="http://jquery.com/">jQuery</a>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script>

	$(document).ready(function(){
		$("a").click(function(event){
			//alert("As you can see, the link no longer took you to jquery.com");
			//event.preventDefault();
			//$("a").addClass("test");
			event.preventDefault();
			$(this).hide("slow");
		});
	});
    </script>
  </body>
</html>