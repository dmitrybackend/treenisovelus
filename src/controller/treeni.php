<?php
function tarkistaaTreeniFormData($formdata){
  $error = [];
  if (!isset($formdata['nimi']) || !$formdata['nimi']) {
    $error['nimi'] = "Anna nimesi.";
  } else {
    if (!preg_match("/^[- '\p{L}0-9]+$/u", $formdata["nimi"])) {
      $error['nimi'] = "Syötä nimesi ilman erikoismerkkejä.";
    }
  }
  if (!isset($formdata['kuvaus']) || !$formdata['kuvaus']) {
    $error['kuvaus'] = "Anna kuvaus.";
  } else {
   if (!preg_match("/^[- '\p{L}0-9]+$/u", $formdata["kuvaus"])) {
      $error['kuvaus'] = "Syötä kuvaus ilman erikoismerkkejä.";
    }
  }

  if (isset($formdata['tr_alkaa']) && $formdata['tr_alkaa'] &&
      isset($formdata['tr_loppuu']) && $formdata['tr_loppuu']) {
    if ($formdata['tr_alkaa'] >= $formdata['tr_loppuu']) {
      $error['tr_loppuu'] = "Treenin aloitusaika pitäisä olla ennen treenin loppua!";
    }
  } else {
    $error['tr_loppuu'] = "Syötä treenin aloitusaika ja loppuaika.";
  }

  if (isset($formdata['ilm_alkaa']) && $formdata['ilm_alkaa'] &&
      isset($formdata['ilm_loppuu']) && $formdata['ilm_loppuu']) {
    if ($formdata['ilm_alkaa'] >= $formdata['ilm_loppuu']) {
      $error['ilm_loppuu'] = "Treenin ilmoitautumisaloitusaika pitäisä olla ennen  ilmoitautumisloppua!";
    }
  } else {
    $error['ilm_loppuu'] = "Syötä ilmoitautumisaloitusaika- ja loppuaika.";
  }

  if (isset($formdata['tr_alkaa']) && $formdata['tr_alkaa'] &&
      isset($formdata['ilm_loppuu']) && $formdata['ilm_loppuu']) {
    if ($formdata['tr_alkaa'] <= $formdata['ilm_loppuu']) {
      $error['ilm_tr'] = "Treenin ilmoitautumisloppuaika pitäisä olla ennen treenin alkua!";
    }
  } 

  if (isset($formdata['osallistujia']) && $formdata['osallistujia'])  {
    if ($formdata['osallistujia'] < 0) {
      $error['osallistujia'] = "Osallistuja ei saa olla 0!";
    }
  } else {
    $error['osallistujia'] = "Syötä max osallistujan määrä!";
  }
  return $error;
}

function lisaaTreeni($formdata, $baseurl='') {

  $error = tarkistaaTreeniFormData($formdata);
  
  
  if (!$error) {
    require_once(MODEL_DIR . 'treeni.php');

    $nimi = $formdata['nimi'];
    $kuvaus = $formdata['kuvaus'];
    $osallistujia = $formdata['osallistujia'];
    $tr_alkaa = $formdata['tr_alkaa'];
    $tr_loppuu = $formdata['tr_loppuu'];
    $ilm_alkaa = $formdata['ilm_alkaa'];
    $ilm_loppuu = $formdata['ilm_loppuu'];  
    
    
    $idtreeni = luoTreeni($nimi,$kuvaus,$osallistujia,$tr_alkaa,$tr_loppuu,$ilm_alkaa,$ilm_loppuu);
    
    if ($idtreeni) {
      return [
        "status" => 200,
        "id"     => $idtreeni,
        "data"   => $formdata
      ];
     
    } else {
      return [
        "status" => 500,
        "data"   => $formdata
      ];
    }

  } else {

    return [
      "status" => 400,
      "data"   => $formdata,
      "error"  => $error
    ];

    }
  
}
function muokkaaTreeni($formdata,$idtreeni, $baseurl='') {

  $error = tarkistaaTreeniFormData($formdata);
  
  
  if (!$error) {
    require_once(MODEL_DIR . 'treeni.php');

    $nimi = $formdata['nimi'];
    $kuvaus = $formdata['kuvaus'];
    $osallistujia = $formdata['osallistujia'];
    $tr_alkaa = $formdata['tr_alkaa'];
    $tr_loppuu = $formdata['tr_loppuu'];
    $ilm_alkaa = $formdata['ilm_alkaa'];
    $ilm_loppuu = $formdata['ilm_loppuu'];    
     
    
    if (updTreeni($idtreeni,$nimi,$kuvaus,$osallistujia,$tr_alkaa,$tr_loppuu,$ilm_alkaa,$ilm_loppuu)) {
      return [
        "status" => 200,
        "id"     => $idtreeni,
        "data"   => $formdata
      ];
     
    } else {
      return [
        "status" => 500,
        "data"   => $formdata
      ];
    }

  } else {

    return [
      "status" => 400,
      "data"   => $formdata,
      "error"  => $error
    ];

    }
  
}


?>
