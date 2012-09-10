<?php
require_once 'templates/header.php';
?>
<div id="content">
    <section id="left">
    </section>
    <section id="shopping_cart">
        <div id="basket">
        </div>
        <div id="shoping_cart_price"> <span>0.00</span>&nbsp;&euro;</div>
        <input id="buyButton" type="button" value="buy" disabled="diabled" onclick="openPayment();"/>
    </section>
    <div id="payment">
        <?php
        require_once 'templates/customer/payment.php';
        ?>
    </div>    
</div>
<?php
require_once 'templates/footer.php';
?>
