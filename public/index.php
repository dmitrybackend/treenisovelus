<?php
    // Aloitetaan istunnot.
    session_start();

  // Suoritetaan projektin alustusskripti.
  require_once '../src/init.php';
    // Haetaan kirjautuneen käyttäjän tiedot.
    if (isset($_SESSION['user'])) {
      require_once MODEL_DIR . 'henkilo.php';
      $loggeduser = haeHenkilo($_SESSION['user']);
    } else {
      $loggeduser = NULL;
    }
  
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
      require_once MODEL_DIR . 'ilmoittautuminen.php';
      $treeni = haeTreeni($_GET['id']);
      if ($treeni) {
        if ($loggeduser) {
          $ilmoittautuminen = haeIlmoittautuminen($loggeduser['idhenkilo'],$treeni['idtreeni']);
        } else {
          $ilmoittautuminen = NULL;
        }
        echo $templates->render('treeni',['treeni' => $treeni,
                                             'ilmoittautuminen' => $ilmoittautuminen,
                                             'loggeduser' => $loggeduser]);
      } else {
        echo $templates->render('treeninotfound');
      }
      break;
    case '/lisaa_tili':
      if (isset($_POST['laheta'])) {
        $formdata = cleanArrayData($_POST);
        require_once CONTROLLER_DIR . 'tili.php';
        $tulos = lisaaTili($formdata,$config['urls']['baseUrl']);
        //$tulos =  array(
        //  "status" => "200", "id" => "200");
        if ($tulos['status'] == "200") {
          echo $templates->render('tili_luotu', ['formdata' => $formdata]);
          break;
        }
        echo $templates->render('lisaa_tili', ['formdata' => $formdata, 'error' => $tulos['error']]);
        echo "Tyhjä lomakee";
        
      } else {
        echo $templates->render('lisaa_tili', ['formdata' => [], 'error' => []]);
        
      }
      break;
      
      case "/kirjaudu":
        if (isset($_POST['laheta'])) {
          require_once CONTROLLER_DIR . 'kirjaudu.php';
          if (tarkistaKirjautuminen($_POST['email'],$_POST['salasana'])) {
            session_regenerate_id();
            $_SESSION['user'] = $_POST['email'];
            header("Location: " . $config['urls']['baseUrl']);
  
          } else {
            echo $templates->render('kirjaudu', [ 'error' => ['virhe' => 'Väärä käyttäjätunnus tai salasana!']]);
          }
        } else {
          echo $templates->render('kirjaudu', [ 'error' => []]);
        }
        break;
  
        case "/logout":
          require_once CONTROLLER_DIR . 'kirjaudu.php';
          logout();
          header("Location: " . $config['urls']['baseUrl']);
          break;
        

      case '/ilmoittaudu':
        if ($_GET['id']) {
          require_once MODEL_DIR . 'ilmoittautuminen.php';
          $idtreeni = $_GET['id'];
          if ($loggeduser) {
            lisaaIlmoittautuminen($loggeduser['idhenkilo'],$idtreeni);
          }
          header("Location: treeni?id=$idtreeni");
        } else {
          header("Location: treenit");
        }
        break;
       
        case '/peru':
          if ($_GET['id']) {
            require_once MODEL_DIR . 'ilmoittautuminen.php';
            $idtreeni = $_GET['id'];
            if ($loggeduser) {
              poistaIlmoittautuminen($loggeduser['idhenkilo'],$idtreeni);
            }
            header("Location: treeni?id=$idtreeni");
          } else {
            header("Location: treenit");  
          }
          break;
    
    
    default:
      echo $templates->render('notfound');
  }    

 
?> 