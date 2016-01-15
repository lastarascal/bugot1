<?
header('Content-Type: application/xml');
if(file_exists('config.php')){
include ("config.php");
}
$urluri = $_SERVER['REQUEST_URI'];
preg_match('/xml\-sitemap\/(.*?)\.xml/', $urluri, $mt);
$xml = $mt[1].'.xml';

if(file_exists('sitemap/'.$xml)){
	$tampil = file_get_contents('sitemap/'.$xml);
	echo $tampil;
}else{

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM keyword";
$result = $conn->query($sql);
$arrow= array();
if ($result->num_rows > 0) {
	 while($row = $result->fetch_assoc()) {
		$arrow[] = $row['id'].'/'.$row['key'];
	 }
}

sort($arrow);
$sitemap = strtolower($_GET['sitemapkey']);
$split = $_GET['split'];
$str = $split*500;
$rstart = ($split*500)+1;
$rend   = ($split*500)+500;

$content = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="'.$siteurl.'/css-sitemap-single.xsl"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$x = 0;
foreach($arrow as $arterm){
	$firstabj = preg_replace('/(.*?)\//i','', $arterm);
	$firstabj = strtolower(substr($firstabj, 0 , 1));
	$start = strtotime("10 September 2000");
	$end = strtotime("22 July 2010");
	$timestamp = mt_rand($start, $end);
	$randomDate = date("Y-m-d", $timestamp);
	if( $firstabj == $sitemap){
		if($x>$str){
		if($rstart<=$rend){
		$content .= '<url><loc>'.$siteurl.'/'.preg_replace('/[^A-Za-z0-9\-\/\.]/', '', strtolower(str_replace(' ','-',$arterm))).'</loc><lastmod>'.$randomDate.'T04:30:36-04:00</lastmod><changefreq>Daily</changefreq><priority>1</priority></url>';
		}
		$rstart = $rstart+1;
		}
		$x = $x+1;
	}
}
$content .= '</urlset>';

$fp       = fopen('sitemap/'.$xml, "w");
fwrite($fp, $content);
fclose($fp);
echo $content;

}
?>