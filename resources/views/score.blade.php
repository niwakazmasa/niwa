<!DOCTYPE html>
<?php
 $status = ['活用中' => 1, '活用していない' => 2];
?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>タイトル &mdash; 点数早見表</title>
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
	<link rel="stylesheet" href="css/score.css">

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
					<li class="fh5co-active"><a href="{{ url('/score/') }}">点数早見表</a></li>
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
        <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">点数早見表</h2>

        <div class="animate-box search-form" data-animate-effect="fadeInLeft">
  　　　　　<!-- 検索フォーム -->
          <form action="{{url('/score')}}" method="GET">
            <!-- 期間ソート -->
            <div class="form-group-date">
              <p class="fh5co-lead ">受講期間を選択：</p>
              <input class="form-control form-sort" type="date" name="sort-start">
              <label> 〜 </label>
              <input class="form-control form-sort" type="date" name="sort-end">
            </div>
            <!-- 期間ソート終わり -->
            <!-- テストの検索 -->
            <div class="form-group-title">
              <p class="fh5co-lead">テストを選択：</p>
              <div class="title-sort">
                <select class="select-test form-control" name="test" value="{{$testss}}">
                  <option value="">---テストを選択---</option>
                  @foreach ($db as $key => $test)
                    <option value="{{$test->title}}">{{$test->title}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <!-- テストの検索終わり -->

            <!-- 使っているテストか判定 -->
            <div class="form-group-status">
              <p class="fh5co-lead">使用有無を選択：</p>
              <label class="use-status"><input type="radio" name="status" value="1" checked="checked"> 使用</label>
							<label class="use-status"><input type="radio" name="status" value="2"> 未使用</label>
            </div>
            <!-- 使っているテストか判定終わり -->

            <!-- 改善前プログラム -->
            <!-- 使っているテストか判定 -->
            <!-- <div class="form-group">
              <select class="select-test" name="status" size="1">
                <option selected="selected" value="">選択してください</option>
                @foreach($status as $key => $value)
                <option value="{{ $value }}" {{ isset($params['status']) && $params['status'] == $value ? 'selected': null }}>
                  {{ $key }}
                </option>
                @endforeach
              </select>
            </div> -->
            <!-- 使っているテストか判定終わり -->

            <div class="form-submit">
              <input type="submit" class="btn btn-primary btn-md" value="検索">
            </div>
          </form>
          <!-- 検索フォーム終わり -->
        </div>

        <div class="score-table animate-box" data-animate-effect="fadeInLeft">
          <table  style="table-layout:fixed;">
            <!-- 各項目 -->
            <tr>
              <th id="number">No.</th>
              <th>生徒</th>
              <th>
                <p class="table-th-p">
                  @empty($testss)
                    全てのテスト
                  @endempty
                  @isset ($testss)
                    {{$testss}}
                  @endisset
                </p>
                <p class="table-p">平均
                  @empty($testss)
                   {{ $dfavg }}
                  @endempty
                   {{ $avg }}
                点</p>
              </th>
            </tr>
            <!-- 各項目終わり -->
            <!-- 検索結果 -->

            @if($dblist->count())
            <?php $counter = 1;//カウンター ?>
            @foreach ($items as $tests)
            <tr>
              <td><p class="table-p"><?php echo $counter ?></p></td> <!-- テストナンバーに変える -->
              <td><p class="table-p">{{$tests->user_name}}</p></td>

              <td><a href="{{ url('testshow', $tests->test_id)}}">{{$tests->score}}点</a></td>
              <?php $counter++;//カウントを増加 ?>

            </tr>
            @endforeach
          @endif
          <!-- 検索結果終わり -->
          </table>
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
