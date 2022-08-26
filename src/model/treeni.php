<?php

  require_once HELPERS_DIR . 'DB.php';

  function haeTreenit() {
    return DB::run('SELECT * FROM treeni ORDER BY tr_alkaa;')->fetchAll();
  }

?>
