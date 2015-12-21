<?php
//assign value for title of page
$pageTitle = 'About: EmbedThis (Oembed)';
$subTitle = 'jason a. clark';
//declare filename for additional stylesheet variable - default is "none"
$customCSS = 'master.css';
//create an array with filepaths for multiple page scripts - default is meta/scripts/global.js
$customScript[0] = 'none';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title><?php echo($pageTitle); ?> - jason a. clark</title>
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
<body class="<?php if(!isset($_GET['view'])) { echo 'what'; } else { echo $_GET['view']; } ?>" role="document" vocab="http://schema.org/" typeof="WebPage">
<header>
<h1><?php echo($pageTitle); ?></h1>
<h2><?php echo($subTitle); ?></h2>
</header>
<div class="main">
<main role="main">
<h2 class="mainHeading">OembedThis: An Oembed Utility</h2>
<p>This is a utility app built around an HTML form and PHP functions that check for an Oembed endpoint and return HTML embed code for various popular web sites.
</p>
<p>To use it, find the URL of an item on a web site. Pass the URL into the form to check for an Oembed service and get embed code. This is open data...</p>
<p>Currently supported sites include:</p>
<ul>
  <li>codepen.io</li>
  <li>dribbble.com</li>
  <li>facebook.com</li>
  <li>flickr.com</li>
  <li>gty.im (getty.com)</li>
  <li>ifttt.com</li>
  <li>instagram.com</li>
  <li>kickstarter.com</li>
  <li>slideshare.net</li>
  <li>soundcloud.com</li>
  <li>speakerdeck.com</li>
  <li>ted.com</li>
  <li>ustream.tv</li>
  <li>vimeo.com</li>
  <li>vine.co</li>
  <li>youtube.com</li>
</ul>
<p>If you know of more Oembed endpoints to add, let me know <a href="https://twitter.com/jaclark">@jaclark</a>.</p>

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
