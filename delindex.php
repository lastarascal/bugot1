<?
clearstatcache();
function recursiveRemoveDirectory($directory)
{
    foreach(glob("{$directory}/*") as $file)
    {
        if(is_dir($file)) { 
            recursiveRemoveDirectory($file);
        } else {
            unlink($file);
        }
    }
    rmdir($directory);
}
recursiveRemoveDirectory('home');
mkdir("home");
$fp       = fopen('home/index.php', "w");
fwrite($fp, '');
fclose($fp);
?>