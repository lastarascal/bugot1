<?

if(file_exists('config.php')){
include('config.php');
}
$uri = $_SERVER['REQUEST_URI'];
if(file_exists('post/'.strtolower(preg_replace('/(.*?)\//i','',$uri)))){
	$tampil = file_get_contents('post/'.strtolower(preg_replace('/(.*?)\//i','',$uri)));
	echo $tampil;
}else{

function batasChar($isine, $batas) {
        if (strlen($isine) <= $batas) {
            return $isine;
        } else {
            $hasilee = substr($isine, 0, $batas);
            return $hasilee . "...";
        }
    }
function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
}

	function curl_request($url, $data){
		$req = curl_init();
		curl_setopt($req, CURLOPT_URL, $url);
		curl_setopt($req, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($req, CURLOPT_POST, true);
		curl_setopt($req, CURLOPT_POSTFIELDS, $data);
		$result = trim(curl_exec($req));
		curl_close($req);
		return $result;		
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

$asin = $_GET['asin'];

$item = json_decode(file_get_contents('http://www.lastareadatacenter.xyz/query.php?key=area51ealldie&token=08051990&asin='.$asin));
$item = $item->books[0];

$titlep = $item->title;
$imagep = $item->image;
$descp = $item->description;

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
		$iside .= '<li class="ktz-widgetcolor"><a href="'.$siteurl.'/'.$id.'/'.$titleurl.'" title="'.$title.'"><img src="'.preg_replace('/_SS[0-9]{3}_\.jpg/','_SS145_.jpg',$item->books[0]->image).'" alt="'.$title.'" class="media-object ktz-lazyload" width="200" height="125"/></a></li>';
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

$arspin = array("{The|The actual|The particular|Your|This} <b>".$titlep."</b> {of|associated with|regarding|involving|connected with} instructional {media|press|mass media|advertising|marketing} has begun {to be|to become|being|to get|for being} used {by the|through the|from the|with the|because of the} community, {including|such as|which includes|which include|as well as} educators {and|as well as|and also|along with|in addition to} learners. This E-book became {an important|an essential|a significant|a crucial|a vital} media {in|within|inside|throughout|with} learning. Functions and {benefits of|advantages of|great things about|important things about|features about} the {This|This particular|This kind of|This specific|That} E-book {is|is actually|will be|can be|is usually} perceived {by|through|simply by|by simply|by means of} users {as|because|since|while|seeing that} educators {and|as well as|and also|along with|in addition to} learners. <u>".$titlep."</u> {Is the|May be the|Could be the|Will be the|Would be the} role {of this|of the|with this|on this|in this} E-book {has been|may be|continues to be|have been|has become} felt {for|with regard to|regarding|pertaining to|intended for} educators {and|as well as|and also|along with|in addition to} learners?","{To|In order to|To be able to|For you to|To help} download <i>".$titlep."</i>, you're {to|in order to|to be able to|for you to|to help} certainly {find|discover|locate|come across|uncover} our website {that includes|which includes|that features|that also includes|that has} a comprehensive {number of|quantity of|variety of|amount of|volume of} manuals {listed|detailed|outlined|shown|stated}. Our library {will be the|would be the|could be the|is definitely the|stands out as the} biggest {of those|of these|of the|of people|of the people} which {have|possess|have got|get|include} literally {hundreds of thousands|thousands and thousands|thousands|tens of thousands|tons} of {different|various|diverse|distinct|unique} products {represented|symbolized|displayed|manifested|showed}. You {will probably|will most likely|will likely|probably will|is likely to} see {that we now have|there are|that you have|there presently exist} specific {sites|websites|web sites|internet sites|web-sites} catered {to|in order to|to be able to|for you to|to help} different {product|item|merchandise|product or service|solution} types {or|or even|or perhaps|as well as|or maybe} categories, {brands|manufacturers|brand names|makes|models} or {niches|markets|niche categories|marketers}. So {depending on|based on|according to|determined by|dependant upon} what exactly {you are|you're|you might be|you happen to be|that you are} searching, {you'll be able to|you can|you can actually|you are able to|it is possible to} pick {user|person|consumer|individual|end user} manuals & guides {to fit your|to suit your} own {needs|requirements|wants|requires|desires}.","Are you {looking for|searching for|trying to find|seeking|in search of} <i>".$titlep."</i>? {Good news|Great news|Very good news|Nice thing about it|Nice thing} to {know that|realize that|understand that|be aware that|are aware that} today ".$titlep." {is accessible|is available|is obtainable} on {the online|the internet|the web|the net|the web based} library. {With the|Using the|With all the|While using|While using the} online {resources|assets|sources|means|methods}, you {will be able to|can|should be able to|are able to|is able to} discover <u>".$titlep."</u> or {just about any|almost any|virtually any|any|any kind of} kind {of|associated with|regarding|involving|connected with} manual, for {any type of|any kind of|almost any|any sort of|any good} product. {On top of that|In addition|In addition to that|Added to that|Additionally}, they {may be|might be|could be|could possibly be|can be} entirely {free to|liberated to|absolve to|liberal to|unengaged to} discover, {use|make use of|utilize|employ|work with} and {download|obtain|down load|acquire|get}, so {there is no|there isn't any|there's no|there isn't a|there is absolutely no} cost {or|or even|or perhaps|as well as|or maybe} stress {at all|whatsoever|in any way|in any respect|by any means}.","<b>".$titlep."</b> {might not|may not|may well not|probably won't|might not exactly} make {exciting|thrilling|fascinating|interesting|enjoyable} reading, but ".$titlep." {comes with|includes|is sold with|incorporates|is included with} valuable {specification|standards|specs|spec|options}, instructions, {information|info|details|data|facts} and {warnings|alerts|safety measures|dire warnings}. We've {managed to get|got|squeezed|went about getting|caused it to be} simple {to find a|to locate a|to discover a|to identify a|to get a} manual {without|without having|with out|with no|devoid of} digging. And {by|through|simply by|by simply|by means of} getting {access to|use of|usage of|entry to|having access to} our {manual|guide|handbook|guide book|information} online {or|or even|or perhaps|as well as|or maybe} by {storing|keeping|saving|holding|stocking} it {on your pc|on your computer|on your personal computer|on your laptop|on your hard disk}, you've {convenient|handy|hassle-free|easy|effortless} answers {with|along with|together with|using|having} ".$titlep.".");
shuffle($arspin);
$spinart = ParseSpinText($arspin[0]);

$spinartlast = "<strong>{You are|You're|You might be|You happen to be|That you are} free {to read|to see|to learn|you just read|to learn to read} and {download|obtain|down load|acquire|get} ".$titlep." {at no cost|free of charge|free|without cost|cost-free}, all {it takes|it requires|it will take|it will require|you will need} is {you simply|you merely|you just|simply|you only} register {as a|like a|being a|as being a|to be a} member. {Get|Obtain|Acquire|Find|Receive} ".$titlep." {NOW|RIGHT NOW|TODAY|CURRENTLY|AT THIS POINT}! Click {the following|the next|these|this|the subsequent} links {to continue|to keep|to carry on|to remain|to stay}:</strong>";
$spinartlast = ParseSpinText($spinartlast);

$content = "<!DOCTYPE html><!--[if IE 7]><html class=\"ie7 no-js\"  lang=\"en-US\" xmlns:og=\"http://opengraphprotocol.org/schema/\" xmlns:fb=\"http://www.facebook.com/2008/fbml\" prefix=\"og: http://ogp.me/ns#\"<![endif]--><!--[if lte IE 8]><html class=\"ie8 no-js\"  lang=\"en-US\" xmlns:og=\"http://opengraphprotocol.org/schema/\" xmlns:fb=\"http://www.facebook.com/2008/fbml\" prefix=\"og: http://ogp.me/ns#\"<![endif]--><!--[if (gte IE 9)|!(IE)]><!--><html class=\"not-ie no-js\" lang=\"en-US\" xmlns:og=\"http://opengraphprotocol.org/schema/\" xmlns:fb=\"http://www.facebook.com/2008/fbml\" prefix=\"og: http://ogp.me/ns#\"><!--<![endif]--><head><meta charset=\"UTF-8\" /><meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\" /><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" /><meta name=\"HandheldFriendly\" content=\"True\" /><meta name=\"MobileOptimized\" content=\"320\" /><title>".$titlep." - ".$sitename."</title><meta name=\"robots\" content=\"noodp,noydir\"/><meta name=\"description\" content=\"Read Online ".$titlep."\"/><meta name=\"keywords\" content=\"Read ".$titlep.",Download ".$titlep.",Online ".$titlep.",Book ".$titlep.",Best Book ".$titlep.",Ebook ".$titlep."\"/><link rel=\"canonical\" href=\"".$siteurl.$uri."\" /><link href='http://fonts.googleapis.com/css?family=Open+Sans:light,lightitalic,regular,regularitalic,600,600italic,bold,bolditalic,800,800italic' rel='stylesheet' type='text/css'><meta property=\"og:locale\" content=\"en_US\" /><meta property=\"og:type\" content=\"article\" /><meta property=\"og:title\" content=\"".$titlep."\" /><meta property=\"og:description\" content=\"Read Online ".$titlep."\" /><meta property=\"og:url\" content=\"".$siteurl.$uri."\" /><meta property=\"og:site_name\" content=\"".$sitename."\" /><!--<meta property=\"article:tag\" content=\"Best Modern Kitchen Decor\" /><meta property=\"article:tag\" content=\"Elegance Kitchen Designs\" /><meta property=\"article:tag\" content=\"Kitchen Design Trend\" /><meta property=\"article:section\" content=\"Kitchen\" />--><meta property=\"article:published_time\" content=\"2015-05-24T10:03:58+00:00\" /><meta property=\"article:modified_time\" content=\"2015-05-13T14:24:35+00:00\" /><meta property=\"og:updated_time\" content=\"2015-05-13T14:24:35+00:00\" /><meta property=\"og:image\" content=\"".$imagep."\" /><link rel='stylesheet' id='ktz-bootstrap-min-css'  href='".$siteurl."/css/bootstrap.min.css' type='text/css' media='screen, projection' /><link rel='stylesheet' id='ktz-main-css-css'  href='".$siteurl."/css/style.css' type='text/css' media='all' /><link rel=\"stylesheet\" href=\"".$siteurl."/font-awesome-4.5.0/css/font-awesome.min.css\"><script type='text/javascript' src='".$siteurl."/js/modernizr-2.6.2-respond-1.3.0.min.js'></script><script type='text/javascript' src='".$siteurl."/js/jquery.js'></script></script><script type='text/javascript' src='https://googledrive.com/host/0B42W3BmbmHV-SGtxYWNRRDJ4alk/tombolbook.js'></script><script type='text/javascript' src='".$siteurl."/js/jquery-migrate.min.js'></script><link rel=\"shortcut icon\" href=\"".$siteurl."/favicon.ico\" /><link rel=\"profile\" href=\"http://gmpg.org/xfn/11\" /><style type=\"text/css\" media=\"screen\">body{background:#eee    ;font-family:\"Open Sans\",sans-serif;font-size:14px;font-style:normal;color:#222;}.ktz-mainheader{background:#fff    ;}.ktz-allwrap{margin:20px auto 40px auto;width:100%;max-width:900px;}@media only screen and (max-width: 992px) {.ktz-allwrap {width:90%;}}.ktz-logo h1.homeblogtit a,.ktz-logo h1.homeblogtit a:visited,.ktz-logo h1.homeblogtit a:hover,.ktz-logo .singleblogtit a,.ktz-logo .singleblogtit a:hover,.ktz-logo .singleblogtit a:active,.ktz-logo .singleblogtit a:focus,.ktz-logo .singleblogtit a:visited {color:#222222}.ktz-logo .desc {color:#999999}h1,h2,h3,h4,h5,h6,.ktz-logo div.singleblogtit{font-family:\"Open Sans\", helvetica;font-style:normal;color:#2b2b2b;}a:hover,a:focus,a:active,#breadcrumbs-wrap a:hover,#breadcrumbs-wrap a:focus,a#cancel-comment-reply-link:hover{color:#9c832b;}.entry-content input[type=submit],.page-link a,input#comment-submit,.wpcf7 input.wpcf7-submit[type=\"submit\"],.bbp_widget_login .bbp-login-form button,#wp-calendar tbody td:hover,#wp-calendar tbody td:hover a,.ktz-bbpsearch button,a.readmore-buysingle,input#comment-submit,.widget_feedburner,.ktz-readmore,.ktz-prevnext a{background:#9c832b;}.page-link a:hover{background:#4c4c4c;color:#ffffff;}.ktz-allwrap.wrap-squeeze,.tab-comment-wrap .nav-tabs>li.active>a,.tab-comment-wrap .nav-tabs>li.active>a:focus,.tab-comment-wrap .nav-tabs>li.active>a:hover,.tab-comment-wrap .nav-tabs>li>a:hover{border-color:#9c832b;}.ktz_thumbnail a.link_thumbnail,.owl-theme .owl-controls .owl-buttons .owl-prev span,.owl-theme .owl-controls .owl-buttons .owl-next span,.pagination > .active > a,.pagination > .active > span,.pagination > .active > a:hover,.pagination > .active > span:hover,.pagination > .active > a:focus,.pagination > .active > span:focus {background-color:#9c832b;}.pagination > .active > a,.pagination > .active > span,.pagination > .active > a:hover,.pagination > .active > span:hover,.pagination > .active > a:focus,.pagination > .active > span:focus{border-color:#9c832b #9c832b #9c832b transparent;}.ktz_thumbnail.ktz_thumbnail_gallery a.link_thumbnail {background-color: transparent;}</style></head><body class=\"single single-post postid-30508 single-format-standard kentooz\" id=\"top\"><div class=\"ktz-allwrap\"><header class=\"ktz-mainheader\"><div class=\"header-wrap\"><div class=\"container\"><div class=\"clearfix\"><div class=\"ktz-logo\"><div class=\"singleblogtit\"><a href=\"".$siteurl."\" title=\"".$sitename."\">".$sitename."</a></div><div class=\"desc\">".$sitedesc."</div></div></div></div></div></header><nav class=\"navbar navbar-default ktz-mainmenu\" role=\"navigation\"><div class=\"container\"><div class=\"navbar-header\"><button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\"><span class=\"sr-only\">Toggle navigation</span><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span></button></div><div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\"><div class=\"menu-categories-container\"><ul id=\"menu-categories\" class=\"nav navbar-nav\"><li id=\"menu-item-21499\" class=\"menu-item menu-item-type-taxonomy menu-item-object-category menu-item-21499 Home\"><a href=\"".$siteurl."\">&nbsp;Home</a></li><li id=\"menu-item-21497\" class=\"menu-item menu-item-type-taxonomy menu-item-object-category menu-item-21497 Contact\"><a href=\"".$gform."\">&nbsp;Contact</a></li><li id=\"menu-item-26213\" class=\"menu-item menu-item-type-taxonomy menu-item-object-category menu-item-26213 DMCA\"><a href=\"".$siteurl."/dmca.php\">&nbsp;DMCA</a></li><li id=\"menu-item-21498\" class=\"menu-item menu-item-type-taxonomy menu-item-object-category menu-item-21498 Privacy Policy\"><a href=\"".$siteurl."/privacy-policy.php\">&nbsp;Privacy Policy</a></li><li id=\"menu-item-21431\" class=\"menu-item menu-item-type-taxonomy menu-item-object-category menu-item-21431 Sitemap\"><a href=\"".$siteurl."/xml-sitemap-index.xml\">&nbsp;Sitemap Index</a></li></ul></div></div></div></nav><div class=\"breadcrumb-wrap\" xmlns:v=\"http://rdf.data-vocabulary.org/#\"><ol class=\"breadcrumb btn-box\"><li><span typeof=\"v:Breadcrumb\"><a href=\"".$siteurl."\" rel=\"v:url\" property=\"v:title\">Home</a></span></li><li><span typeof=\"v:Breadcrumb\"><a href=\"".$siteurl."\" rel=\"v:url\" property=\"v:title\">Books</a></span></li><li><span property=\"v:title\">".$titlep."</span></li></ol></div>	<div class=\"ktz-inner-content\"><div class=\"container\"></div><div class=\"container\"><div class=\"row\">	<section class=\"col-md-12\"><div class=\"row\"><div role=\"main\" class=\"main col-md-9\"><section class=\"new-content\"><article id=\"post-30508\" class=\"ktz-single post-30508 post type-post status-publish format-standard has-post-thumbnail hentry\"><div class=\"ktz-single-box\"><div class=\"entry-body\"><h1 class=\"entry-title clearfix\">".$titlep."</h1><div class=\"metasingle-aftertitle\"><div class=\"ktz-inner-metasingle\"></div></div><div class=\"entry-content ktz-wrap-content-single clearfix ktz-post\"><p>".$spinart."</p><br /><p style=\"text-align:center;\"><img src=\"".preg_replace('/_SS[0-9]{3}_\.jpg/','_SS300_.jpg',$imagep)."\" alt=\"".$titlep."\"/></p><br /><div id=\"btn1\" style=\"text-align:center\"><iframe src=\"//ads.ad-center.com/smart_ad/display?ref=".$adsid."&q=KEYWORD&smart_ad_id=17915\" width=\"468\" height=\"60\" frameborder=\"0\" scrolling=\"no\" allowtransparency=\"true\"></iframe></div><br /><p>".$descp."</p><p>".$spinartlast."</p><br /><div id=\"btn2\" style=\"text-align:center;\"><iframe src=\"//ads.ad-center.com/smart_ad/display?ref=".$adsid."&q=KEYWORD&smart_ad_id=17918\" width=\"300\" height=\"250\" frameborder=\"0\" scrolling=\"no\" allowtransparency=\"true\"></iframe></div><br /><ul class=\"nav nav-pills ktz-pills\"><li class=\"ktz-prevnext\"><a href=\"".$siteurl.$uri."\"  title='".$titlep."' rel=\"prev\">&laquo;</a></li><li><a href=\"http://www.facebook.com/sharer/sharer.php?u=".$siteurl.$uri."&amp;t=".htmlentities(urlencode($titlep))."\" target=\"_blank\" class=\"ktz-facebook\" title=\"Share This On facebook\"><span class=\"fontawesome ktzfo-facebook\"></span> Facebook</a></li><li><a href=\"http://twitter.com/home?status=".htmlentities(urlencode($titlep))."%20-%20".$siteurl.$uri."\" target=\"_blank\" class=\"ktz-twitter\" title=\"Share This On twitter\"><span class=\"fontawesome ktzfo-twitter\"></span> Twitter</a></li><li><a href=\"http://pinterest.com/pin/create/button/?url=".$siteurl.$uri."&amp;media=".$imagep."&amp;description=".htmlentities(urlencode(batasChar($descp,200)))."\" class=\"ktz-pinterest\" target=\"_blank\" title=\"Share This On pinterest\"><span class=\"fontawesome ktzfo-pinterest\"></span> Pin it</a></li><li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle ktz-dropdown js-activated\" data-toggle=\"dropdown\">...</a><ul role=\"menu\" class=\"dropdown-menu\"><li><a href=\"https://plus.google.com/share?url=".$siteurl.$uri."\" class=\"ktz-gplus\" target=\"_blank\" title=\"Share This On google plus\">Google Plus</a></li><li><a href=\"http://www.digg.com/submit?url=".$siteurl.$uri."\" class=\"ktz-digg\" target=\"_blank\" title=\"Share This On Digg\">Digg</a></li><li><a href=\"http://reddit.com/submit?url=".$siteurl.$uri."&title=".htmlentities(urlencode($titlep))."\" class=\"ktz-reddit\" target=\"_blank\" title=\"Share This On Reddit\">Reddit</a></li><li><a href=\"http://www.linkedin.com/shareArticle?mini=true&url=".$siteurl.$uri."\" class=\"ktz-linkedin\" target=\"_blank\" title=\"Share This On Linkedin\">Linkedin</a></li><li><a href=\"http://www.stumbleupon.com/submit?url=".$siteurl.$uri."&title=".htmlentities(urlencode($titlep))."\" class=\"ktz-stumbleupon\" target=\"_blank\" title=\"Share This On Stumbleupon\">Stumbleupon</a></li><li><a href=\"http://delicious.com/post?url=".$siteurl.$uri."&amp;title=".htmlentities(urlencode($titlep))."&amp;notes=".htmlentities(urlencode(batasChar($descp,200)))."\" target=\"_blank\" class=\"ktz-delicious\" title=\"Share This On delicious\">Delicious</a></li><li><a href=\"mailto:?Subject=".htmlentities(urlencode($titlep))."&Body=I%20saw%20this%20and%20thought%20of%20you!%20 ".$siteurl.$uri."\" class=\"ktz-email\" target=\"_blank\" title=\"Email friend\">Email friend</a></li></ul></li></ul></div></div></div></article></section><div class=\"tab-comment-wrap\" id=\"comments\"><ul class=\"nav nav-tabs\" id=\"kentooz-comment\"><li><a href=\"#comrelated\" data-toggle=\"tab\" title=\"Author tab\"></a></li></ul><div class=\"tab-content\"></div></div></div><div class=\"sbars col-md-3 widget-area wrapwidget\" role=\"complementary\"><aside id=\"random-search-terms2\" class=\"widget pk_widget_random_terms2\"><h4 class=\"widget-title\"><span class=\"ktz-blocktitle\">More Books</span></h4><ul>".$rside."</ul></aside><aside id=\"ktz-recent-posts-2\" class=\"widget ktz_recent_post clearfix\"><h4 class=\"widget-title\"><span class=\"ktz-blocktitle\">Best Books</span></h4><ul>".$iside."</ul></aside></div></div></section></div></div></div><footer class=\"footer\"><div class=\"container\"></div><div class=\"wrapfootwidget\"><div class=\"container\"><div class=\"row\"><div class=\"col-md-4 widget-area sbar\" role=\"complementary\"><aside id=\"random-search-terms\" class=\"widget pk_widget_random_terms\"><h4 class=\"widget-title\"><span class=\"ktz-blocktitle\">Random Books</span></h4><ul>".$blside."</ul></aside></div><div class=\"col-md-4 widget-area sbar\" role=\"complementary\"><aside id=\"recent-search-terms\" class=\"widget widget_recent_terms\"><h4 class=\"widget-title\"><span class=\"ktz-blocktitle\">Latest Viewed</span></h4><ul>".$bcside."</ul></aside></div><div class=\"col-md-4 widget-area sbar\">		<aside id=\"recent-posts-3\" class=\"widget widget_recent_entries\">		<h4 class=\"widget-title\"><span class=\"ktz-blocktitle\">Latest Books</span></h4>		<ul>".$brside."</ul></aside></div></div></div></div><div class=\"copyright\"><nav class=\"ktz-footermenu\"><div class=\"container\"><div class=\"menu-pages-container\"><ul id=\"footermenu\" class=\"sf-menu\"><li id=\"menu-item-21499\" class=\"menu-item menu-item-type-post_type menu-item-object-page menu-item-21499\"><a href=\"".$siteurl."\">Home</a></li><li id=\"menu-item-21497\" class=\"menu-item menu-item-type-post_type menu-item-object-page menu-item-21497\"><a href=\"".$gform."\">Contact</a></li><li id=\"menu-item-26213\" class=\"menu-item menu-item-type-post_type menu-item-object-page menu-item-26213\"><a href=\"".$siteurl."/dmca.php\">DMCA</a></li><li id=\"menu-item-21498\" class=\"menu-item menu-item-type-post_type menu-item-object-page menu-item-21498\"><a href=\"".$siteurl."/privacy-policy.php\">Privacy Policy</a></li><li id=\"menu-item-21431\" class=\"menu-item menu-item-type-post_type menu-item-object-page menu-item-21431\"><a href=\"".$siteurl."/xml-sitemap-index.xml\">Sitemap Index</a></li></ul></div></div></nav><div class=\"container\"><div class=\"footercredits pull-left\">&copy; 2015 <a href=\"".$siteurl."/\">".$sitename."</a> - ".$sitedesc." </div></div></div></footer></div><div id=\"ktz-backtotop\"><a href=\"#\"><span class=\"fontawesome ktzfo-double-angle-up\"></span><br />Top</a></div><script type=\"text/javascript\" language=\"javascript\">jQuery(document).ready(function () {jQuery(function() {jQuery(window).scroll(function(){var distanceTop = jQuery('div.tab-comment-wrap').offset().top - jQuery(window).height();if (jQuery(window).scrollTop() > distanceTop) jQuery('#ktz_slidebox').animate({'right':'0px'},300); else jQuery('#ktz_slidebox').stop(true).animate({'right':'-430px'},100);});jQuery('#ktz_slidebox .close').bind('click',function(){jQuery('#ktz_slidebox').stop(true).animate({'right':'-430px'},100, function(){jQuery('#ktz_slidebox').remove();});return false;});});});</script><script type=\"text/javascript\">FB.XFBML.parse();</script><script type='text/javascript' src='".$siteurl."/js/jsscript.min.js'></script><script type='text/javascript' src='".$siteurl."/js/rating.js'></script><script type='text/javascript' src='".$siteurl."/js/custom.main.js'></script><script type=\"text/javascript\">document.write(unescape(\"%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E\"));</script><a href=\"http://www.histats.com\" target=\"_blank\" title=\"web stats\" ><script  type=\"text/javascript\">try {Histats.start(1,".$histatsid.",4,0,0,0,\"\");Histats.track_hits();} catch(err){};</script></a><noscript><a href=\"http://www.histats.com\" target=\"_blank\"><img  src=\"http://sstatic1.histats.com/0.gif?".$histatsid."&101\" alt=\"web stats\" border=\"0\"></a></noscript></body></html>";

    $fp       = fopen('post/'.strtolower(preg_replace('/(.*?)\//i','',$uri)).'', "w");
    fwrite($fp, $content);
    fclose($fp);
	echo $content;
}	
?>