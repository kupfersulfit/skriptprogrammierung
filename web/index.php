<?php
require_once 'templates/header.php';
?>
<div id="content">
    <section id="left">
        <section id="system">
            <div id="customer">Welcome&nbsp;<span>Guest</span></div>
            <div id="messages"></div>
        </section>
        <section id="page"></section>
    </section>
    <section id="shoping_cart">
        <div id="basket">
        </div>
        <div id="shoping_cart_price"> <span>0.00</span>&nbsp;&euro;</div>
        <input id="buyButton" type="button" value="buy" onclick="Payment.openPayment();"/>
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
