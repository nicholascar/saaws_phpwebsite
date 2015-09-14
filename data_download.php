<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // connect to DB using mysqli
        include('db-connection.php');
    
        $start = preg_replace("*(\d+)/(\d+)/(\d+)*", "$3-$2-$1", $_GET['start']);
        if ($_GET['end'] == 'latest')
        {
            $end = date('Y-m-d',strtotime('-1 day',strtotime(date('Y-m-d'))));
        }
        else
        {
            $end = preg_replace("*(\d+)/(\d+)/(\d+)*", "$3-$2-$1", $_GET['end']);
        }   
    
        $sql = '';
        if ($_GET['format'] == '15min')
        {
            $sql = 	"SELECT DISTINCT tbl_stations.name, stamp, airT, appT, dp, rh, deltaT, soilT, gsr, Wavg, Wmax, Wdir, pressure, rain, leaf
                    FROM tbl_data_minutes
                    INNER JOIN tbl_stations 
                    ON tbl_data_minutes.aws_id = tbl_stations.aws_id 
                    WHERE tbl_data_minutes.aws_id = '".$_GET['aws_id']."' AND stamp BETWEEN '".$start."' AND '".$end."' + INTERVAL 23 HOUR
                    ORDER BY stamp;";
                    
                if (intval(substr($start,0,4)) < 2012) {
                    $sql = rtrim($sql,";");
                    $sql = '('.$sql.') UNION (' .str_replace('tbl_15min','tbl_15min_pre2012',$sql). ')';                
                }				
        }
        else //daily data
        {
            $sql = 	"SELECT tbl_stations.name, tbl_data_days.* FROM tbl_data_days ".
                    "INNER JOIN tbl_stations ".
                    "ON tbl_data_days.aws_id = tbl_stations.aws_id ".
                    "WHERE tbl_data_days.aws_id = '".$_GET['aws_id']."' AND stamp BETWEEN '".$start."' AND '".$end."' ORDER BY stamp;";			
        }
    
        $name = "";
        $data = "";
    
        if ($_GET['format'] == '15min')
        {
            if ($result = $mysqli->query($sql))
            {
                while($obj = $result->fetch_object())
                {
                    $name = $obj->name;
                    $data .=
                            $obj->stamp . ',' .
                            $obj->airT . ',' .
                            $obj->appT . ',' .
                            $obj->dp . ',' .
                            $obj->rh . ',' .
                            $obj->deltaT . ',' .
                            $obj->soilT . ',' .
                            $obj->gsr . ',' .
                            $obj->Wavg . ',' .
                            $obj->Wmax . ',' .
                            $obj->Wdir . ',' .
                            $obj->pressure . ',' .
                            $obj->rain . ',' .
                            $obj->leaf . ',' . "\n";
                }
            }
    
            $csv_output = "Time,".
                            "Air Temp (deg C),".
                            "App Temp (deg C),".
                            "Dew Pt (deg C),".
                            "RH (%),".
                            "Delta T (deg C),".
                            "Soil T (deg C),".
                            "Solar (W/m^2),".
                            "Wind Avg (km/hr),".
                            "Wind Max (km/hr),".
                            "Wind Dir (deg),".
                            "Pressure (hPa),".
                            "Rain (mm),".
                            "Leaf Wet (%)\n";
    
            $csv_output .= $data;
            //send the file
            //$size_in_bytes	= strlen($csv_output);
            $csv_file			= 'aws_data_minutes_'.$name.'_'.preg_replace("*(\d+)/(\d+)/(\d+)*", "$3-$2-$1", $start).'_'.preg_replace("*(\d+)/(\d+)/(\d+)*", "$3-$2-$1", $end).".csv";
            $ContentType		= "Content-type: application/vnd.ms-excel";
            //$ContentLength	= "Content-Length: $size_in_bytes";
            $ContentDisposition	= "Content-Disposition: attachment; filename=\"$csv_file\"";
    
            header($ContentType);
            //header($ContentLength);
            header($ContentDisposition);
        }
        else //daily data
        {
            if ($result = $mysqli->query($sql))
            {
                while($obj = $result->fetch_object())
                {
                    $name = $obj->name;
                    $data .=
                            $obj->stamp . ',' .
                            $obj->airT_min . ',' .
                            $obj->airT_avg . ',' .
                            $obj->airT_max . ',' .
                            $obj->appT_min . ',' .
                            $obj->appT_avg . ',' .
                            $obj->appT_max . ',' .
                            $obj->canT_min . ',' .
                            $obj->canT_avg . ',' .
                            $obj->canT_max . ',' .		
                            $obj->soilT_min . ',' .
                            $obj->soilT_avg . ',' .
                            $obj->soilT_max . ',' .
                            $obj->deltaT_min . ',' .
                            $obj->deltaT_avg . ',' .
                            $obj->deltaT_max . ',' .						
                            $obj->dp_min . ',' .
                            $obj->dp_avg . ',' .
                            $obj->dp_max . ',' .
                            $obj->rh_avg . ',' .
                            $obj->rh_max . ',' .
                            $obj->canRH_avg . ',' .
                            $obj->canRH_max . ',' .
                            $obj->leaf_avg . ',' .
                            $obj->leaf_max . ',' .
                            $obj->leaf_min . ',' .						
                            $obj->gsr_total . ',' .
                            $obj->Wavg . ',' .
                            $obj->Wmax . ',' .
                            $obj->rain_total . ',' .
                            $obj->frost_hrs . ',' .
                            $obj->deg_days . ',' .				
                            $obj->et_asce_s . ',' .
                            $obj->et_asce_t . ',' ."\n";
                }
            }
    
            $csv_output = "Date,".
                            "Air T Min (deg C),".
                            "Air T Avg (deg C),".
                            "Air T Max (deg C),".
                            "App T Min (deg C),".
                            "App T Avg (deg C),".
                            "App T Max (deg C),".
                            "Can T Min (deg C),".
                            "Can T Avg (deg C),".
                            "Can T Max (deg C),".
                            "Soil T Min (deg C),".
                            "Soil T Avg (deg C),".
                            "Soil T Max (deg C),".
                            "Delta T Min (deg C),".
                            "Delta T Avg (deg C),".
                            "Delta T Max (deg C),".		
                            "Dew Pt Min (deg C),".
                            "Dew Pt Avg (deg C),".
                            "Dew Pt Max (deg C),".
                            "RH Avg (%),".
                            "RH Max (%),".
                            "Can RH Avg (%),".
                            "Can RH Max (%),".	
                            "Leaf Wet Min (%),".	
                            "Leaf Wet Avg (%),".
                            "Leaf Wet Max (%),".
                            "Solar (W/m^2),".
                            "Wind Avg (km/hr),".
                            "Wind Max (km/hr),".
                            "Rain (mm),".
                            "Frost (Hrs),".
                            "Day Degs,".
                            "ET ref_s (mm),".
                            "ET ref_t (mm)\n";
    
            $csv_output .= $data;
            //send the file
            //$size_in_bytes	= strlen($csv_output);
            $csv_file			= 'aws_data_days_'.$name.'_'.$start.'_'.$end.".csv";
            $ContentType		= "Content-type: application/vnd.ms-excel";
            //$ContentLength	= "Content-Length: $size_in_bytes";
            $ContentDisposition	= "Content-Disposition: attachment; filename=\"$csv_file\"";
    
            header($ContentType);
            //header($ContentLength);
            header($ContentDisposition);
        }
    
        echo $csv_output;
	} else {
        print 'This page cannot be viewed directly - it is to be used for downloading data only.';
    }        
?>
