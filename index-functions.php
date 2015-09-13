<?php
//not used since using home page template
function add_dcterms_to_template() {
	//remove all meta tags
	$metaStart = strrpos($theme_header, '<link href');
	$theme_header = substr($theme_header, $metaStart);
	
	//add back in document start, title and Dublic core terms
	$this_uri = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$this_uri = str_replace("&","&amp;",$this_uri);
	
	$theme_header = '<!DOCTYPE html>
	<html lang="en" xml:lang="en" class="aw">
	<head>
		<meta charset="UTF-8">
		<title>Natural Resources Murray Darling Basin weatherstation data</title>
		
		<meta name="dcterms.creator" CONTENT="Department of Environment, Water and Natural Resources (DEWNR)">
		<meta name="dcterms.publisher" CONTENT="Department of Environment, Water and Natural Resources (DEWNR)">
		<meta name="dcterms.title" CONTENT="Natural Resources SA Murray-Darling Basin weatherstation data">
		<meta name="dcterms.created" CONTENT="2014-01-15">
		<meta name="dcterms.modified" CONTENT="2014-01-15">
		<meta name="dcterms.description" CONTENT="Hourly and daily weatherstation data from Natural Resources SA Murray-Darling Basin\'s weatherstation network">
		<meta name="dcterms.identifier" CONTENT="'.$this_uri.'">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		'.generate_aws_css().'
	' . $theme_header;	
}

function generate_page_with_template($template_url, $template_cache_file, $page_content) {
	//get template (using site index)
	$template = get_cached_contents($template_url, $template_cache_file);
	//$template = get_template_from_web($template_uri, $template_cache_file);
	
	//make all img & src links absolute
	$template = str_replace('src="/', 'src="http://www.naturalresources.sa.gov.au/', $template);
	$template = str_replace("src='/", "src='http://www.naturalresources.sa.gov.au/", $template);
	$template = str_replace('href="/', 'href="http://www.naturalresources.sa.gov.au/', $template);
	$template = str_replace("href='/", "href='http://www.naturalresources.sa.gov.au/", $template);
	
	// Isolate the header and the footer
	//$headerEnd = strrpos($template, '<div id="main" class="landing">') + 31;
	//$headerEnd = strrpos($template, '<form name="mainForm"');
	//$footerStart = strrpos($template, '</div><!--normalTemplateEnd-->');
	$headerEnd = strrpos($template, '<!--normalTemplateStart-->') + 26;
    $footerStart = strrpos($template, '<!--normalTemplateEnd-->');
    $template_header = clean_template_header(substr($template, 0, $headerEnd));// . '<div id="main">';        
    $template_footer = "\n".substr($template, $footerStart);
	
	//assemble page
	$ret  = $template_header;
	$ret .= $page_content;
	$ret .= $template_footer;
	
	return $ret;
}


function clean_template_header($template_header) {
	/*
	$headerMapStart = strpos($template, '<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/');
	$headerMapEnd = strpos($template, '</head>');
	$template_header_top = substr($template_header, 0, $headerMapStart);
	$template_header_bottom = substr($template_header, $headerMapEnd);
	
	return $template_header_top . '<!-- SPLICE -->' . $template_header_bottom;
	*/

	return $template_header;
}
//from http://davidwalsh.name/php-cache-function
/*
Pull from web disabled due to SA server blocking requests. Using static local copy of index-template for now. 2012-04-01
*/
function get_cached_contents($template_url, $template_cache_file, $hours = 48) {
	/*
	//if we have a local copy, check it for currency. If not, request a new template from web
	if (file_exists($template_cache_file)) {
		$current_time = time();
		$expire_time = $hours * 60 * 60;
		$file_time = filemtime($template_cache_file);
		
		//if we still have a current local copy, return its contents
		if ($current_time - $expire_time < $file_time) {
			return file_get_contents($template_cache_file);
		} else { //not current, request new
			$template_content = get_template_from_web($template_url, $template_cache_file);
			if ($template_content === FALSE) {
				return file_get_contents($template_cache_file);
			} else {
				return $template_content;
			}
		}
	} else { //if not, request
		$template_content = get_template_from_web($template_url, $template_cache_file);
		if ($template_content === FALSE) {
			return file_get_contents($template_cache_file);
		} else {
			return $template_content;
		}
	}
	*/
	return file_get_contents($template_cache_file);
}

function get_template_from_web($template_url, $template_cache_file) {
	$ctx = stream_context_create(array('http'=>
	array(
		'timeout' => 2, // 1 200 Seconds = 20 Minutes
	    )
	));
	$template = @file_get_contents($template_url, false, $ctx);
	$template .= '<!-- cached:  '.date('Y-m-d\TH:s:iT').' -->';
	//write new template back to cache file
	file_put_contents($template_cache_file, $template);
	return $template;	
}


function generate_breadcrumbs($aws_id) {
	if (strlen($aws_id) != 1) /*i.e. $aws_id == 0*/ {
		// connect to DB using mysqli
		include('db-connection.php');
						
		$sql = "SELECT tbl_stations.name, tbl_districts.name AS district FROM tbl_stations INNER JOIN tbl_districts ON district_id = id WHERE aws_id = '".$aws_id."'";
		if ($result = $mysqli->query($sql)) {
			while($obj = $result->fetch_object()){
				$name = $obj->name;
				$district = $obj->district;
			}
		}
		unset($result);
		
		$ret = '<p><a href="#">All weatherstations</a> &gt; '.$district.' &gt; <span class="active">'.$name.'</span></p>';
	} else { //we are looking at all stations
		$ret = '<p><a href="#">All weatherstations</a></p>';
	}
	
	return $ret;
}

