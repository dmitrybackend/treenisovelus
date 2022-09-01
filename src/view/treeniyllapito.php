<?php $this->layout('template', ['title' => 'Treenien ylläpito']) ?>

<h1>Treenien ylläpito</h1>

<form action="" method="POST">
  <div>
    <label for="nimi">Ryhmän nimi:</label>
    <input id="nimi" type="text" name="nimi" value="<?= getValue($formdata,'nimi') ?>">
    <div class="error"><span><?= getValue($error,'nimi'); ?></span></div>
  </div>
  <div>
    <label>Treeni kuvaus:</label>
    <input type="text" name="kuvaus" value="<?= getValue($formdata,'kuvaus') ?>">
    <div class="error"><span><?= getValue($error,'kuvaus'); ?></span></div>
  </div>
  <div>
    <label>Osallistujat:</label>
    <input type="number" name="osallistujat" value="<?= getValue($formdata,'osallistujat') ?>">
    <div class="error"><span><?= getValue($error,'osallistujat'); ?></span></div>
  </div>
  <div>
    <label>Treeni alkaa:</label>
    <input type="datetime-local" name="tr_alkaa" value="<?= getValue($formdata,'tr_alkaa') ?>">
   
  </div>
  <div>
    <label>Treeni loppuu:</label>
    <input type="datetime-local" name="tr_loppuu" value="<?= getValue($formdata,'tr_loppuu') ?>">
    <div class="error"><span><?= getValue($error,'tr_loppuu'); ?></span></div>
  </div>
  
  </div>
  <div>
    <label>Ilmoitautuminen alkaa:</label>
    <input type="datetime-local" name="ilm_alkaa" value="<?= getValue($formdata,'ilm_alkaa') ?>">
   
  </div>
  <div>
    <label>Ilmoitautuminen loppu:</label>
    <input type="datetime-local" name="ilm_loppuu" value="<?= getValue($formdata,'ilm_loppuu') ?>">
    <div class="error"><span><?= getValue($error,'ilm_loppuu'); ?></span></div>
    <div class="error"><span><?= getValue($error,'ilm_tr'); ?></span></div>
  </div>

  <div>
    <input type="submit" name="laheta" value="Tallenna">
  </div>
</form>
