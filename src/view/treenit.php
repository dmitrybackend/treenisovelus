<?php $this->layout('template', ['title' => 'Tulevat treenit']) ?>

<h1>Tulevat treenit</h1>

<div class='treenit'>
<?php

foreach ($treenit as $treeni) {

  $start = new DateTime($treeni['tr_alkaa']);
  $end = new DateTime($treeni['tr_loppuu']);

  echo "<div>";
    echo "<div>$treeni[nimi]</div>";
    echo "<div>$treeni[kuvaus]</div>";
    echo "<div>" . $start->format('j.n.Y') . "-" . $end->format('j.n.Y') . "</div>";
    echo "<div><a href='treeni?id=" . $treeni['idtreeni'] . "'>TIEDOT</a></div>";
  echo "</div>";

}

?>
</div>
