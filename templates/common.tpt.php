<?php function output_header()
{ ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tasty Eats</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>

        <header>
            <a href="index.html"><img src="docs/logo.jpg" width="50" height="50" alt="logo"></a>
            <h1 id="logo_name"><a href="index.html">Tasty Eats</a></h1>
            <span><a id="header_search" href="index.html">&#128270;</a></span>
            <a class="header_right" id="signup" href="login.html">Sign in</a><!-- TODO: if session ... -->
        </header>
        <main>

        <?php } ?>


        <?php function output_footer()
        { ?>

        </main>

        <footer>
            <p>Spicy Restaurant LTW 2021/22</p>
        </footer>
    </body>

    </html>

<?php } ?>