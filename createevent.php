<?php
include 'functions.php';
session_start();
if(!isset($_SESSION['username']))
{
  header('location: index.php');
}


$name = $price = $location = $event_date = $description = "";
$msg = '';
// Check if POST data is not empty
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdo = pdo_connect_mysql();

      $pdo = pdo_connect_mysql();
        $stmt = $pdo->prepare("INSERT INTO events (name, price , location, event_date, description) VALUES (:name, :price, :location, :event_date, :description)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':event_date', $event_date);
        $stmt->bindParam(':description', $description);

        $name = clean($_POST["name"]);
        $price = clean($_POST["price"]);
        $location = clean($_POST["location"]);
        $event_date = clean($_POST["event_date"]);
        $description = clean($_POST["description"]);
        $stmt->execute();

    echo "<div class='event-center'><h2>New Event created</h2>";
    echo "<b>Event Name :</b> " . $name;
    echo "<br>";
    echo "<b>Event Price :</b> ". $price;
    echo "<br>";
    echo "<b>Event Location :</b> " . $location;
    echo "<br>";
    echo "<b>Event Date :</b>" . $event_date;
    echo "<br>";
    echo "<b>Event Description :</b>" . $description;
    echo "<br>";
    echo "<h2>New event is added to the database</h2></div> ";

    $msg = 'Created Successfully!';


}
?>
    <?php include 'header.php'; ?>
    <div class="contact-section">

            <h1>Create New Event</h1>
            <p></p>
            <div class="border"></div>
            <form class="contact-form" action="createevent.php" method="post" enctype="multipart/form-data">
                <label for="name">Event Name</label>
                <input type="text" name="name" id="name" class="contact-form-text" placeholder="Event Name" required>
                <label for="name">Event price</label>
                <input type="decimals" name="price" id="price" class="contact-form-text" placeholder="Event Price" required>
                <label for="name">Event Date</label>
                <input type="date" name="event_date" id="event_date" class="contact-form-text" value="2021-03-22" required>
                <label for="name">Event Location</label>
                <input type="text" name="location" id="location" class="contact-form-text" placeholder="Event location" required>
                <textarea name="description" class="contact-form-text" placeholder="event description"></textarea>
                <input type="submit" name="submit" class="contact-button" value="Create">
                <button onclick="goBack()">Go Back</button>

                <script>
                    function goBack() {
                    window.history.back();
                }
                </script>
            </form>
        <?php if ($msg): ?>
        <p><?=$msg?></p>
        <?php endif; ?>
    </div>


<?php include 'footer.php'; ?>