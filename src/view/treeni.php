<?php $this->layout('template', ['title' => $treeni['nimi']]) ?>

<?php
  $start = new DateTime($treeni['tr_alkaa']);
  $end = new DateTime($treeni['tr_loppuu']);
?>

<h1><?=$treeni['nimi']?></h1>
<div><?=$treeni['kuvaus']?></div>
<div>Alkaa: <?=$start->format('j.n.Y G:i')?></div>
<div>Loppuu: <?=$end->format('j.n.Y G:i')?></div>
<?php
  if ($loggeduser) {
    if (!$ilmoittautuminen) {
      echo "<div class='flexarea'><a href='ilmoittaudu?id=$treeni[idtreeni]' class='button'>ILMOITTAUDU</a></div>";    
    } else {
      echo "<div class='flexarea'>";
      echo "<div>Olet ilmoittautunut treeniin!</div>";
      echo "<a href='peru?id=$treeni[idtreeni]' class='button'>PERU ILMOITTAUTUMINEN</a>";
      echo "</div>";
    }

    if ($isAdmin) {
      echo "<div class='flexarea'>";
      
      echo "<a href='treeniyllapito?idtreeni=$treeni[idtreeni]' class='button'>Muokkaa</a>"; 
      //echo "<a href='treeniyllapito?idtreeni=$treeni[idtreeni]' class='button'>Poista</a>";  
    echo "</div>";
    }
  }
?>
