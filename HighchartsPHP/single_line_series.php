<?php

//use Ghunti\HighchartsPHP\Highchart;
//use Ghunti\HighchartsPHP\HighchartJsExpr;
include_once('src/Highchart.php'); 
include_once('src/HighchartJsExpr.php'); 
$chart = new Highchart(Highchart::HIGHSTOCK);

$chart->chart->renderTo = "container";
$chart->rangeSelector->selected = 1;
$chart->title->text = "Example";
$chart->series[] = array(
    'name' => "AAPL",
    'data' => new HighchartJsExpr("data"),
    'tooltip' => array(
        'valueDecimals' => 2
    )
);
$chart->credits->enabled=false;
    ?>

<html>
    <head>
        <title>Single line series</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
            $.getJSON('call_TachoDataRange.php', function(data) {
                // Create the chart
                window.chart = <?php echo $chart->render(); ?>;
            });
        </script>
    </body>
</html>