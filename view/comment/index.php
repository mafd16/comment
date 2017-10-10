<?php

// Gather incoming variables and use default values if not set
$comments = isset($comments) ? $comments : null;

?>

<section class="section">
  <div class="container">
    <h1 class="title">
      Kommentarssystem
    </h1>
    <p class="subtitle">
        Eller åtminstone en prototyp
    </p>
    <br>
    <p>
        I denna uppgiften ska vi skapa ett kommentarssystem. Systemet ska vara
        byggt enligt MVC - Model, View, Controller. Till att börja med så blir
        det ett enklare system. Kommentarerna sparas i sessionen!
    </p>
    <p>Nu höjer vi ribban! Kommentarer sparas numera i en sqlite-databas!</p>
    <br>
    <p class="subtitle">Kommentarer:</p>
    <hr>


<!--
//print_r($comments);
//var_dump($comments);
-->
<?php if (!$comments) : ?>
    <p>Inga kommentarer hittills!</p>
<?php else : ?>
    <?php foreach ($comments as $comment) : ?>
    <?php if (!$comment->deleted) : ?>
        <!-- Code for the Gravatar:-->
        <?php
            $gravatarhash = md5(strtolower(trim($comment->UserEmail)));
        ?>

        <article class="media">
            <figure class="media-left">
                <p class="image is-64x64">
        <!--<img src="http://bulma.io/images/placeholders/128x128.png">-->
                    <img src="https://www.gravatar.com/avatar/<?= $gravatarhash ?>?s=64" />
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong><a href=<?="mailto:" . $comment->UserEmail?>><?= $comment->UserName ?></a></strong>
                        <br>
                        <?= $comment->comment ?>
                    </p>
                </div>
                <?php if ($comment->UserId == $di->get("session")->get("my_user_id") || $di->get("session")->get("my_user_admin")) : ?>
                <nav class="level is-mobile">
                    <div class="level-left">
                        <a class="level-item" href=<?= $di->get("url")->create("comment/edit") . "?key=comPage&id=" . $comment->id ?>>
                            <span class="icon is-small"><i class="fa fa-pencil"></i></span>
                        </a>
                        <a class="level-item" href=<?= $di->get("url")->create("comment/delete") . '?key=comPage&id=' . $comment->id ?>>
                            <span class="icon is-small"><i class="fa fa-times-circle"></i></span>
                        </a>
                    </div>
                </nav>
                <?php endif ?>
            </div>
        </article>
    <?php endif ?>
    <?php endforeach ?>
<?php endif ?>

<hr>


<?php if ($di->get("session")->has("my_user_id")) : ?>

<div class="columns is-mobile">
  <div class="column is-two-third-tablet is-half-desktop">
      <form action=<?= $di->get("url")->create("comment/add"); ?> method="post">
          <input type="hidden" name="article" value="comPage">
          <input class="input" type="hidden" name="id" value=<?= $di->get("session")->get("my_user_id") ?>>
          <!--Namn: <input class="input" type="text" name="name"><br>-->
          <input class="input" type="hidden" name="name" value=<?= $di->get("session")->get("my_user_name") ?>>
          <!--Epost: <input class="input" type="text" name="email"><br>-->
          <input class="input" type="hidden" name="email" value=<?= $di->get("session")->get("my_user_email") ?>>
          <!--Kommentar: <input class="textarea" type="text" name="comment"><br>-->
          Kommentera här: <textarea class="textarea" name="comment"></textarea><br>
          <input type="submit" value="Posta" class="button is-primary">
      </form>
  </div>
</div>
<?php else : ?>
    <p>Du måsta vara inloggad för att kunna kommentera!</p>
<?php endif ?>


  </div>
</section>
