<?php $this->layout('template', ['title' => 'Salasanan vaihtaminen']) ?>

<h1>Salasanan vaihtaminen</h1>
<form action="" method="POST">
  <div>
    <label>Sähköposti:</label>
    <input type="text" name="email">
  </div>
  <div class="error"><?= getValue($error,'virhe'); ?></div>
  <div>
   <input type="submit" name="laheta" value="Lähetä">
  </div>
</form>