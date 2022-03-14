<div id="piechart"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
var events = "<?php echo($events)?>";
var products = "<?php echo($products)?>";
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Type', 'Total sales'],
  ['Events', parseInt(events)],
  ['Products', parseInt(products)],
]);
  var options = {'title':'Events vs Products', 'width':700, 'height':700};
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>