<?php
session_start();
if ($_SESSION['permission'] == 'admin') {
    $indirect = true;
    require '../php/connect.php';
    @$con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    
    if ($con->connect_errno) {
        $con->close();
        die ('Nie udało się obsłużyć tego żądania');
    }

    $sql = <<< A
        INSERT INTO deletions (deletion_id, deleted_by, reason)
        VALUES (null, $_SESSION[id], '$_GET[reason]')
    A;

    $con->query($sql);
    $deletion_id = $con->insert_id;

    $sql = <<< A
        UPDATE users
        SET deletion_id = $deletion_id
        WHERE user_id = $_GET[user_id]
    A;

    $con->query($sql);
    echo "Użytkownik o id=$deletion_id usunięty pomyślnie";
    $con->close();
} else {
    echo 'Brak uprawnień';
}