function make_aws_content_data($aws_id, $view) {
    $d = get_graph_data($aws_id, $view);
    switch ($view) {
        case 'today';
            $time_name = 'Today';
            break;
        case 'yesterday';
            $time_name = 'Yesterday';
            break;
        case '7days';
            $time_name = '7 day';
            break;
        case '30days';
            $time_name = '30 day';
            break;
        case 'monthly';
            $time_name = 'Each month';
            break;
    }
    
    $html = '<h2>'.$time_name.'\'s data for ' . $d[0] . '</h2>';
    
    switch ($view) {
        case 'today';
        case 'yesterday';
            // make HTML table
            $html .= make_table_hourly($d, $time_name);
            // make graphs                            
            $title = $time_name.'\'s temperatures for ' . $d[0];
            $is_bar_graph = 'false';
            $colour = 'red';
            $html .= '<p><img src="graph.php?title='.$title.'&data='.urlencode(serialize($d[1]['airT'])).'&is_bar_graph='.$is_bar_graph.'&colour='.$colour.'"  alt="no data for '.$time_name.'\'s temperatures"/></p>';
            $title = $time_name.'\'s rain for ' . $d[0];
            $is_bar_graph = 'true';
            $colour = 'blue';
            $html .= '<p><img src="graph.php?title='.$title.'&data='.urlencode(serialize($d[1]['rain'])).'&is_bar_graph='.$is_bar_graph.'&colour='.$colour.'"  alt="no data for '.$time_name.'\'s rain"/></p>';
            $title = $time_name.'\'s relative humidity for ' . $d[0];
            $is_bar_graph = 'false';
            $colour = 'purple';
            $html .= '<p><img src="graph.php?title='.$title.'&data='.urlencode(serialize($d[1]['rh'])).'&is_bar_graph='.$is_bar_graph.'&colour='.$colour.'"  alt="no data for '.$time_name.'\'s relative humidity"/></p>';
            $title = $time_name.'\'s solar radiation (GSR) for ' . $d[0];
            $is_bar_graph = 'true';
            $colour = 'red';
            $html .= '<p><img src="graph.php?title='.$title.'&data='.urlencode(serialize($d[1]['gsr'])).'&is_bar_graph='.$is_bar_graph.'&colour='.$colour.'"  alt="no data for '.$time_name.'\'s solar radiation"/></p>';
            $title = $time_name.'\'s windspeeds for ' . $d[0];
            $data = array(
                'min' => null,
                'avg' => $d[1]['Wavg'],
                'max' => $d[1]['Wmax']
            );
            $html .= '<p><img src="graph.php?is_multi=true&title='.$title.'&data='.urlencode(serialize($data)).'&is_bar_graph='.$is_bar_graph.'&colour='.$colour.'"  alt="no data for '.$time_name.'\'s windspeeds"/></p>';
            break;
        case '7days';            
        case '30days';
        case 'monthly';
            // make HTML table
            $html .= make_table_daily($d, $time_name);
            // make graphs
            $title = $time_name.'\'s ET for ' . $d[0] . ' (mm)';
            $is_bar_graph = 'true';
            $colour = 'red';
            $html .= '<p><img src="graph.php?title='.$title.'&data='.urlencode(serialize($d[1]['et_asce_t'])).'&is_bar_graph='.$is_bar_graph.'&colour='.$colour.'"  alt="no data for '.$time_name.'\'s ET"/></p>';  
            $title = $time_name.'\'s rain for ' . $d[0] . ' (mm)';
            $is_bar_graph = 'true';
            $colour = 'blue';
            $html .= '<p><img src="graph.php?title='.$title.'&data='.urlencode(serialize($d[1]['rain'])).'&is_bar_graph='.$is_bar_graph.'&colour='.$colour.'"  alt="no data for '.$time_name.'\'s rain"/></p>';                            
            $title = '$time_name\'s temperatures for ' . $d[0] . ' (deg C)';
            $data = array(
                'min' => $d[1]['airT_min'],
                'avg' => $d[1]['airT_avg'],
                'max' => $d[1]['airT_max']
            );
            $html .= '<p><img src="graph.php?is_multi=true&title='.$title.'&data='.urlencode(serialize($data)).'"  alt="no data for '.$time_name.'\'s temperatures"/></p>';
            $title = $time_name.'\'s relative humidity for ' . $d[0] . ' (%)';
            $data = array(
                'min' => $d[1]['rh_min'],
                'avg' => $d[1]['rh_avg'],
                'max' => $d[1]['rh_max']
            );
            $html .= '<p><img src="graph.php?is_multi=true&title='.$title.'&data='.urlencode(serialize($data)).'"  alt="no data for last '.$time_name.'\'s relative humidity"/></p>';
            $title = $time_name.'\'s solar radiation for ' . $d[0] . ' (KW/m2)';
            $is_bar_graph = 'true';
            $colour = 'red';
            $html .= '<p><img src="graph.php?title='.$title.'&data='.urlencode(serialize($d[1]['gsr'])).'&is_bar_graph='.$is_bar_graph.'&colour='.$colour.'"  alt="no data for '.$time_name.'\'s solar radiation"/></p>';  
            $title = $time_name.'\'s wind speeds for ' . $d[0] . ' (km/h)';
            $data = array(
                'min' => null,
                'avg' => $d[1]['Wavg'],
                'max' => $d[1]['Wmax']
            );
            $html .= '<p><img src="graph.php?is_multi=true&title='.$title.'&data='.urlencode(serialize($data)).'"  alt="no data for '.$time_name.'\'s wind speeds"/></p>';
            break;
    }    
    
    return $html;
}
// TODO: complete the views finyear download summary
// TODO: fix the graphs for monthly temp & RH
// TODO: fix footer breaking code
function generate_aws_content($aws_id, $view, $main_view)  {
	$aws_content = "\n\n<!-- //////////////weatherstation content/////////////////////////////////////////////////////// -->\n\n";

	//correct for broken graph images in Chrome
	$head_additions = '
	<script type="text/javascript" src="jquery-1.8.0.min.js"></script>
	<script type="text/javascript"> 
	$(document).ready(function() {
		$("img").error(function () { 
			$(this).hide();
			// or $(this).css({visibility:"hidden"}); 
		});
	});
	</script>
	';
	
	if (strlen($aws_id) > 1) /*i.e. $aws_id == 0*/ {
        //test the type of station for TBRG
        if (substr($aws_id,0,4) == 'TBRG') {
            // connect to DB using mysqli
            include('db-connection.php');

            $sql = "SELECT tbl_stations.name, tbl_districts.name AS district FROM tbl_stations INNER JOIN tbl_districts ON district_id = id WHERE aws_id =  '".$aws_id."'";
            
            if ($result = $mysqli->query($sql)) {
                while($obj = $result->fetch_object()) {
                    $name = $obj->name;
                    $aws_content .= '<h3>'.$name.' Raingauge</h3>';
                    $aws_content .= get_include_contents('table_raingauge_summary.php');
                    $aws_content .= '<p></p>';
                    $aws_content .= get_include_contents('table_rain.php');
                    $aws_content .= '<p><b>NOTE: where there are differences between the summary and the full data table, always follow the summary table. Results will be consistent across tables after June \'11 when this new system is fully operational.</b></p>';
                }	
            }
            unset($result);
            
            $aws_content .= '<p></p>';
            $aws_content .= view_download_rainguage();
	    }
		else {
            //this is a full AWS, not a TBRG
            $aws_content .= '<p id="regularity_note">These weatherstations record data every 15 minutes but only reports to the web on the hour.</p>
            <div id="single_station_links">
                Observations:&nbsp;
                <a href="?aws_id='. $aws_id .'&amp;view=summary">Summary</a> |
                <a href="?aws_id='. $aws_id .'&amp;view=today">Today</a> |
                <a href="?aws_id='. $aws_id .'&amp;view=yesterday">Yesterday</a> |
                <a href="?aws_id='. $aws_id .'&amp;view=7days">7 days</a> |
                <a href="?aws_id='. $aws_id .'&amp;view=30days">30 days</a> |
                <a href="?aws_id='. $aws_id .'&amp;view=monthly">Monthly History</a> |
                <a href="?aws_id='. $aws_id .'&amp;view=finyr">Fin. Year</a> |
                <a href="?aws_id='. $aws_id .'&amp;view=download">Download</a>
            </div>
            <p></p>';

            switch($view) {
                case "today":
                case "yesterday":
                case "7days":
                case "30days":
                case "monthly":
                    $aws_content .= make_aws_content_data($aws_id, $view);
                    break;	
                case "finyr":
                    $aws_content .= get_include_contents('table_finyr.php');
                    $aws_content .= '<p></p>';
                    break;			
                case "download":
                    $aws_content .= view_download();
                    break;			
                default:	//table_summary	
                    $aws_content .= get_include_contents('table_summary.php');
                    break;
			}
		}
	}
	else {
		$aws_content .= '<p id="regularity_note">These weatherstations record data every 15 minutes but only reports to the web on the hour.</p>
				<p id="all_station_links">
					<a href="?main=map">Region Map</a> | 
					<a href="?main=15min">Latest 15min Readings</a> | 
					<a href="?main=daily">Latest Daily Readings</a>
				</p>';
		
        switch($main_view) {
            case '15min':
                $aws_content .= main_15min();
                break;
            case 'daily':
                $aws_content .= main_daily();
                break;
            default:
                $aws_content .= main_map($head_additions);
                break;
		}
	}

	$aws_content .= "<!-- ///////////end weatherstation content/////////////////////////////////////////////////// -->\n\n";

	return $aws_content;
}

