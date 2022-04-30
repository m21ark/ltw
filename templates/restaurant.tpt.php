<?php
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');

session_start(); ?>


<?php function drawRestaurantPresentation()
{ ?>

    <section id="presentation">
        <div id="left">
            <h1>Restaurant 1</h1>
            <!--http://maps.google.com/maps?daddr=Rua das Amoreiras, Lisboa-->
            <p>Adress: <a href="https://www.google.com/maps/place/Rua das Amoreiras, Lisboa" target="#">Rua das
                    Amoreiras - Lisboa</a></p>
            <p>Contact: <a href="tel:+4733378901">22456789</a></p>
        </div>

        <div id="right">
            <p>3/5 &star;</p>
            <a class="link_button" href="#">Italian Food</a>
        </div>
    </section>


    <section id="description" class="container">
        <div>
            <h2>Description</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur
                adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna
                aliqua. Ut enim ad minim veniam, quis
                nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat.
            </p>
        </div>
        <img src="docs/restaurant.jpg" alt="">
        <a class="link_button" href="#">Add to favorites &star;</a>
    </section>

<?php } ?>


<?php function drawRestaurantAskReview()
{ ?>

    <section id="share_exp" class="container">
        <p>Share your experience</p>
        <a class="link_button" href="review.php">Review</a>
    </section>

<?php } ?>



<?php function drawRestaurantReviews()
{ ?>
    <article id="reviews">
        <h2>Reviews</h2>

        <?php for ($i = 0; $i < 3; $i++) {
            drawRestaurantReview();
        } ?>
    </article>

<?php } ?>



<?php function drawRestaurantReview()
{ ?>

    <article class="rest_review container">
        <div>
            <div class="review_header">
                <p class="review_name">James Workman</p>
                <p class="review_date">2022-12-2</p>
            </div>
            <p class="review_text">
                Lorem ipsum dolor sit amet, consectetur
                adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna
                aliqua. Ut enim ad minim veniam.
            </p>
        </div>
        <div>
            <img src="docs/pizza.jpg" alt="">
            <p class="review_score">3/5 &star;</p>
        </div>
    </article>

<?php } ?>