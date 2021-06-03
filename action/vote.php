<?php
    session_start();
    $indirect = true;

    if (!(empty($_GET['post_id'])) || empty($_SESSION['id'])) {
        require '../php/connect.php';
        @$con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        
        if ($con->connect_errno) {
          $con->close();
          die ('Nie udało się obsłużyć tego żądania');
        }
        $sql = <<< A
            SELECT post_id, user_id, is_up
            FROM post_votes
            WHERE post_id = '$_GET[post_id]' AND user_id = '$_SESSION[id]'
        A;

        $res = $con->query($sql);
        if ($res->num_rows > 0) {
            $arr = $res->fetch_row();
            if ($arr[2] == $_GET['votetype']) {
                $skip = true;
            } else {
                $sql = <<< A
                        UPDATE post_votes
                        SET is_up = ?
                        WHERE post_id = ? AND user_id = ?
                    A;
            }
        } else {
            $sql = <<< A
                INSERT INTO post_votes (is_up, post_id, user_id)
                VALUES(?, ?, ?)
            A;
        }

        if (!isset($skip)) {
            $stmt = $con->prepare($sql);
            $stmt->bind_param('iii', $_GET['votetype'], $_GET['post_id'], $_SESSION['id']);
            $stmt->execute();
            
            if ($_GET['votetype'] == '1') {
                $sql1 = <<< A
                    UPDATE posts
                    SET up_votes = up_votes + 1
                    WHERE post_id = ?
                A;

                $sql2 = <<< A
                    UPDATE posts
                    SET down_votes = down_votes - 1
                    WHERE post_id = ?
                A;
            } else {
                $sql1 = <<< A
                    UPDATE posts
                    SET down_votes = down_votes + 1
                    WHERE post_id = ?
                A;

                $sql2 = <<< A
                    UPDATE posts
                    SET up_votes = up_votes - 1
                    WHERE post_id = ?
                A;
            }
    
            $stmt = $con->prepare($sql1);
            $stmt->bind_param('i', $_GET['post_id']);
            $stmt->execute();

            $stmt = $con->prepare($sql2);
            $stmt->bind_param('i', $_GET['post_id']);
            $stmt->execute();
        }

        if ($_GET['votetype'] == '1') {
            $sql = <<< A
                SELECT up_votes
                FROM posts
                WHERE post_id = ?
            A;
        } else {
            $sql = <<< A
                SELECT down_votes
                FROM posts
                WHERE post_id = ?
            A;
        }
        $stmt = $con->prepare($sql);
        $stmt->bind_param('i', $_GET['post_id']);
        $stmt->execute();
        $res = $stmt->get_result();
        $num = $res->fetch_array();

        if ($_GET['votetype'] == '1') {
            echo "<p>+$num[0]</p>";
        } else {
            echo "<p>-$num[0]</p>";
        }
        $con->close();
    } else {
        echo '<p>BŁĄD</p>';
        $con->close();
    }
?>
