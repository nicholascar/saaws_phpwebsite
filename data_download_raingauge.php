<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // connect to DB using mysqli
        include('db-connection.php');
    
        $start = $_GET['start'];
        $end = $_GET['end'];
        
        $sql = '';
        if ($_GET['format'] == 'minutes') {
            $sql = "SELECT DISTINCT tbl_stations.name, tbl_data_minutes.stamp, tbl_data_minutes.rain AS rain
                    FROM tbl_data_minutes
                    INNER JOIN tbl_stations 
                    ON tbl_data_minutes.aws_id = tbl_stations.aws_id 
                    WHERE
                        tbl_data_minutes.aws_id = '".$_GET['aws_id']."'
                        AND stamp BETWEEN '".$start."' AND '".$end."' + INTERVAL 23 HOUR
                    ORDER BY stamp;";
                    
                if (intval(substr($start,0,4)) < 2012) {
                    $sql = rtrim($sql,";");
                    $sql = '('.$sql.') UNION (' .str_replace('tbl_15min','tbl_15min_pre2012',$sql). ')';                
                }				
        }
        else {
            $sql = 	"SELECT tbl_stations.name, tbl_data_days.stamp, tbl_data_days.rain_total AS rain
                    FROM tbl_data_days 
                    INNER JOIN tbl_stations 
                    ON tbl_data_days.aws_id = tbl_stations.aws_id 
                    WHERE
                        tbl_data_days.aws_id = '".$_GET['aws_id']."'
                        AND stamp BETWEEN '".$start."' AND '".$end."' ORDER BY stamp;
                    ORDER BY stamp;";
                    
            $sql = "SELECT DISTINCT tbl_stations.name, tbl_data_days.stamp, tbl_data_days.rain_total AS rain
                    FROM tbl_data_days
                    INNER JOIN tbl_stations 
                    ON tbl_data_days.aws_id = tbl_stations.aws_id 
                    WHERE
                        tbl_data_days.aws_id = '".$_GET['aws_id']."'
                        AND stamp BETWEEN '".$start."' AND '".$end."'
                    ORDER BY stamp;";
        }
    
        $name = "";
        $data = "";
    
        
        if ($result = $mysqli->query($sql)) {
            while($obj = $result->fetch_object()) {
                $name = $obj->name;
                $data .=  $obj->stamp . ',' . $obj->rain . "\n";
            }
        }
        if ($_GET['format'] == 'minutes') {
            $csv_output = "Time, Rain (mm)\n";
            $csv_file = 'aws_data_minutes_';
        } else {
            $csv_output = "Date, Rain (mm)\n";
            $csv_file = 'aws_data_days_';
        }
        $csv_output .= $data;
        //send the file
        $csv_file			= $csv_file . $name.'_'.preg_replace("*(\d+)/(\d+)/(\d+)*", "$3-$2-$1", $start).'_'.preg_replace("*(\d+)/(\d+)/(\d+)*", "$3-$2-$1", $end).".csv";
        $ContentType		= "Content-type: application/vnd.ms-excel";
        //$ContentLength	= "Content-Length: $size_in_bytes";
        $ContentDisposition	= "Content-Disposition: attachment; filename=\"$csv_file\"";

        header($ContentType);
        //header($ContentLength);
        header($ContentDisposition);
    
        echo $csv_output;
	} else {
        print 'This page cannot be viewed directly - it is to be used for downloading data only.';
    }        
?>
