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
        UPDATE posts
        SET deletion_id = $deletion_id
        WHERE post_id = $_GET[post_id]
    A;

    $con->query($sql);
    echo "Post o id=$deletion_id usunięty pomyślnie";
    $con->close();
} else {
    echo 'Brak uprawnień';
}