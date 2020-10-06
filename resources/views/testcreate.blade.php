<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>タイトル &mdash; テスト新規作成</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
<meta name="keywords" content="free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
<meta name="author" content="FreeHTML5.co" />

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
<link rel="stylesheet" href="css/animate.css">
<!-- Icomoon Icon Fonts-->
<link rel="stylesheet" href="css/icomoon.css">
<!-- Bootstrap  -->
<link rel="stylesheet" href="css/bootstrap.css">
<!-- Flexslider  -->
<link rel="stylesheet" href="css/flexslider.css">
<!-- Theme style  -->
<link rel="stylesheet" href="css/style.css">
<!-- score style  -->
<link rel="stylesheet" href="css/home.css">

<!-- Modernizr JS -->
<script src="js/modernizr-2.6.2.min.js"></script>

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
				@if($errors->any())
				<div class="alert alert-danger alert-form">
					<ul>
					@foreach($errors->all() as $message)
						<li>{{ $message }}</li>
					@endforeach
					</ul>
				</div>
				@endif
				<h2 class="fh5co-heading">テスト新規作成</h2>

				<!-- バリデーション -->
				@if ($errors->any())
				<div class="errors">
					<ul>
				  @foreach ($errors->all() as $error)
				  	<li>{{ $error }}</li>
				  @endforeach
					</ul>
				</div>
				@endif
				<!-- バリデーション終わり -->

        <div id="count" class="container animate-box" data-animate-effect="fadeInLeft">
          <form action = "{{ url('/testcreate/') }}" method="post">
            <input type="text" name="title"   placeholder="テストタイトルを入力してください。">
							<label><input type="radio" name="status" value="1" checked>使用</label>
							<label><input type="radio" name="status" value="2">未使用</label>
							<div class="time-rap">
								<label>テストタイム　<input type="number" name="test_time" min="1" max="100" value="1"> 分</label>
            	</div>
							<!-- <textarea name="test_heory" rows="2" placeholder="ここにテキストを入れることができます。"></textarea> -->
	            <table>
	              <tbody id="sortable">
	              	<!-- ここに問題が追加されていきます。 -->
	              </tbody>
	            </table>
							{{ csrf_field() }}
            <input id="save" type="submit" value="保存">
          </form>

          <button id="addTest1" class="plus">+ 1回答問題追加</button>
          <button id="addTest2" class="plus">+ 2回答問題追加</button>
          <!-- <button id="addChoice4" class="plus">+ 4択問題追加</button> -->
          <button id="addChoice8" class="plus">+ 択問題追加</button>
          <!-- <button id="addText" class="plus">+ テキスト問題追加</button> -->

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script>

	        $(function(){

						// テーブルの値を１行ずつ取得してjqueryにて連想配列を作る
						// .idの処理
						// $('#addChoice8').click(function(){
							$('#save').click(function(){
								// コンテナーにid振る
								$('#sortable tr').each(function(i){
									$(this).attr('value',(i+1));
									// alert(value);
								});
								$('#sortable #con').each(function(i){
										$(this).attr('class','con' + (i+1));
								});
								$('#sortable #ta').each(function(i){
									$(this).attr('class','ta' + (i+1));
								});
								$('#sortable #in').each(function(i){
										$(this).attr('class','in' + (i+1));
								});
								$('#sortable #er').each(function(i){
									$(this).attr('class','er' + (i+1));
								});

								$('#sortable .id').each(function(i){
									// $(this).attr('name','id_' + (i+1));
									$(this).attr('name','id');
									$(this).attr('value',(i+1));
								});

								// .1textの処理
								$('#sortable .1text').each(function(i){
									var value = $('.con' + (i+1)).attr("value");
									$(this).attr('name','1text' + (value));
								});
								// .1answer_の処理
								$('#sortable .1answer_').each(function(i){
									var value = $('.con' + (i+1)).attr("value");
									$(this).attr('name','1answer_' + (value));
								});
								// .2textの処理
								$('#sortable .2text').each(function(i){
									var value = $('.ta' + (i+1)).attr("value");
									$(this).attr('name','2text' + (value));
								});
								// .2answer1_"の処理
								$('#sortable .2answer1_').each(function(i){
									var value = $('.ta' + (i+1)).attr("value");
									$(this).attr('name','2answer1_' + (value));
								});
								// .2answer2_"の処理
								$('#sortable .2answer2_').each(function(i){
									var value = $('.ta' + (i+1)).attr("value");
									$(this).attr('name','2answer2_' + (value));
								});

								// .8text"の処理
								$('#sortable .8text').each(function(i){
									var value = $('.er' + (i+1)).attr("value");
									$(this).attr('name','8text' + (value));
								});

							// .8answer[t]_"の処理
							for (var t = 1; t <= 8; t++) {
									$('#sortable .8answer'+t+'_').each(function(i){
										var value = $('.er' + (i+1)).attr("value");
										$(this).attr('name','8answer'+t+'_' + (value));
										// alert('.8answer'+t+'_');
									});
							}

							// .8choice[t]_"のラジオボタン処理
							for (var t = 1; t <= 8; t++) {
									$('#sortable .8choice'+t+'_').each(function(i){
										var value = $('.er' + (i+1)).attr("value");
										// $(this).attr('name','8choice'+t+'_' + (value));
										$(this).attr('name','8choice'+t+'_' + (value));
										// alert('.8answer'+t+'_'(value));
									});
							}

							});

	            // 並び替え機能
	            $('tbody').sortable();

	        		// 問題追加 1回答
	        		$('#addTest1').click(function(){
									var html = '<tr id="con" class=""><input type="hidden" class="id" value=""><td><textarea class="1text" name="" rows="5" cols="50" placeholder="ここに問題文を入力してください。" value=""></textarea></td><td><input type="text" class="1answer_" name="" value="" placeholder="回答を入力してください。"></td><td class="remove-center"><button class="remove">-</button></td></tr>';
	        				$('tbody').append(html);
	            });

	            // 問題追加 2回答
	        		$('#addTest2').click(function(){
									var html = '<tr id="ta"><input type="hidden" class="id" value=""><td><textarea class="2text" name="" rows="5" cols="50" placeholder="ここに問題文を入力してください。" value=""></textarea></td><td><input type="text" class="2answer1_" name="" value="" placeholder="回答を入力してください。"><input type="text" class="2answer2_" name="" value="" placeholder="回答を入力してください。"></td><td class="remove-center"><button class="remove">-</button></td></tr>';
	        				$('tbody').append(html);
	            });

	            // 8択問題追加
	        		$('#addChoice8').click(function(){
									var html = '<tr id="er"><input type="hidden" class="id" value=""><td><textarea class="8text" name="" rows="5" cols="50" placeholder="ここに問題文を入力してください。"></textarea></td><td><input type="radio" name="correct" class="8choice1_"><input type="text" class="8answer1_" name="" value="" placeholder="回答を入力してください。"><input type="radio" name="correct" class="8choice2_"><input type="text" class="8answer2_" name="" value="" placeholder="回答を入力してください。"><input type="radio" name="correct" class="8choice3_"><input type="text" class="8answer3_" name="" value="" placeholder="回答を入力してください。"><input type="radio" name="correct" class="8choice4_"><input type="text" class="8answer4_" name="" value="" placeholder="回答を入力してください。"><input type="radio" name="correct" class="8choice5_"><input type="text" class="8answer5_" name="" value="" placeholder="回答を入力してください。"><input type="radio" name="correct" class="8choice6_"><input type="text" class="8answer6_" name="" value="" placeholder="回答を入力してください。"><input type="radio" name="correct" class="8choice7_"><input type="text" class="8answer7_" name="" value="" placeholder="回答を入力してください。"><input type="radio" name="correct" class="8choice8_"><input type="text" class="8answer8_" name="" value="" placeholder="回答を入力してください。"></td><td class="remove-center"><button class="remove">-</button></td></tr>';
	        				$('tbody').append(html);
	            });

	            // テキスト問題追加
	        		// $('#addText').click(function(){
	            //     var html = '<tr><td><textarea name="text" rows="5" cols="50" placeholder="ここに問題文を入力してください。"></textarea></td><td><textarea name="text" rows="5" cols="50" placeholder="回答を入力してください。"></textarea></td><td><button class="remove">-</button></td></tr>';
	        		// 		$('tbody').append(html);
	            // });

	        		// 削除処理
	        		$(document).on('click', '.remove', function() {
	                $(this).parents('tr').remove();
	            });

							// 問題数上限カウント処理 //完成
							$(function(){
								$('#save').hide();
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
										if( n <= 9 ){
											// $('#output').html(i);
										} else {
											// 問題追加ボタンを消す
											$('.plus').hide();
											//保存ボタン出現
											$('#save').show();
										}
									});
									// 問題を削除するたび数字をマイナスする
									$(document).on('click', '.remove', function() {
										i--;
										var n = i;
										// alert(n);
										// $('#output').html(i);
										if( n >= 9 ){
											// 問題ボタンを復活させる
											$('.plus').show();
											$('#save').hide();
										}
									});
							});

	        });
					
        </script>

        <a href="{{ url('/testlist/') }}" class="more icon-arrow-left3"> 戻る</a>
			</div>
		</div>
	</div>

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
