<?php $this->layout('template', ['title' => 'Uuden salasanan luonti']) ?>

<h1>Uuden salasanan luonti</h1>

<form action="" method="POST">
  
  <div>
    <label>Salasana:</label>
    <input type="password" name="salasana1">
    <div class="error"><?= getValue($error,'salasana'); ?></div>
  </div>
  <div>
    <label>Salasana uudelleen:</label>
    <input type="password" name="salasana2">
  </div>
  <div>
    <input type="submit" name="laheta" value="Luo salasana">
  </div>
</form>
