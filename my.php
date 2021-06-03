<?php
  session_start();
  if (empty($_SESSION['id'])) {
    header('Location: index');
  }

  $personal_data = $_SESSION['first_name'].' '.$_SESSION['last_name'];
  $additional_scripts = [
    
  ];
  $indirect = 'normal';
  $subpage_title = $personal_data;
  require_once 'layout/head.php';
  require_once 'layout/header.php'; 
?>
      <main>
<?php
          $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
          if($pageWasRefreshed) {
            unset($_GET['newpost']);
          }
          if (!empty($_GET['newpost']) && $_GET['newpost'] == true) {
            echo <<< A
              <section>
                <div class='success'>Pomyślnie dodano nowy post!</div>
              </section>
            A;
          }
?>
        <section>
          <h1>Twoje posty</h1>
          <a href='newpost'><button class='btn--form'>Dodaj nowy post</button></a>
<?php
            require 'php/connect.php';
            @$con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

            if ($con->connect_errno) {
              $connect->close();
              die ('Nie udało się obsłużyć tego żądania');
            }

            $res = $con->query(<<< A
              SELECT content, DATE_FORMAT(time_created, '%e %b %Y, %H:%i'), time_created, up_votes, down_votes
              FROM posts
              WHERE author_id = ${_SESSION['id']} AND deletion_id IS NULL
              ORDER BY time_created DESC
              LIMIT 100
            A); 
?>
        </section>
        <section>
<?php if ($res->num_rows != 0): ?>
<?php   while (($a = $res->fetch_row()) && ($even = ('odd') ? 'even' : 'odd')): ?>
        <section class='post' name='post'>
          <div class='post__profile_img'>
            <img alt='awatar' class='img--parent-full-size' src='/beTogether/img/noavatar.png'>
          </div>
          <em><?php echo $a[1]?></em>
          <button class='btn--post_more'><img alt='więcej' class='img--parent-full-size' src='/beTogether/img/more_icon.png'></button>
          <div class='post__personal' name="Author's personal data"><?php echo "$personal_data";?></div>
          <article class='post__content'>
            <?php echo $a[0]?>
          </article>
          <figure>

          </figure>
          <div class='post__comments'>0 komentarzy</div>
          <div class='post__ups'>
            +<?php echo $a[3]?>
          </div>
          <div class='post__downs'>
            -<?php echo $a[4]?>
          </div>
        </section>
<?php   endwhile ?>
<?php else: ?>
        <section>
          <h1>Witaj, <?php echo $_SESSION['first_name']?></h1>
          <p>Nie opublikowałeś/-aś póki co żadnych postów. Chcesz dodać nowy?</p>
        </section>
<?php endif ?>
      </main>
<?php 
  $con->close();
  require_once 'layout/footer.php'; 
?>