function generate_aws_css() {
	$ret = "\n<style>
	
	#regularity_note {
		font-weight:bold;
	}
	
	#all_station_links {
		width:100%;
		text-align:center;
		margin-top:10px;
	}
	
	#single_station_links {
		
	}
	
	/*
	 *  table_data
	 */
	.table_data, 
	.sortable {
			font-size: 11px;
			border-collapse: collapse;
			color: white;
			width: 750px;
	}
	
	.table_data h2, 
	.sortable h2 {
			color:white;
	}
	
	.table_data tr, 
	.sortable tr {
			vertical-align:top;
	}
	
	.table_data th, 
	.sortable th {
			background-color: #727272; /*#007dcc;*/
			color: white;
			border: solid 1px #dedbee; /*#007dcc;*/
			font-weight: normal;
	}

	.table_data th a, 
	.sortable th a {
		text-decoration: none;
		color: white;
	}

	.table_data td, 
	.sortable td {
			color: #58595b;
			border: solid 1px #dedbee; /*#007dcc;*/
	}
	
	.table_data th, 
	.table_data td {
			padding:2px;
	}

	.table_data tr.odd, .sortable tr.odd {
		background-color: #eeeeee;
	}
	
	#map_canvas {
		border: solid 1px black;
		width:750px; 
		height:450px;
	}
	
	table.newlayout {
		border-collapse:collapse;
	}
	
	table.newlayout,
	table.newlayout td {
		border:solid 0px white;
		vertical-align:top;
	}	
	</style>
	\n";
	
	return $ret;
}


function generate_sidebar() {
	//get SAMDB AWSes
    // connect to DB using mysqli
    include('db-connection.php');
	
	$sql = "SELECT aws_id, tbl_stations.name, tbl_districts.name AS district FROM tbl_stations INNER JOIN tbl_districts ON district_id = id WHERE tbl_stations.owner = 'SAMDB' ORDER BY weight, name;";
	
	$stations = "";
	$dist_count = 0;
	$last_district = "";
	if ($result = $mysqli->query($sql))	{
		while($obj = $result->fetch_object()) {
			if ($obj->district != $last_district) {
				$dist_count++;
				//1st district
				if ($dist_count == 1) {
					$stations .= '<ul>
					<li class="parent">
						'.$obj->district. '
						<ul>'."\n";
				} else if ($dist_count > 1) {
					$stations .= '
						</ul>
					</li>
					<li class="parent">
						'.$obj->district.'
						<ul>'."\n";
				}
			}
		
			$stations .= '							<li><a href="?aws_id='.$obj->aws_id.'&amp;view=summary">'.$obj->name.'</a></li>'."\n";
			
			$last_district = $obj->district;
		}	
	}
	else
	{
		print '<h3>Sorry! There is a problem with the system. We have been notified and are working on fixing it.</h3>';
	}

	$stations .= '						</ul>
					</li>
				</ul>';
    
	$ret = '<ul>
			<li>
				<p><a href="?view=chill">Chill Calculator</a></p>
			</li>
			<li class="parent">
				<p><a href="?main=15min">All Stations</a></p>
				'.$stations.'
			</li>
		</ul>';

	return $ret;
}


function main_map(&$head_additions) {
	//add the Google JS to index head
	$head_additions = '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>'."\n";
	
	//generate my JS
    // connect to DB using mysqli
    include('db-connection.php');
							
	//get the map centre
	$sql = "SELECT 
				ROUND(AVG(lon),6) AS lon_avg, 
				ROUND(AVG(lat),6) AS lat_avg 
			FROM tbl_stations 
			WHERE OWNER = 'SAMDB' AND lat IS NOT NULL;";
	$lat_avg = -34.397;
	$lon_avg = 150.644;
	
	if ($result = $mysqli->query($sql))
	{
		while($obj = $result->fetch_object())
		{
			$lon_avg = $obj->lon_avg;
			$lat_avg = $obj->lat_avg;
		}
	}
	unset($result);
	
	//get all the place markers
	$js_addition .= '		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
		$(document).ready(function() {			
			var myLatlng = new google.maps.LatLng('.$lat_avg.', '.$lon_avg.');
			var myOptions = {
						zoom: 7,
						center: myLatlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};

			var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);'."\n\n".
			
			'
			$("#map_canvas").css({height: "450px", width: "750px", border: "solid 1px black"});
			
			'
			;
			
	$sql = 	"SELECT aws_id, name, lon, lat FROM tbl_stations WHERE owner = 'SAMDB' AND lat IS NOT NULL;";
	if ($result = $mysqli->query($sql))
	{
		while($obj = $result->fetch_object())
		{
			$js_addition .= "\n\n";
			$aws_id = $obj->aws_id;
		$js_addition .= '			var aws_marker'.$aws_id.' = new google.maps.Marker({
								position: new google.maps.LatLng('.$obj->lat.','.$obj->lon.'),
								map: map,
								title: "'.$obj->name.'",
								url: "?aws_id='.$aws_id.'"  
							});'."\n\n";	
			
			//single click: display the station's latest hour in a bubble
			$js_addition .= '			google.maps.event.addListener(aws_marker'.$aws_id.', \'click\', function(){
												var infocontent'.$aws_id.' = \''.get_map_summary($aws_id).'\';
												var infowindow'.$aws_id.' = new google.maps.InfoWindow({
													content: infocontent'.$aws_id.',
													minWidth: 200
												});													
												infowindow'.$aws_id.'.open(map, aws_marker'.$aws_id.');
											});'."\n\n";
			
			//double click: go to the station's page					
			$js_addition .= '			google.maps.event.addListener(aws_marker'.$aws_id.', \'dblclick\', function(){
												window.location.href = aws_marker'.$aws_id.'.url;
											});'."\n\n";
		}
	}	
			$js_addition .= '			});
		</script>';

	//generate the map's HTML
	$ret .= "\n\n";
	$ret .= '			<div id="map_canvas"></div>'."\n\n";
	$ret .= '			<ul>
				<li><b>Click</b> on a marker to see the latest hour\'s readings in brief</li>
				<li><b>Double Click</b> on a marker to go to that station\'s full details</li>
			</ul>'."\n\n";
	
	$ret .= $js_addition;		
		
	//return the HTML
	return $ret;
}


