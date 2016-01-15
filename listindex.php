<?php
clearstatcache();
    if ($handle = opendir('home/')) {
		$jumlah = 0;
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $jumlah = $jumlah+1;
            }
        }
	
echo 'Terindex: '.$jumlah.'<br /><br />';
        closedir($handle);
   }
$files = scandir('home');	
foreach ($files as $file){
	echo $file.'<br />';
}
?>