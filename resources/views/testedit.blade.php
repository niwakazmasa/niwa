<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>タイトル &mdash; テスト詳細・編集</title>
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
				<h2 class="fh5co-heading">テスト詳細・編集</h2>
				<div id="count" class="container animate-box" data-animate-effect="fadeInLeft">
					<form action="{{ url('/testedit/'.$test_id)}}" method="post">
						@csrf
	          <div class="title-rap">
	            <input type="text" name="text" value="{{$test->title}}">
							<label><input type="radio" value="1" name="status" @if (old('status', $test->status) == 1) checked @endif>使用</label>
							<label><input type="radio" value="2" name="status" @if (old('status', $test->status) == 2) checked @endif>未使用</label>
	          </div>

						<table>
	          	<tbody id="sortable">
								@foreach ($sort as $value)
									@if ($value->role == 1)
									<tr id="con" class="">
										<input type="hidden" class="id" value="">
										<td>
											<textarea class="1text" name="" rows="5" cols="50" placeholder="ここに問題文を入力してください。" value="">{{$value->question}}</textarea>
										</td>
										<td class="remove-center"><button class="remove">-</button></td>
									</tr>
									@endif

									@if ($value->role == 2)
									<tr id="er">
										<input type="hidden" class="id" value="">
										<td>
											<textarea class="8text" name="" rows="5" cols="50" placeholder="ここに問題文を入力してください。">{{$value->question}}</textarea>
										</td>
										<td>
											<input type="radio" class="8choice1_" @if (old('answer', $value->answer) == 1) checked @endif>
											<input type="text" class="8answer1_" name="" placeholder="回答を入力してください。" value="{{$value->select_item1}}">
											<input type="radio" class="8choice2_" @if (old('answer', $value->answer) == 2) checked @endif>
											<input type="text" class="8answer2_" name="" placeholder="回答を入力してください。" value="{{$value->select_item2}}">
											<input type="radio" class="8choice3_" @if (old('answer', $value->answer) == 3) checked @endif>
											<input type="text" class="8answer3_" name="" placeholder="回答を入力してください。" value="{{$value->select_item3}}">
											<input type="radio" class="8choice4_" @if (old('answer', $value->answer) == 4) checked @endif>
											<input type="text" class="8answer4_" name="" placeholder="回答を入力してください。" value="{{$value->select_item4}}">

											@if ($value->select_item5 != null)
											<input type="radio" class="8choice5_" @if (old('answer', $value->answer) == 5) checked @endif>
											<input type="text" class="8answer1_" name="" placeholder="回答を入力してください。" value="{{$value->select_item1}}">
											<input type="radio" class="8choice6_" @if (old('answer', $value->answer) == 6) checked @endif>
											<input type="text" class="8answer5_" name="" placeholder="回答を入力してください。" value="{{$value->select_item2}}">
											<input type="radio" class="8choice7_" @if (old('answer', $value->answer) == 7) checked @endif>
											<input type="text" class="8answer7_" name="" placeholder="回答を入力してください。" value="{{$value->select_item3}}">
											<input type="radio" class="8choice8_" @if (old('answer', $value->answer) == 8) checked @endif>
											<input type="text" class="8answer8_" name="" placeholder="回答を入力してください。" value="{{$value->select_item4}}">
											@endif
										</td>
										<td class="remove-center"><button class="remove">-</button></td>
									</tr>
									@endif

									@if ($value->role == 3)
									<tr id="ta">
										<td>
											<input type="hidden" class="id" value="">
											<textarea class="2text" name="" rows="5" cols="50" placeholder="ここに問題文を入力してください。">{{$value->question}}</textarea>
										</td>
										<td><input type="text" class="2answer1_" name="" placeholder="回答を入力してください。" value="{{$value->answer1}}"></td>
										<td><input type="text" class="2answer2_" name="" placeholder="回答を入力してください。" value="{{$value->answer2}}"></td>
										<td class="remove-center"><button class="remove">-</button></td>
									</tr>
									@endif
								@endforeach
							</tbody>
						</table>

	          <input id="save" type="submit" value="保存">

					</form>

	        <p id="output">{{$count_questions}}</p>

	        <button id="addTest1" class="plus">+ 1回答問題追加</button>
	        <button id="addTest2" class="plus">+ 2回答問題追加</button>
	        <button id="addChoice8" class="plus">+ 8択問題追加</button>

				</div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <script>
        $(function(){

					// テーブルの値を１行ずつ取得してjqueryにて連想配列を作る
					// .idの処理
					// $('#addChoice8').click(function(){
						$('#save').click(function(){
						// alert({{$test->title}});
							// コンテナーにid振る
							$('#sortable tr').each(function(i){
								$(this).attr('value',(i+1));
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
								});
						}

						// .8choice[t]_"のラジオボタン処理
						for (var t = 1; t <= 8; t++) {
								$('#sortable .8choice'+t+'_').each(function(i){
									var value = $('.er' + (i+1)).attr("value");
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
					var html = '<tr id="er"><input type="hidden" class="id" value=""><td><textarea class="8text" name="" rows="5" cols="50" placeholder="ここに問題文を入力してください。"></textarea></td><td><input type="radio" class="8choice1_"><input type="text" class="8answer1_" name="" value="" placeholder="回答を入力してください。"><input type="radio" class="8choice2_"><input type="text" class="8answer2_" name="" value="" placeholder="回答を入力してください。"><input type="radio" class="8choice3_"><input type="text" class="8answer3_" name="" value="" placeholder="回答を入力してください。"><input type="radio" class="8choice4_"><input type="text" class="8answer4_" name="" value="" placeholder="回答を入力してください。"><input type="radio" class="8choice5_"><input type="text" class="8answer5_" name="" value="" placeholder="回答を入力してください。"><input type="radio" class="8choice6_"><input type="text" class="8answer6_" name="" value="" placeholder="回答を入力してください。"><input type="radio" class="8choice7_"><input type="text" class="8answer7_" name="" value="" placeholder="回答を入力してください。"><input type="radio" class="8choice8_"><input type="text" class="8answer8_" name="" value="" placeholder="回答を入力してください。"></td><td class="remove-center"><button class="remove">-</button></td></tr>';
        				$('tbody').append(html);
            });

        		// 削除処理
        		$(document).on('click', '.remove', function() {
                $(this).parents('tr').remove();
            });

						// 問題数上限カウント処理 //完成
						$(function(){
							var i = 0;
								// 問題を追加するたび数字をプラスする
								$(document).on('click', '.plus', function() {
									if ((n === undefined)) {
										var n = {{$count_questions}};
									} else {
										var n = n;
									}
									i++;
									var n = n + i;
									// alert(n);
									if( n <= 9 ){
										// $('#output').html(i);
									} else {
										// 問題追加ボタンを消す
										$('.plus').hide();
									}
								});
								// 問題を削除するたび数字をマイナスする
								$(document).on('click', '.remove', function() {
									if ((n === undefined)) {
										var n = {{$count_questions}};
									} else {
										var n = n;
									}
									i--;
									var n = n + i;
									// $('#output').html(i);
									if( n >= 9 ){
										// 問題ボタンを復活させる
										$('.plus').show();
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
