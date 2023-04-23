<!-- news_chart.php -->

<html>
  <head>
    <title>Төрөл мэдээ</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Type', 'Count'],
          <?php
            $conn = mysqli_connect('localhost', 'root', '', 'muruu');
            $result = mysqli_query($conn, "SELECT type, COUNT(*) as count FROM news_form GROUP BY type");

            while ($row = mysqli_fetch_assoc($result)) {
              echo "['" . $row['type'] . "', " . $row['count'] . "],";
            }
            mysqli_close($conn);
          ?>
        ]);

        var options = {
          title: 'Мэдээний нийтлэлийн тоо төрлөөр',
          legend: { position: 'none' },
          bars: 'vertical',
          vAxis: { title: 'Count' },
          hAxis: { title: 'ТӨРӨЛ' }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f7f7f7;
}

#chart_div {
  margin: 50px auto;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
#chart_div h1 {
  font-size: 24px;
  font-weight: bold;
  text-align: center;
  margin: 0;
  padding: 20px 0;
  color: #333;
}

.google-visualization-columnchart {
  width: 100%;
  height: 100%;
  padding: 20px;
}

.google-visualization-columnchart .google-visualization-vaxis,
.google-visualization-columnchart .google-visualization-haxis {
  font-size: 14px;
  color: #777;
}

.google-visualization-columnchart .google-visualization-column {
  fill: #4285f4;
}

.google-visualization-tooltip {
  font-size: 14px;
  font-weight: bold;
  background-color: #333;
  color: #fff;
  border-radius: 5px;
  padding: 10px;
}

.google-visualization-tooltip:before {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent transparent #333 transparent;
}

  </style>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>