// TODO: CALL function
function get_map_summary($aws_id) {
	$mysqli = new mysqli("localhost", "aws", "ascetall", "aws")
			or die ('Error connecting to mysql: ' . mysqli_error($mysqli));
		
	$sql1 =	"CALL summary_latest_hour('".$aws_id."');";
	if ($result1 = $mysqli->query($sql1))
	{
		while($obj1 = $result1->fetch_object())
		{			
			$name = $obj1->name;
			$latest_reading = $obj1->latest;
			$latest_airT = $obj1->airT_avg;
			$latest_appT = $obj1->appT_avg;
			$latest_dp = $obj1->dp_avg;
			$latest_rh = $obj1->rh_avg;
			$latest_deltaT = $obj1->deltaT_avg;
			$latest_rain_earlier = $obj1->rain_sum_earlier;		
			$latest_rain_later = $obj1->rain_sum_later;
		}		
	}	
	
	$latest_reading = strftime("%d/%m, %H:00",strtotime($latest_reading));
	$ret = "<table class=\"table_data\" style=\"width:375px\">".
				"<tr>".
					"<th colspan=\"5\">Latest reading for <span style=\"font-size:14px;\">$name</span> at: $latest_reading</th>".
				"</tr>".
				"<tr>".
					"<td style=\"width:75px;\">Air Temp</td>".
					"<td style=\"width:75px;\">App Tem</td>".
					"<td style=\"width:75px;\">Dew Pt</td>".
					"<td style=\"width:75px;\">RH</td>".
					"<td style=\"width:75px;\">Delta-T</td>".
				"</tr>".
				"<tr>".
					"<td>$latest_airT &deg;C</td>".
					"<td>$latest_appT &deg;C</td>".
					"<td>$latest_dp &deg;C</td>".
					"<td>$latest_rh %</td>".
					"<td>$latest_deltaT &deg;C</td>".
				"</tr>".
			"</table>";																
	
	return $ret;
}


// TODO: CALL function
function main_15min() {
    // connect to DB using mysqli
    include('db-connection.php');
		
	$sql = 	"CALL main_latest_15min('SAMDB');";
	$mysqli->query($sql);
	$sql = "SELECT * FROM readings_15min;";
	
	$ret = '';
	if ($result = $mysqli->query($sql))
	{
		$ret .= '<table class="table_data">
				<tr><th colspan="17"><span style="font-weight:400; font-size:18px; line-size:25px;">Region Summary (latest 15-minute record)</span></th></tr>
				<tr>
					<th>Station</th>
					<th>Time</th>
					<th>Air T<br />&deg;C</th>
					<th>App T<br />&deg;C</th>
					<th>RH<br />%</th>
					<th>Dew Pt<br />&deg;C</th>
					<th>Delta T<br />&deg;C</th>
					<th>Soil T<br />&deg;C</th>
					<th>Solar Rad<br />W/m^2</th>
					<th colspan="2">Wind<br />Av Max<br />km/h</th>
					<th>Wind Dir<br />&deg;</th>
					<th>Rain<br />mm</th>
				</tr>';
				   		
		while($obj = $result->fetch_object())
		{
			$ret .= "<tr>
						<td><a href=\"?aws_id=$obj->aws_id\">$obj->name</a></td>					
						<td>".date("d/m/Y H:i",strtotime($obj->stamp))."</td>
						<td>$obj->airT</td>
						<td>$obj->appT</td>
						<td>$obj->rh</td>
						<td>$obj->dp</td>
						<td>$obj->deltaT</td>
						<td>$obj->soilT</td>
						<td>$obj->gsr</td>
						<td>$obj->Wavg</td>
						<td>$obj->Wmax</td>
						<td>$obj->Wdir</td>
						<td>$obj->rain</td>
					</tr>";
		}
		$ret .= '</table>';
	}
	return $ret;	
}

function main_daily() {
    // connect to DB using mysqli
    include('db-connection.php');
		
	$sql = 	"CALL proc_days_latest('SAMDB');";
	$mysqli->query($sql);
	$sql = "SELECT * FROM tbl_temp_data_days_latest;";
	
	$ret = '';
	if ($result = $mysqli->query($sql))
	{
		$ret .= '<table class="table_data">
				<tr><th colspan="17"><span style="font-weight:400; font-size:18px; line-size:25px;">Region Summary (latest daily record)</span></th></tr>
				<tr>
					<th>Station</th>
					<th>Date</th>
					<th>Air T<br />&deg;C</th>
					<th>RH<br />%</th>
					<th>Dew Pt<br />&deg;C</th>
					<th>Delta T<br />&deg;C</th>
					<th>Solar Rad<br />W/m^2</th>
					<th colspan="2">Wind<br />Av Max<br />km/h</th>
					<th>Rain<br />mm</th>
					<th>Frost<br />Hrs</th>
					<th>Day Degs</th>
					<th>ET (ASCE s)<br />mm</th>
				</tr>';
				   		
		while($obj = $result->fetch_object())
		{
			$ret .= "<tr>
						<td><a href=\"?aws_id=$obj->aws_id\">$obj->name</a></td>					
						<td>".date("d/m/Y",strtotime($obj->stamp))."</td>
						<td>$obj->airT_max<br />$obj->airT_avg<br />$obj->airT_min</td>
						<td>$obj->rh_max<br />$obj->rh_avg</td>
						<td>$obj->dp_max<br />$obj->dp_avg<br />$obj->dp_min</td>
						<td>$obj->deltaT_max<br />$obj->deltaT_avg<br />$obj->deltaT_min</td>
						<td>$obj->gsr_total</td>
						<td>$obj->Wavg</td>
						<td>$obj->Wmax</td>
						<td>$obj->rain_total</td>
						<td>$obj->frost_hrs</td>
						<td>$obj->deg_days</td>
						<td>$obj->et_asce_t</td>
					</tr>";
		}
		$ret .= '</table>';
	}
	return $ret;
}

function view_download() {
    // connect to DB using mysqli
    include('db-connection.php');
	
	$sql = "SELECT name FROM tbl_stations WHERE aws_id = '".$_GET['aws_id']."';";
	$name = '';
	if ($result = $mysqli->query($sql))
	{
		while($obj = $result->fetch_object())
		{
			$name = $obj->name;
		}		
	}	
		
	$ret = "<h3>Download data for $name</h3>";
	$ret .= '<h4>Choose the timespan and the type of readings you wish to download:</h4>
            <script>
                $(document).ready(function() {                    
                    $("#download_data").click(function() {
                        console.log("data_download");
                        var i = $("#aws_id").val();
                        var s = $("#start").val();
                        var e = $("#end").val();
                        var f = $("input[name=format]:checked").val();
                        var url = "http://aws-samdbnrm.sa.gov.au/data_download.php?aws_id="+i+"&start="+s+"&end="+e+"&format="+f+"";
                        console.log(url);
                        window.location = url;
                        
                        return false;
                    });
                    $("#download_ires").click(function() {
                        console.log("data_download_ires");
                        var i = $("#aws_id_ires").val();
                        var f = $("input[name=et_type]:checked").val();
                        var url = "http://aws-samdbnrm.sa.gov.au/data_download_ires.php?aws_id="+i+"&et_type="+f+"";
                        console.log(url);
                        window.location = url;
                        
                        return false;
                    });
                });
            </script>
			<div>
                <input type="hidden" name="location" value="data_download" />
				<input type="hidden" id="aws_id" name="aws_id" value="'.$_GET['aws_id'].'" />
				<table class="format">
				<tr>
					<td>Start:</td>
					<td><input type="text" name="start" id="start" size="10" class="datepicker" /> (dd/mm/yyyy format, earliest 01/07/2006, most stations)</td>
				</tr>
				<tr>
					<td>End:</td>

					<td><input type="text" name="end" id="end" size="10" class="datepicker" /> (dd/mm/yyyy format, put in <b>latest</b> for latest)</td>
				</tr>
				<tr>
					<td>Timestep:&nbsp;</td>
					<td>
						15 min:<input type="radio" name="format" value="15min" /><br />
						Daily : <input type="radio" name="format" value="day" checked="checked" />

					</td>
				</tr>
				<tr>
					<td></td>
					<td><button id="download_data">Download</button></td>
				</tr>
				</table>
			</div>
			<p>&nbsp;</p>
			<h3>IRES Download</h3>
            <div>
                <input type="hidden" name="location" value="data_download_ires" />
				<input type="hidden" id="aws_id_ires" name="aws_id_ires" value="'.$_GET['aws_id'].'" />
				ET (short): <input type="radio" name="et_type" value="short" checked="checked" /><br />
				ET (tall):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="et_type" value="tall"  /><br />
				<td><button id="download_ires">Download</button></td>
			</div>';
			
	return $ret;
}



