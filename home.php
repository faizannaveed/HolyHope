<?php 
session_start();
if(!isset($_SESSION['username']))
{
  header('location: index.php');
}
?>

<?php include 'header.php';?>
<div id="home-container">
  <div class="top left">
  <button class="home-button button3" onclick="document.location='readevents.php'">Events page</button>
  </div>
  <div class="top right">
  <button class="home-button button3" onclick="document.location='#'">Products page</button>
  </div>
  <div class="bottom left">
  <button class="home-button button3" onclick="document.location='#'">Emails page</button>
  </div>
  <div class="bottom right">
  <button class="home-button button3" onclick="document.location='#'">KPI's page</button>
  </div>
</div>


<?php include 'footer.php'; ?>