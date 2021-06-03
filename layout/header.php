<?php
  if (!isset($indirect)) {
    die('Nie udało się obsłużyć tego żądania');
  }

  if (empty($_SESSION['id'])) {
    $links = [
      ['register', 'Zarejestruj'],
      ['login', 'Zaloguj']
    ];
  } else {
    $links = [
      ['my', 'Ja'],
      ['logout', 'Wyloguj'],
    ];
    if ($indirect == 'admin') {
      array_unshift($links, array('dashboard', 'Tryb zwykły'));
    }
    elseif ($_SESSION['permission'] == 'admin') {
      array_unshift($links, array('admin', 'Administracja'));
    }
  }
?>
      <header>
        <div id='hamburger'></div>
        <a href='index'><img src='img/logo.png' alt='logo witryny' id='logo' title='Przejdź na stronę główną'></a>
        <nav>
          <ul>
  <?php   foreach ($links as $a): ?>
            <li><?php echo "<a href='$a[0]'>$a[1]</a>"?></li>
  <?php   endforeach ?>
            <li>
              <div>
                <button class='btn--accessibility' id='darktheme' title='włącz/wyłącz ciemny motyw'></button>
                <button class='btn--accessibility' id='serif' title='włącz/wyłącz czcionkę bezszeryfową'></button>
              </div>
            </li>
          </ul>
        </nav>
      </header>
