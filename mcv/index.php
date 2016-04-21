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
$sidebar = generate_sidebar('MCV');
if (!empty($_POST['chill_submit'])) {
	$aws_id = $_POST['aws_id'];
	$start_date = strftime("%Y-%m-%d",strtotime($_POST['start_date']));
	$end_date = strftime("%Y-%m-%d",strtotime($_POST['end_date']));
    $chill = chill_calculate_chill($aws_id, $start_date, $end_date);
	$aws_content = chill_show_results($aws_id, $start_date, $end_date, $chill);
} else if (!empty($_GET['view']) and $_GET['view'] == 'chill') { //present form to user
    $aws_content = chill_show_form('MCV');
} else if (!empty($_GET['view']) and $_GET['view'] == 'chillresult') { //present results to user
    $aws_id = $_GET['aws_id'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $chill = chill_calculate_chill($aws_id, $start_date, $end_date);
    $aws_content = chill_show_results($aws_id, $start_date, $end_date, $chill);
} else {
    $aws_content = generate_aws_content($aws_id, $view, $main_view, 'MCV');
}

$ga_code = google_analytics_samdb();
?>

<!DOCTYPE html> 
<html class="js activeSlide" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
	<?php include 'mclaren-header.php'; ?>
	<?php if (isset($head_additions)) {echo $head_additions;} ?>
</head>
<body> 
	<?php include 'mclaren-top.php'; ?>
	<?php include 'aws-style.php'; ?>
	<div class="content_container_aws">
		<div class="content_layout">
			<h1>Weatherstations</h1>
			<?php print $aws_content; ?>
			<?php include 'aws-bottom.php'; ?>
		</div>
	</div>
	<?php include 'mclaren-bottom.php'; ?>
</body>
</html>