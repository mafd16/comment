<?php

namespace Anax\View;

/**
 * View to create user.
 */

// If not admin, redirect!
if (!$di->get("session")->get("my_user_admin")) {
    $di->get("response")->redirect("user/profile");
}

?><section class="section">

<div class="container">
<h1 class=title>Admin skapa konto</h1>
<hr>
<div class="columns is-mobile">
<div class="column is-two-third-tablet is-half-desktop">

    <?= $message ?>

    <form action=<?= $di->get("url")->create("user/admin/creating"); ?> method="post">
        <!--<input type="hidden" name="article" value="comPage">-->
        Namn: <input class="input" type="text" name="name"><br>
        Epost: <input class="input" type="text" name="email"><br>
        Admin: <input class="input" type="number" name="admin" value="0"><br>
        Lösenord: <input class="input" type="password" name="password"><br>
        Repetera lösenord: <input class="input" type="password" name="passwordagain"><br>
        <!--Kommentar: <input class="textarea" type="text" name="comment"><br>-->
        <br>
        <input type="submit" value="Skapa konto" class="button is-primary">
    </form>


</div>
</div>

<hr>

</div>
</section>
