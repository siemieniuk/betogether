<?php
  session_start();
  if (empty($_SESSION['id'])) {
    header('Location: index');
  }
  if ($_SESSION['permission'] != 'admin') {
    header('Location: dashboard');
  }

  $additional_scripts = [
    'js/admin_actions.js', 
  ];
  $indirect = 'admin';
  $subpage_title = 'Panel administracyjny';
  require_once 'layout/head.php';
  require_once 'layout/header.php'; 
?>
      <main>
        <section>
          <h1>Panel administracyjny</h1>
        </section>
        <div id='admin-msg'></div>
        <section>
          <h1>Lista użytkowników</h1>
          <div class='table-container'>
            <table>
              <thead>
                <th>Nazwa użytkownika</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Data utworzenia</th>
                <th>Blokady</th>
                <th>Usuń</th>
              </thead>
              <tbody>
              <?php
                require 'php/connect.php';
                @$con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    
                if ($con->connect_errno) {
                  $connect->close();
                  die ('Nie udało się obsłużyć tego żądania');
                }
    
                $res = $con->query(<<< A
                  SELECT nickname, first_name, last_name, time_created, user_id
                  FROM users
                  WHERE user_id <> ${_SESSION['id']} AND deletion_id IS NULL
                  LIMIT 100
                A); 
    
                $even = 'even';
                while ($a = $res->fetch_row()) {
                  $even = $even ? null : 'even';
                  echo <<< A
                    <tr>
                      <td class="$even">$a[0]</td>
                      <td class="$even">$a[1]</td>
                      <td class="$even">$a[2]</td>
                      <td class="$even">$a[3]</td>
                      <td class="cell-with-button $even"><a class="btn--action" href="#">ban</a></td>
                      <td class="cell-with-button $even"><a class="btn--action" onClick='removeUser($a[4])'>usuń</a></td>
                    </tr>
                  A;
                }
              ?>
              </tbody>
            </table>
          </div>
        </section>
        <section>
          <h1>Lista postów</h1>
          <div class='table-container'>
            <table>
              <thead>
                <th>Nazwa użytkownika</th>
                <th>Data utworzenia</th>
                <th>Treść</th>
                <th>Usuń</th>
              </thead>
              <tbody>
              <?php
                $res = $con->query(<<< A
                  SELECT users.nickname, posts.time_created, posts.content , posts.post_id
                  FROM posts INNER JOIN users ON users.user_id = posts.author_id
                  WHERE posts.deletion_id IS NULL
                  ORDER BY 1 DESC
                  LIMIT 100;
                A); 
    
                $even = 'even';
                while ($a = $res->fetch_row()) {
                  $even = $even ? null : 'even';
                  echo <<< A
                    <tr>
                      <td class="$even">$a[0]</td>
                      <td class="$even">$a[1]</td>
                      <td class="$even">$a[2]</td>
                      <td class="cell-with-button $even"><a class="btn--action" onClick='removePost($a[3])'>usuń</a></td>
                    </tr>
                  A;
                }
    
                $con->close();
              ?>
              </tbody>
            </table>
          </div>
        </section>
      </main>
<?php require_once 'layout/footer.php'; ?>