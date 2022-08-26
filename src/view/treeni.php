<?php $this->layout('template', ['title' => $treeni['nimi']]) ?>

<?php
  $start = new DateTime($treeni['tr_alkaa']);
  $end = new DateTime($treeni['tr_loppuu']);
?>

<h1><?=$treeni['nimi']?></h1>
<div><?=$treeni['kuvaus']?></div>
<div>Alkaa: <?=$start->format('j.n.Y G:i')?></div>
<div>Loppuu: <?=$end->format('j.n.Y G:i')?></div>
