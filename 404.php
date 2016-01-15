<?
include('config.php');
function batasChar($isine, $batas) {
        if (strlen($isine) <= $batas) {
            return $isine;
        } else {
            $hasilee = substr($isine, 0, $batas);
            return $hasilee . "...";
        }
    }
function ParseSpinText($s) {
        preg_match('#{(.+?)}#is',$s,$m);
        if(empty($m)) return $s;
     
        $t = $m[1];
     
        if(strpos($t,'{')!==false){
                $t = substr($t, strrpos($t,'{') + 1);
        }
     
        $parts = explode("|", $t);
        $s = preg_replace("+{".preg_quote($t)."}+is", $parts[array_rand($parts)], $s, 1);
     
        return ParseSpinText($s);
    }
function random($panjang)
{
   $pengacak = '123456789';
   $string = '';
   for($i = 0; $i < $panjang; $i++) {
   $pos = rand(0, strlen($pengacak)-1);
   $string .= $pengacak{$pos};
   }
    return $string;
}	
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM `keyword` ORDER BY RAND() LIMIT 70";
$result = $conn->query($sql);

$contents = '';
$rside = '';
$iside = '';
$blside = '';
$bcside = '';
$brside = '';
$description = '';
if($result->num_rows > 0){
	$i = 0;
	$postnum = 30501;
	while($row = $result->fetch_assoc()){
	$id = trim($row['id']);
	$titles = trim($row['key']);
	$title = ucwords(str_replace(array('-','.html'),array(' ',''), $titles));
	$titleurl = str_replace(' ','-', $titles);
	$titleurl = preg_replace('/[^a-zA-Z0-9-\.]/','',$titleurl);
	//$imageurl = $siteurl.'/'.$id.'/300/'.$titleurl.'.jpg';
	if( $i < 11 ){
		/*$item = json_decode(file_get_contents('http://www.lastareadatacenter.xyz/query.php?key=area51ealldie&token=08051990&asin='.$id));
		$contents .= '<article id="post-'.$postnum.'" class="box-post ktz-archive post-'.$postnum.' post type-post status-publish format-standard has-post-thumbnail hentry"><h2 class="entry-title"><a href="'.$siteurl.'/'.$id.'/'.$titleurl.'" title="'.$title.'" rel="bookmark">'.$title.'</a></h2><div class="meta-post"></div><div class="entry-body media"><div class="clearfix"><div class="ktz-featuredimg"><a href="'.$siteurl.'/'.$id.'/'.$titleurl.'"><img width="560" height="386" src="'.$item->books[0]->image.'" class="attachment-full wp-post-image" alt="'.$title.'" /></a></div></div><div class="media-body ktz-post">'.batasChar($item->books[0]->description, 250).'</div></div></article>';*/
		$i++;
		$postnum++;
	}elseif( $i < 21){
		$rside .= '<li><a href="'.$siteurl.'/'.$id.'/'.$titleurl.'" title="'.$title.'">'.ucwords($title).'</a></li>';
		$i++;
	}elseif( $i < 27 ){		
		$item = json_decode(file_get_contents('http://www.lastareadatacenter.xyz/query.php?key=area51ealldie&token=08051990&asin='.$id));
		$iside .= '<li class="ktz-widgetcolor"><a href="'.$siteurl.'/'.$id.'/'.$titleurl.'" title="'.$title.'"><img src="'.$item->books[0]->image.'" alt="'.$title.'" class="media-object ktz-lazyload" width="200" height="125"/></a></li>';
		$i++;
	}elseif( $i < 37 ){
		$blside .= '<li><a href="'.$siteurl.'/'.$id.'/'.$titleurl.'" title="'.$title.'">'.ucwords($title).'</a></li>';
		$i++;
	}elseif( $i < 47 ){
		$bcside .= '<li><a href="'.$siteurl.'/'.$id.'/'.$titleurl.'" title="'.$title.'">'.ucwords($title).'</a></li>';
		$i++;
	}elseif( $i < 57 ){
		$brside .= '<li><a href="'.$siteurl.'/'.$id.'/'.$titleurl.'" title="'.$title.'">'.ucwords($title).'</a></li>';
		$i++;
	}else{
		break;
	}
	}
}
$conn->close();
?>
<!DOCTYPE html>
<!--[if IE 7]><html class="ie7 no-js"  lang="en-US" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" prefix="og: http://ogp.me/ns#"<![endif]-->
<!--[if lte IE 8]><html class="ie8 no-js"  lang="en-US" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" prefix="og: http://ogp.me/ns#"<![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie no-js" lang="en-US" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" prefix="og: http://ogp.me/ns#"><!--<![endif]-->

