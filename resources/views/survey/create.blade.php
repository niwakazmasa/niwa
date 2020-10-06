<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>タイトル &mdash; アンケート新規作成</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
	<meta name="keywords" content="free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />

  	<!--
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE
	DESIGNED & DEVELOPED by FreeHTML5.co

	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	-->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="{{ asset('css/flexslider.css') }}">
	<!-- Theme style  -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<!-- score style  -->
	<link rel="stylesheet" href="{{ asset('css/home.css') }}">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
	<div id="fh5co-page">
		<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
		<aside id="fh5co-aside" role="complementary" class="border js-fullheight">

			<h1 id="fh5co-logo"><a href="{{ url('/home/') }}">タイトル</a></h1>
			<nav id="fh5co-main-menu" role="navigation">
				<ul>
					<li><a href="{{ url('/home/') }}">Home</a></li>
					<li><a href="{{ url('/testlist/') }}">テスト一覧</a></li>
					<li><a href="{{ url('/survey/') }}">アンケート一覧</a></li>
					<li><a href="{{ url('/student/') }}">生徒一覧</a></li>
					<li><a href="{{ url('/score/') }}">点数早見表</a></li>
					<li><a href="{{ url('/grade/') }}">未採点</a></li>
				</ul>
			</nav>

			<div class="fh5co-footer">
				<div class="logout-space">
					<a href="{{ route('logout') }}" class="logout-btn">ログアウト</a>
				</div>
				<p><small>&copy; 2020 carecon. All Rights Reserved.</small></p>
			</div>

		</aside>

		<div id="fh5co-main" class="animate-box" data-animate-effect="fadeInLeft">
			<div class="fh5co-narrow-content">
				<h2 class="fh5co-heading">アンケート新規作成</h2>

        <div id="count" class="container animate-box" data-animate-effect="fadeInLeft">
					<form action="{{ route('survey.store')}}" method="POST">
						@csrf
            <div class="title-rap">
              <input type="text" name="ak_title" placeholder="アンケートタイトルを入力してください。">
							<label><input type="radio" name="status" value="1" checked>使用</label>
							<label><input type="radio" name="status" value="2">未使用</label>
              <!-- <textarea name="text" rows="2" placeholder="ここにテキストを入れることができます。"></textarea> -->
            </div>
            <table>
              <!-- <tbody> -->
              <tbody id="sortable">
              <!-- ここに問題が追加されていきます。 -->

              </tbody>
            </table>
            <input type="submit" id="save" onclick="return confirm('アンケート作成を完了しますか？')" value="保存"> <!-- 保存した時にアンケート順番で連番つける（jQuery） -->
          </form>

          <!-- <p id="output">0</p> -->

          <button id="addChoice2" class="plus">+ 2択問題追加</button>
          <button id="addText" class="plus">+ アンケート追加</button>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
				<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
				<script>
				// テーブルの値を１行ずつ取得してjqueryにて連想配列を作る
				// .idの処理
				// $('#addText').click(function(){
					$('#save').click(function(){
						// trにvalue値入れる
						$('#sortable tr').each(function(i){
							$(this).attr('value',(i+1));
							// alert(value);
						});
						// 選択問題の何問目か判定
						$('#sortable #con').each(function(i){
								$(this).attr('class','con' + (i+1));
						});
						// 記述問題の何問目か判定
						$('#sortable #tainer').each(function(i){
							$(this).attr('class','tainer' + (i+1));
						});

						// ロール判定つける
						$('#sortable .role').each(function(i){
							$(this).attr('name','role' + (i+1));
						});

						// 全体で何問目かの判定　nameにid振る
						$('#sortable .id').each(function(i){
							$(this).attr('name','id');
							$(this).attr('value',(i+1));
						});

						// .choice-textの処理
						$('#sortable .choice-text').each(function(i){
							var value = $('.con' + (i+1)).attr("value");
							$(this).attr('name','choice_text' + (value));
						});
						// .yes-answerの処理
						$('#sortable .yes-answer').each(function(i){
							var value = $('.con' + (i+1)).attr("value");
							$(this).attr('name','yes_answer' + (value));
						});
						// .no-answerの処理
						$('#sortable .no-answer').each(function(i){
							var value = $('.con' + (i+1)).attr("value");
							$(this).attr('name','no_answer' + (value));
						});
						// .describing-textの処理
						$('#sortable .describing-text').each(function(i){
							var value = $('.tainer' + (i+1)).attr("value");
							alert(value);
							$(this).attr('name','describing_text' + (value));
						});
					});

					// 並び替え機能
						$('tbody').sortable();

						var h = 0;
            // 2択問題追加
        		//追加ボタンがクリックされたら、function(){…}の処理を実行する
						$('#addChoice2').click(function(){
								var html = '<tr id="con" class=""><input type="hidden" class="id" value=""><input type="hidden" class="role" value="2"><td><textarea class="choice-text" name="" rows="5" cols="50" placeholder="ここに質問を入力してください。" value=""></textarea></td><td><input type="text" class="yes-answer" name="" value="" placeholder="回答を入力してください。"><input type="text" class="no-answer" name="" value="" placeholder="回答を入力してください。"></td><td class="remove-center"><button class="remove">-</button></td></tr>';
								//append()を使ってtbody内の一番最後にhtmlを追加する
								$('tbody').append(html);
            });

            // アンケート追加
						//記述アンケート
        		//追加ボタンがクリックされたら、function(){…}の処理を実行する
        		$('#addText').click(function(){
								var html ='<tr id="tainer" class=""><input type="hidden" class="id" value=""><input type="hidden" class="role" value="1"><td><textarea class="describing-text" name="" rows="5" cols="50" placeholder="ここに質問を入力してください。"></textarea></td><td class="remove-center"><button class="remove">-</button></td></tr>';
								//append()を使ってtbody内の一番最後にhtmlを追加する
        				$('tbody').append(html);
            });

        		// 削除処理
        		//削除ボタンがクリックされたら、function(){…}の処理を実行する
        		$(document).on('click', '.remove', function() {
        				//クリックされた.removeの親要素trをremove（削除）する
                $(this).parents('tr').remove();
            });



				// 問題数上限カウント処理 //完成
				$(function(){
					var i = 0;
					if ((n === undefined)) {
						var n = 0;
					} else {
						var n = n;
					}
						// 問題を追加するたび数字をプラスする
						$(document).on('click', '.plus', function() {
							i++;
							var n = i;
							// alert(n);
							if( n <= 49 ){
								// $('#output').html(i);
							} else {
								// 問題追加ボタンを消す
								$('.plus').hide();
							}
						});
						// 問題を削除するたび数字をマイナスする
						$(document).on('click', '.remove', function() {
							i--;
							var n = i;
							// alert(n);
							// $('#output').html(i);
							if( n >= 49 ){
								// 問題ボタンを復活させる
								$('.plus').show();
							}
						});
				});

			</script>



				<a href="{{ route('survey.index')}}" class="more icon-arrow-left3"> 戻る</a>
			</div>
		</div>
		</div>

	<!-- jQuery -->
	<!-- <script src="js/jquery.min.js"></script> -->
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>


	<!-- MAIN JS -->
	<script src="js/main.js"></script>

	</body>
</html>
