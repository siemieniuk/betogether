<?php
    if (!isset($indirect)) {
        die('Nie udało się obsłużyć tego żądania');
    }

    function write_error($msg) {
      echo <<< E
        <div class='error--server'>
          $msg
        </div>
      E;
    }

    function write_success($msg) {
      echo <<< E
        <div class='success'>
          $msg
        </div>
      E;
    }
?>