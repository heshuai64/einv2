<?php
	session_start();
	if(empty($_SESSION['user_name'])){
		header('Location: login.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="../ext-3.2.0/resources/css/ext-all.css" />
		<link rel="stylesheet" type="text/css" href="css/uploadify.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" />
                <!-- GC -->
	 	<!-- LIBS -->
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
	 	<script type="text/javascript" src="../ext-3.2.0/adapter/jquery/ext-jquery-adapter.js"></script>
	 	<!-- ENDLIBS -->
		<script type="text/javascript" src="../ext-3.2.0/ext-all.js"></script>
		<script type="text/javascript" src="zh_cn.js"></script>
		<script type="text/javascript" src="js/swfobject.js"></script>
		<script type="text/javascript" src="js/jquery.uploadify.v2.1.4.min.js"></script>
		<script type="text/javascript" src="js/jquery.lightbox-0.5.min.js"></script>
		<?php
			if($_SESSION['role'] == 1 || $_SESSION['role'] == 2){
		?>
			<script type="text/javascript" src="research.js"></script>
		<?php
			}else{
		?>
			<script type="text/javascript" src="purchase.js"></script>
		<?php
			}
		?>
	</head>
    <body>
        <div id="xx"></div>
    </body>
</html>
    