<head>

	<meta charset="UTF-8" />
	
	<!-- Meta responsive compatible mode on IE and chrome, and zooming 1 by kentooz themes -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- mobile optimized meta by kentooz themes -->
	<meta name="HandheldFriendly" content="True" />
	<meta name="MobileOptimized" content="320" />

	<!-- Title by kentooz themes -->
	<title><?=$sitename;?> - <?=$sitedesc;?></title>
	
	
<!-- This site is optimized with the Yoast SEO plugin v2.3.2 - https://yoast.com/wordpress/plugins/seo/ -->
<meta name="robots" content="noindex, nofollow">
<meta name="description" content="<?=$sitedesc;?>"/>
<meta name="keywords" content="<?=$sitekey;?>"/>
<link rel="canonical" href="<?=$siteurl;?>" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?=$sitename;?> - <?=$sitedesc;?>" />
<meta property="og:description" content="<?=$sitedesc;?>" />
<meta property="og:url" content="<?=$siteurl;?>" />
<meta property="og:site_name" content="<?=$sitename;?>" />
<script type='application/ld+json'>{"@context":"http:\/\/schema.org","@type":"WebSite","url":"http:\/\/<?php echo str_replace('http://','',$siteurl);?>\/","name":"<?php echo $sitename;?>","potentialAction":{"@type":"SearchAction","target":"http:\/\/<?php echo str_replace('http://','',$siteurl);?>\/?s={search_term_string}","query-input":"required name=search_term_string"}}</script>
<!-- / Yoast SEO plugin. -->

