<?php
  session_start();
  if (empty($_SESSION['id'])) {
    header('Location: index');
  }
  
  $additional_scripts = [
    'js/voting.js',
  ];
  $indirect = 'normal';
  $subpage_title = "Posty";
  require_once 'layout/head.php';
  require_once 'layout/header.php'; 
?>
<?php
            require 'php/connect.php';
            @$con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

            if ($con->connect_errno) {
              $connect->close();
              die ('Nie udało się obsłużyć tego żądania');
            }

            $res = $con->query(<<< A
              SELECT content, DATE_FORMAT(p.time_created, '%e %b %Y, %H:%i'), p.time_created, u.first_name, u.last_name, p.post_id, p.up_votes, p.down_votes
              FROM posts p
              INNER JOIN users u
              ON p.author_id = u.user_id
              WHERE p.deletion_id IS NULL AND p.author_id <> $_SESSION[id]
              ORDER BY p.time_created DESC
              LIMIT 100
            A); 
?>
      <main>
        <section>
<?php if ($res->num_rows != 0): ?>
<?php   while (($a = $res->fetch_row()) && ($even = ('odd') ? 'even' : 'odd')): ?>
          <section class='post' name='post'>
            <div class='post__profile_img'>
              <img alt='awatar' class='img--parent-full-size' src='/beTogether/img/noavatar.png'>
            </div>
            <em><?php echo $a[1]?></em>
            <button class='btn--post_more'><img alt='więcej' class='img--parent-full-size' src='/beTogether/img/more_icon.png'></button>
            <div class='post__personal' name="Author's personal data"><?php echo $a[3].' '.$a[4];?></div>
            <article class='post__content'>
              <?php echo $a[0]?>
            </article>
            <figure>
            
            </figure>
            <div class='post__comments'>0 komentarzy</div>
            <div class='post__ups' onClick = 'votePost(this, <?php echo $a[5]?>, 1)'>
              +<?php echo $a[6]?>
            </div>
            <div class='post__downs' onClick = 'votePost(this, <?php echo $a[5]?>, 0)'>
              -<?php echo $a[7]?>
            </div>
          </section>
<?php   endwhile ?>
<?php else: ?>
          <h1>Witaj, <?php echo $_SESSION['first_name'];?></h1>
          <p>Na razie tu nic nie ma, ale wkrótce pojawi się tu jakiś  wystrzałowy content!</p>
<?php endif ?>
        </section>
      </main>
<?php require_once 'layout/footer.php'; ?>