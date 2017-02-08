<meta charset="utf-8">
<title><?php echo isset($title) ? $title : ''; ?> | <?php echo \Config::get('accon.site_name') ?></title>
<meta name="description" itemprop="description"
	  content="<?php echo isset($sub_title) ? $sub_title : ''; ?> | <?php echo isset($description) ? $description : ''; ?>"/>
<meta name="keywords" itemprop="keywords" content="<?php echo isset($keyword) ? $keyword : ''; ?>"/>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<?php
echo Asset::css('bootstrap.css');
echo Asset::js('bootstrap.min.js');
echo Asset::css('fileinput.min.css');
echo Asset::js('fileinput.min.js');
echo Asset::js('jquery.dataTables.min.js');
echo Asset::js('moment.min.js');
echo Asset::js('bootstrap-datetimepicker.min.js');
echo Asset::css('bootstrap-datetimepicker.min.css');
echo Asset::css('accon.css');
echo Asset::js('accon.js');
?>
<style>
	a {
		color: #5759ed;
	}

	a:hover {
		color: #241078;
	}

	.btn.btn-primary {
		color: #ffffff !important;
		background-color: #bfbff5;
		background-repeat: repeat-x;
		background-image: -moz-linear-gradient(top, #bfbff5, #2e2660);
		background-image: -ms-linear-gradient(top, #bfbff5, #2e2660);
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #bfbff5), color-stop(100%, #2e2660));
		background-image: -webkit-linear-gradient(top, #bfbff5, #2e2660);
		background-image: -o-linear-gradient(top, #bfbff5, #2e2660);
		background-image: linear-gradient(top, #bfbff5, #2e2660);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#bfbff5', endColorstr='#2e2660', GradientType=0);
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		border-color: #bfbff5 #2e2660 #141428;
		border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
	}

	.btn.btn-primary:hover,
	.btn.btn-primary:focus {
		background-image: -moz-linear-gradient(top, #2e2660, #bfbff5);
		background-image: -ms-linear-gradient(top, #2e2660, #bfbff5);
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2e2660), color-stop(100%, #bfbff5));
		background-image: -webkit-linear-gradient(top, #2e2660, #bfbff5);
		background-image: -o-linear-gradient(top, #2e2660, #bfbff5);
		background-image: linear-gradient(top, #2e2660, #bfbff5);
	}

	/*.panel-heading,*/
	.btn.btn-info {
		color: #ffffff !important;
		background-color: #c3e3ff;
		background-repeat: repeat-x;
		background-image: -moz-linear-gradient(top, #c3e3ff, #223d78);
		background-image: -ms-linear-gradient(top, #c3e3ff, #223d78);
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #c3e3ff), color-stop(100%, #223d78));
		background-image: -webkit-linear-gradient(top, #c3e3ff, #223d78);
		background-image: -o-linear-gradient(top, #c3e3ff, #223d78);
		background-image: linear-gradient(top, #c3e3ff, #223d78);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#c3e3ff', endColorstr='#223d78', GradientType=0);
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		border-color: #c3e3ff #223d78 #00235d;
		border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
	}

	/*.panel-heading:hover,*/
	/*.panel-heading:focus,*/
	.btn.btn-info:hover,
	.btn.btn-info:focus {
		background-image: -moz-linear-gradient(top, #223d78, #c3e3ff);
		background-image: -ms-linear-gradient(top, #223d78, #c3e3ff);
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #223d78), color-stop(100%, #c3e3ff));
		background-image: -webkit-linear-gradient(top, #223d78, #c3e3ff);
		background-image: -o-linear-gradient(top, #223d78, #c3e3ff);
		background-image: linear-gradient(top, #223d78, #c3e3ff);
	}

	.btn.btn-success {
		color: #ffffff !important;
		background-color: #affab1;
		background-repeat: repeat-x;
		background-image: -moz-linear-gradient(top, #affab1, #0a422e);
		background-image: -ms-linear-gradient(top, #affab1, #0a422e);
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #affab1), color-stop(100%, #0a422e));
		background-image: -webkit-linear-gradient(top, #affab1, #0a422e);
		background-image: -o-linear-gradient(top, #affab1, #0a422e);
		background-image: linear-gradient(top, #affab1, #0a422e);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#affab1', endColorstr='#0a422e', GradientType=0);
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		border-color: #affab1 #0a422e #091a0d;
		border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
	}

	.btn.btn-success:hover,
	.btn.btn-success:focus {
		background-image: -moz-linear-gradient(top, #0a422e, #affab1);
		background-image: -ms-linear-gradient(top, #0a422e, #affab1);
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #0a422e), color-stop(100%, #affab1));
		background-image: -webkit-linear-gradient(top, #0a422e, #affab1);
		background-image: -o-linear-gradient(top, #0a422e, #affab1);
		background-image: linear-gradient(top, #0a422e, #affab1);
	}

	.btn.btn-danger {
		color: #ffffff !important;
		background-color: #ffa9ac;
		background-repeat: repeat-x;
		background-image: -moz-linear-gradient(top, #ffa9ac, #561216);
		background-image: -ms-linear-gradient(top, #ffa9ac, #561216);
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffa9ac), color-stop(100%, #561216));
		background-image: -webkit-linear-gradient(top, #ffa9ac, #561216);
		background-image: -o-linear-gradient(top, #ffa9ac, #561216);
		background-image: linear-gradient(top, #ffa9ac, #561216);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffa9ac', endColorstr='#561216', GradientType=0);
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		border-color: #ffa9ac #561216 #3b1617;
		border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
	}

	.btn.btn-danger:hover,
	.btn.btn-danger:focus {
		background-image: -moz-linear-gradient(top, #561216, #ffa9ac);
		background-image: -ms-linear-gradient(top, #561216, #ffa9ac);
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #561216), color-stop(100%, #ffa9ac));
		background-image: -webkit-linear-gradient(top, #561216, #ffa9ac);
		background-image: -o-linear-gradient(top, #561216, #ffa9ac);
		background-image: linear-gradient(top, #561216, #ffa9ac);
	}

	.btn.btn-warning {
		color: #ffffff !important;
		background-color: #fffaa6;
		background-repeat: repeat-x;
		background-image: -moz-linear-gradient(top, #fffaa6, #4a4517);
		background-image: -ms-linear-gradient(top, #fffaa6, #4a4517);
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fffaa6), color-stop(100%, #4a4517));
		background-image: -webkit-linear-gradient(top, #fffaa6, #4a4517);
		background-image: -o-linear-gradient(top, #fffaa6, #4a4517);
		background-image: linear-gradient(top, #fffaa6, #4a4517);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffaa6', endColorstr='#4a4517', GradientType=0);
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		border-color: #fffaa6 #4a4517 #2e2d16;
		border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
	}

	.btn.btn-warning:hover,
	.btn.btn-warning:focus {
		background-image: -moz-linear-gradient(top, #4a4517, #fffaa6);
		background-image: -ms-linear-gradient(top, #4a4517, #fffaa6);
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #4a4517), color-stop(100%, #fffaa6));
		background-image: -webkit-linear-gradient(top, #4a4517, #fffaa6);
		background-image: -o-linear-gradient(top, #4a4517, #fffaa6);
		background-image: linear-gradient(top, #4a4517, #fffaa6);
	}

	.btn.btn-default {
		color: #ffffff !important;
		background-color: #e2e2e2;
		background-repeat: repeat-x;
		background-image: -moz-linear-gradient(top, #e2e2e2, #3b3b3b);
		background-image: -ms-linear-gradient(top, #e2e2e2, #3b3b3b);
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #e2e2e2), color-stop(100%, #3b3b3b));
		background-image: -webkit-linear-gradient(top, #e2e2e2, #3b3b3b);
		background-image: -o-linear-gradient(top, #e2e2e2, #3b3b3b);
		background-image: linear-gradient(top, #e2e2e2, #3b3b3b);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e2e2e2', endColorstr='#3b3b3b', GradientType=0);
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		border-color: #e2e2e2 #3b3b3b #070707;
		border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
	}

	.btn.btn-default:hover,
	.btn.btn-default:focus {
		background-image: -moz-linear-gradient(top, #3b3b3b, #e2e2e2);
		background-image: -ms-linear-gradient(top, #3b3b3b, #e2e2e2);
		background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #3b3b3b), color-stop(100%, #e2e2e2));
		background-image: -webkit-linear-gradient(top, #3b3b3b, #e2e2e2);
		background-image: -o-linear-gradient(top, #3b3b3b, #e2e2e2);
		background-image: linear-gradient(top, #3b3b3b, #e2e2e2);
	}

</style>
<?php if (file_exists(APPPATH."views/layout/analyticstracking.php")) include_once(APPPATH."views/layout/analyticstracking.php") ?>

