
<section class="section">
    <div class="container">
        <!--<h1 class="title">
            Kommentarssystem
        </h1>-->
        <p class="subtitle">
            Redigera kommentar
        </p>
        <br>

        <div class="columns is-mobile">
        <div class="column is-two-third-tablet is-half-desktop">
        <form action=<?= $di->get("url")->create("comment/edit2"); ?> method="post">
            Namn: <input class="input" type="text" name="name" value="<?= $comment->UserName ?>"><br>
            Epost: <input class="input" type="text" name="email" value="<?= $comment->UserEmail ?>"><br>
            Kommentar: <textarea class="textarea" name="comment"><?= $comment->comment ?></textarea><br>
            <input type="hidden" name="id" value="<?= $comment->id ?>">
            <input type="hidden" name="user_id" value="<?= $comment->UserId ?>">
            <input type="hidden" name="key" value="comPage">

            <div class="field is-grouped">
                <p class="control">
                    <input type="submit" value="Redigera" class="button is-primary">
                </p>
                <p class="control">
                    <a class="button" href="<?= $di->get("url")->create("comment"); ?>">
                        Avbryt
                    </a>
                </p>
            </div>
        </form>
        </div>
        </div>


    </div>
</section>
