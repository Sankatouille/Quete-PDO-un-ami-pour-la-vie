<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Recherche d'un Friend</h1>
    <form action="index.php" method="POST">
        <label for="firstname" >Firstname</label>
        <input type="text" name="firstname">
        
        <label for="lastname" >Lastname</label>
        <input type="text" name="lastname">

        <button type="submit">Submit</button>

        
    </form>

    
</body>
</html>

<?php


require_once 'connec.php';

$pdo = new \PDO(DSN,USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();



foreach($friends as $friend) {
    echo "<ul>\n<li>" .$friend['firstname'].' '. $friend['lastname'] . "</li></ul>";
}


$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);

$query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname , :lastname)";
$statement= $pdo->prepare($query);

$statement->bindvalue('firstname', $firstname, \pdo::PARAM_STR);
$statement->bindvalue('lastname', $lastname, \pdo::PARAM_STR);


$statement->execute();

$friends = $statement->fetchAll();

