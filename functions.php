<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'admin';
    $DATABASE_PASS = 'j159540!';
    $DATABASE_NAME = 'holyhope';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}

function curl_ping($function, $productId, $name, $description, $max_attendee, $price, $image_url){
    if ($image_url = ""){
        $ending = $productId + "/" + $name + "/" + $max_attendee + "/" + $description + "/" + $price;
    } else{
        $ending = $productId + "/" + $name + "/" + $max_attendee + "/" + $description + "/" + $price + "/" + $image_url;
    }
    $url_start = "https://holyhope.co.uk/_functions-dev/" + $function + '/secretphrase/';
    $url = $url_start + $ending;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Content-Length: 0",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    var_dump($resp);
    }

function add_event($productId, $name, $description, $max_attendee, $price, $image_url = ""){
    $function = "add_event";

    curl_ping($function, $productId, $name, $description, $max_attendee, $price, $image_url);


}

function updateEvent($productId, $name, $description, $max_attendee, $price, $image_url = ""){
    $function = "updateEvent";

    curl_ping($function, $productId, $name, $description, $max_attendee, $price, $image_url);


}






function clean($userInput) {
    $userInput = trim($userInput);
    $userInput = stripslashes($userInput);
    $userInput = htmlspecialchars($userInput);
    return $userInput;
}

//returns the total amount of columns in the table
function getRowAmount($tableName){
    $db = pdo_connect_mysql();
    $query = "select COUNT(*) from " .$tableName;
    $stmt = $db->query($query);
    return $stmt->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
}


// returns the amount of attendees at a given event id
// NOTE - $tablename should always be the name of the linking table between events and custumers.
// TO CHANGE - once table names are known $tablename can be removed
function getAttendeesAmount($tableName, $eventId){
    $db = pdo_connect_mysql();
    $query = "select COUNT(id) from". $tableName ."where id =". $eventid;
    $stmt = $db->query($query);
    return $stmt->fetch(PDO::FETCH_ASSOC)["COUNT(id)"];
}

function getHashValue($toHash){
    return hash('sha256', $toHash);
}

function loginAutentication($givenUsername, $givenPassword){
    $db = pdo_connect_mysql();
    $query = 'select exists(SELECT * from authenticated_users where username = ?) as "exists"';
    $stmt = $db->prepare($query);
    $stmt->execute([$givenUsername]);
    $returnedValue = $stmt->fetch(PDO::FETCH_ASSOC)["exists"];
    if ($returnedValue == "1"){
        $query = "select password from authenticated_users where username = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$givenUsername]);
        $returnedValue = $stmt->fetch(PDO::FETCH_ASSOC)["password"];
        if ($returnedValue == getHashValue($givenPassword)){
            return TRUE;
        }
        else{
            return False;
        }

    }
    else{
        return FALSE;
        
    }

}
?>

