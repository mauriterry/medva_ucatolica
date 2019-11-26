<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?= $this->_titlepage ?></title>
	<meta name="description" content="<?= $this->_data['metadescription']; ?>" />
	<meta name="keywords" content="<?= $this->_data['metakeywords']; ?>"/>
	<link rel="stylesheet" type="text/css" href="/scripts/carousel/carousel.css">
	<link rel="stylesheet" href="/components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/skins/page/css/global.css">
	<link rel="stylesheet" href="/components/chart.js/dist/Chart.css">
	<script src="/components/chart.js/dist/Chart.js"></script>
	<link rel="shortcut icon" href="/favicon.ico">
	<script type="text/javascript" id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflS50iB-/www-widgetapi.js" async=""></script>

</head>
<body>
	<header>
		<?= $this->_data['header']; ?>
	</header>
	<div><?= $this->_content ?></div>
	<footer>
		<?= $this->_data['footer']; ?>
	</footer>

	<script src="/components/jquery/dist/jquery.min.js"></script>
	<script src="/scripts/popper.min.js"></script>
	<script src="/components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/scripts/carousel/carousel.js"></script>
	<script src="/skins/page/js/main.js"></script>
</body>
</html>