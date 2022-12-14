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

  function updTreeni($idtreeni,$nimi,$kuvaus,$osallistujia,$tr_alkaa,$tr_loppuu,$ilm_alkaa,$ilm_loppuu){
    return DB::run('UPDATE treeni SET nimi = ?,kuvaus = ?,osallistujia = ?,tr_alkaa = ?,tr_loppuu = ?,ilm_alkaa = ?,ilm_loppuu = ? WHERE idtreeni = ?', [$nimi,$kuvaus,$osallistujia,$tr_alkaa,$tr_loppuu,$ilm_alkaa,$ilm_loppuu,$idtreeni])->rowCount();
  }
  function poistaTreeni($idtreeni){
    return DB::run('DELETE from treeni WHERE idtreeni = ?', [$idtreeni])->rowCount();
  }
?>
