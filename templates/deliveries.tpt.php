<?php function draw_deliverTaken()
{
?>

    <section id="delivery_container" class="container">
        <h2>Order being taking</h2>

        <div class="delivery_taken">
            <h3><?= "Name" ?></h3>
            <p><?= "14.95€" ?></p>
            <a class="link_button" href="#">Cancel Order</a>
        </div>
    </section>

<?php } ?>



<?php function draw_deliveryOptions()
{
?>

    <section id="delivery_container" class="container">
        <h2>Orders waiting delivery</h2>
        <div>

            <?php for ($i = 0; $i < 10; $i++) { ?>

                <article class="delivery_item">
                    <div>
                        <p><?= "Name" ?></p>
                        <p><?= "14.95€" ?></p>
                        <a class="link_button" href="#">Take Order</a>
                    </div>
                </article>

            <?php } ?>

        </div>
    </section>

<?php } ?>