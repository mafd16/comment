<?php

namespace Anax\View;

/**
 * View to display user profile.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

//print_r($_SESSION);
//echo "<br>";

//var_dump($user);
//var_dump($data);
// Create urls for navigation
//$urlToCreate = url("book/create");
//$urlToDelete = url("book/delete");

//$di->get("session")->destroy();
//print_r($user);

// If not logged in, redirect!
if (!$di->get("session")->has("my_user_id")) {
    $di->get("response")->redirect("user/login");
}



// Create gravatar for user!
$gravatarhash = md5(strtolower(trim($user->email)));


?><section class="section">



<div class="container">

<h1 class=title>Profilsida</h1>
<hr>
<!--<p>
    <a href="<?= $urlToCreate ?>">Create</a> |
    <a href="<?= $urlToDelete ?>">Delete</a>
</p>-->
<br>

<article class="media">
    <figure class="media-left">
        <p class="image is-64x64">
            <!--<img src="http://bulma.io/images/placeholders/128x128.png">-->
            <img src="https://www.gravatar.com/avatar/<?= $gravatarhash ?>?s=64" />
        </p>
    </figure>
</article>

<br>

<p>Namn: <?= $user->acronym; ?> </p>
<p>Epost: <?= $user->email; ?> </p>
<p>Admin: <?= $user->admin; ?> </p>

<hr>

<a href="<?= $di->get("url")->create("user/update") ?>">Uppdatera konto</a>

<?php if ($user->admin) : ?>
    | <a href="<?= $di->get("url")->create("user/admin") ?>">Hantera användare</a>
<?php endif ?>

<br>
<br>
