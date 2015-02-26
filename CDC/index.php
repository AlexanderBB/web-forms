<?php
	include_once  'lib/init.php';
        if($_GET['act']=='register'){new init('register');}else{
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Course poll card</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<style>
			.fixHeight{height:auto !important;}
			.fixWidth{width:115px !important;text-align: right;}
			.customDivHolder{width: 100%;padding-bottom: 5px;}
			.login-header{ font-size: 2em; margin-bottom: 10px; margin-top: -15px; color: #1abc9c; text-align: center;	border-bottom: 1px dashed #fff;	padding-bottom: 10px;}
		</style>
	</head>
	<body>
	<noscript>
		<div class="noscriptmsg" id="noscriptmsg">
		<table>
		<tr>
			<td colspan="3" style="text-align: center;"><img src="images/noscript_big.png" title="NoScript" alt="NoScript"></td>
		</tr>
		<tr>
			<td><div>&lt;noscript&gt;</div></td>
			<td><div style="background: grey;border: 3px solid black;color: white;text-shadow: 0px 0px 10px black;padding: 0px 10px;">
			<h1>WARNING!<br>
				The support of JavaScript in your browser is turned off.
			</h1>
			<h2>
			For the best experience  please turn on support for JavaScript in your browser.
			</h2>
			</div></td>
			<td><div>&lt;/noscript&gt;</div></td>
		</tr></table>
		</div>
	</noscript>

	<div class="container">
		<?php new init();?>
    </div>
	<!-- TODO: CLEAR THE UNUSED JS libs -->
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/jquery.ui.touch-punch.min.js"></script>
    <script src="js/flatui-radio.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/bootstrap-switch.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <!-- <script src="FLATUI/js/bootstrap.min.js"></script>-->
    <script src="js/flatui-checkbox.js"></script>
    <script src="js/flatui-radio.js"></script>
    <script src="js/jquery.tagsinput.js"></script>
    <script src="js/jquery.placeholder.js"></script>
    <script src="js/jquery.stacktable.js"></script>
    <!-- <script src="http://vjs.zencdn.net/c/video.js"></script>-->
    <script src="js/application.js"></script>
    <!-- Custom JavaScript functions -->
    <script src="js/_custom.inc.js"></script>
	</body>
</html>
        <?php }?>