<?php
//assign value for title of page
$pageTitle = 'EmbedThis (Oembed)';
$subTitle = 'Pass a URL & Get Embed Code';
//declare filename for additional stylesheet variable - default is "none"
$customCSS = 'master.css';
//create an array with filepaths for multiple page scripts - default is meta/scripts/global.js
$customScript[0] = 'none';

//get and set url protocol
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
//set and sanitize global variables for URL construction
$server = htmlentities(strip_tags($_SERVER['SERVER_NAME']));
$path = htmlentities(strip_tags(dirname($_SERVER['PHP_SELF'])));
$fileName = htmlentities(strip_tags(basename($_SERVER['SCRIPT_NAME'])));
$fileNameURI = htmlentities(strip_tags($_SERVER['REQUEST_URI']));
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title><?php echo($pageTitle); ?> - jason a. clark</title>
<meta name="description" content="Utility app built around an HTML form & PHP functions that check for an Oembed endpoint & return HTML embed code for various popular web sites."/>
<!-- Social Media Tags -->
<meta name="twitter:title" content="EmbedThis (Oembed)">
<meta name="twitter:description" content="Utility app that checks for an Oembed endpoint & returns HTML embed code.">
<meta name="twitter:image:src" content="<?php echo $protocol.$server.$path; ?>/meta/img/share-code-small.png">
<meta name="twitter:url" content="<?php echo $protocol.$server.$path.'/'.$fileName; ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@jaclark">
<meta name="twitter:creator" content="@jaclark">
<meta property="og:title" content="EmbedThis (Oembed)">
<meta property="og:description" content="Utility app that checks for an Oembed endpoint & returns HTML embed code.">
<meta property="og:image" content="<?php echo $protocol.$server.$path; ?>/meta/img/share-code-small.png">
<meta property="og:url" content="<?php echo $protocol.$server.$path.'/'.$fileName; ?>">
<meta property="og:type" content="website" />
<meta property="og:site_name" content="Jason A. Clark's web site"/>

<meta property="og:title" content="HTML5 Mobile Feed App"/>
<meta property="og:description" content="A single page app using HTML5 markup, CSS3, &amp; Javascript APIs to create a mobile feed search/display as a teaching tool for HTML5 courses."/>
<meta property="og:image" content="http://www.lib.montana.edu/~jason/meta/img/clark-share-default.png"/>
<meta property="og:url" content="http://www.lib.montana.edu/~jason/files/html5-mobile-feed/"/>
<meta property="og:type" content="website"/>
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="http://www.jasonclark.info"/>
<meta name="twitter:creator" content="@jaclark"/>

<!-- End Social Media Tags -->
<link rel="alternate" type="application/rss+xml" title="diginit - jason clark" href="http://feeds.feedburner.com/diginit" />
<?php if ($customCSS != 'none') {
?>
<link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/meta/styles/<?php echo $customCSS; ?>">
<?php
}
if ($customScript[0] != 'none') {
  $counted = count($customScript);
  for ($i = 0; $i < $counted; $i++) {
   echo '<script type="text/javascript" src="'.$customScript[$i].'"></script>'."\n";
  }
}
?>
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body class="<?php if(!isset($_GET['view'])) { echo 'home'; } else { echo $_GET['view']; } ?>" role="document" vocab="http://schema.org/" typeof="WebPage">
<header role="banner" property="name description">
<h1><?php echo($pageTitle); ?></h1>
<h2><?php echo($subTitle); ?></h2>
</header>
<div class="main">
<main role="main">
<?php
//turn on full error reports for development - REMOVE when in production
//error_reporting(E_ALL);

if (isset($_POST['passField']) && trim($_POST['passField']) != ''):
?>
  <h2>Thanks for posting a general inquiry, ROBOT. Please, go die in a fire!</h2>
<?php
elseif (isset($_REQUEST['submitCheck']) && $_REQUEST['submitCheck'] == 1 || isset($_GET['uri'])):

