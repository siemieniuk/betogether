<?php
  session_start();
  if (empty($_SESSION['id'])) {
    header('Location: index');
  }

  $additional_scripts = [
    
  ];
  $indirect = 'normal';
  $subpage_title = "Tworzenie nowego postu";
  require_once 'layout/head.php';
  require_once 'layout/header.php'; 
?>
<?php
    if(!empty($_POST['filled'])) {
      require 'php/connect.php';
      @$con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
  
      if ($con->connect_errno) {
        $connect->close();
        die ('Nie udało się obsłużyć tego żądania');
      }
      
      $txt = $_POST['content'];
      $txt = trim(htmlentities($txt));
      $sql = <<< E
        INSERT INTO posts(post_id, author_id, content)
        VALUES (null, $_SESSION[id], ?)
      E;

      $stmt = $con->prepare($sql);
      $stmt->bind_param('s', $txt);
      $stmt->execute();
      if ($stmt->affected_rows > 0) {
        header('Location: my?newpost=true');
      }
      else {
        echo $con->error;
      }
      $con->close();
    }
?>
      <main>
        <section>
          <h1>Powiedz, co się dzieje w Twojej okolicy!</h1>
          <form action='newpost' method='post' name='newpost'>
            <label for='content'>Treść postu</label>
            <textarea class='newpost__content' name='content' maxlength='600' required></textarea>
            <button class='btn--form'>Wstaw post</button>
            <input type="hidden" name='filled' value='true'>
          </form>
        </section>
      </main>
<?php require_once 'layout/footer.php'; ?>