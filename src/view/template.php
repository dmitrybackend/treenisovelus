<!DOCTYPE html>
<html lang="fi">
  <head>
  <link href="styles/styles.css" rel="stylesheet">

    <title>treenisovelus - <?=$this->e($title)?></title>
    <meta charset="UTF-8">    
  </head>
  <body>
  <header>
      <h1><a href="<?=BASEURL?>">treeni sovelus</a></h1>
    </header>

    <section>
      <?=$this->section('content')?>
    </section>
    <footer>
      <hr>
      <div>treenisovelus by Dmitry</div>
    </footer>
  </body>
</html>
