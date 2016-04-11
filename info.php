<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:login.php");
	}

    require('config.php');
    // Create connection
    $userid = $_SESSION['id'];
    $conn = new mysqli($host, $user, $passwd, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM tanques where usuario = '$userid'";
    $result = $conn->query($sql);

        // output data of each row
        while($row = $result->fetch_assoc()) 
        {

echo '<div class="row">
	    <div class="col-sm-4">
            <h3 class="title">Nivel actual tanque '.$row['alias'].'</h3>
            <div id="nivel'.$row['id'].'" class="nivel"></div>
        </div>
        <div class="col-sm-8">
            <h3 class="title">Nivel mensual diario tanque '.$row['alias'].'</h3>
            <div id="consumomes'.$row['id'].'" class="mes"></div>
        </div>
      </div>
      <hr>
';
}
?>
<script>
	$(document).ready(function(){
<?php
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) 
        {
?>

        $.getJSON('actualstate.php?tanque=<?php echo $row['id'];?>',
        function(data){
            nivel(data,'#nivel<?php echo $row['id'];?>');
        });
    
		$.getJSON('dataweek.php?tanque=<?php echo $row['id'];?>',
		function(data){
			consumo(data[0],data[1],'#consumomes<?php echo $row['id'];?>');
		});
<?php
    
    }
    $conn->close();
?>
});

function nivel(porcentaje,target) {

    $(target).highcharts({

        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

        title: {
            text: 'Porcentaje <?php echo date("Y/m/d");?>'
        },

        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },

        // the value axis
        yAxis: {
            min: 0,
            max: 100,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'Porcentaje'
            },
            plotBands: [{
                from: 50,
                to: 100,
                color: '#55BF3B' // green
            }, {
                from: 20,
                to: 50,
                color: '#DDDF0D' // yellow
            }, {
                from: 10,
                to: 20,
                color: '#FF8000' // orange
            }, {
                from: 0,
                to: 10,
                color: '#DF5353' // red
            }]
        },
        credits: {
            enabled: false
        },

        series: [{
            name: 'Porcentaje',
            data: [80],
            tooltip: {
                valueSuffix: '%'
            }
        }]

    },
    // Add some life
    function (chart) {
       if (!chart.renderer.forExport) {
            
                var point = chart.series[0].points[0],
                    newVal,
                    inc = Math.floor(porcentaje * 100);

                newVal =inc;        

                point.update(newVal);
        }
    });
}

function consumo(fechas, datos,target) {
    $(target).highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Porcentaje diario'
        },
        subtitle: {
            text: 'GasU'
        },
        xAxis: {
            categories: fechas
        },
        yAxis: {
            title: {
                text: 'Porcentaje (%)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Porcentaje',
            data: datos,
            color:'#55BF3B'
        }
        ]
    });
}
</script>