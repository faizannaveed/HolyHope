<?php ;
session_start();
if(!isset($_SESSION['username']))
{
  header('location: index.php');
}
?>
<?php include 'header.php';?>
<div id="home-container">
  <div class="top left">
  <button class="home-button button3" onclick="document.location='#'">Monthly sales report</button>
  </div>
  <div class="top right">
  <button class="home-button button3" onclick="document.location='#'">Current months events report</button>
  </div>
  <div class="bottom left">
  <button class="home-button button3" onclick="document.location='salesBreakdownReport.php'">Sales breakdown report</button>
  </div>
  <div class="bottom right">
  <button class="home-button button3" onclick="document.location='#'">monthly sales report vs last years</button>
  </div>
</div>
<?php include 'footer.php'; ?>