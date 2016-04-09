<?php
session_start();
	if(!$_SESSION)
		header('Location:login.html');
	else
		{
			$id = $_SESSION["id"];
			$servername = "localhost";
			$username = "root";
			$password = "";
			$db = "chatall";
			$conn = mysqli_connect($servername, $username, $password,$db);
			if(mysqli_connect_error()) 
			{
    		die("Database connection failed: " . mysqli_connect_error());
			}
			$sql = "update users set status = 1 where username = '$id' ";
			mysqli_query($conn,$sql);
		}	
?>
<!doctype html>
<html>

<head>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.websocket.js"></script>
<link href="img/icon.jpg" rel="shortcut icon">

<title>ChatsAll</title>
</head>

<style>
.messages
{
	height:450px;
	width:700px;
	margin-right: auto; 
	margin-left: auto;
	opacity:.7;
	background-color:#FCFB98;
}
input
{
	font-family: 'Marck Script',cursive;
}
.system_msg{color: #BDBDBD;font-style: italic;}
</style>

<body>
	
    <table align="center" cellpadding="2px">
    	<tr align="center">
    		<td>
        	<input id="msg" style="width:500px;height:30px" type="text" placeholder="enter your message"></textarea>
        	<input type="button" id="send" value="Send" style="width:70px;height:38px">
            <input type="button" value="Leave" id="leave" style="width:70px;height:38px">
        	</td>
    	</tr>
	</table>
    
    <div class="messages">
    </div>
    
</body>
<script>
$(document).ready(function(e) {
	
	var wsurl = "ws://localhost:9000/okchat/server.php"; 	
	websocket = new WebSocket(wsurl);
	websocket.onopen = function(ev) { 
		$('.messages').append('<div class="system_msg">connected</div>');
	}
	
	$("#send").click(function() {
        var msg = $("#msg").val();
		
		if(msg == "")
			{
				alert("enter message please!!");
				return;
			}
		
		else {	
				var mymsg = {
							name: "<?php echo $_SESSION["id"] ?>",
							message: msg
   						    };

		websocket.send(JSON.stringify(mymsg));
			}
	});
	
	websocket.onmessage = function(ev) {
										var rmsg = JSON.parse(ev.data);
										var umsg = rmsg.message;
										var uname = rmsg.name;
										$('.messages').append('<div>'+'<i><strong>'+uname+'</strong></i>:'+umsg+'</div>');	
										};
	
	websocket.onerror	= function(ev){$('.messages').append('<div>error in connection</div>');}; 
	websocket.onclose 	= function(ev){$('.messages').append('<div class="system_msg">connection closed</div>');}; 

});

</script>
</html>