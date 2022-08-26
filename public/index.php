<?php
  // Suoritetaan projektin alustusskripti.
  require_once '../src/init.php';
    // Luodaan uusi Plates-olio ja kytketään se sovelluksen sivupohjiin.
    $templates = new League\Plates\Engine(TEMPLATE_DIR);
  // Siistitään polku urlin alusta ja mahdolliset parametrit urlin lopusta.
  // Siistimisen jälkeen osoite /~koodaaja/lanify/tapahtuma?id=1 on 
  // lyhentynyt muotoon /tapahtuma.
  $request = str_replace($config["urls"]["baseUrl"],'',$_SERVER['REQUEST_URI']);
  $request = strtok($request, '?');

  // Selvitetään mitä sivua on kutsuttu ja suoritetaan sivua vastaava 
  // käsittelijä.
  

  if ($request === '/' || $request === '/treenit') {
    require_once MODEL_DIR . 'treeni.php';
    $treenit = haeTreenit();
    echo $templates->render('treenit',['treenit' => $treenit]);
  } else if ($request === '/treeni') {
    require_once MODEL_DIR . 'treeni.php';
    $treeni = haeTreeni($_GET['id']);
    if ($treeni) {
      echo $templates->render('treeni',['treeni' => $treeni]);
    } else {
      echo $templates->render('treeninotfound');
    }
  } else if ($request === '/lisaa_tili') {
    echo $templates->render('lisaa_tili');
  } else {
    echo $templates->render('notfound');
    
  }
 
?> 