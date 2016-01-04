<!DOCTYPE html>
<html class="no-js" lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>MODEL SEARCH</title>
<link rel="stylesheet" href="../include/view/css/normalize.css">
<link rel="stylesheet" href="../include/view/css/colorbox.css">
<link rel="stylesheet" href="../include/view/css/main.css">
<script src="../include/view/js/vendor/modernizr.custom.min.js"></script>
<script src="../include/view/js/vendor/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../include/view/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
<script src="../include/view/js/vendor/jquery.ba-throttle-debounce.min.js"></script>
<script src="../include/view/js/vendor/imagesloaded.pkgd.min.js"></script>
<script src="../include/view/js/vendor/masonry.pkgd.min.js"></script>
<!-- <script src="../include/view/js/vendor/jquery.colorbox-min2.js"></script> -->

<script>
	$(document).ready(function(){

		$(".item_link").on('click',function(e){
			alert('aaa');
		});
		/*
		$(".design").colorbox({
			rel:'design'
		});

		$(".inline").colorbox({
			rel:'group',
			inline: true
		});
		$(".close_demo").colorbox({
			inline: true
		});
		$(".close_demo2").colorbox({
			inline: true,
			returnFocus:false
		});
		$('.close').on('click', function(e){
			e.preventDefault();
			$.colorbox.close();
		});
		
		$('.title').on('click', function(e){
			e.preventDefault();
			$.colorbox.close();
		});
		$('.close2').on('click', function(e){
			e.preventDefault();
			$.colorbox.close();
			var position = $('#anchor_demo').offset().top;
			window.scrollTo(0,position);
		});
*/
	});
</script>
</head>
<body>

<header class="page-header" role="banner">
    <div class="inner clearfix">
        <h1 class="site-logo"><a href="./"><img src="../include/view/images/logo.png" alt="modelsearch" height="21" width="200"></a></h1>
        <form class="filter-form" id="gallery-filter">
            <span class="form-item">
                <input type="radio" name="filter" id="filter-all" value="all" checked>
                <label for="filter-all" id="filter_all"> ALL</label>
            </span>
            <span class="form-item">
                <input type="radio" name="filter" id="filter-people" value="people">
                <label for="filter-people">スタジオ撮影</label>
            </span>
            <span class="form-item">
                <input type="radio" name="filter" id="filter-animals" value="animals">
                <label for="filter-animals">屋外撮影</label>
            </span>
            <span class="form-item">
                <input type="radio" name="filter" id="filter-nature" value="nature">
                <label for="filter-nature">夜景</label>
            </span>
            <span class="form-item">
                <input type="radio" name="filter" id="filter-plantes" value="plantes">
                <label for="filter-plantes">ファッション撮影</label>
            </span>
            <span class="form-item">
                <input type="radio" name="filter" id="filter-architects" value="architects">
                <label for="filter-architects">アート撮影</label>
            </span>
        </form>
    </div>
</header>

<div class="page-main" role="main">
	<ul class="head_photo" id="head_photo">
		<div class="h_sec1">
			<a><img class="head_photo1" src="../include/view/images/bg1.jpg" alt="制作事例1"></a>
			<div class="kozu"><a href="#">構図</a></div>
		</div>
		<div class="h_sec2">
			<a><img class="head_photo2" src="../include/view/images/bg_c.jpg" alt="制作事例2"></a>
			<div class="profile"><a href="./profile.php?user_id=2">プロフィール</a></div>
		</div>
		<div class="h_sec3">
			<a><img class="head_photo3" src="../include/view/images/bg_m.jpg" alt="制作事例3"></a>
			<div class="profile"><a href="./profile.php?user_id=4">プロフィール</a></div>
		</div>
	</ul>

	<div id="container clearfix">
	    <ul class="gallery clearfix" id="gallery"></ul>
	    <button class="load-more" id="load-more">Load more</button>
    </div>
</div>		

<div style="display:none">

		<div id="inline03" style="width:300px;text-align:center;background:#eee;padding:50px;">
			<p style="padding: 100px 30px 30px">ボタンでColorboxを閉じる</p>
			<p class="btn"><a href="javascript:void(0);" class="close">Colorboxを閉じる</a></p>
		</div>

		<div id="inline04" style="width:300px;text-align:center;background:#eee;padding:50px;">
			<p style="padding: 100px 30px 30px">ボタンでColorboxを閉じる</p>
			<p class="btn"><a href="#anchor_demo" class="close2">移動してからColorboxを閉じる</a></p>
		</div>

</div>
<div id="modal">
  <div id="modal-container">
    <div id="modal-contents"></div>
    <div id="modal-close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></div>
    <div id="modal-prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></div>
    <div id="modal-next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></div>
  </div>
</div>
<div id="modal-overlay"></div>

<script src="../include/view/js/main.js"></script>
</body>
</html>