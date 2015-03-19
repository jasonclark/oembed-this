<?php
//assign value for title of page
$pageTitle = 'Code: EmbedThis (Oembed)';
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
<head>
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
<body class="<?php if(!isset($_GET['view'])) { echo 'code'; } else { echo $_GET['view']; } ?>" role="document" vocab="http://schema.org/" typeof="WebPage">
<header>
<h1><?php echo($pageTitle); ?></h1>
<h2><?php echo($subTitle); ?></h2>
</header>
<div class="main">
<main role="main">
<h2 class="mainHeading">Code for the EmbedThis (Oembed) utility app</h2>
<p>Source code here is the HTML, CSS, and PHP from the EmbedThis (Oembed) utility app.</p>
<p><a href="index.txt" title="html markup and PHP for web app">HTML markup &amp; PHP for the EmbedThis (Oembed) utility app</a></p>
<p><a href="master.txt" title="css rules and declarations for web app">CSS rules &amp; declarations for the EmbedThis (Oembed) utility app</a></p>
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
