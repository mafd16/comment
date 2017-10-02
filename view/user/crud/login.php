<?php

namespace Anax\View;

/**
 * View to display user login.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo "<br>";
//echo showEnvironment(get_defined_vars());
//print_r($_SESSION);

// Create urls for navigation
//$urlToCreate = url("book/create");
//$urlToDelete = url("book/delete");

//$di->get("session")->destroy();
//print_r($data);

//$di->get("session")->destroy();

?>
<section class="section">
  <div class="container">
    <h1 class="title">
      Logga in
    </h1>
    <p class="subtitle">
        Ange ditt användarnamn och lösenord
    </p>

<hr>



<div class="columns is-mobile">
  <div class="column is-two-third-tablet is-half-desktop">
      <form action=<?= $di->get("url")->create("user/validate"); ?> method="post">
          <!--<input type="hidden" name="article" value="comPage">-->
          Användarnamn: <input class="input" type="text" name="name"><br>
          Lösenord: <input class="input" type="password" name="password"><br>
          <!--Kommentar: <input class="textarea" type="text" name="comment"><br>-->
          <br>
          <input type="submit" value="Logga in" class="button is-primary">
      </form>
  </div>
</div>

<?= $message ?>

<hr>

<a href="<?= $di->get("url")->create("user/create") ?>">Skapa konto!</a>

<!--Glömt lösenordet?-->


</div>
</section>
