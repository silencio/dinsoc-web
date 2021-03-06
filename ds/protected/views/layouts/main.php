<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en-gb"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en-gb"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en-gb"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-gb"> <!--<![endif]-->
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="language" content="en" />
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<!-- You can also compile style.less to use regular css. Your apps will still work. -->
	<style type="text/css">body{padding-top:60px}.hidden{margin:20px;border:5px solid #a24c4c;background-color:red;padding:10px;width:400px;color:white;font-family:helvetica,sans-serif}</style>
	<link rel="stylesheet/less" type="text/css" href="kickstrap.less">
	<script src="Kickstrap/js/less-1.3.0.min.js"></script>
	
	  <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyA7PCfSIn5fRe7ZQBpmqe-piuRei1LwNGo&sensor=true"></script>
	  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	  <script>window.jQuery || document.write('<script src="Kickstrap/js/jquery-1.8.2.min.js"><\/script>');</script>
	  <!-- Kickstrap CDN thanks to our friends at netDNA.com -->
	  <script id="appList" src="http://netdna.getkickstrap.com/1.2/Kickstrap/js/kickstrap.min.js"></script>
	  <script>window.consoleLog || document.write('<script id="appList" src="Kickstrap/js/kickstrap.min.js"><\/script>')</script>
	  <script>
	   ks.ready(function() {
	      // JavaScript placed here will run only once Kickstrap has loaded successfully.
	   });
	  </script>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
</head>

<body>

<div id="sf-wrapper"> <!-- Sticky Footer Wrapper -->
   <div class="hidden"><h1>No Stylesheet Loaded</h1><p><strong>Could not load Kickstrap.</strong>There are <a href="http://getkickstrap.com/docs/1.2/troubleshooting/#lessjs-errors">several common reasons for this error.</a></p></div>
  <!-- Prompt IE 6/7 users to install Chrome Frame. Remove this if you support IE 7-.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 8]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
<!--! END KICKSTRAP HEADER --> 
   
	<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/ds/index.php"><?php echo CHtml::encode(Yii::app()->name); ?></a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="/ds/index.php?r=authority">Authority</a></li>
              <li><a href="/ds/index.php?r=place">Place</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>











<?php echo $content; ?>










  <!--! KICKSTRAP FOOTER -->
  <div id="push"></div></div> <!-- sf-wrapper -->
  <footer class="container" id="footer">
	  <p>Built with <a href="http://getkickstrap.com">Kickstrap</a></p>
  </footer>
  <!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
       mathiasbynens.be/notes/async-analytics-snippet -->
  <!--script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script-->

</body>
</html>
