<?php 

    $data = (unserialize(urldecode(stripslashes($_GET['data']))));
    if (isset($_GET['is_multi'])) {
        if ($_GET['is_multi'] == 'true') {
            make_graph_multi_line($_GET['title'], $data['min'], $data['avg'], $data['max']);
        }
    } else {
        make_graph($_GET['title'], $data, $_GET['is_bar_graph'], $_GET['colour']);
    }
    
    function make_graph($title, $data, $is_bar_graph, $colour) {
		include('phpgraphlib.php');
		$graph = new PHPGraphLib(530,250);
        $graph->addData($data);
        if ($is_bar_graph == 'true') {
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
?>
