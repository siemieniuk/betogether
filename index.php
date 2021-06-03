<?php
  session_start();
  if (!empty($_SESSION['id'])) {
    header('Location: dashboard');
  }

  $additional_scripts = [
    
  ];
  $subpage_title = 'Witamy na naszej (Waszej!) platformie';
  $indirect = true;
  require_once 'layout/head.php';
  require_once 'layout/header.php'; 
?>
      <main id='start'>
        <section title='hello'>
          <h1>Witamy na naszej (Waszej!) platformie!</h1>
          <p>To nie żart, ta platforma jest miejscem, które Wy jako społeczność sami tworzycie!</p>
          <p>Nazwa serwisu nie jest przypadkowa. Jest to miejsce, w którym razem spędzimy wspólny czas: na żartowaniu, plotkowaniu, rozmowie.</p>
          <p>Wymieniaj się postami i wspomnieniami, głosuj na najlepsze (i najgorze) wpisy. Możliwości są nieograniczone.</p>
          <p>Na co zwlekasz? Bądźmy razem!</p>
          <section id='index_buttons'>
            <a href='register'><button class='btn--form'>Stwórz konto</button></a>
            <a href='login'><button class='btn--form'>Zaloguj</button></a>
          </section>
        </section>
      </main>
<?php require_once 'layout/footer.php'; ?>
