<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>タイトル &mdash; アンケート受講</title>
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
<!-- botan style  -->
<link rel="stylesheet" href="css/botan.css">

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
					<!-- アンケート回答中のため非表示 -->
	        <!-- <li><a href="{{ url('/home/') }}">Home</a></li>
	        <li><a href="{{ url('/testlist/') }}">テスト一覧</a></li>
	        <li><a href="{{ url('/survey/') }}">アンケート一覧</a></li>
	        <li><a href="{{ url('/student/') }}">生徒一覧</a></li>
	        <li><a href="{{ url('/score/') }}">点数早見表</a></li>
	        <li><a href="{{ url('/grade/') }}">未採点</a></li> -->
	      </ul>
	    </nav>

	    <div class="fh5co-footer">
	      <div class="logout-space">
	        <a href="{{ route('logout') }}" class="logout-btn">ログアウト</a>
	      </div>
	      <p><small>&copy; 2020 carecon. All Rights Reserved.</small></p>
	    </div>

	  </aside>

	<div id="fh5co-main">
	  <div class="fh5co-narrow-content">
	    <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">アンケート1</h2>

	    <!-- 問題表示 -->
	    <form class="form-inline" id="answer" action="" method="GET">
	          @foreach ($sorteds as $key => $ak)
	          <div class="fh5co-narrow-content animate-box" data-animate-effect="fadeInLeft">
	            <div class="row">
	              <div class="col-md-6">
	                <h4>問{{$ak->question_number}}</h4>
	                <p class="question-p">{{$ak->question}}</p>
	                <input type="hidden" class="form-control" name="text_question{{$ak->question_number}}" value="{{$ak->question}}">　<!-- 問題送る様 -->
	              </div>
	            </div>

	          <!-- ここからテスト問題の回答 -->
	          @if ($ak->role === 1)　<!-- 記述アンケート -->
	          <div class="row">
	            <div class="col-md-12">
	              <div class="row">
	                <div class="col-md-6">
	                  <div class="form-group">
	                    <label for="content">A.<input type="text" class="form-control question-input" name="answer{{$ak->question_number}}" placeholder="回答を入力"></label>
	                    <input type="hidden" class="form-control" name="role{{$ak->question_number}}" value="{{$ak->role}}">
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>

	          @elseif ($ak->role === 2)　<!-- 選択アンケート -->
	            <div class="row">
	              <div class="form-group">
	                <div class="col-md-12">
	                  <div class="radio">
	                    <label><input type="radio" name="b_answer{{$ak->question_number}}" value="1">　{{$ak->select_item1}}　</label>　<!-- ラジオボタン送信様 -->
	                    <input type="hidden" class="form-control " name="question{{$ak->question_number}}" value="{{$ak->role}}">
	                  </div>
	                  <div class="radio">
	                    <label><input type="radio" id="2" name="b_answer{{$ak->question_number}}" value="2">　{{$ak->select_item2}}　</label>　<!-- ラジオボタン送信様 -->
	                    <input type="hidden" id="2" class="form-control" name="question{{$ak->question_number}}" value="{{$ak->role}}">
	                  </div>
	                </div>
	                <input type="hidden" class="form-control" name="role{{$ak->question_number}}" value="{{$ak->role}}">
	              </div>
	            </div>
	          @endif
	          </div>
	          @endforeach

	      <div class="test-btn">
	        <input type="submit" class="btn btn-primary btn-md" onclick="return confirm('アンケートを終了してもよろしいですか？')" onclick="location.href='{{ url('/surveyend/') }}'" value="アンケート終了">
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


<!-- MAIN JS -->
<script src="js/main.js"></script>

</body>
</html>
