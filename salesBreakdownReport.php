<?php ;
include "functions.php";
session_start();
if(!isset($_SESSION['username']))
{
  header('location: index.php');
}
?>
<?php include 'header.php';?>
<h1>Sales breakdown report</h1>
<?php
$events = getRowAmount("events");
$products = getRowAmount("products");
// pichart.php displays a pichart on the page 
include "piechart.php";
echo "<div>
<p>Total events sold: ". $events. "</p>
<p>Total products sold: " .$products."</p>
</div>";
?>

<?php include 'footer.php'; ?>