<?php
  session_start();
  if (!empty($_SESSION['id'])) {
    header('Location: dashboard.php');
  }
  $indirect = true;
  $err = null;

  if (!(empty($_POST['login']) || empty($_POST['nickname']) || empty($_POST['password']))) {
    require_once 'php/connect.php';
    $connect = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    $stmt = $connect->prepare(<<<A
      SELECT user_id, first_name, last_name, permission, password
      FROM users
      WHERE nickname = ?
      A);
      $stmt->bind_param('s', $_POST['nickname']);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $fn, $ln, $perm, $pwd);
        $stmt->fetch();
      if (password_verify($_POST['password'], $pwd)) {
        $_SESSION['id'] = $id;
        $_SESSION['first_name'] = $fn;
        $_SESSION['last_name'] = $ln;
        $_SESSION['permission'] = $perm;
        $connect->close();
        header('Location: dashboard');
      } else {
        $err = true;
        $connect->close();
      }
    }
    else {
      $err = true;
    }
  }
  
  $additional_scripts = [
    'js/menu.js',
  ];
  $subpage_title = 'Panel logowania';
  require_once 'layout/head.php';
  require_once 'layout/header.php'; 
?>
      <main>
<?php
      if (!empty($err)) {
        include_once 'layout/msg_blocks.php';
        write_error('Niepoprawna nazwa użytkownika lub hasło');
      }
?>
        <h1>Wprowadź swój nick i hasło</h1>
        <form action='login' name='login' method='post'>
          <input type='text' name='nickname' placeholder='Nazwa użytkownika'>
          <input type='password' name='password' placeholder='hasło'>
          <input type='text' name='login' value='1' style='display: none;'>
          <button class='btn--form'>zaloguj</button>
        </form>
      </main>
<?php require_once 'layout/footer.php'; ?>