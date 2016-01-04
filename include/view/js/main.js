$(function () {

    /*
     * ヘッダー
     */
    $('.kozu a').on('mouseenter', function(){
        $('.head_photo1').attr('src',"../include/view/images/kozu.png");
    });

    $('.kozu a').on('mouseleave', function(){
/*
          var file_name = .attr('src').split('/').pop();

          var file_name_s = file_name.replace(/.jpg/g,"");

          selectedSrc = file_name_s.replace(/thumb/g,"large");

          selectedSrc_o = selectedSrc + '.jpg';
*/
          $('.head_photo1').attr('src',"../include/view/images/bg1.jpg");
    });
    /*
     * ギャラリー
     */
    $('#gallery').each(function () {
        /* 兵庫 */ 
        var $container = $(this),
            $loadMoreButton = $('#load-more'), // 追加ボタン
            $filter = $('#gallery-filter'),    // フィルタリングのフォーム
            addItemCount = 16,                    // 一度に表示するアイテム数
            addedd = 0,                        // 表示済みのアイテム数
            allData = [],                      // すべての JSON データ
            filteredData = [];                 // フィルタリングされた JSON データ

        $container.masonry({
            columnWidth: 230,
            gutter: 10,
            itemSelector: '.gallery-item'
        });

        // JSON を取得し、initGallery 関数を実行
        $.getJSON('../include/view/data/content.json', initGallery);

        // ギャラリーを初期化する
        function initGallery (data) {

            // 取得した JSON データを格納
            allData = data;

            // 最初の状態ではフィルタリングせず、そのまま全データを渡す
            filteredData = allData;

            // 最初のアイテムを表示
            addItems();

            // 追加ボタンがクリックされたら追加で表示
            $loadMoreButton.on('click', addItems);

            // フィルターのラジオボタンが変更されたらフィルタリングを実行
            $filter.on('change', 'input[type="radio"]', filterItems);

            // 06-04 に追加
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            // アイテムのリンクにホバーエフェクト処理を登録
            $container.on('mouseenter mouseleave', '.gallery-item a', headDisp);
            //$container.on('mouseenter mouseleave', '.gallery-item a', headDisp);
            
            //評点
            //$container.on('mouseenter mouseleave', '.gallery-itme a', headDisp);
            
            //$container.on('mouseenter mouseleave', '.gallery-itme a', headDisp);


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        }

        // アイテムを生成しドキュメントに挿入する
        function addItems (filter) {

          this.$container = $("#modal");
          this.$item = $(".gallery-item");
          this.$contents = $("#modal-contents");
          this.$close = $("#modal-close");
          this.$next = $("#modal-next");
          this.$prev = $("#modal-prev");
          this.$overlay = $("#modal-overlay");
          this.$window = $(window);
          /*  */
            var elements = [],
                // 追加するデータの配列
                slicedData = filteredData.slice(addedd, addedd + addItemCount);

            // slicedData の要素ごとに DOM 要素を生成
            $.each(slicedData, function (i, item) {
                var itemHTML =
                        '<li class="gallery-item is-loading">' +
                            '<a id="item_link'+ item.dataindex + '" data-index="'+ item.dataindex + '" href="' + item.images.large + '">' +
                                '<img src="' + item.images.thumb + '" alt="">' +
                                '<span class="caption">' +
                                    '<span class="inner">' +
                                        '<b class="title">' + item.title + '</b>' +
                                        '<time class="date" datatime="' + item.date + '">' +
                                            item.date.replace(/-0?/g, '/') +
                                        '</time>' +
                                    '</span>' +
                                    '<span class="inner2">' +        
                                    	'<b class="title"><form action="./profile.php?user_id=2" method="get"><input name="user_id" type="hidden" value="2"><input type="submit" value="閲覧"></form>' + item.user + '</b>' +

                                    '</span>' +
                                '</span>' +
                            '</a>' +
                        '</li>';     
                elements.push($(itemHTML).get(0));
            });

            // DOM 要素の配列をコンテナーに挿入し、Masonry レイアウトを実行
            $container
                .append(elements)
                .imagesLoaded(function () {
                    $(elements).removeClass('is-loading');
                    $container.masonry('appended', elements);

                    // フィルタリング時は再配置
                    if (filter) {
                        $container.masonry();
                    }
                });

            // リンクに Colorbox を設定
            $(".gallery-item a").on('click',function(e){
                //e.preventDefault();
                var src = this;
                alert(src);
                //課題：今クリックされたclass="gallery-item"を$itemに指定したい
                //alert(e.target.attr("src"));
                //var src = this;
                //var src2 = this;
                //console.log(src);
                //alert(src);
                //alert(src2);
                //var src = this.find('a').attr("href");
                //var src2 = this.find('a');
                //alert(src);
                //var index = $container.find('a').attr("data-index");   
                //alert(index);  
                /*
                $("#modal-contents").html("<img src=\"" + src + "\" />");
                $("#modal").fadeIn();
                $("#modal-overlay").fadeIn();
                var index = $container.find('a').attr("data-index");
                //alert(index);
                var size = $('li').length;
                //console.log(index);

                countChange = createCounter(index, size);
                //$("#modal-overlay");
                //this.$contents.html("<img src=\"" + src + "\" />");
                //this.$container.fadeIn();
                //this.$overlay.fadeIn();
                //alert(src);
                //self.show(e);
                */
                return false;
            });

            function createCounter(index, len){
                return function(num) {
                return index = (index + num + len) % len;
                };
            };

            /* オブジェクトの次を（前を）選ぶ */
            function slide(index){

                $("#modal-contents").find("img").fadeOut({
                    complete:function(){
                        //本来はオブジェクトが渡されてくるが現在は箱が渡されている
                        var src = $("[data-index=\"" + index + "\"]").find("img").attr("src");
                        
                        $(this).attr("src", src).fadeIn();
                    }
                });
            }

            $("#modal-close").on("click", function(e) {
                $("#modal").fadeOut(e);
                $("#modal-overlay").fadeOut(e);
                return false;
              });

            $("#modal-next").on("click", function(e) {
              //alert('aaa');
              slide(countChange(1));
              return false;
            });

            $("#modal-prev").on("click", function(e) {
              //alert('aaa');
              slide(countChange(-1));
              return false;
            });

            $window.on("load resize", function(){
              var w = $window.width();
              if(w < 640){
                $("#container").css({"width": "320","height":"213"});
              }else{
                $("#container").css({"width": "750","height":"500"});
              }
            });

            /*
            $container.find('a').colorbox({
                maxWidth: '970px',
                maxHeight: '95%',
                title: function () {
                    return $(this).find('.inner2').html();
                }
            });
            */

            // 追加済みアイテム数の更新
            addedd += slicedData.length;

            // JSON データがすべて追加し終わっていたら追加ボタンを消す
            if (addedd < filteredData.length) {
                $loadMoreButton.show();
            } else {
                $loadMoreButton.hide();
            }
        }

        // アイテムをフィルタリングする
        function filterItems () {
            var key = $(this).val(), // チェックされたラジオボタンの value

            // 追加済みの Masonry アイテム
            masonryItems = $container.masonry('getItemElements');

            // Masonry アイテムを削除
            $container.masonry('remove', masonryItems);

            // フィルタリング済みアイテムのデータをリセットと
            // 追加済みアイテム数をリセット
            filteredData = [];
            addedd = 0;

            if (key === 'all') {
                // all がクリックされた場合、すべての JSON データを格納
                filteredData = allData;
            } else {
                // all 以外の場合、キーと一致するデータを抽出
                filteredData = $.grep(allData, function (item) {
                    return item.category === key;
                });
            }

            // アイテムを追加
            addItems(true);
        }

// 06-04 に追加
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // ホバーエフェクト
        //function hoverhead (event) {
        //    console.log('bbb');

        /*
            var $overlay = $(this).find('.caption'),
                side = getMouseDirection(event),
                animateTo,
                positionIn = {
                    top:  '0%',
                    left: '0%'
                },
                positionOut = (function () {
                    switch (side) {
                        // case 0: top, case 1: right, case 2: bottom, default: left
                        case 0:  return { top: '-100%', left:    '0%' }; break; // top
                        case 1:  return { top:    '0%', left:  '100%' }; break; // right
                        case 2:  return { top:  '100%', left:    '0%' }; break; // bottom
                        default: return { top:    '0%', left: '-100%' }; break; // left
                    }
                })();
            if (event.type === 'mouseenter') {
                animateTo = positionIn;
                $overlay.css(positionOut);
            } else {
                animateTo = positionOut;
            }
            $overlay.stop(true).animate(animateTo, 250, 'easeOutExpo');
            */
        //}

        // マウスの方向を検出する関数
        // http://stackoverflow.com/a/3647634
        /*
        function getMouseDirection (event) {
            var $el = $(event.currentTarget),
                offset = $el.offset(),
                w = $el.outerWidth(),
                h = $el.outerHeight(),
                x = (event.pageX - offset.left - w / 2) * ((w > h)? h / w: 1),
                y = (event.pageY - offset.top - h / 2) * ((h > w)? w / h: 1),
                direction = Math.round((Math.atan2(y, x) * (180 / Math.PI) + 180) / 90  + 3) % 4;
            return direction;
        }
        */
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // ホバーエフェクト
        function headDisp(event){

          // マウスオーバーした写真のファイル名を取得
          var file_name = $(this).children().attr('src').split('/').pop();

          var file_name_s = file_name.replace(/.jpg/g,"");

/*

          // マウスオーバーした写真のファイル名を取得
          var selectedSrc_t = $(this).children().attr('src').split('/').pop();

          //「/」で区切って配列化
          var pathinfo = path.split('/');
          //最後の要素（ファイル名）だけ抜き出し
          var filename = pathinfo.pop();

          //console.log(pathinfo);
          //console.log(filename);
*/

          selectedSrc = file_name_s.replace(/thumb/g,"large");
          selectedSrc_o = selectedSrc + '.jpg';
          selectedSrc_m = selectedSrc + '_m.jpg';
          selectedSrc_c = selectedSrc + '_c.jpg';
          console.log(selectedSrc_o);
          console.log(selectedSrc_m);
          console.log(selectedSrc_c);
          //console.log(selectedSrc_o);
          //console.log(selectedSrc_m);
          //console.log(selectedSrc_c);
          // TOP写真をマウスオーバーした写真で入れ替える
          $('.head_photo1').attr('src',"../include/view/img/" + selectedSrc_o);
          $('.head_photo2').attr('src',"../include/view/img/" + selectedSrc_m);
          $('.head_photo3').attr('src',"../include/view/img/" + selectedSrc_c);
          // console.log(selt);
        }
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    });

    // jQuery UI Button
    $('.filter-form input[type="radio"]').button({
        icons: {
            primary: 'icon-radio'
        }
    });

    // Resize page header
    $('.page-header').each(function () {
        var $header = $(this),
            headerHeight = $header.outerHeight(),
            headerPaddingTop = parseInt($header.css('paddingTop'), 10),
            headerPaddingBottom = parseInt($header.css('paddingBottom'), 10);
        $(window).on('scroll', $.throttle(1000 / 60, function () {
            var scroll = $(this).scrollTop(),
                styles = {};
            if (scroll > 0) {
                if (scroll < headerHeight) {
                    styles = {
                        paddingTop: headerPaddingTop - scroll / 2,
                        paddingBottom: headerPaddingBottom - scroll / 2
                    };
                } else {
                    styles = {
                        paddingTop: 0,
                        paddingBottom: 0
                    };
                }
            } else {
                styles = {
                    paddingTop: '',
                    paddingBottom: ''
                }
            }
            $header.css(styles);
        }));
    });
});
