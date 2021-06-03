<?php
  if (!isset($indirect)) {
    die('Nie można było przetworzyć tego żądania');
  } elseif (!isset($subpage_title)) {
      die('Błąd w funkcjonowaniu serwisu');
  } else {
    $subpage_title = trim($subpage_title);
  }
?>
<!DOCTYPE html>
<html lang='pl' dir='ltr'>
  <head>
    <meta charset="utf-8">
    <title><?php echo $subpage_title;?> | beTogether</title>
    <meta name="author" content="Szymon Siemieniuk">
    <meta name="description" content="Swobodnie wyrażaj swoje poglądy. Wszystko co nie zakazane jest dozwolone. beTogether, większej swobody nie zaznasz">
    <meta name="keywords" content="betogether, portal społecznościowy, social media, betogether portal, swobodny portal, polski portal społecznościowy">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="/beTogether/img/favicon.png">
    <link rel="stylesheet" href="/beTogether/css/style.css">
    <script src="/beTogether/js/accessibility.js"></script>
    <script src="/beTogether/js/menu.js"></script>
<?php if (isset($additional_scripts)): ?>
<?php   foreach ($additional_scripts as $a): ?>
    <script src='/beTogether/<?php echo $a?>'></script>
<?php   endforeach ?>
<?php endif ?>
    <style>
      /* @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Source+Sans+Pro&display=swap'); */
      @import url('https://fonts.googleapis.com/css2?family=Lora&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');
    </style>
  </head>
  <body>
    <div id='container'>
