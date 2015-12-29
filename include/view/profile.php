<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="../include/view/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="../include/view/css/bootstrap-timepicker.css">
<link href='../include/view/css/bootstrap.min.css' rel='stylesheet' />
<link href='../include/view/css/blog-post.css' rel='stylesheet' />
<link href='../include/view/js/fullcalendar.css' rel='stylesheet' />
<link href='../include/view/js/fullcalendar.css' rel='stylesheet' />
<script src="../include/view/js/jquery-1.11.3.min.js"></script>
<script src="../include/view/js/moment.js"></script>
<script src="../include/view/js/fullcalendar.js"></script>
<script src="../include/view/js/bootstrap.min.js"></script>
<script src="../include/view/js/bootstrap-datepicker.js"></script>
<script src="../include/view/js/bootstrap-datepicker.ja.js"></script>
<script src="../include/view/js/bootstrap-timepicker.js"></script>
<script src="../include/view/js/bootstrap-timepicker.ja.js"></script>
<script type="text/javascript">
$(function() {
    $('.set_time').timepicker({});
});
</script>
<script type="text/javascript">
$(function() {
    $('.set_date').datepicker({
        format: 'yyyy/mm/dd',
        language: 'ja'
    });
});
</script>
<script type="text/javascript">
$(document).ready(function () {
    // Documentの読み込みが完了するまで待機し、カレンダーを初期化します。
    $('#calendar').fullCalendar({
        // ヘッダーのタイトルとボタン
        header: {
            // title, prev, next, prevYear, nextYear, today
            left: 'prev,next today',
            center: 'title',
            right: 'month agendaWeek agendaDay'
        },
        // jQuery UI theme
        theme: false,
        // 最初の曜日
        firstDay: 1, // 1:月曜日
        // 土曜、日曜を表示
        weekends: true,
        // 週モード (fixed, liquid, variable)
        weekMode: 'fixed',
        // 週数を表示
        weekNumbers: false,
        // 高さ(px)
        height: 400,
        // コンテンツの高さ(px)
        contentHeight: 400,
        // カレンダーの縦横比(比率が大きくなると高さが縮む)
        aspectRatio: 1.5,
        // ビュー表示イベント
        viewDisplay: function(view) {
            //alert('ビュー表示イベント ' + view.title);
        },
        // ウィンドウリサイズイベント
        windowResize: function(view) {
            //alert('ウィンドウリサイズイベント');
        },
        // 日付クリックイベント
        dayClick: function () {
            //alert('日付クリックイベント');
        },
        // 初期表示ビュー
        defaultView: 'month',
        // 終日スロットを表示
        allDaySlot: true,
        // 終日スロットのタイトル
        allDayText: '終日',
        // スロットの時間の書式
        axisFormat: 'H(:mm)',
        // スロットの分
        slotMinutes: 15,
        // 選択する時間間隔
        snapMinutes: 15,
        // TODO よくわからない
        //defaultEventMinutes: 120,
        // スクロール開始時間
        firstHour: 9,
        // 最小時間
        minTime: 6,
        // 最大時間
        maxTime: 20,
        // 表示する年
        year: 2012,
        // 表示する月
        month: 12,
        // 表示する日
        day: 31,
        // 時間の書式
        timeFormat: 'H(:mm)',
        // 列の書式
        columnFormat: {
            month: 'ddd',    // 月
            week: "d'('ddd')'", // 7(月)
            day: "d'('ddd')'" // 7(月)
        },
        // タイトルの書式
        titleFormat: {
            month: 'yyyy年M月',                             // 2013年9月
            week: "yyyy年M月d日{ ～ }{[yyyy年]}{[M月]d日}", // 2013年9月7日 ～ 13日
            day: "yyyy年M月d日'('ddd')'"                  // 2013年9月7日(火)
        },
        // ボタン文字列
        buttonText: {
            prev:     '&lsaquo;', // <
            next:     '&rsaquo;', // >
            prevYear: '&laquo;',  // <<
            nextYear: '&raquo;',  // >>
            today:    '今日',
            month:    '月',
            week:     '週',
            day:      '日'
        },
        // 月名称
        monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        // 月略称
        monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        // 曜日名称
        dayNames: ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
        // 曜日略称
        dayNamesShort: ['日', '月', '火', '水', '木', '金', '土'],
        // 選択可
        selectable: true,
        // 選択時にプレースホルダーを描画
        selectHelper: true,
        // 自動選択解除
        unselectAuto: true,
        // 自動選択解除対象外の要素
        unselectCancel: '',
        // イベントソース
        eventSources: [
            {

                events :<?php echo json_encode($userData); ?>
                //events: [
                //    {
                //        title: '<?php echo $yoyaku_title ?>',
                //        start: '<?php echo $year ?>-<?php echo $month ?>-<?php echo $date ?> 10:30:00',
                //        end: '2015-12-22-22 12:30:00'
                 //   },
                
                //]
            }
        ]
    });
    // 動的にオプションを変更する
    //$('#calendar').fullCalendar('option', 'height', 700);
 
    // カレンダーをレンダリング。表示切替時などに使用
    //$('#calendar').fullCalendar('render');
 
    // カレンダーを破棄（イベントハンドラや内部データも破棄する）
    //$('#calendar').fullCalendar('destroy')
});
</script>
<title>MODEL SEARCH</title>
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">MODEL SEARCH</a>

        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav">
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                <li>
                    <a href="logout.php">ログアウト</a>
                </li>
                <li>
                    <a href="./mypage.php"><p>ようこそ<?php echo $user_name ?>さん</p></a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->

            <!-- Title -->
            <div class="title"><?php echo $mt_user_name ?>さんのページ</div>

            <!-- Preview Image -->
            <img class="img-responsive" src="../include/view/images/bg.jpg" alt="">

            <hr>

            <!-- Post Content -->
            <p class="lead">モデル情報<p>
            <hr>
            <p>女性　<?php echo $age ?>歳　出身地：神戸</p>                
            <hr>          
            <p class="lead">自己紹介<p>
            <hr>
            <p>小さなころから人前で踊ったりすることが大好きでした。テレビで○○さんをみたのをきっかけに、モデルになりたいと思うようになり、今回、思い切ってオーディションに応募してみました。普段はたくさんの友達に囲まれて、趣味のスポーツやウインドウショッピングを楽しんでいます。最後までやり遂げたいという強い気持ちと、やる気だけは誰にも負けないと自負しています。どうぞ、よろしくお願いします。</p>
            <hr>
            <p class="lead">事務所コメント<p>
            <hr>          
            <p>小さなころから人前で踊ったりすることが大好きでした。テレビで○○さんをみたのをきっかけに、モデルになりたいと思うようになり、今回、思い切ってオーディションに応募してみました。普段はたくさんの友達に囲まれて、趣味のスポーツやウインドウショッピングを楽しんでいます。最後までやり遂げたいという強い気持ちと、やる気だけは誰にも負けないと自負しています。どうぞ、よろしくお願いします。</p>
            
            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form">
                    <div class="form-group">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <p class="lead">コメント欄<p>
            <hr>  
            
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="../include/view/images/icon2.png" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">カメラマン1
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
					小さなころから人前で踊ったりすることが大好きでした。テレビで○○さんをみたのをきっかけに、モデルになりたいと思うようになり、今回、思い切ってオーディションに応募してみました。普段はたくさんの友達に囲まれて、趣味のスポーツやウインドウショッピングを楽しんでいます。最後までやり遂げたいという強い気持ちと、やる気だけは誰にも負けないと自負しています。どうぞ、よろしくお願いします。
                </div>
            </div>

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="../include/view/images/icon2.png" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">カメラマン１
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
					小さなころから人前で踊ったりすることが大好きでした。テレビで○○さんをみたのをきっかけに、モデルになりたいと思うようになり、今回、思い切ってオーディションに応募してみました。普段はたくさんの友達に囲まれて、趣味のスポーツやウインドウショッピングを楽しんでいます。最後までやり遂げたいという強い気持ちと、やる気だけは誰にも負けないと自負しています。どうぞ、よろしくお願いします。
                    <!-- Nested Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="../include/view/images/icon1.png" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">モデル1
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
							小さなころから人前で踊ったりすることが大好きでした。テレビで○○さんをみたのをきっかけに、モデルになりたいと思うようになり、今回、思い切ってオーディションに応募してみました。普段はたくさんの友達に囲まれて、趣味のスポーツやウインドウショッピングを楽しんでいます。最後までやり遂げたいという強い気持ちと、やる気だけは誰にも負けないと自負しています。どうぞ、よろしくお願いします。
                        </div>
                    </div>
                    <!-- End Nested Comment -->
                </div>
            </div>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">
            <!-- Blog Categories Well -->
            <div class="mt60"></div>
            <div class="well">
                <h4><a href="./schedule.php">スケジュール</a></h4>
      			<div id='calendar' class="calendar"></div>
            </div>
                <!-- /.row -->
            <div class="well">
                <h4>■依頼条件</h4>
                <div class="request">
                    <p class="subtitle">・希望の日程は？</p>
                    <hr>
                    <p class="set_date_label">開始日程：<input class="set_date" name="start_time" type="text" value=""></p>
                    <p class="set_date_label">終了日程：<input class="set_date" name="end_time" type="text" value=""></p>
                    <p class="subtitle">・希望の時間帯は？</p>
                    <hr>
                    <p class="set_time_label">開始時間：<input class="set_time" name="start_time" type="text" value=""></p>
                    <p class="set_time_label">終了時間：<input class="set_time" name="end_time" type="text" value=""></p>
                    <p>ご希望の時間を選択してください</p>
                    <p class="subtitle">・希望料金</p>
                    <hr>
                    <p>時給 1,200円 ×0.0時間 =0円</p>
                    </br>
                    ※基本料金のほかに、キッズライン手数料、往復交通費、オプション費が設定されている場合はオプション費がかかります。</p>
                    <p class="subtitle">・オプション料金</p>
                    <hr>
                    <p>特になし</p>
                    <div class="apply_button">
                        <form action="./yoyaku.php" method="post">
                            <input class="btn btn-primary" type="submit" name="apply" value="○○に申し込みを行う"/>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Side Widget Well -->

        </div>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; MODEL SEARCH 2015</p>
            </div>
        </div>
        <!-- /.row -->
    </footer>

</div>

</body>

</html>
