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
recursiveRemoveDirectory('sitemap');
mkdir("sitemap");
$fp       = fopen('sitemap/index.php', "w");
fwrite($fp, '');
fclose($fp);
?>