function view_download_rainguage() {	
	$ret = '<h3>Download data</h3>
			<h4>Choose the timespan and the type of readings you wish to download:</h4>
			<form method="post" action="data_download_rainguage.php">
				<input type="hidden" name="aws_id" value="'.$_GET['aws_id'].'" />
				<table class="format">
				<tr>
					<td>Start:</td>
					<td><input type="text" name="start" id="start" size="10" /> (dd/mm/yyyy format, earliest 01/07/2006, most stations)</td>
				</tr>
				<tr>
					<td>End:</td>

					<td><input type="text" name="end" size="10" /> (dd/mm/yyyy format, put in <b>latest</b> for latest)</td>
				</tr>
				<tr>
					<td>Timestep:&nbsp;</td>
					<td>
						15 min:<input type="radio" name="format" value="15min" /><br />
						Daily : <input type="radio" name="format" value="day" checked="checked" />
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Download" /></td>
				</tr>
				</table>
			</form>';
			
	return $ret;
}

function get_include_contents($filename)  {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    return false;
}


function chill_show_form() {
    // connect to DB using mysqli
    include('db-connection.php');
	   
	$sql = "SELECT aws_id, `name` FROM tbl_stations WHERE OWNER = 'SAMDB' AND aws_id NOT LIKE 'TBRG%' ORDER BY `name`;";
	 
	$options = '';
	 
	if ($result = $mysqli->query($sql))
	{
		while($obj = $result->fetch_object())
		{
			$options .= '<option value="' . $obj->aws_id . '">' . $obj->name . '</option>' . "\n";
		}
	}
	  
    $resp = '
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <h2>Chill Calculator</h2>
    <p>This form lets you calculate chill hours for two threshold values (7&deg;C and 10&degC) as well as <em>chill portions</em> for any station for any time period.</p>
    <p><em>Chill Portions</em>, the more advanced calculation, is explained by the <a href="http://fruitsandnuts.ucdavis.edu/Weather_Services/chilling_accumulation_models/CropChillReq/">University of California Davis\' website</a>.</p>
    <form action="index.php" method="post">
        <table>
            <tr>
                <td>Station</td>
                <td>
                    <select name="aws_id">
                        '.$options.'
                    </select>
                </td>
            </tr>
            <tr>
                <td>Start date:</td><td><input type="text" id="start_date" name="start_date" style="width:150px;" /></td>
            </tr>
            <tr>
                <td>End date:</td><td><input type="text" id="end_date" name="end_date" style="width:150px;" /></td>
            </tr>
            <tr>
                <td></td><td><input type="submit" name="chill_submit" value="Calculate Chill" /></td>
            </tr>
        </table>
    </form>
    <script>
        $(document).ready(function() {
            jQuery("#start_date").datepicker({dateFormat: "dd-mm-yy"});
            jQuery("#end_date").datepicker({dateFormat: "dd-mm-yy"});
        });
    </script>     
    ';
    
    return $resp;    
}

