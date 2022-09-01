<?php $this->layout('template', ['title' => getValue($viesti,'title')]) ?>

<h1><?= getValue($viesti,'title') ?></h1>
<p><?= getValue($viesti,'viesti') ?></p>