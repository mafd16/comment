<?php

// This is the admin page!!!
// If not admin, redirect!
if (!$di->get("session")->get("my_user_admin")) {
    $di->get("response")->redirect("user/profile");
}

// Gather incoming variables and use default values if not set
$users = isset($users) ? $users : null;


?>

<section class="section">
  <div class="container">
    <h1 class="title">
      Hantera användare
    </h1>
    <p class="subtitle">
        Skapa, redigera och ta bort användare
    </p>
    <a href="<?= $di->get("url")->create("user/admin/create") ?>">Skapa ny användare</a>
    <br>
    <br>
    <p class="subtitle">Användare:</p>
    <hr>


<!--
//print_r($comments);
//var_dump($comments);
-->
<?php if (!$users) : ?>
    <p>This will never happen!</p>
<?php else : ?>
    <?php foreach ($users as $user) : ?>
        <!-- Code for the Gravatar:-->
        <?php $gravatarhash = md5(strtolower(trim($user->email))); ?>

        <article class="media">
            <figure class="media-left">
                <p class="image is-64x64">
        <!--<img src="http://bulma.io/images/placeholders/128x128.png">-->
                    <img src="https://www.gravatar.com/avatar/<?= $gravatarhash ?>?s=64" />
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <strong><a href=<?="mailto:" . $user->email?>><?= $user->acronym ?></a></strong>
                    <p>Admin: <?= $user->admin ?></p>
                    <?php if ($user->deleted) : ?>
                        Deleted: <?= $user->deleted ?>
                    <?php endif ?>

                </div>
                <nav class="level is-mobile">
                    <div class="level-left">
                        <a class="level-item" href=<?= $di->get("url")->create("user/admin/update") . "?id=" . $user->id ?>>
                            <span class="icon is-small"><i class="fa fa-pencil"></i></span>
                        </a>
                        <a class="level-item" href=<?= $di->get("url")->create("user/admin/delete") . '?id=' . $user->id ?>>
                            <span class="icon is-small"><i class="fa fa-times-circle"></i></span>
                        </a>
                    </div>
                </nav>
            </div>
        </article>
    <?php endforeach ?>
<?php endif ?>

<hr>

  </div>
</section>
