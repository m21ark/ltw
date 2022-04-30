<?php
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');
require_once(__DIR__ . '/../database/restaurant.class.php');
session_start(); ?>


<?php function drawRestaurantPresentation(Restaurant $restaurant)
{ ?>

    <section id="presentation">
        <div id="left">
            <h1><?=$restaurant->name?></h1>
            <!--http://maps.google.com/maps?daddr=Rua das Amoreiras, Lisboa-->
            <p>Adress: 
                <a href=<?="https://www.google.com/maps?daddr=" . str_replace(' ','%20',$restaurant->address)?> target="#">
                    <?=$restaurant->address?>
                </a>
            </p>
            <p>Contact: <a href=<?="tel:" . $restaurant->phone?>><?=$restaurant->phone?></a></p>
        </div>

        <div id="right">
            <p>TODO/5 &star;</p>
            <?php // TODO ::: THE CATEGORY database should not be has it is as it's a bad design 
                // the design makes us hard to Have 2 categories, we could use explode but that we need to check
                // if we loose points for that
            ?>
            <a class="link_button" href="#"><?=$restaurant->category?></a>
        </div>
    </section>


    <section id="description">
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

    <section id="share_exp">
        <p>Share your experience</p>
        <a class="link_button" href="review.php">Review</a>
    </section>

<?php } ?>



<?php function drawRestaurantReviews(array $reviews)
{ ?>
    <article id="reviews">
        <h2>Reviews</h2>

        <?php foreach($reviews as $review) {
            drawRestaurantReview($review);
        } ?>
    </article>

<?php } ?>



<?php function drawRestaurantReview(Review $review)
{ ?>

    <article class="rest_review">
        <div>
            <div class="review_header">
                <p class="review_name"><?='ERRO NA BASE DE DADOS: falta saber quem fez a review'?></p>
                <p class="review_date"><?=$review->date->format('Y-m-d')?></p>
            </div>
            <p class="review_text">
                <?=$review->text?>
            </p>
        </div>
        <div>
            <img src="docs/pizza.jpg" alt="">
            <p class="review_score"><?=$review->score?>/5 &star;</p>
        </div>
    </article>

<?php } ?>