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
	<title>Privacy Policy<?=$sitename;?></title>
	
	
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
		<p>We recognize that your privacy is important. This document outlines the types of personal information we receive and collect when you use , as well as some of the steps we take to safeguard information. We hope this will help you make an informed decision about sharing personal information with us.  strives to maintain the highest standards of decency, fairness and integrity in all our operations. Likewise, we are dedicated to protecting our customers', consumers' and online visitors' privacy on our website.</p>
			<p><strong>Personal Information</strong></p>
			<p> collects personally identifiable information from the visitors to our website only on a voluntary basis. Personal information collected on a voluntary basis may include name, postal address, email address, company name and telephone number.</p>
			<p>This information is collected if you request information from us, participate in a contest or sweepstakes, and sign up to join our email list or request some other service or information from us. The information collected is internally reviewed, used to improve the content of our website, notify our visitors of updates, and respond to visitor inquiries.</p>
			<p>Once information is reviewed, it is discarded or stored in our files. If we make material changes in the collection of personally identifiable information we will inform you by placing a notice on our site. Personal information received from any visitor will be used only for internal purposes and will not be sold or provided to third parties.</p>
			<p><strong>Use of Cookies and Web Beacons</strong></p>
			<p>We may use cookies to help you personalize your online experience. Cookies are identifiers that are transferred to your computer's hard drive through your Web browser to enable our systems to recognize your browser. The purpose of a cookie is to tell the Web server that you have returned to a specific page. For example, if you personalize the sites pages, or register with any of our site's services, a cookie enables  to recall your specific information on subsequent visits.</p>
			<p>You have the ability to accept or decline cookies by modifying your Web browser; however, if you choose to decline cookies, you may not be able to fully experience the interactive features of the site.</p>
			<p>A web beacon is a transparent image file used to monitor your journey around a single website or collection of sites. They are also referred to as web bugs and are commonly used by sites that hire third-party services to monitor traffic. They may be used in association with cookies to understand how visitors interact with the pages and content on the pages of a web site.</p>
			<p>We may serve third-party advertisements that use cookies and web beacons in the course of ads being served on our web site to ascertain how many times you've seen an advertisement. No personally identifiable information you give us is provided to them for cookie or web beacon use, so they cannot personally identify you with that information on our web site.</p>
			<p>Some third-party advertisements may be provided by Google, which uses cookies to serve ads on this site. Google uses the DART cookie, which enables it to serve ads to our users based on their visits to this site and other sites on the Web. You may opt out of the use of the DART cookie by visiting the Google ad and content network privacy policy.</p>
			<p>Browsers can be set to accept or reject cookies or notify you when a cookie is being sent. Privacy software can be used to override web beacons. Taking either of these actions shouldn't cause a problem with our site, should you so choose.</p>
			<p><strong>Children's Online Privacy Protection Act</strong></p>
			<p>This website is directed to adults; it is not directed to children under the age of 13. We operate our site in compliance with the Children's Online Privacy Protection Act, and will not knowingly collect or use personal information from anyone under 13 years of age.</p>
			<p><strong>Non-Personal Information</strong></p>
			<p>In some cases, we may collect information about you that is not personally identifiable. We use this information, which does not identify individual users, to analyze trends, to administer the site, to track users' movements around the site and to gather demographic information about our user base as a whole. The information collected is used solely for internal review and not shared with other organizations for commercial purposes.</p>
			<p><strong>Release of Information</strong></p>
			<p>If  is sold, the information we have obtained from you through your voluntary participation in our site may transfer to the new owner as a part of the sale in order that the service being provided to you may continue. In that event, you will receive notice through our website of that change in control and practices, and we will make reasonable efforts to ensure that the purchaser honors any opt-out requests you might make of us.</p>
			<p><strong>How You Can Correct or Remove Information</strong></p>
			<p>We provide this privacy policy as a statement to you of our commitment to protect your personal information. If you have submitted personal information through our website and would like that information deleted from our records or would like to update or correct that information, please use our Contact Us page.</p>
			<p><strong>Updates and Effective Date</strong></p>
			<p> reserves the right to make changes in this policy. If there is a material change in our privacy practices, we will indicate on our site that our privacy practices have changed and provide a link to the new privacy policy. We encourage you to periodically review this policy so that you will know what information we collect and how we use it.</p>
			<p><strong>Agreeing to Terms</strong></p>
			<p>If you do not agree to  Privacy Policy as posted here on this website, please do not use this site or any services offered by this site.</p>
			<p>Your use of this site indicates acceptance of this privacy policy.</p>
			<p><strong>DISCLAIMER</strong></p>
			<p> provides this website as a service. While the information contained within the site is periodically updated, no guarantee is given that the information provided in this website is correct, complete, and/or up-to- date.</p>
			<p>The materials contained on this website are provided for general information purposes only.  does not accept any responsibility for any loss which may arise from reliance on information contained on this site.</p>
			<p>Permission is given for the downloading and temporary storage of one or more of these pages for the purpose of viewing on a personal computer. The contents of this site are protected by copyright under international conventions and, apart from the permission stated, the reproduction, permanent storage, or retransmission of the contents of this site is prohibited without the prior written consent of .</p>
			<p>Some links within this website may lead to other websites, including those operated and maintained by third parties.  includes these links solely as a convenience to you, and the presence of such a link does not imply a responsibility for the linked site or an endorsement of the linked site, its operator, or its contents (exceptions may apply).</p>
			<p>This website and its contents are provided 'AS IS' without warranty of any kind, either express or implied, including, but not limited to, the implied warranties of merchantability, fitness for a particular purpose, or non-infringement.</p>
			<p>Reproduction, distribution, republication, and/or retransmission of material contained within this website are prohibited unless the prior written permission of  has been obtained. provides this website as a service. While the information contained within the site is periodically updated, no guarantee is given that the information provided in this website is correct, complete, and/or up-to- date.</p>
			<p>The materials contained on this website are provided for general information purposes only.  does not accept any responsibility for any loss which may arise from reliance on information contained on this site.</p>
			<p>Permission is given for the downloading and temporary storage of one or more of these pages for the purpose of viewing on a personal computer. The contents of this site are protected by copyright under international conventions and, apart from the permission stated, the reproduction, permanent storage, or retransmission of the contents of this site is prohibited without the prior written consent of .<br>
			Some links within this website may lead to other websites, including those operated and maintained by third parties.  includes these links solely as a convenience to you, and the presence of such a link does not imply a responsibility for the linked site or an endorsement of the linked site, its operator, or its contents (exceptions may apply).</p>
			<p>This website and its contents are provided &ldquo;AS IS&rdquo; without warranty of any kind, either express or implied, including, but not limited to, the implied warranties of merchantability, fitness for a particular purpose, or non-infringement.</p>
			<p>Reproduction, distribution, republication, and/or retransmission of material contained within this website are prohibited unless the prior written permission of  has been obtained.</p>
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
