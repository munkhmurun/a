<?php
@include 'config.php';

// Хэрэглэгчийн тоог хүйсээр нь авахын тулд мэдээллийн сангаас авна.
$result = mysqli_query($conn, "SELECT gender, COUNT(*) as count FROM user_form GROUP BY gender");
// Диаграмын өгөгдлийг хадгалах массив үүсгэнэ
$data = array();

// Асуулгын үр дүнг гүйлгэж, өгөгдлийн массив руу нэмнэ үү
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array($row['gender'], (int)$row['count']);
}

// Өгөгдлийн массивыг JSON болгон хөрвүүлнэ
$json_data = json_encode($data);

mysqli_close($conn);
?>

<!-- Графикийн санг оруулах (жишээ нь: Google Charts эсвэл Chart.js) -->
<script src="https://www.gstatic.com/charts/loader.js"></script>

<!-- Диаграм div  -->
<div id="chart_div"></div>

<!-- График зурах скрипт  -->
<script>
// Диаграмын сан
    google.charts.load('current', {'packages':['corechart']});

   // Номын сан ачаалагдсан үед диаграм зурахын тулд буцаан дуудах функцийг тохируулна уу
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      // JSON өгөгдлөөс өгөгдлийн хүснэгт үүсгэнэ үү
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Gender');
        data.addColumn('number', 'Count');
        data.addRows(<?php echo $json_data; ?>);

        var options = {
            title: 'Хэрэглэгчдийн хүйсийн харьцаа.',
            pieHole: 0.4,
            colors: ['#FF69B4', '#87CEFA'],
            legend: { position: 'bottom' }, 
            pieSliceText: 'value',
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
