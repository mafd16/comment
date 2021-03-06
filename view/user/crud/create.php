<?php

namespace Anax\View;

/**
 * View to create user.
 */

?><section class="section">

<div class="container">
<h1 class=title>Skapa konto</h1>
<hr>
<div class="columns is-mobile">
<div class="column is-two-third-tablet is-half-desktop">


    <?= $message ?>


    <form action=<?= $di->get("url")->create("user/creating"); ?> method="post">
        <!--<input type="hidden" name="article" value="comPage">-->
        Namn: <input class="input" type="text" name="name"><br>
        Epost: <input class="input" type="text" name="email"><br>
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
