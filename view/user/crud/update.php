<?php

namespace Anax\View;

/**
 * View to update user.
 */

?><section class="section">

<div class="container">
<h1 class=title>Uppdatera konto <?= $user->acronym ?></h1>
<hr>
<div class="columns is-mobile">
<div class="column is-two-third-tablet is-half-desktop">


    <?= $message ?>


    <form action=<?= $di->get("url")->create("user/change"); ?> method="post">
        <!--<input type="hidden" name="article" value="comPage">-->
        Epost: <input class="input" type="text" name="email" value="<?= $user->email ?>"><br>
        Lösenord: <input class="input" type="password" name="password"><br>
        Repetera lösenord: <input class="input" type="password" name="passwordagain"><br>
        <!--Kommentar: <input class="textarea" type="text" name="comment"><br>-->
        <br>
        <input type="submit" value="Uppdatera" class="button is-primary">
    </form>


</div>
</div>

<hr>

</div>
</section>
