<?php
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');
require_once(__DIR__ . '/../database/restaurant.class.php');
session_start(); ?>


<?php function drawRestaurantDescriptionName(PDO $db ,Restaurant $restaurant)
{ ?>

    <section id="presentation">
        <div>
            <h1><?= $restaurant->name ?></h1>
            <!--http://maps.google.com/maps?daddr=Rua das Amoreiras, Lisboa-->
            <p>Adress:
                <a href=<?= "https://www.google.com/maps?daddr=" . str_replace(' ', '%20', $restaurant->address) ?> target="#">
                    <?= $restaurant->address ?>
                </a>
            </p>
            <p>Contact: <a href=<?= "tel:" . $restaurant->phone ?>><?= $restaurant->phone ?></a></p>
        </div>

        <div>
            <p><?=$restaurant->getMediumScore($db)?>/5 &star;</p>
            <?php // TODO ::: THE CATEGORY database should not be has it is as it's a bad design 
            // the design makes us hard to Have 2 categories, we could use explode but that we need to check
            // if we loose points for that
            ?>
            <a class="link_button" href="#"><?= $restaurant->category ?></a>
        </div>
    </section>

<?php } ?>


<?php function drawRestaurantDescription(Restaurant $restaurant)
{ ?>

    <section id="description" class="container">
        <div>
            <h2>Description</h2>
            <p>
                <?=$restaurant->description;?>
            </p>
        </div>
        <img src="docs/restaurant.jpg" alt="">
        <a class="link_button add_to_favorites" href="#">Add to favorites &star;</a>
    </section>

<?php } ?>

<?php function drawRestaurantAskReview(Restaurant $restaurant)
{ ?>

    <section id="share_exp" class="container">
        <p>Share your experience</p>
        <a class="link_button" href=<?="review.php?id=". $restaurant->id?>>Review</a>
    </section>

<?php } ?>

<?php function drawRestaurantOwnerReview()
{ ?>

    <section id="share_exp" class="container">
        <p>Check Your Client Opinions</p>
    </section>

<?php } ?>

<?php function drawRestaurantReviews(PDO $db , array $reviews)
{ ?>
    <article id="reviews">
        <h2>Reviews</h2>

        <?php foreach ($reviews as $review) {
            $reviewer = $review->getReviewerName($db);
            drawRestaurantReview($review, $reviewer);
        } ?>
    </article>

<?php } ?>



<?php function drawRestaurantReview(Review $review, string $reviewer)
{ ?>

    <article class="rest_review container">
        <div>
            <div class="review_header">
                <p class="review_name"><?=$reviewer?></p>
                <p class="review_date"><?= $review->date->format('Y-m-d') ?></p>
            </div>
            <p class="review_text">
                <?= $review->text ?>
            </p>
        </div>
        <div>
            <img src="docs/pizza.jpg" alt="">
            <p class="review_score"><?= $review->score ?>/5 &star;</p>
        </div>
    </article>

<?php } ?>