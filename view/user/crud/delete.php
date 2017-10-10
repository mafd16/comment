<?php

namespace Anax\View;

/**
 * View to delete a book.
 */

// Create urls for navigation
$urlToView = url("book");



?><section class="section">

<div class="container">

<h1 class=title>Delete a book</h1>
<hr>
<div class="columns is-mobile">
<div class="column is-two-third-tablet is-half-desktop">


<!--<div class="select">-->
<?= $form ?>
<!--</div>-->

</div>
</div>
<hr>
<p>
    <a href="<?= $urlToView ?>">View all books!</a>
</p>

</div>

</section>
