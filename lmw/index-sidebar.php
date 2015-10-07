<?php
$cnt = 0;
print '<tr>
	<td class="CMSTreeMenuItem" id="plc_lt_zoneContent_PagePlaceholder_PagePlaceholder_lt_zoneLeftMenu_LeftTreeMenu_tid_'.$cnt.'_0">
			<strong>Whole Region</strong>
	</td>
</tr>';
$cnt++;

print '<tr>
	<td class="CMSTreeMenuItem" id="plc_lt_zoneContent_PagePlaceholder_PagePlaceholder_lt_zoneLeftMenu_LeftTreeMenu_tid_'.$cnt.'_0">
		<a href="/?main=map" class="CMSTreeMenuLink" id="plc_lt_zoneContent_PagePlaceholder_PagePlaceholder_lt_zoneLeftMenu_LeftTreeMenu_tid_'.$cnt.'_0_item">
			Station Map
		</a>
	</td>
</tr>';
$cnt++;

print '<tr>
	<td class="CMSTreeMenuItem" id="plc_lt_zoneContent_PagePlaceholder_PagePlaceholder_lt_zoneLeftMenu_LeftTreeMenu_tid_'.$cnt.'_0">
		<a href="/?main=daily" class="CMSTreeMenuLink" id="plc_lt_zoneContent_PagePlaceholder_PagePlaceholder_lt_zoneLeftMenu_LeftTreeMenu_tid_'.$cnt.'_0_item">
			Latest Daily readings
		</a>
	</td>
</tr>';
$cnt++;

print '<tr>
	<td class="CMSTreeMenuItem" id="plc_lt_zoneContent_PagePlaceholder_PagePlaceholder_lt_zoneLeftMenu_LeftTreeMenu_tid_'.$cnt.'_0">
		<a href="/?main=15min" class="CMSTreeMenuLink" id="plc_lt_zoneContent_PagePlaceholder_PagePlaceholder_lt_zoneLeftMenu_LeftTreeMenu_tid_'.$cnt.'_0_item">
			Latest 15min readings
		</a>
	</td>
</tr>';
$cnt++;

print '<tr>
	<td class="CMSTreeMenuItem" id="plc_lt_zoneContent_PagePlaceholder_PagePlaceholder_lt_zoneLeftMenu_LeftTreeMenu_tid_'.$cnt.'_0">
		<a href="/?view=chill" class="CMSTreeMenuLink" id="plc_lt_zoneContent_PagePlaceholder_PagePlaceholder_lt_zoneLeftMenu_LeftTreeMenu_tid_'.$cnt.'_0_item">
			Chill Calculator
		</a>
	</td>
</tr>';
$cnt++;

// connect to DB using mysqli
include('../db-connection.php');

$sql = "SELECT aws_id, tbl_stations.name, tbl_districts.name AS district FROM tbl_stations INNER JOIN tbl_districts ON district_id = id WHERE tbl_stations.owner = 'LMW' ORDER BY weight, name;";

$last_district = "";

if ($result = $mysqli->query($sql)) {
	while($obj = $result->fetch_object()) {
		if ($obj->district != $last_district) {
			//print '<tr><td class="CMSTreeMenuItem">&nbsp;</td></tr>';
			print '<tr>
	<td class="CMSTreeMenuItem" id="plc_lt_zoneContent_PagePlaceholder_PagePlaceholder_lt_zoneLeftMenu_LeftTreeMenu_tid_'.$cnt.'_0">
			'.$obj->district.'
	</td>
</tr>';			
		}
		//print '<a class="blue" href="?aws_id='.$obj->aws_id.'&view=summary">'.$obj->name.'</a><br />';
		print '<tr>
	<td class="CMSTreeMenuItem" id="plc_lt_zoneContent_PagePlaceholder_PagePlaceholder_lt_zoneLeftMenu_LeftTreeMenu_tid_'.$cnt.'_0">
		<a href="/?aws_id='.$obj->aws_id.'&view=summary" class="CMSTreeMenuLink" id="plc_lt_zoneContent_PagePlaceholder_PagePlaceholder_lt_zoneLeftMenu_LeftTreeMenu_tid_'.$cnt.'_0_item">
			'.$obj->name.'
		</a>
	</td>
</tr>';
		$cnt++;
		$last_district = $obj->district;
	}	
} else {
	print '<h3>Sorry! There is a problem with the system. We have been notified and are working on fixing it.</h3>';
}

print '<tr><td class="CMSTreeMenuItem">&nbsp;</td></tr>';

?>
