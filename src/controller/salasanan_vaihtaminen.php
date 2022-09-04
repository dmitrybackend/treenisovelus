<?php

  function tarkistaEmail($email="") {

    // Haetaan käyttäjän tiedot sen sähköpostiosoitteella. 
    require_once(MODEL_DIR . 'henkilo.php');
    $tiedot = haeHenkilo($email);
    //$tiedot = array_shift($tiedot);

    // Tarkistetaan ensin löytyikö käyttäjä. Jos löytyi, niin
    // tarkistetaan täsmäävätkö salasanat.
    if ($tiedot ) {
      return true;
    }

    // Käyttäjää ei löytynyt tai salasana oli väärin. 
    return false;

  }
  function lahetaLinkkiUuttaSalasanaaVarten($email){
    require_once(HELPERS_DIR . "secret.php");
    $avain = generateActivationCode($email);
    $url = 'https://' . $_SERVER['HTTP_HOST'] . $baseurl . "/uusi_salasana?key=$avain";

    if (paivitaVahvavain($email,$avain) && lahetaUudenSalasananVahvavain($email,$url)) {
    return [
      "status" => 200,
      "email"     => $email,
      "data"   => $formdata
    ];
  } else {
    return [
      "status" => 500,
      "data"   => $formdata
    ];
  }
}
  function lahetaUudenSalasananVahvavain($email,$url) {
    $message = "Hei!\n\n" . 
               "Linkki uuden salasanan vaihtoa varten\n" .                
               "$url\n\n" .
               "Jos et ole rekisteröitynyt Treenisovelus palveluun, niin\n" . 
               "silloin tämä sähköposti on tullut sinulle\n" .
               "vahingossa. Siinä tapauksessa ole hyvä ja\n" .
               "poista tämä viesti.\n\n".
               "Terveisin, Treenisovelus-palvelu";
    return mail($email,'Treenisovelus-salasanan vaihtaminen',$message);
  } 

  

  function uusiSalasana($formdata, $avain, $baseurl='') {
   

    require_once(MODEL_DIR . 'henkilo.php');
  
    $error = [];  
  
    if (isset($formdata['salasana1']) && $formdata['salasana1'] &&
        isset($formdata['salasana2']) && $formdata['salasana2']) {
      if ($formdata['salasana1'] != $formdata['salasana2']) {
        $error['salasana'] = "Salasanasi eivät olleet samat!";
      }
    } else {
      $error['salasana'] = "Syötä salasanasi kahteen kertaan.";
    }
  
    if (!$error) {  
      
      $salasana = password_hash($formdata['salasana1'], PASSWORD_DEFAULT);
     /* return [
        "status" => "Hi",
        "data"   => $formdata,
        "salasana" => $salasana,
        "avain" => $avain
      ];*/
      if (paivitaSalasana($avain,$salasana) ){      
        return [
          "status" => 200,
          "avain"     => $avain,
          "data"   => $formdata
        ];
      } else {
        return [
          "status" => 500,
          "data"   => $formdata,
          "salasana" => $salasana,
          "avain" => $avain
        ];
      }
  
    } else {
  
      // Lomaketietojen tarkistuksessa ilmeni virheitä.
      return [
        "status" => 400,
        "data"   => $formdata,
        "error"  => $error
      ];
  
      }
    }
  
?>
