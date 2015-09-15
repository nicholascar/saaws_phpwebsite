<?php
include '../index-functions.php';

//generate the relevant content's variables
if (isset($_GET['aws_id'])) {
	$aws_id = $_GET['aws_id'];
} else {
	$aws_id = 0;
}

if (isset($_GET['view'])) {
	$view = $_GET['view'];
} else {
	$view = 'summary';
}

if (!empty($_GET['main'])) {
	$main_view = $_GET['main'];
} else {
	$main_view = 'map';
}

/*
 * AWS content
 */
$breadcrumbs = generate_breadcrumbs($aws_id);
$sidebar = generate_sidebar('LMW');
if (!empty($_POST['chill_submit'])) {
	$aws_id = $_POST['aws_id'];
	$start_date = strftime("%Y-%m-%d",strtotime($_POST['start_date']));
	$end_date = strftime("%Y-%m-%d",strtotime($_POST['end_date']));
    $chill = chill_calculate_chill($aws_id, $start_date, $end_date);
	$aws_content = chill_show_results($aws_id, $start_date, $end_date, $chill);
} else if (!empty($_GET['view']) and $_GET['view'] == 'chill') { //present form to user
    $aws_content = chill_show_form('LMW');
} else if (!empty($_GET['view']) and $_GET['view'] == 'chillresult') { //present results to user
    $aws_id = $_GET['aws_id'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $chill = chill_calculate_chill($aws_id, $start_date, $end_date);
    $aws_content = chill_show_results($aws_id, $start_date, $end_date, $chill);
} else {
    $aws_content = generate_aws_content($aws_id, $view, $main_view, 'LMW');
}

$ga_code = google_analytics_samdb();

//generate page structure
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="Head1">
		<?php if (isset($head_additions)) {print $head_additions;} ?>
		<style type="text/css">
			#bodywrap
			{
				padding-left:20px;
				font-size:11px;
				font-family:Verdana;
			}
			ul#stationlist
			{
				list-style-type: none;
			}
			.format
			{
				font-size:11px;
				font-family:Verdana;		
			}
			.table_data
			{
				border-collapse:collapse;
				border:solid 1px #004a95;
				margin-bottom:10px;
				font-size:11px;
				font-family:Verdana;
			}
			.table_data a
			{
				color:#004a95;
				text-decoration:underline;
			}
			.table_data a:hover
			{
				text-decoration:none;
			}
			.table_data th
			{
				background-color: #004a95;
				color:white;
				vertical-align:top;
			}	
			.table_data td,
			.table_data th
			{
				border:solid 1px #004a95;
			}
			.table_data th h2
			{
				color:white;
			}
			.table_data .odd
			{
				background-color:white;
			}
			.table_data .even
			{
				background-color:#a6d2ef;
			}
			#viewlinks a
			{
				color:#004a95;
				text-decoration:underline;		
			}
		</style>			
		
	<title>
		Lower Murray Water - Weatherstations
	</title><meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
	<meta http-equiv="pragma" content="no-cache"> 
	<meta http-equiv="content-style-type" content="text/css"> 
	<meta http-equiv="content-script-type" content="text/javascript"> 
	<link type="text/css" rel="stylesheet" href="GetCSS_002.css"> 
	<link href="themefiles/GetCSS.css" type="text/css" rel="stylesheet" media="print"> 
	<link href="themefiles/Dialogs.css" type="text/css" rel="stylesheet"><link href="themefiles/ECommerce.css" type="text/css" rel="stylesheet"></head>
	</head>
	<body class="LTR Gecko8 ENAU">
		<?php include 'index-top.php'; ?>
			<!--You are here &gt; <strong><span class="CMSBreadCrumbsCurrentItem">LMW Weatherstations</span></strong>
			<br><br>-->
			<span style="font-size: medium"><span style="color: #0099ff"><strong>LMW Weatherstations</strong></span></span>
			<p>&nbsp;</p>
			<?php print $aws_content; ?>
		<?php include 'index-bottom.php' ?>
	</body>
</html>