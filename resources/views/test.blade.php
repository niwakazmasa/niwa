<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>タイトル &mdash; テスト受講</title>
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
<!-- home style  -->
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
			</nav>

			<div class="fh5co-footer">
				<p><small>&copy; 2020 carecon. All Rights Reserved.</small></p>
			</div>

		</aside>

		<div id="fh5co-main">
			<div class="timerbox">
				<h1 id="timer" class="hako box" style=""></h1>
			</div>
			<div class="fh5co-narrow-content">
				<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">テストタイトル</h2>

				<!-- 問題表示 -->
				<form class="form-inline" id="answer" action="{{ url('/test') }}" method="GET">
					@foreach ($sorteds as $key => $tests)
					<div class="fh5co-narrow-content animate-box" data-animate-effect="fadeInLeft">
						<div class="row">
							<div class="col-md-4">
								<h4>問題{{$tests->question_number}}</h4>
								<p>{{$tests->question}}</p>
							</div>
						</div>

						<!-- ここからテスト問題の回答 -->
						<div class="row">
							<!-- if文で選択、穴埋め、記述を切り分ける -->
							<!-- テスト回答送信機能 -->
							<!-- actionに問題の番号つけて送信した時に区別する -->
							<!-- テストの回答方式で判別 -->
							@if ($tests->role === 1)　<!-- role　1　記述問題 -->
							<div class="form-group">
							 	<label for="content">回答記入欄</label>
								<input type="hidden" class="form-control" name="question{{$tests->question_number}}" value="{{$tests->role}}">　<!-- ロール判定用 -->
								<input type="text" class="form-control" name="answer{{$tests->question_number}}" value="">
							</div>

							@elseif ($tests->role === 2)　<!-- role　2　選択問題 -->
							<!-- もし4択8択で切り分けが必要な時はNULLをif文できる -->
							<div class="form-group">
								<input type="hidden" class="form-control" name="question{{$tests->question_number}}" value="{{$tests->role}}"> <!-- ロール判定用 -->
								<input type="hidden" class="form-control" name="question_answer{{$tests->question_number}}" value="{{$tests->answer}}"> <!-- 回答正解判定用 -->
								<input type="radio" name="b_answer{{$tests->question_number}}" value="1">　<!-- ラジオボタン送信様 -->
								<label for="content">{{$tests->select_item1}}</label>
								<input type="radio" name="b_answer{{$tests->question_number}}" value="2">　<!-- ラジオボタン送信様 -->
								<label for="content">{{$tests->select_item2}}</label>
								<input type="radio" name="b_answer{{$tests->question_number}}" value="3">　<!-- ラジオボタン送信様 -->
								<label for="content">{{$tests->select_item3}}</label>
								<input type="radio" name="b_answer{{$tests->question_number}}" value="4">　<!-- ラジオボタン送信様 -->
								<label for="content">{{$tests->select_item4}}</label>
								<input type="radio" name="b_answer{{$tests->question_number}}" value="5">　<!-- ラジオボタン送信様 -->
								<label for="content">{{$tests->select_item5}}</label>
								<input type="radio" name="b_answer{{$tests->question_number}}" value="6">　<!-- ラジオボタン送信様 -->
								<label for="content">{{$tests->select_item6}}</label>
								<input type="radio" name="b_answer{{$tests->question_number}}" value="7">　<!-- ラジオボタン送信様 -->
								<label for="content">{{$tests->select_item7}}</label>
								<input type="radio" name="b_answer{{$tests->question_number}}" value="8">　<!-- ラジオボタン送信様 -->
								<label for="content">{{$tests->select_item8}}</label>
							</div>

							@elseif ($tests->role === 3)　<!-- role　3　穴埋め問題 -->
							<div class="form-group">
								<label for="content">回答記入欄</label>
								<input type="hidden" class="form-control" name="question{{$tests->question_number}}" value="{{$tests->role}}">　<!-- ロール判定用 -->
								<input type="hidden" class="form-control" name="question_answer1_{{$tests->question_number}}" value="{{$tests->answer1}}"> <!-- 1回答正解判定用 -->
								<label for="content">1</label>
								<input type="text" class="form-control" name="h_answer1_{{$tests->question_number}}" value="">
								<input type="hidden" class="form-control" name="question_answer2_{{$tests->question_number}}" value="{{$tests->answer2}}"> <!-- 2回答正解判定用 -->
								<label for="content">2</label>
								<input type="text" class="form-control" name="h_answer2_{{$tests->question_number}}" value="">
							</div>
							@endif
						</div>
					</div>
					@endforeach

					<div class="test-btn">
						<!-- <input type="submit" onclick="return confirm('テストを終了してもよろしいですか？')" name="answers" form="answer" class="btn btn-primary btn-md"
						onclick="location.href='{{ url('/testend/') }}'" value="テスト終了"> -->
						<input type="submit" onclick="return confirm('テストを終了してもよろしいですか？')" class="btn btn-primary btn-md" value="テスト終了">
						<!-- <input id="btn" type="hidden" name="answers" form="answer" onclick="return confirm('テストを終了を終了します。')" value="テスト終了"> -->
						<input id="btn" type="submit" style="visibility: hidden;" name="answers" form="answer" onclick="" value="テスト終了">
						<!-- <input id="btn" type="hidden" name="answers" form="answer" onclick="return confirm('テストを終了してもよろしいですか？')" value="テスト終了"> -->
					</div>
				</form>

			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="js/google_map.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

	<!-- タイマー機能の処理（jquery） -->
	<script>

	var to_timeup = {{$test_time}} *60; //講師の設定した時間をテーブルから持ってくる
			var intervalid;
			var start_flag = false;

				if($.cookie('end')){
		        var end = new Date($.cookie('end'));
		     } else {
					 var end = new Date();
					 end.setMinutes(end.getMinutes() + {{$test_time}});
					 // end.setMinutes(end.getMinutes() + 1);
					 $.cookie('end', end);
					 var ended = $.cookie('end');
	 				 console.log(ended);
		     }
				 // $.removeCookie('end');

			function count_start(){
				 if(start_flag===false){
					intervalid = setInterval(count_down,1000);
					start_flag = true;
				 }
			}

			function count_stop(){
                clearInterval(intervalid);
                start_flag = false;
      }

			function count_down(){

				var now = new Date();
				var count = Math.floor((end - now) / 1000);

				if (count < 0) {
					$.removeCookie('end');
					$('#btn').trigger('click');
					count_stop();
				}   else {
					to_timeup--;
					padding();
				}
			}

			function padding(){
					var timer=document.getElementById("timer");
					var min = 0;
					var sec = 0;
					min = Math.floor(to_timeup/60);
					sec = (to_timeup%60);
					min = ("0"+min).slice(-2);
					sec = ("0"+sec).slice(-2);
					timer.innerHTML = min +":"+ sec;
			}

			window.onload = function(){
					padding();
					count_start();
			}

　</script>

	<!-- MAIN JS -->
	<script src="js/main.js"></script>

</body>
</html>
