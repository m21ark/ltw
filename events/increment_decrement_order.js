"use strict";
function totalCart() {
    const buyButton = document.querySelector('#cart_list>.form_button');

    const cartList = buyButton.parentElement;
    const orders = cartList.querySelectorAll('.container>.container_price');
    const quantity = cartList.querySelectorAll('.container>.cart_qnt_arrows>.input-number');

    let total = 0;
    for (let i = 0; i < orders.length; i++) {
        total += parseFloat(orders[i].textContent, 10) * parseInt(quantity[i].value, 10);
    }

    buyButton.value = "Buy for " + total + " $";
}

function incrementPlateOrders() {
    const incrementsButton = document.querySelectorAll('.input-number-increment');

    for (const button of incrementsButton) {
        button.addEventListener('click', function () {
            if (parseInt(button.previousElementSibling.value, 10) >= 20) {
                // TODO send Error Mensage saying that one cannot make so much orders
                return;
            }
            button.previousElementSibling.value = parseInt(button.previousElementSibling.value, 10) + 1;
            updateCart(button.dataset.id, parseInt(button.previousElementSibling.value, 10));
            totalCart();
        });
    }
}

function decrementPlateOrders() {
    const decrementButton = document.querySelectorAll('.input-number-decrement');

    for (const button of decrementButton) {
        button.addEventListener('click', function () {
            if (parseInt(button.nextElementSibling.value, 10) <= 1) {
                // TODO send Error Mensage saying that one cannot make so much orders
                return;
            }
            button.nextElementSibling.value = parseInt(button.nextElementSibling.value, 10) - 1;
            updateCart(button.dataset.id, parseInt(button.nextElementSibling.value, 10));
            totalCart();
        });
    }
}

function updateCart(dish, qnt) {
    const request = new XMLHttpRequest();
    request.withCredentials = true;
    request.open("POST", "../actions/action_update_cart.php", true);
    request.setRequestHeader('Content-Type',
        'application/x-www-form-urlencoded')

    request.send(encodeForAjax({ dishID: dish, qnt: qnt }));
}

totalCart();
incrementPlateOrders();
decrementPlateOrders();
