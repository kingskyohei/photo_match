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
<script src="../include/view/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
<script src="../include/view/js/vendor/jquery.ba-throttle-debounce.min.js"></script>
<script src="../include/view/js/vendor/imagesloaded.pkgd.min.js"></script>
<script src="../include/view/js/vendor/masonry.pkgd.min.js"></script>
<script src="../include/view/js/vendor/jquery.colorbox-min.js"></script>
<script src="../include/view/js/main.js"></script>
<script>
	$(document).ready(function(){

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

	});

</script>
</head>
<body>

<header class="page-header" role="banner">
    <div class="inner clearfix">
        <h1 class="site-logo"><a href="./"><img src="../include/view/img/logo.png" alt="Shiftbrain" height="21" width="169"></a></h1>
        <form class="filter-form" id="gallery-filter">
            <span class="form-item">
                <input type="radio" name="filter" id="filter-all" value="all" checked>
                <label for="filter-all">All</label>
            </span>
            <span class="form-item">
                <input type="radio" name="filter" id="filter-people" value="people">
                <label for="filter-people">People</label>
            </span>
            <span class="form-item">
                <input type="radio" name="filter" id="filter-animals" value="animals">
                <label for="filter-animals">Animals</label>
            </span>
            <span class="form-item">
                <input type="radio" name="filter" id="filter-nature" value="nature">
                <label for="filter-nature">Nature</label>
            </span>
            <span class="form-item">
                <input type="radio" name="filter" id="filter-plantes" value="plantes">
                <label for="filter-plantes">Plantes</label>
            </span>
            <span class="form-item">
                <input type="radio" name="filter" id="filter-architects" value="architects">
                <label for="filter-architects">Architects</label>
            </span>
        </form>
    </div>
</header>
<!--
<div id="section03" class="section">
	<h2>別のJavaScriptからColorBoxの操作を行う</h2>
	<p class="btn" style="margin-bottom:40px;"><a class="close_demo" href="#inline03">モーダル内のボタンでColorboxを閉じる。</a></p>
	<p class="btn"><a class="close_demo" href="#inline04">アンカーリンクで移動してからColorboxを閉じる その1</a></p>
</div>
-->
<div class="page-main" role="main">
    <ul class="gallery" id="gallery"></ul>
    <button class="load-more" id="load-more">Load more</button>
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


</body>
</html>
