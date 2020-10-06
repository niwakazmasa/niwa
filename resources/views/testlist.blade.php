<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>タイトル &mdash; テスト一覧</title>
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
					<li class="fh5co-active"><a href="{{ url('/testlist/') }}">テスト一覧</a></li>
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

		<div id="fh5co-main">
			<div class="fh5co-narrow-content">
				<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">テスト一覧</h2>

				{{-- @if ($user_role == 2) --}}
					<input type="submit" class="btn btn-primary btn-md animate-box" data-animate-effect="fadeInLeft" onclick="location.href='{{ url('/testcreate/') }}'" value="新規作成">
					<form action="{{ url('/testlist/') }}" method="POST">
						@csrf
						<div class="test-select animate-box" data-animate-effect="fadeInLeft">
							<input type="submit" name="status" id="on" value="1" {{ $status == '1' ? 'checked' : '' }}>
							<label for="on">使用中テスト表示</label>
							<input type="submit" name="status" id="off" value="2"　{{ $status == '2' ? 'checked' : '' }}>
							<label for="off">未使用テスト表示</label>
						</div>
					</form>
				{{-- @endif --}}

				<div class="row row-bottom-padded-md">

				@foreach ($dblist as $key => $tests)
					<div class="col-md-3 col-sm-6 col-padding animate-box" data-animate-effect="fadeInLeft">
						<div class="blog-entry">
							<a href="{{ url('/test/') }}" class="blog-img"><img src="" class="img-responsive" alt="#"></a>
							<div class="desc">
								<h3><a href="{{ url('/test/') }}">{{$tests->title}}</a></h3>
								<span><small>{{$tests->updated_at}}</small></span>
								<!-- <p>ここにテキストを入れることができます。</p> -->
								<div class="more-center">
									<a href="{{ url('/test/') }}" class="lead more">テスト受講</a>
									@if ($user_role == 2)
										<a href="{{ url('/testedit/'.$tests->id)}}" class="lead more">詳細・編集</a>

										<form action="/testlist/delete/{{$tests->id}}" method="POST">
											{{ csrf_field() }}
											<input class="lead more" type="submit" value="削除" onclick='return confirm("本当に削除しますか？");'>
										</form>
									@endif

								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
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
