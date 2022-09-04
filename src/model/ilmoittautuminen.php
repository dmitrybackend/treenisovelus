<?php

  require_once HELPERS_DIR . 'DB.php';

  function haeIlmoittautuminen($idhenkilo,$idtreeni) {
    return DB::run('SELECT * FROM ilmoittautuminen WHERE idhenkilo = ? AND idtreeni = ?',
                   [$idhenkilo, $idtreeni])->fetchAll();
  }

  function lisaaIlmoittautuminen($idhenkilo,$idtreeni) {
    DB::run('INSERT INTO ilmoittautuminen (idhenkilo, idtreeni) VALUE (?,?)',
            [$idhenkilo, $idtreeni]);
    return DB::lastInsertId();
  }

  function poistaIlmoittautuminen($idhenkilo, $idtreeni) {
    return DB::run('DELETE FROM ilmoittautuminen  WHERE idhenkilo = ? AND idtreeni = ?',
                   [$idhenkilo, $idtreeni])->rowCount();
  }
  function haeOsallistujat($idtreeni) {
    return DB::run('SELECT HK.nimi as nimi, email FROM ilmoittautuminen as ILM, henkilo as HK Where HK.idhenkilo= ILM.idhenkilo AND idtreeni = ?', [$idtreeni])->fetchAll();
  }

?>
