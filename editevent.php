

<?php
include 'functions.php';
session_start();
if(!isset($_SESSION['username']))
{
  header('location: index.php');
}

$pdo = pdo_connect_mysql();
$msg = '';
// Check if the events id exists, for example update.php?id=1 will get the events with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead updates a record and not insert
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $event_date = isset($_POST['event_date']) ? $_POST['event_date'] : '';
        $location = isset($_POST['location']) ? $_POST['location'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE events SET name = ?, price = ?, event_date = ?, location = ?, description = ? WHERE id = ?');
        $stmt->execute([$id, $name, $price, $event_date, $location ,$description, $_GET['id']]);
        $msg = 'Updated Successfully!';
        header('Location: readevent.php');
    }
    // Get the events from the Events table
    $stmt = $pdo->prepare('SELECT * FROM events WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$event) {
        exit('events doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<!-- The above code will check for the Event ID, the ID will be a parameter in the URL, for example, http://localhost/phpcrud/update.php?id=1 will get the Event with the ID of 1, and then request can be handelled with the GET method and execute a MySQL query that will get the Event by ID. -->
    <?php include 'header.php'; ?>
        <div class="contact-section">
            <h2>Update Event #<?=$event['id']?></h2>
            <form action="editevent.php?id=<?=$event['id']?>" method="post">
                    <label for="name">Event Name</label>
                    <input type="text" name="name" id="name" class="contact-form-text" placeholder="Event Name" value="<?=$event['name']?>" required>
                    <label for="name">Event price</label>
                    <input type="decimals" name="price" id="price" class="contact-form-text" placeholder="Event price" value="&pound; <?=$event['price']?>" required>
                    <label for="name">Event Date</label>
                    <input type="date" name="event_date" id="event_date" class="contact-form-text" value="<?=$event['event_date']?>" required>
                    <label for="name">Event Location</label>
                    <input type="text" name="location" id="location" class="contact-form-text" placeholder="Event price" value="<?=$event['location']?>" required>
                    <label for="description">Description</label>
                    <input type="text" name="description" placeholder="enter some description" value="<?=$event['description']?>" id="description">

                    <input type="submit" name="submit" class="contact-button" value="update">
                    <input type="button" class="contact-button" value="Go back!" onclick="history.go(-1)">
            </form>
            <?php if ($msg): ?>
            <?php endif; ?>
        </div>

<?php include 'footer.php'; ?>
