<?php
include 'index-functions.php';

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
$sidebar = generate_sidebar();
if (!empty($_POST['chill_submit'])) {
	$aws_id = $_POST['aws_id'];
	$start_date = strftime("%Y-%m-%d",strtotime($_POST['start_date']));
	$end_date = strftime("%Y-%m-%d",strtotime($_POST['end_date']));
    $chill = chill_calculate_chill($aws_id, $start_date, $end_date);
	$aws_content = chill_show_results($aws_id, $start_date, $end_date, $chill);
} else if (!empty($_GET['view']) and $_GET['view'] == 'chill') { //present form to user
    $aws_content = chill_show_form();
} else if (!empty($_GET['view']) and $_GET['view'] == 'chillresult') { //present results to user
    $aws_id = $_GET['aws_id'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $chill = chill_calculate_chill($aws_id, $start_date, $end_date);
    $aws_content = chill_show_results($aws_id, $start_date, $end_date, $chill);
} else {
    $aws_content = generate_aws_content($aws_id, $view, $main_view);
}

$ga_code = google_analytics_samdb();

//generate page structure
$page_contents = '
	<div id="breadcrumbs">
		'.$breadcrumbs.'
	</div>
	<div id="navigation">
		'.$sidebar.'
	</div><!-- #navigation -->
	
	<div id="content">
		<h1>Weatherstations</h1>
		'.$aws_content.'
	</div><!-- #content -->
	
	'.$ga_code.'
';

//get the template, fill it with content, print
$template_url = "http://www.naturalresources.sa.gov.au/samurraydarlingbasin/home";
$template_cache_file = "index-template.php";
print generate_page_with_template($template_url, $template_cache_file, $page_contents);

?>
