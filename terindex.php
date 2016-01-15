<?php
clearstatcache();
    if ($handle = opendir('post/')) {
		$jumlah = 0;
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $jumlah = $jumlah+1;
            }
        }
	
echo 'Terindex: '.$jumlah.'<br /><br />';
        closedir($handle);
   }
$files = scandir('post');	
foreach ($files as $file){
	echo $file.'<br />';
}
?>