// TODO: CALL function
function chill_calculate_chill($aws_id, $start_date, $end_date) {
	$chill_hours_7 = 0;
	$chill_hours_10 = 0;
	$chill_portions = 0;

	$mysqli = new mysqli("localhost", "aws", "ascetall", "aws")
	    or die ('Error connecting to mysql: ' . mysqli_error($mysqli));

	$sql = "CALL chill(?,?,?);";

	if (!($stmt = $mysqli->prepare($sql))) {
	    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	$stmt->bind_param('sss',$aws_id, $start_date, $end_date);

	if (!$stmt->execute()) {
	    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	if (!$stmt->bind_result($chill_hours_7, $chill_hours_10, $chill_portions)) {
	    echo "Bind failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	$stmt->fetch();

	return array($chill_hours_7, $chill_hours_10, $chill_portions);
}

function chill_show_results($aws_id, $start_date, $end_date, $chill) {
    //get station name
    // connect to DB using mysqli
    include('db-connection.php');
    
    $stmt = $mysqli->prepare("SELECT name FROM tbl_stations WHERE aws_id = ?");
    $stmt->bind_param('s', $aws_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($aws_name);
    while($stmt->fetch()) {
        $name = $aws_name;
    }
    $stmt->close();

    $resp = '
    <h4>Chill Results</h4>
    <p>For station <strong>'.$name.'</strong> over date range '.$start_date.' to '.$end_date.'</p> 
    <table>
	<tr>
	    <td>Hours &lt; 7&deg;C:</td><th>'.$chill[0].'</th>
	</tr>
	<tr>
	    <td>Hours &lt; 10&deg;C:</td><th>'.$chill[1].'</th>
	</tr>
	<tr>
	    <td>Portions</td><th>'.$chill[2].'</th>
	</tr>	
    </table>   
    ';
    
    return $resp;
}



function google_analytics_samdb() {
	return "
	<!-- Google Analytics page tracking -->
	<script type=\"text/javascript\">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-24359648-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
	";
}

function get_graph_data($aws_id, $view) {
    // connect to DB using mysqli
    include('db-connection.php');
    
    //set the SQL
    switch($view) {
        case 'today':
            $sql = "SELECT
                name,
                DATE_FORMAT(stamp, '%H:%i') AS s,
                tbl_data_minutes.*
            FROM tbl_data_minutes INNER JOIN tbl_stations
            ON tbl_data_minutes.aws_id = tbl_stations.aws_id
            WHERE tbl_data_minutes.aws_id = '" . $aws_id . "' AND DATE(stamp) = CURDATE() - INTERVAL 20 DAY AND MINUTE(stamp) = 0
            ORDER BY stamp;";
            break;
        case 'yesterday':
            $sql = "SELECT
                name,
                DATE_FORMAT(stamp, '%H:%i') AS s,
                tbl_data_minutes.*
            FROM tbl_data_minutes INNER JOIN tbl_stations
            ON tbl_data_minutes.aws_id = tbl_stations.aws_id
            WHERE tbl_data_minutes.aws_id = '" . $aws_id . "' AND DATE(stamp) = CURDATE() - INTERVAL 21 DAY AND MINUTE(stamp) = 0
            ORDER BY stamp;";
            break;
        case '7days':
            $sql = "SELECT
                name,
                DATE_FORMAT(stamp,'%m-%d') AS s,
                tbl_data_days.*
            FROM tbl_data_days INNER JOIN tbl_stations
            ON tbl_data_days.aws_id = tbl_stations.aws_id
            WHERE tbl_data_days.aws_id = '" . $aws_id . "' AND stamp >= CURDATE() - INTERVAL 17 DAY
            ORDER BY stamp;";
            break;
        case '30days':
            $sql = "SELECT
                name,
                DATE_FORMAT(stamp,'%m-%d') AS s,
                tbl_data_days.*
            FROM tbl_data_days INNER JOIN tbl_stations
            ON tbl_data_days.aws_id = tbl_stations.aws_id
            WHERE tbl_data_days.aws_id = '" . $aws_id . "' AND stamp >= CURDATE() - INTERVAL 40 DAY
            ORDER BY stamp;";
            break;
        case 'monthly':
            $sql = "            
            SELECT
                name,
                DATE_FORMAT(stamp,'%y-%m') AS s,
                ROUND(MIN(airT_min),1) AS airT_min,
                ROUND(AVG(airT_avg),1) AS airT_avg,
                ROUND(MAX(airT_max),1) AS airT_max,
                ROUND(AVG(appT_avg),1) AS appT_avg,
                ROUND(AVG(dp_avg),1) AS dp_avg,
                ROUND(AVG(deltaT_avg),1) AS deltaT_avg,
                ROUND(MIN(soilT_min),1) AS soilT_min,
                ROUND(AVG(soilT_avg),1) AS soilT_avg,
                ROUND(MAX(soilT_max),1) AS soilT_max,
                ROUND(MIN(rh_min),1) AS rh_min,
                ROUND(AVG(rh_avg),1) AS rh_avg,
                ROUND(MAX(rh_max),1) AS rh_max,
                ROUND(SUM(gsr_total),0) AS gsr_total,
                ROUND(AVG(Wavg),1) AS Wavg,
                ROUND(MAX(Wmax),1) AS Wmax,
                ROUND(SUM(rain_total),1) AS rain_total,
                ROUND(SUM(et_asce_t),1) AS et_asce_t,
                ROUND(SUM(deg_days),1) AS deg_days,
                ROUND(SUM(frost_hrs),1) AS frost_hrs
            FROM tbl_data_days INNER JOIN tbl_stations
            ON tbl_data_days.aws_id = tbl_stations.aws_id
            WHERE tbl_data_days.aws_id = '" . $aws_id . "'
            GROUP BY YEAR(stamp), MONTH(stamp)
            ORDER BY YEAR(stamp) DESC, MONTH(stamp);";
            break;        
    }

    //make the data array
    switch($view) {
        case 'today':
        case 'yesterday':
            if ($result = $mysqli->query($sql)) {
                while($obj = $result->fetch_object()) {
                    $name = $obj->name;
                    $airT[$obj->s]  = $obj->airT;
                    $appT[$obj->s]  = $obj->appT;
                    $dp[$obj->s]  = $obj->dp;
                    $soilT[$obj->s] = $obj->soilT;
                    $deltaT[$obj->s]  = $obj->deltaT;
                    $rain[$obj->s]  = $obj->rain;
                    $rh[$obj->s]    = $obj->rh;
                    $gsr[$obj->s]   = $obj->gsr;
                    $Wavg[$obj->s]  = $obj->Wavg;
                    $Wmax[$obj->s]  = $obj->Wmax;
                    $Wdir[$obj->s]  = $obj->Wdir;
                }
            }
            
            $data = array(
                        'airT' => $airT,
                        'appT' => $appT,
                        'dp' => $dp,
                        'soilT' => $soilT,
                        'deltaT' => $deltaT,
                        'rain' => $rain,
                        'rh' => $rh,
                        'gsr' => $gsr,
                        'Wavg' => $Wavg,
                        'Wmax' => $Wmax,
                        'Wdir' => $Wdir
                      );
            break;
        case '7days':
        case '30days':
        case 'monthly':
            if ($result = $mysqli->query($sql)) {
                while($obj = $result->fetch_object()) {
                    $name = $obj->name;
                    $airT_min[$obj->s]   = $obj->airT_min;
                    $airT_avg[$obj->s]   = $obj->airT_avg;
                    $airT_max[$obj->s]   = $obj->airT_max;
                    $appT_avg[$obj->s]   = $obj->appT_avg;
                    $dp_avg[$obj->s]     = $obj->dp_avg;
                    $deltaT_avg[$obj->s] = $obj->deltaT_avg;
                    $soilT_min[$obj->s]  = $obj->soilT_min;
                    $soilT_avg[$obj->s]  = $obj->soilT_avg;
                    $soilT_max[$obj->s]  = $obj->soilT_max;                        
                    $rh_min[$obj->s]     = $obj->rh_min;
                    $rh_avg[$obj->s]     = $obj->rh_avg;
                    $rh_max[$obj->s]     = $obj->rh_max;
                    $gsr[$obj->s]        = $obj->gsr_total;
                    $Wavg[$obj->s]       = $obj->Wavg;
                    $Wmax[$obj->s]       = $obj->Wmax;
                    $rain[$obj->s]       = $obj->rain_total;
                    $frost_hrs[$obj->s]  = $obj->frost_hrs;
                    $deg_days[$obj->s]   = $obj->deg_days;
                    $et_asce_t[$obj->s]  = $obj->et_asce_t;
                }
            }
            
            $data = array(
                        'airT_min' => $airT_min,
                        'airT_avg' => $airT_avg,
                        'airT_max' => $airT_max,
                        'appT_avg' => $appT_avg,
                        'dp_avg' => $dp_avg,
                        'deltaT_avg' => $deltaT_avg,
                        'soilT_min' => $soilT_min,
                        'soilT_avg' => $soilT_avg,
                        'soilT_max' => $soilT_max,
                        'rh_min' => $rh_min,
                        'rh_avg' => $rh_avg,
                        'rh_max' => $rh_max,
                        'gsr' => $gsr,
                        'Wavg' => $Wavg,
                        'Wmax' => $Wmax,
                        'rain' => $rain,
                        'frost_hrs' => $frost_hrs,
                        'deg_days' => $deg_days,
                        'et_asce_t' => $et_asce_t
                      );
            break;
    }
    
    // garbage collection
    $result->close();
    unset($obj);
    unset($sql);
    $mysqli->close();
    
    return array($name, $data);
}

function make_graph($title, $data, $is_bar_graph, $colour) {
    include('phpgraphlib.php');
    $graph = new PHPGraphLib(530,250);
    $graph->addData($data);
    if ($is_bar_graph) {
        $graph->setBars(true);
        $graph->setLine(false);
        $graph->setBarColor($colour);
    } else {
        $graph->setBars(false);
        $graph->setLine(true);
        $graph->setLineColor($colour);
        $graph->setDataPoints(true);
        $graph->setDataPointSize(4);
        $graph->setDataPointColor($colour);
    }
    
    $graph->setTitle($title);
    $graph->setTitleColor("88,89,91");
    $graph->setXValuesVertical(false);
    $graph->createGraph();
}


function make_graph_multi_line($title, $data_min, $data_avg, $data_max) {
    include('phpgraphlib.php');
    $graph = new PHPGraphLib(530,250);
    
    $graph->setBars(false);
    $graph->setLine(true);         
    $graph->setTitle($title);
    $graph->setTitleColor("88,89,91");
    $graph->setXValuesVertical(false);
    $graph->setDataPoints(true);
    $graph->setDataPointSize(4);
    $graph->setDataPointColor('purple');
    $graph->setLegend(true);
    if (empty($data_min)) {
        $graph->addData($data_avg);
        $graph->addData($data_max);            
        $graph->setLineColor('purple', 'red');
        $graph->setLegendTitle('avg', 'max');
    } else {
        $graph->addData($data_min);
        $graph->addData($data_avg);
        $graph->addData($data_max);
        $graph->setLineColor('blue', 'purple', 'red');
        $graph->setLegendTitle('min', 'avg', 'max');
    }
    
    $graph->createGraph();
}
function make_table_hourly($data, $time_name) {
    $html = '<table class="table_data"  id="table_today">';
    $html .= '<tr><th colspan="13"><span style="font-weight:400; font-size:18px; line-size:25px;">'.$time_name.'\'s data for '.$data[0].'</span></th></tr>';
    $html .= '<tr>
                <th>Time</th>
                <th>Air Temp<br />&deg;C</th>
                <th>App Temp<br />&deg;C</th>
                <th>Dew Point<br />&deg;C</th>
                <th>Rel. Hum<br />%</th>
                <th>Delta Temp<br />&deg;C</th>
                <th>Soil Temp<br />&deg;C</th>
                <th>Solar Rad<br />W/m<sup>2</sup></th>
                <th>Wind Avg<br />km/h</th>
                <th>Wind Max<br />km/h</th>
                <th>Wind Dir<br />&deg;</th>
                <th>Rain<br />mm</th>
            </tr>';
            
    foreach ($data[1]['airT'] as $k => $v) {
        $html .= '<tr>';
        $html .= '  <td>'.$k.'</td>';
        $html .= '  <td>'.$v.'</td>';//airT
        $html .= '  <td>'.$data[1]['appT'][$k].'</td>';
        $html .= '  <td>'.$data[1]['dp'][$k].'</td>';
        $html .= '  <td>'.$data[1]['rh'][$k].'</td>';
        $html .= '  <td>'.$data[1]['deltaT'][$k].'</td>';
        $html .= '  <td>'.$data[1]['soilT'][$k].'</td>';
        $html .= '  <td>'.$data[1]['gsr'][$k].'</td>';
        $html .= '  <td>'.$data[1]['Wavg'][$k].'</td>';
        $html .= '  <td>'.$data[1]['Wmax'][$k].'</td>';
        $html .= '  <td>'.$data[1]['Wdir'][$k].'</td>';
        $html .= '  <td>'.$data[1]['rain'][$k].'</td>';
        $html .= '<tr>';
    }

    $html .= '<table>';
  
    return $html;
}
function make_table_daily($data, $time_name) {
    $html = '<table class="table_data"  id="table_today">';
    $html .= '<tr><th colspan="14"><span style="font-weight:400; font-size:18px; line-size:25px;">'.$time_name.'\'s data for '.$data[0].'</span></th></tr>';
    $html .= '<tr>
                <th>Time</th>
                <th>Air Temp avg<br />&deg;C</th>                
                <th>App Temp avg<br />&deg;C</th>
                <th>Dew Point avg<br />&deg;C</th>
                <th>Rel. Hum avg<br />%</th>
                <th>Delta Temp avg<br />&deg;C</th>
                <th>Soil Temp avg<br />&deg;C</th>
                <th>Solar Rad<br />W/m<sup>2</sup></th>
                <th>Wind Avg<br />km/h</th>
                <th>Wind Max<br />km/h</th>
                <th>Rain<br />mm</th>
                <th>Frost<br />Hrs<br />mm</th>
                <th>Deg Days<br />mm</th>
                <th>ET<sub>asce t</sub><br />mm</th>
            </tr>';
            
    foreach ($data[1]['airT_avg'] as $k => $v) {
        $html .= '<tr>';
        $html .= '  <td><nobr>'.$k.'</nobr></td>';
        $html .= '  <td>'.$v.'</td>';//airT
        $html .= '  <td>'.$data[1]['appT_avg'][$k].'</td>';
        $html .= '  <td>'.$data[1]['dp_avg'][$k].'</td>';
        $html .= '  <td>'.$data[1]['rh_avg'][$k].'</td>';
        $html .= '  <td>'.$data[1]['deltaT_avg'][$k].'</td>';
        $html .= '  <td>'.$data[1]['soilT_avg'][$k].'</td>';
        $html .= '  <td>'.$data[1]['gsr'][$k].'</td>';
        $html .= '  <td>'.$data[1]['Wavg'][$k].'</td>';
        $html .= '  <td>'.$data[1]['Wmax'][$k].'</td>';
        $html .= '  <td>'.$data[1]['rain'][$k].'</td>';
        $html .= '  <td>'.$data[1]['frost_hrs'][$k].'</td>';
        $html .= '  <td>'.$data[1]['deg_days'][$k].'</td>';
        $html .= '  <td>'.$data[1]['et_asce_t'][$k].'</td>';
        $html .= '<tr>';
    }

    $html .= '<table>';
  
    return $html;
}
# not used yet
function make_table_monthly_rain($aws_id, $name) {
    $sql = "
        SELECT * FROM 
        (
            SELECT 
            aws_id,
            DATE_FORMAT(stamp, '%m/%Y') month, 
            ROUND(SUM(rain_total),1) AS total, 
            COUNT(rain_total) AS rain_days
            FROM tbl_data_days 
            WHERE aws_id = 'RMPW08' 
            GROUP BY YEAR(stamp), MONTH(stamp) 
            ORDER BY YEAR(stamp) DESC, MONTH(stamp) DESC
        ) AS sums
        INNER JOIN
        (
            SELECT 
            DATE_FORMAT(stamp, '%m/%Y') AS month2,
            SUM(IF(DAY(stamp) = 1,rain_total,'')) AS 'c1',
            SUM(IF(DAY(stamp) = 2,rain_total,'')) AS 'c2',
            SUM(IF(DAY(stamp) = 3,rain_total,'')) AS 'c3',
            SUM(IF(DAY(stamp) = 4,rain_total,'')) AS 'c4',
            SUM(IF(DAY(stamp) = 5,rain_total,'')) AS 'c5',
            SUM(IF(DAY(stamp) = 6,rain_total,'')) AS 'c6',
            SUM(IF(DAY(stamp) = 7,rain_total,'')) AS 'c7',
            SUM(IF(DAY(stamp) = 8,rain_total,'')) AS 'c8',
            SUM(IF(DAY(stamp) = 9,rain_total,'')) AS 'c9',
            SUM(IF(DAY(stamp) = 10,rain_total,'')) AS 'c10',
            SUM(IF(DAY(stamp) = 11,rain_total,'')) AS 'c11',
            SUM(IF(DAY(stamp) = 12,rain_total,'')) AS 'c12',
            SUM(IF(DAY(stamp) = 13,rain_total,'')) AS 'c13',
            SUM(IF(DAY(stamp) = 14,rain_total,'')) AS 'c14',
            SUM(IF(DAY(stamp) = 15,rain_total,'')) AS 'c15',
            SUM(IF(DAY(stamp) = 16,rain_total,'')) AS 'c16',
            SUM(IF(DAY(stamp) = 17,rain_total,'')) AS 'c17',
            SUM(IF(DAY(stamp) = 18,rain_total,'')) AS 'c18',
            SUM(IF(DAY(stamp) = 19,rain_total,'')) AS 'c19',
            SUM(IF(DAY(stamp) = 20,rain_total,'')) AS 'c20',
            SUM(IF(DAY(stamp) = 21,rain_total,'')) AS 'c21',
            SUM(IF(DAY(stamp) = 22,rain_total,'')) AS 'c22',
            SUM(IF(DAY(stamp) = 23,rain_total,'')) AS 'c23',
            SUM(IF(DAY(stamp) = 24,rain_total,'')) AS 'c24',
            SUM(IF(DAY(stamp) = 25,rain_total,'')) AS 'c25',
            SUM(IF(DAY(stamp) = 26,rain_total,'')) AS 'c26',
            SUM(IF(DAY(stamp) = 27,rain_total,'')) AS 'c27',
            SUM(IF(DAY(stamp) = 28,rain_total,'')) AS 'c28',
            SUM(IF(DAY(stamp) = 29,rain_total,'')) AS 'c29',
            SUM(IF(DAY(stamp) = 30,rain_total,'')) AS 'c30',
            SUM(IF(DAY(stamp) = 31,rain_total,'')) AS 'c31'
            FROM tbl_data_days
            WHERE aws_id = 'RMPW08' 
            GROUP BY YEAR(stamp), MONTH(stamp)
            ORDER BY YEAR(stamp) DESC, MONTH(stamp)
        ) AS days
        ON sums.month = days.month2;";
        
        // connect to DB using mysqli
        include('db-connection.php');
        
	$table = '';
	$name = '';

	$cnt = 0;
	if ($result = $mysqli->query($sql))
	{
		while($obj = $result->fetch_object())
		{
			$name = $obj->name;
			if ($cnt % 2 == 0)
			{
				$table .= '<tr class="even">';
			}
			else
			{
				$table .= '<tr class="odd">';
			}	
			$cnt++;		
			$table.=
				'	<td>' . $obj->month . '</td>'.
				'	<td>&nbsp;</td>'.
				'	<td>' . $obj->total . '</td>'.
				'	<td>&nbsp;</td>'.
				'	<td>' . $obj->rain_days . '</td>'.
				'	<td>' . ($obj->c1 > 0 ? $obj->c1 : '').'</td>'.
				'	<td>' . ($obj->c2 > 0 ? $obj->c1 : ''). '</td>'.
				'	<td>' . ($obj->c3 > 0 ? $obj->c3 : ''). '</td>'.
				'	<td>' . ($obj->c4 > 0 ? $obj->c4 : ''). '</td>'.
				'	<td>' . ($obj->c5 > 0 ? $obj->c5 : ''). '</td>'.
				'	<td>' . ($obj->c6 > 0 ? $obj->c6 : ''). '</td>'.
				'	<td>' . ($obj->c7 > 0 ? $obj->c7 : ''). '</td>'.
				'	<td>' . ($obj->c8 > 0 ? $obj->c8 : ''). '</td>'.
				'	<td>' . ($obj->c9 > 0 ? $obj->c9 : ''). '</td>'.
				'	<td>' . ($obj->c10 > 0 ? $obj->c10 : ''). '</td>'.
				'	<td>' . ($obj->c11 > 0 ? $obj->c11 : ''). '</td>'.
				'	<td>' . ($obj->c12 > 0 ? $obj->c12 : ''). '</td>'.
				'	<td>' . ($obj->c13 > 0 ? $obj->c13 : ''). '</td>'.
				'	<td>' . ($obj->c14 > 0 ? $obj->c14 : ''). '</td>'.
				'	<td>' . ($obj->c15 > 0 ? $obj->c15 : ''). '</td>'.
				'	<td>' . ($obj->c16 > 0 ? $obj->c16 : ''). '</td>'.
				'	<td>' . ($obj->c17 > 0 ? $obj->c17 : ''). '</td>'.
				'	<td>' . ($obj->c18 > 0 ? $obj->c18 : ''). '</td>'.
				'	<td>' . ($obj->c19 > 0 ? $obj->c19 : ''). '</td>'.
				'	<td>' . ($obj->c20 > 0 ? $obj->c20 : ''). '</td>'.
				'	<td>' . ($obj->c21 > 0 ? $obj->c21 : ''). '</td>'.
				'	<td>' . ($obj->c22 > 0 ? $obj->c22 : ''). '</td>'.
				'	<td>' . ($obj->c23 > 0 ? $obj->c23 : ''). '</td>'.
				'	<td>' . ($obj->c24 > 0 ? $obj->c24 : ''). '</td>'.
				'	<td>' . ($obj->c25 > 0 ? $obj->c25 : ''). '</td>'.
				'	<td>' . ($obj->c26 > 0 ? $obj->c26 : ''). '</td>'.
				'	<td>' . ($obj->c27 > 0 ? $obj->c27 : ''). '</td>'.
				'	<td>' . ($obj->c28 > 0 ? $obj->c28 : ''). '</td>'.
				'	<td>' . ($obj->c29 > 0 ? $obj->c29 : ''). '</td>'.
				'	<td>' . ($obj->c30 > 0 ? $obj->c30 : ''). '</td>'.
				'	<td>' . ($obj->c31 > 0 ? $obj->c31 : ''). '</td>'.
				'</tr>';
		}
	}

	$table = 	'<style>
					.table_data {
						table-layout: fixed;
						font-size: 10px;
					}
					.table_data th, .table_data td {
						width:25px!important;
						overflow:hidden;
						padding:0px!important;
						/*border:none!important;*/
					}
				</style>
				<table class="table_data">
					<tr style="text-align:center;"><th colspan="36"><span style="font-weight:400; font-size:18px; line-size:25px;">Monthly Rain\'s data for '.$name.'</span></th></tr>
					<tr style="text-align:center;"><th>Month</th><th></th><th>Total Rain</th><th></th><th>Rain</th><th colspan="31">Day of month</th></tr>
					<tr>
						<th></th>
						<th></th>
						<th>mm</th>
						<th></th>
						<th>Days</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
						<th>9</th>
						<th>10</th>
						<th>11</th>
						<th>12</th>
						<th>13</th>
						<th>14</th>
						<th>15</th>
						<th>16</th>
						<th>17</th>
						<th>18</th>
						<th>19</th>
						<th>20</th>
						<th>21</th>
						<th>22</th>
						<th>23</th>
						<th>24</th>
						<th>25</th>
						<th>26</th>
						<th>27</th>
						<th>28</th>
						<th>29</th>
						<th>30</th>
						<th>31</th>
					</tr>'
					.$table.
				'</table>';
				

	//garbage collection
	$result->close();
	unset($obj);
	unset($sql);
	unset($query);
	$mysqli->close();

	echo $table;        
}
?>