//set default value for URL
$uri = isset($_REQUEST['uri']) ? strip_tags($_REQUEST['uri']) : null;
?>
<h3>Hmmm... Thanks for trying out the URL at <a href="<?php echo $uri; ?>"><?php echo $uri; ?></a></h3>
<p>Here's what I found:</p>
<?php
function getEmbedCode($url = "", $maxwidth = 320) {

  $embedResult = '';
  //instagram only allowing http for oembed, stripping out https
  if (stristr($url, 'instagram.com')) {
    $url = 'http://'.substr($url, 8);
    //echo $url;
  }

  $sources = array(
    'codepen.io' => 'http://codepen.io/api/oembed',
    'dribbble.com' => 'https://api.embed.ly/v1/api/oembed',
    'flickr.com' => 'https://www.flickr.com/services/oembed/',
    //note: getty needs short url pattern + asset id -> http://gty.im/[asset-id]
    'gty.im' => 'http://embed.gettyimages.com/oembed',
    //'github.com' => 'https://github.com/api/oembed',
    //'hulu.com' => 'http://www.hulu.com/api/oembed.json',
    'ifttt.com' => 'https://ifttt.com/oembed',
    'instagram.com' => 'https://api.instagram.com/oembed/',
    'kickstarter.com' => 'https://www.kickstarter.com/services/oembed',
    'slideshare.net' => 'http://www.slideshare.net/api/oembed/2',
    'soundcloud.com' => 'https://soundcloud.com/oembed',
    'speakerdeck.com' => 'https://speakerdeck.com/oembed.json',
    'ted.com' => 'https://www.ted.com/talks/oembed.json',
    'ustream.tv' => 'http://www.ustream.tv/oembed',
    'vine.co' => 'https://vine.co/oembed.json',
    'vimeo.com' => 'https://vimeo.com/api/oembed.json',
    'youtube.com' => 'https://www.youtube.com/oembed'
  );

  $service = false;
  foreach($sources as $domain => $source) {
    if (stristr($url, $domain)) {
      $service = $source;
    }
  }

  if (!$service) {
    $message = 'Could not find an Oembed service endpoint.';
    return $message;
  }

  $options = array(
    CURLOPT_URL => $service.'?url='.urlencode($url).'&format=json&maxwidth='.$maxwidth,
    CURLOPT_USERAGENT => 'jasonclark.info',
    CURLOPT_TIMEOUT => 5,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HEADER => FALSE
  );

  $curl = curl_init();
  curl_setopt_array($curl, $options);
  $result = curl_exec($curl);
  curl_close($curl);

  $response = json_decode($result, true);

  if (isset($response['type'])) {
    switch ($response['type']) {
      case 'photo':
        $img = '<img src="'.$response['url'].'" alt="'.$response['title'].'" />';
        $embedResult = $response['title'].'<br />'.$img.'<p>embed source code:<br /><pre contentEditable="true">'.htmlspecialchars($img).'</pre></p>';
      break;
      default:
        $embedResult = $response['title'].'<br />'.$response['html'].'<p>embed source code:<br /><pre contentEditable="true">'.htmlspecialchars($response['html']).'</pre></p>';
      break;
    }
  }

  if (empty($response['type'])) {
    $message = 'Oembed result not available for this service.';
    return $message;
  } else {
    return $embedResult;
  }

}

echo getEmbedCode($uri);
?>
<p class="control"><a href="<?php echo htmlentities(strip_tags(basename(__FILE__))); ?>" class="refresh">Reset</a></p>
<?php
else:
?>
<form method="post" action="<?php echo htmlentities(strip_tags(basename(__FILE__))); ?>">
<input type="hidden" name="submitCheck" value="1" />
<span id="access">
  <label for="passField">omit field (bot test):</label>
  <input id="passField" name="passField" type="text" autofill="off" />
  <script>(function () { var e = document.getElementById("access"); e.parentNode.removeChild(e); })();</script>
</span>
<fieldset>
  <label for="uri">Enter URL:</label>
  <input title="Enter URL" type="text" name="uri" id="uri" placeholder="URL from youtube, flickr, instagram, etc..." autofocus />
  <button type="submit" class="button">Get Code</button>
</fieldset>
</form>
<?php
endif;
?>
</main>
</div><!--end .main div-->
<aside role="complementary">
<nav role="navigation">
<h3>Key:</h3>
  <a href="./index.php">Home</a>
  <a href="./what.php">What?</a>
  <a href="./code.php">Code</a>
  <a title="Bibliography by Suzanne Chapman (CC BY-NC-SA 2.0)" href="https://www.flickr.com/photos/sukisuki/4413551329/">Credit</a>
  <a href="http://twitter.com/jaclark" class="twitter">@jaclark</a>
</nav>
</aside>
</body>
</html>
