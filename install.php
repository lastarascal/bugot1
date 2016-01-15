<?
if(file_exists('error_log')){
	unlink('error_log');
}
if(file_exists('config.php')){
include('config.php');
}

$input = false;
$clear = false;
if(isset($_POST['servername']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['dbname']) && isset($_POST['siteurl']) && isset($_POST['sitename']) && isset($_POST['sitedesc']) && isset($_POST['sitekey']) && isset($_POST['histatsid']) && isset($_POST['gform']) && isset($_POST['adsid']) && isset($_POST['email']) && isset($_POST['limit'])){
$servername = $_POST['servername'];
$username = $_POST['username'];
$password = $_POST['password'];
$dbname = $_POST['dbname'];
$siteurl = $_POST['siteurl'];
$sitename = $_POST['sitename'];
$sitedesc = $_POST['sitedesc'];
$sitekey = $_POST['sitekey'];
$histatsid = $_POST['histatsid'];
$gform = $_POST['gform'];
$adsid = $_POST['adsid'];
$email = $_POST['email'];
$limit = $_POST['limit'];
$input = true;
}elseif(isset($_GET['clear'])){
$clear = true;
}else{
$pesan = '<font color="red">**)Semua form harus di isi...!</form>';
}
if($input === false && $clear === false){
if(file_exists('config.php')){
$isconfig = file_get_contents('config.php');
eval($isconfig);
}else{
$servername = "";
$username = "";
$password = "";
$dbname = "";
$siteurl = "";
$sitename = "";
$sitedesc = "";
$sitekey = "";
$histatsid = "";
$gform = "";
$adsid = "";
$email = "";
}
?>
<html><head><title>Instalation</title></head><body>
<form method="POST" action="">
<table>
<tr><td>Servername</td><td> : </td><td><input type="text" size="20" name="servername" value="<?=$servername;?>"/></td><td>*Database Server (ex: localhost)</td></tr>
<tr><td>Username</td><td> : </td><td><input type="text" size="20" name="username" value="<?=$username;?>"/></td><td>*Database User</td></tr>
<tr><td>Password</td><td> : </td><td><input type="text" size="20" name="password" value="<?=$password;?>"/></td><td>*Database Password</td></tr>
<tr><td>DB Name</td><td> : </td><td><input type="text" size="20" name="dbname" value="<?=$dbname;?>"/></td><td>*Database Name</td></tr>
<tr><td>Site URL</td><td> : </td><td><input type="text" size="20" name="siteurl" value="<?=$siteurl;?>"/></td><td>*Site URL (ex: http://blablabla.com)</td></tr>
<tr><td>Sitename</td><td> : </td><td><input type="text" size="20" name="sitename" value="<?=$sitename;?>"/></td><td>*Sitename (ex: Free Ebook)</td></tr>
<tr><td>Site Desc</td><td> : </td><td><input type="text" size="20" name="sitedesc" value="<?=$sitedesc;?>"/></td><td>*Site Description (ex: Tempat download buku gratis)</td></tr>
<tr><td>Site Keyw</td><td> : </td><td><input type="text" size="20" name="sitekey" value="<?=$sitekey;?>"/></td><td>*Site Keywords (ex: online book reading,mobile ebook,download ebook,latest ebook online)</td></tr>
<tr><td>Histats ID</td><td> : </td><td><input type="text" size="20" name="histatsid" value="<?=$histatsid;?>"/></td><td>*Histats HIDDEN ID</td></tr>
<tr><td>Contact Url</td><td> : </td><td><input type="text" size="20" name="gform" value="<?=$gform;?>"/></td><td>*Contact URL</td></tr>
<tr><td>Ads ID</td><td> : </td><td><input type="text" size="20" name="adsid" value="<?=$adsid;?>"/></td><td>*Ad-center Campaign ID</td></tr>
<tr><td>Email</td><td> : </td><td><input type="text" size="20" name="email" value="<?=$email;?>"/></td><td>*Email Contact</td></tr>
<tr><td>Limit Query</td><td> : </td><td><input type="text" size="20" name="limit" value=""/></td><td>*Batas Query</td></tr>
</table><br /><?=$pesan;?><br /><br />
<input type="submit" value="Input"/>

</form><br /><br /><br />
<a href="?clear=1"><input type="button" value="Clear Keyword Added"/></a>
</body></html>

<?
}else{
if($input === true){

$config = "<?\n";
$config .= "\$servername = \"" . $servername . "\";\n";
$config .= "\$username = \"" . $username . "\";\n";
$config .= "\$password = \"" . $password . "\";\n";
$config .= "\$dbname = \"" . $dbname . "\";\n";
$config .= "\$siteurl = \"" . $siteurl . "\";\n";
$config .= "\$sitename = \"" . $sitename . "\";\n";
$config .= "\$sitedesc = \"" . $sitedesc . "\";\n";
$config .= "\$sitekey = \"" . $sitekey . "\";\n";
$config .= "\$histatsid = \"" . $histatsid . "\";\n";
$config .= "\$gform = \"" . $gform . "\";\n";
$config .= "\$adsid = \"" . $adsid . "\";\n";
$config .= "\$email = \"" . $email . "\";\n";
$config .= "?>";

$fp       = fopen('config.php', "w");
fwrite($fp, $config);
fclose($fp);

try{
	$target = json_decode(file_get_contents("http://lastareadatacenter.xyz/getsitemap.php?key=area51ealldie&token=08051990&end=".$limit));
}catch(exception $e){
	exit();
}

$items = $target->sitemap;

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("<font color='red'>Connection failed: " . $conn->connect_error ."</font>");
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "<font color='green'>Database created successfully</font><br />";
} else {
    echo "<font color='red'>Error creating database: " . $conn->error."</font><br />";
}

$conn->close();
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "CREATE TABLE IF NOT EXISTS `keyword` (`id` varchar(255) NOT NULL default '', `key` varchar(255) NOT NULL default '', PRIMARY KEY  (`id`))";
if ($conn->query($sql) === TRUE) {
    echo "<font color='green'>Table created successfully</font><br />";
} else {
    echo "<font color='red'>Error creating table: " . $conn->error."</font><br />";
}

//$tot = 0;
$inid = array();
foreach($items as $item){
$artrm = array();
$artrm = explode("/", $item->url);
$id = $artrm[0];
$key = $artrm[1];
$pnj = strlen($id);
if( $pnj > 5 && $pnj < 11 ){
$inp[] = "('".$id."','".$key."')";
//$tot++;
}
}
$inp = array_unique($inp);
$tot = count($inp);
$inquery = implode(",", $inp);

$sql = "INSERT IGNORE INTO `keyword` (`id`,`key`) VALUES $inquery";
if($conn->query($sql) === TRUE){}else{
echo '<font color="red">Insert error '.mysqli_error($conn).'</font><br />';
}

$sql = "SELECT * FROM `keyword`";
$total = $conn->query($sql);
$count = mysqli_num_rows($total);


echo '<font color="blue">'.$tot.' keyword added.</font><br />';
echo 'Total keyword : '.$count.' <br /><br />';
echo '<a href="delete.php?del=1"><input type="button" value="Delete file install.php ??" name="delete"/></a>';
$conn->close();
}
if($clear === true){
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "DROP TABLE `keyword`";
if($conn->query($sql) === TRUE){
	echo '<font color="green">All Keywords Deleted</font>';
}else{
	echo "<font color='red'>Error deleting keywords: " . $conn->error."</font>";
}
}
}
?>