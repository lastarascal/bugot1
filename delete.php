<?
if(isset($_GET['del'])){
if(file_exists('install.php')){
	unlink('install.php');
	echo 'File install.php deleted...!!!';
}
}
?>