<!--
<link rel="alternate" type="application/rss+xml" title="<?=$sitename;?> &raquo; Feed" href="<?=$siteurl;?>/feed/" />
<link rel="alternate" type="application/rss+xml" title="<?=$sitename;?> &raquo; Comments Feed" href="<?=$siteurl;?>/comments/feed/" />
-->
<link rel='stylesheet' id='ktz-bootstrap-min-css'  href='<?=$siteurl;?>/css/bootstrap.min.css' type='text/css' media='screen, projection' />
<link rel='stylesheet' id='ktz-main-css-css'  href='<?=$siteurl;?>/css/style.css' type='text/css' media='all' />
<link rel="stylesheet" href="<?=$siteurl;?>/font-awesome-4.5.0/css/font-awesome.min.css">
<script type='text/javascript' src='<?=$siteurl;?>/js/modernizr-2.6.2-respond-1.3.0.min.js'></script>
<script type='text/javascript' src='<?=$siteurl;?>/js/jquery.js'></script>
<script type='text/javascript' src='<?=$siteurl;?>/js/jquery-migrate.min.js'></script>
<!--
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?=$siteurl;?>/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?=$siteurl;?>/wlwmanifest.xml" /> 
-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:light,lightitalic,regular,regularitalic,600,600italic,bold,bolditalic,800,800italic' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="<?=$siteurl;?>/favicon.ico" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<!--<link rel="pingback" href="<?=$siteurl;?>/xmlrpc.php" />-->
<style type="text/css" media="screen">body{background:#eee    ;font-family:"Open Sans",sans-serif;font-size:14px;font-style:normal;color:#222;}.ktz-mainheader{background:#fff    ;}.ktz-allwrap{margin:20px auto 40px auto;width:100%;max-width:900px;}@media only screen and (max-width: 992px) {.ktz-allwrap {width:90%;}}.ktz-logo h1.homeblogtit a,.ktz-logo h1.homeblogtit a:visited,.ktz-logo h1.homeblogtit a:hover,.ktz-logo .singleblogtit a,.ktz-logo .singleblogtit a:hover,.ktz-logo .singleblogtit a:active,.ktz-logo .singleblogtit a:focus,.ktz-logo .singleblogtit a:visited {color:#222222}.ktz-logo .desc {color:#999999}h1,h2,h3,h4,h5,h6,.ktz-logo div.singleblogtit{font-family:"Open Sans", helvetica;font-style:normal;color:#2b2b2b;}a:hover,a:focus,a:active,#breadcrumbs-wrap a:hover,#breadcrumbs-wrap a:focus,a#cancel-comment-reply-link:hover{color:#9c832b;}.entry-content input[type=submit],.page-link a,input#comment-submit,.wpcf7 input.wpcf7-submit[type="submit"],.bbp_widget_login .bbp-login-form button,#wp-calendar tbody td:hover,#wp-calendar tbody td:hover a,.ktz-bbpsearch button,a.readmore-buysingle,input#comment-submit,.widget_feedburner,.ktz-readmore,.ktz-prevnext a{background:#9c832b;}.page-link a:hover{background:#4c4c4c;color:#ffffff;}.ktz-allwrap.wrap-squeeze,.tab-comment-wrap .nav-tabs>li.active>a,.tab-comment-wrap .nav-tabs>li.active>a:focus,.tab-comment-wrap .nav-tabs>li.active>a:hover,.tab-comment-wrap .nav-tabs>li>a:hover{border-color:#9c832b;}.ktz_thumbnail a.link_thumbnail,.owl-theme .owl-controls .owl-buttons .owl-prev span,.owl-theme .owl-controls .owl-buttons .owl-next span,.pagination > .active > a,.pagination > .active > span,.pagination > .active > a:hover,.pagination > .active > span:hover,.pagination > .active > a:focus,.pagination > .active > span:focus {background-color:#9c832b;}.pagination > .active > a,.pagination > .active > span,.pagination > .active > a:hover,.pagination > .active > span:hover,.pagination > .active > a:focus,.pagination > .active > span:focus{border-color:#9c832b #9c832b #9c832b transparent;}.ktz_thumbnail.ktz_thumbnail_gallery a.link_thumbnail {background-color: transparent;}</style>
</head>
<body class="home blog kentooz" id="top">
	
	<div class="ktz-allwrap">
	<header class="ktz-mainheader">
	<div class="header-wrap">
		<div class="container">
			<div class="clearfix">	
			<div class="ktz-logo"><h1 class="homeblogtit"><a href="<?=$siteurl;?>" title="<?=$sitename;?>"><?=$sitename;?></a></h1><div class="desc"><?=$sitedesc;?></div></div>			</div>
		</div>	
	</div>
	</header>
	
	<nav class="navbar navbar-default ktz-mainmenu" role="navigation">
	<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<div class="menu-categories-container"><ul id="menu-categories" class="nav navbar-nav">

<li id="menu-item-21499" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-21499 Home"><a href="<?=$siteurl;?>">&nbsp;Home</a></li>
<li id="menu-item-21497" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-21497 Contact"><a href="<?=$gform;?>">&nbsp;Contact</a></li>
<li id="menu-item-26213" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-26213 DMCA"><a href="<?=$siteurl;?>/dmca.php">&nbsp;DMCA</a></li>
<li id="menu-item-21498" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-21498 Privacy Policy"><a href="<?=$siteurl;?>/privacy-policy.php">&nbsp;Privacy Policy</a></li>
<li id="menu-item-21431" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-21431 Sitemap"><a href="<?=$siteurl;?>/xml-sitemap-index.xml">&nbsp;Sitemap Index</a></li>
</ul></div>    </div>
	</div>
	</nav>
				<div class="ktz-inner-content">
		<div class="container">
					</div>	
		<div class="container">
			<div class="row">
	<section class="col-md-12">
	<div class="row">
			<div role="main" class="main col-md-9">
		<section class="new-content">
		Error 404: Not Found
		</section>
		</div>
	<div class="sbars col-md-3 widget-area wrapwidget" role="complementary">
<aside id="random-search-terms2" class="widget pk_widget_random_terms2"><h4 class="widget-title"><span class="ktz-blocktitle">More Books</span></h4><ul><?=$rside;?></ul></aside><aside id="ktz-recent-posts-2" class="widget ktz_recent_post clearfix"><h4 class="widget-title"><span class="ktz-blocktitle">Best Books</span></h4><ul><?=$iside;?></ul></aside></div>
	</div>
	</section>
	</div> <!-- .row on head -->
	</div> <!-- .container on head -->
	</div> <!-- .ktz-inner-content head -->
	<footer class="footer">
	
	<div class="container">
		</div>
	
		<div class="wrapfootwidget">
		<div class="container">
			<div class="row"><div class="col-md-4 widget-area sbar" role="complementary"><aside id="random-search-terms" class="widget pk_widget_random_terms"><h4 class="widget-title"><span class="ktz-blocktitle">Random Books</span></h4><ul><?=$blside;?></ul></aside></div><div class="col-md-4 widget-area sbar" role="complementary"><aside id="recent-search-terms" class="widget widget_recent_terms"><h4 class="widget-title"><span class="ktz-blocktitle">Latest Viewed</span></h4><ul><?=$bcside;?></ul></aside></div><div class="col-md-4 widget-area sbar">		<aside id="recent-posts-3" class="widget widget_recent_entries">		<h4 class="widget-title"><span class="ktz-blocktitle">Latest Books</span></h4>		<ul><?=$brside;?></ul>
		</aside></div></div>		</div>
	</div>
		<div class="copyright">
	<nav class="ktz-footermenu">
		<div class="container">
			<div class="menu-pages-container"><ul id="footermenu" class="sf-menu"><li id="menu-item-21499" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21499"><a href="<?=$siteurl;?>">Home</a></li>
<li id="menu-item-21497" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21497"><a href="<?=$gform;?>">Contact</a></li>
<li id="menu-item-26213" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-26213"><a href="<?=$siteurl;?>/dmca.php">DMCA</a></li>
<li id="menu-item-21498" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21498"><a href="<?=$siteurl;?>/privacy-policy.php">Privacy Policy</a></li>
<li id="menu-item-21431" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21431"><a href="<?=$siteurl;?>/xml-sitemap-index.xml">Sitemap Index</a></li>
</ul></div>		</div>	
	</nav>
		<div class="container">
				<div class="footercredits pull-left">&copy; 2015 <a href="<?=$siteurl;?>/"><?=$sitename;?></a> - <?=$sitedesc;?> </div></div>
	</div>
	</footer>
	</div> <!-- .all-wrapper on head -->
	<div id="ktz-backtotop"><a href="#"><span class="fontawesome ktzfo-double-angle-up"></span><br />Top</a></div>
	
	<script type="text/javascript">
	FB.XFBML.parse();
	</script>
	<script type='text/javascript' src='<?=$siteurl;?>/js/jsscript.min.js'></script>
<!--<script type='text/javascript'>
var ktz_ajax_data = {"ajax_url":"http:\/\/<?php echo str_replace('http://','',$siteurl);?>\/wp-admin\/admin-ajax.php","codes":{"SUCCESS":1,"PREVIOUSLY_VOTED":0,"REQUEST_ERROR":2,"UNKNOWN":-1},"messages":{"success":"You've voted correctly","previously_voted":"You had previously voted","request_error":"The request was malformed, try again","unknown":"An unknown error has occurred, try to vote again"}};
</script>-->
<script type='text/javascript' src='<?=$siteurl;?>/js/rating.js'></script>
<script type='text/javascript' src='<?=$siteurl;?>/js/custom.main.js'></script>

<!-- Histats.com  START (hidden counter)-->
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="web stats" ><script  type="text/javascript" >
try {Histats.start(1,<?php echo $histatsid;?>,4,0,0,0,"");
Histats.track_hits();} catch(err){};
</script></a>
<noscript><a href="http://www.histats.com" target="_blank"><img  src="http://sstatic1.histats.com/0.gif?<?=$histatsid;?>&101" alt="web stats" border="0"></a></noscript>
<!-- Histats.com  END  -->
</body>
</html>
