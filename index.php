<?php
require 'connect.php';

$pdo = new \PDO(DSN, USER, PASS);

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $firstname = trim(stripslashes(htmlspecialchars($_POST['firstname'])));
    $lastname = trim(stripslashes(htmlspecialchars($_POST['lastname'])));
    
    $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
    $statement = $pdo->prepare($query);

    $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

    $statement->execute();
    $friends = $statement->fetchAll();
    
        header('Location: index.php');

    // var_dump($_POST);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method='post' enctype = "application/x-www-form-urlencoded">
        <label for="firstname" >Enter your firstname : </label>
        <input type="text" name="firstname" maxlength = "45" required>
        <label for="lastname" >Enter your lastname : </label>
        <input type="text" name="lastname" maxlength = "45" required>
        <button type="submit" name='submit'>Submit</button>
    </form>

    <div>
        <?php
        $query = "SELECT * FROM friend";
        $statement = $pdo->query($query);
    
    
        // Solution avec FETCH_ASSOC
        // $friends = $statement->fetchAll(PDO::FETCH_ASSOC);
        // foreach ($friends as $friend){
        //     echo $friend['firstname'] . " " . $friend['lastname'] . '<br>' . PHP_EOL;
        // }

        // Solution avec FETCH_OBJ
        $friends = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($friends as $friend){
            echo '<ul>' . $friend->firstname . ' ' . $friend->lastname . '</ul>' . PHP_EOL;
    }

        ?>
    </div>
</body>
</html>