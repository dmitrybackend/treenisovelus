<?php
  // Suoritetaan projektin alustusskripti.
  require_once '../src/init.php';
    // Luodaan uusi Plates-olio ja kytketään se sovelluksen sivupohjiin.
    $templates = new League\Plates\Engine(TEMPLATE_DIR);
  // Siistitään polku urlin alusta ja mahdolliset parametrit urlin lopusta.
  // Siistimisen jälkeen osoite /~koodaaja/lanify/treeni?id=1 on 
  // lyhentynyt muotoon /treeni.
  $request = str_replace($config["urls"]["baseUrl"],'',$_SERVER['REQUEST_URI']);
  $request = strtok($request, '?');

  // Selvitetään mitä sivua on kutsuttu ja suoritetaan sivua vastaava 
  // käsittelijä.
  

  switch ($request) {
    case '/':
    case '/treenit':
      require_once MODEL_DIR . 'treeni.php';
      $treenit = haeTreenit();
      echo $templates->render('treenit',['treenit' => $treenit]);
      break;
    case '/treeni':
      require_once MODEL_DIR . 'treeni.php';
      $treeni = haeTreeni($_GET['id']);
      if ($treeni) {
        echo $templates->render('treeni',['treeni' => $treeni]);
      } else {
        echo $templates->render('treeninotfound');
      }
      break;
    case '/lisaa_tili':
      if (isset($_POST['laheta'])) {
        $formdata = cleanArrayData($_POST);
        require_once CONTROLLER_DIR . 'tili.php';
        $tulos = lisaaTili($formdata);
        //$tulos =  array(
        //  "status" => "200", "id" => "200");
        if ($tulos['status'] == "200") {
          echo "Tili on luotu tunnisteella $tulos[id]";
          break;
        }
        echo $templates->render('lisaa_tili', ['formdata' => $formdata, 'error' => $tulos['error']]);
        echo "Tyhjä lomakee";
        
      } else {
        echo $templates->render('lisaa_tili', ['formdata' => [], 'error' => []]);
        
      }
      break;
    default:
      echo $templates->render('notfound');
  }    

 
?> 