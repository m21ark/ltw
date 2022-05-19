<?php
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');
require_once(__DIR__ . '/../database/restaurant.class.php');
require_once(__DIR__ . '/../database/connection.php');

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

?>


<?php function drawRestaurantDescriptionName(PDO $db, Restaurant $restaurant)
{ ?>


    <section id="presentation">
        <div>
            <h1><?= $restaurant->name ?></h1>
            <p>Adress:
                <a href=<?= "https://www.google.com/maps?daddr=" . str_replace(' ', '%20', $restaurant->address) ?> target="#">
                    <?= $restaurant->address ?>
                </a>
            </p>
            <p>Contact: <a href=<?= "tel:" . $restaurant->phone ?>><?= $restaurant->phone ?></a></p>
        </div>

        <div>
            <p><?= $restaurant->getMediumScore($db) ?>/5 &star;</p>
            <?php // TODO ::: THE CATEGORY database should not be has it is as it's a bad design 
            // the design makes us hard to Have 2 categories, we could use explode but that we need to check
            // if we loose points for that
            ?>
            <a class="link_button" href="#"><?= $restaurant->category ?></a>
        </div>

    </section>

<?php } ?>


<?php function drawRestaurantDescription(Restaurant $restaurant, bool $isOwner)
{ ?>

    <section id="description" class="container">
        <div>
            <h2>Description</h2>
            <p>
                <?= $restaurant->description; ?>
            </p>
        </div>
        <img src="docs/restaurant/<?= $restaurant->id ?>.jpg" alt="">
        <div id="rest_links">
            <?php if ($isOwner) { ?><a class="link_button" href="edit_restaurant.php?id=<?= $restaurant->id ?>">Edit Restaurant</a><?php } ?>
            <a class="link_button add_to_favorites" href="#">Add to favorites &star;</a>
            <?php if ($isOwner) { ?><a class="link_button" href="edit_plate.php?pid=0&restId=<?= $restaurant->id ?>">Add Plate</a><?php } ?>
        </div>
    </section>

<?php } ?>

<?php function drawRestaurantAskReview(Restaurant $restaurant)
{ ?>

    <section id="share_exp" class="container">
        <p>Share your experience</p>
        <a class="link_button" href=<?= "review.php?id=" . $restaurant->id ?>>Review</a>
    </section>

<?php } ?>

<?php function drawRestaurantOwnerReview(Restaurant $restaurant)
{ ?>

    <section id="share_exp" class="container">
        <p>Respond To Your Client Reviews / Orders </p>
        <a class="link_button" href="control_center.php?id=<?= $restaurant->id ?>">Control Center</a>
    </section>

<?php } ?>

<?php function drawRestaurantReviews(PDO $db, array $reviews, bool $isOwner)
{ ?>
    <article id="reviews">
        <h2>Reviews</h2>

        <?php foreach ($reviews as $review) {
            $reviewer = $review->getReviewerName($db);
            drawRestaurantReview($review, $reviewer, $isOwner);
        } ?>
    </article>

<?php } ?>



<?php function drawRestaurantReview(Review $review, string $reviewer, bool $isOwner)
{
    $db = getDatabaseConnection(); ?>

    <article class="rest_review container">
        <div>
            <div class="review_header">
                <p class="review_name"><?= $reviewer ?></p>
                <p class="review_date"><?= $review->date->format('Y-m-d') ?></p>
            </div>
            <p class="review_text">
                <?= $review->text ?>
            </p>
            <?php if ($review->getResponse($db) !== null) {
            ?>
                <p class="response_text">
                    <?= $review->getResponse($db); ?>
                    ✔
                </p>
            <?php } else if ($isOwner) { ?>
                <div class="response_form">
                    <label for="owner_response">Respond to Client:</label>
                    <textarea id="owner_response" name="Owner_response" rows="1" cols="30">
                    </textarea>
                    <button class="respond_button" value=<?= $review->id ?>>Respond</button>
                </div>
            <?php } ?>
        </div>
        <div>
            <img src="docs/pizza.jpg" alt="">
            <p class="review_score"><?= $review->score ?>/5 &star;</p>
        </div>
    </article>

<?php } ?>