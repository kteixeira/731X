<!DOCTYPE HTML>
<html>
	<head>
		<title>731X - Respeito e União</title>
		<meta charset="UTF-8" />
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Link Swiper's CSS -->
    	<link rel="stylesheet" href="bower_components/swiper/dist/css/swiper.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/grid-min.css" />
	</head>
<body>

	<?php include 'header-white.php'; ?>
	<span class="pager"></span>	

    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><div class="slides item-1"></div></div>
            <div class="swiper-slide"><div class="slides item-2"></div></div>
            <div class="swiper-slide"><div class="slides item-3"></div></div>
            <div class="swiper-slide"><div class="slides item-4"></div></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <script src="bower_components/swiper/dist/js/swiper.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
    <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true
    });
    </script>
</body>
</html>