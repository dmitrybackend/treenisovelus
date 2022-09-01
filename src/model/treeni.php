<?php

  require_once HELPERS_DIR . 'DB.php';

  function haeTreenit() {
    return DB::run('SELECT * FROM treeni ORDER BY tr_alkaa;')->fetchAll();
  }

  function haeTreeni($id) {
    return DB::run('SELECT * FROM treeni WHERE idtreeni = ?;',[$id])->fetch();
  }

 function luoTreeni($nimi,$kuvaus,$osallistujia,$tr_alkaa,$tr_loppuu,$ilm_alkaa,$ilm_loppuu) {
    DB::run('INSERT INTO treeni (nimi, kuvaus, osallistujia, tr_alkaa, tr_loppuu, ilm_alkaa, ilm_loppuu) VALUE  (?,?,?,?,?,?,?);',[$nimi,$kuvaus,$osallistujia,$tr_alkaa,$tr_loppuu,$ilm_alkaa,$ilm_loppuu]);
    return DB::lastInsertId(); 
  }
?>
