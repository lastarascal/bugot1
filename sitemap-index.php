<?
header('Content-Type: application/xml');
if(file_exists('config.php')){
include ("config.php");
}

if(file_exists('sitemap/xml-sitemap-index.xml')){
	$tampil = file_get_contents('sitemap/xml-sitemap-index.xml');
	echo $tampil;
}else{
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM keyword";
$result = $conn->query($sql);
$arrow= array();
if ($result->num_rows > 0) {
	 while($row = $result->fetch_assoc()) {
		$arrow[] = $row['key'];
	 }
}


$content = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="'.$siteurl.'/css-sitemap-index.xsl"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$arraykey = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
foreach($arraykey as $key){
	$x = 0;
	foreach( $arrow as $arterm ){
		//$firstabj = preg_replace('/(.*?)\//i','', $arterm);
		$firstabj = $arterm;
		$firstabj = strtolower(substr($firstabj, 0 , 1));
		if( $firstabj == $key){
			$x = $x+1;
		}
		}
		$numterm = $x/500;
		$nterm = ceil($numterm);
		for($i=0;$i<$nterm; ++$i){
			$start = strtotime("10 September 2000");
			$end = strtotime("22 July 2010");
			$timestamp = mt_rand($start, $end);
			$randomDate = date("Y-m-d", $timestamp);
			$content .= '<sitemap><loc>'.$siteurl.'/xml-sitemap/sitemap-'.$key.'-'.$i.'.xml</loc><lastmod>'.$randomDate.'T04:31:39-04:00</lastmod></sitemap>';
		}
	
}
/*foreach($arraykey as $key){
	$start = strtotime("10 September 2000");
	$end = strtotime("22 July 2010");
	$timestamp = mt_rand($start, $end);
	$randomDate = date("Y-m-d", $timestamp);
	echo '<sitemap><loc>'.$siteurl.'/xml-sitemap/sitemap-'.$key.'.xml</loc><lastmod>'.$randomDate.'T04:31:39-04:00</lastmod></sitemap>';
	
}*/
$content .= '</sitemapindex>';

$fp       = fopen('sitemap/xml-sitemap-index.xml', "w");
fwrite($fp, $content);
fclose($fp);

echo $content;
}
?>