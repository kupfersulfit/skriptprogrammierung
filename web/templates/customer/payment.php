
<div id="payment_top"><div id="paymentClose" onclick="Payment.closePayment();" >close</div></div>
<div id="payment_content">
    <section class="topic">
        Personality
    </section>
    <section id="personality">
        <div id="personality_column_1">
            <label for="payment_surname">surname</label>
            <input id="payment_surname" class="payment_text" type="text" value="" />
        </div>
        <div id="personality_column_2">
            <label for="payment_givenname">givenname</label>
            <input id="payment_givenname" class="payment_text" type="text" value="" />
        </div>
        <div class="clear"></div>
    </section>
    <section class="topic">
        Payment
    </section>
    <section id="bank_transfer">
        <p>
            <label>bank transfer</label>
            <input id="bank" type="radio" name="paymentType" value="1" checked="checked" onclick="Payment.changePaymentMethod();" />
        </p>
        <hr />
        <p>
            <label for="bank_name">name of bank</label>
            <input id="bank_name" class="payment_text" type="text" value="" autocomplete="off"/>
        </p>
        <p>
            <label for="account_number">bank account number</label>
            <input id="account_number" class="payment_text" type="text" value="" autocomplete="off"/>
        </p>
        <p>
            <label for="bank_code">bank code</label>
            <input id="bank_code" class="payment_text" type="text" value="" autocomplete="off"/>
        </p>
    </section>
    <section id="credit_card">
        <p><label>creditcard</label><input id="card" type="radio" name="paymentType" value="2" onclick="Payment.changePaymentMethod();" /></p>
        <hr />
        <p><label>creditcard type</label>
            <label><img src="media/visa.gif" class="card_img" width="20" height="22" title="Visa" /></label>
            <input type="radio" value="visa" name="card" class="card" checked="checked" disabled="disabled" />
            <label><img src="media/master_card.gif" class="card_img" width="20" height="22" title="MasterCard" /></label>
            <input type="radio" value="mas" name="card" class="card" disabled="disabled" />
            <label><img src="media/american_express.gif" class="card_img" width="20" height="22" title="AmericanExpress" /></label>
            <input type="radio" value="ame" name="card" class="card" disabled="disabled"/>
        </p>
        <p><label for="ccnr_1">creditdard nr.</label>
            <input id="ccnr_4" class="payment_text ccnr" type="text" value="" maxlength="4" size="4" autocomplete="off" disabled="disabled" />
            <input id="ccnr_3" class="payment_text ccnr" type="text" value="" maxlength="4" size="4" autocomplete="off" disabled="disabled" />
            <input id="ccnr_2" class="payment_text ccnr" type="text" value="" maxlength="4" size="4" autocomplete="off" disabled="disabled" />
            <input id="ccnr_1" class="payment_text ccnr" type="text" value="" maxlength="4" size="4" autocomplete="off" disabled="disabled" />
        </p>
        <p>
            <label for="valid">valid until</label>
            <select id="valid_month" disabled="disabled">

            </select>
            <select id="valid_year" disabled="disabled">
            </select>
        </p>
        <p>
            <label for="cvc_cvv">CVC/CVV code</label>
            <input id="cvc_cvv" class="payment_text" type="text" value="" autocomplete="off" maxlength="4" size="4" disabled="disabled" />
        </p>
    </section>
    <div class="clear"></div>
    <section class="topic">
        Delivery
    </section>
    <section id="delivery">
        <p>If the delivery adress, the same as you used for registration, you don't need to fill this. </p>
        <div id="delivery_column_1">
            <p>
                <label for="deliver_zip">zip</label>
                <input id="deliver_zip" class="payment_text" type="text" value="" maxlength="5" size="5" />
                <br />
                <label for="deliver_method">method of delivery</label>
                <select id="deliver_method">
                    <option value="1">standard shipping 15&euro;</option>
                    <option value="2">express shipping 15&euro;</option>
                    <option value="3">overnight shipping 15&euro;</option>
                </select>
            </p>
        </div>
        <div id="delivery_column_2">
            <p>
                <label for="delivery_street">street - nr.</label>
                <input id="delivery_nr" class="payment_text" type="text" value="" maxlength="4" size="4"/>
                <input id="delivery_street" class="payment_text" type="text" value="" />
            </p>
        </div>
        <div class="clear"></div>
    </section>
    <input type="button" id="payButton" onclick="Payment.pay();" value="pay" />
</div>