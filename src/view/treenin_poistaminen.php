<?php $this->layout('template', ['title' => $treeni['nimi']." poistaminen"]) ?>

<?php
  $start = new DateTime($treeni['tr_alkaa']);
  $end = new DateTime($treeni['tr_loppuu']);
?>

<h1><?=$treeni['nimi']?></h1>
<div><?=$treeni['kuvaus']?></div>
<div>Alkaa: <?=$start->format('j.n.Y G:i')?></div>
<div>Loppuu: <?=$end->format('j.n.Y G:i')?></div>
<?php

    if ($isAdmin) {
      echo "<form action='' method='POST'>";
      echo "<input type='hidden' name='idtreeni' value=". getValue($treeni,'idtreeni') .">";      
      echo "</div>";
      echo "<input type='submit' name='laheta' value='Haluan poistaa sen pysyvästi.'>";
      echo "</div>";
      echo "</form>";

    }
?>
