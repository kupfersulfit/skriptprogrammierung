var Payment = {
    enabled : false,
    
    openPayment : function() {
        if (this.enabled) {
            if (ShoppingCart.price > 0) {
                this.creditCartValidTime();
                jQuery('#payment_surname').val(Customer.name);
                jQuery('#payment_givenname').val(Customer.vorname);
                jQuery('#deliver_zip').val(Customer.plz);
                jQuery('#delivery_street').val(Customer.strasse.split(' ')[0]);
                jQuery('#delivery_nr').val(Customer.strasse.split(' ')[1]);
                jQuery('#payment').fadeIn('slow');
            } else {
                systemessages({
                    "error":"nothing to buy"
                });
            }
        } else {
            systemessages({
                "error":"you need to login first"
            });
        }
    },
    
    creditCartValidTime : function() {
        if (jQuery('#valid_month option').length == 0) {
            for (var i = 1; i <= 12; ++i) {
                jQuery('#valid_month').append('<option value="' + i + '" >' + i + '</option>');
            }
        
            var date = new Date();
            date = date.getFullYear();
        
            for (var i = date; i <= date + 20; ++i) {
                jQuery('#valid_year').append('<option value="' + i + '" >' + i + '</option>');
            }
        }
    },

    closePayment : function() {
        jQuery('#payment').fadeOut('slow');
    },
    
    changePaymentMethod : function() {
        var enabled  = '#bank_transfer input';
        var disabled = '#credit_cart input';
        
        if (jQuery("input[name='paymentType']:checked").val() == 2) {
            enabled  = '#credit_cart input, #credit_cart select';
            disabled = '#bank_transfer input';
        }


        jQuery(enabled).each(function() {
            jQuery(this).removeAttr('disabled'); 
        });

        jQuery(disabled).each(function () {
            jQuery(this).css('border-color', '#F0F0F0');
            jQuery(this).attr('disabled', disabled);
        });
        
        //unsch�n kann man vllt oben rausnehmen und garnicht erst disablen
        jQuery('#bank').removeAttr('disabled');
        jQuery('#cart').removeAttr('disabled');
    },
    
    paymentCheck : function() {
        this.firstfocus = true;
        var valid = true;
    
        valid = this.checkInputs('personality', valid);
        
        if (jQuery("input[name='paymentType']:checked").val() == 1) {
            valid = this.checkInputs('bank_transfer', valid); 
        } else {    
            valid = this.checkInputs('credit_cart', valid);
        }
    
        valid = this.checkInputs('delivery', valid);

        return valid;
    },
    
    validateBLZ : function() {
        if (jQuery("input[name='paymentType']:checked").val() == 1) {
            var blz = jQuery('#bank_code').val();
            blz = blz.replace(/-/g,'');
            blz = jQuery.trim(blz);
            if (!(blz.match(/[0-9]{3} ?[0-9]{3} ?[0-9]{2}/) || blz.match(/^\d{8}$/))) {
                jQuery('#bank_code').css('border-color', '#FA5858');
                systemessages({
                    "error":"bank code is invalid"
                });
                return false;
            }
        }
        return true;
    },
    
    validateMonth : function() {
        if (jQuery("input[name='paymentType']:checked").val() == 2) {
            var valid = true;
            var month = jQuery('#valid_month').val();
            var year = jQuery('#valid_year').val();
            var date = new Date();
            if (year == date.getFullYear() && month < date.getMonth() + 1 ) {
                jQuery('#valid_month').css('background-color','#FA5858');
                systemessages({
                    "error":"creditcart is no longer valid"
                });
                return false;
            }
            jQuery('#valid_month').css('background-color','#FFFFFF');
        }
        return true;
    },

    checkInputs : function(id, valid) {

        jQuery('#' + id + ' input').each(function () {
            if (jQuery(this).val() == '') {
                jQuery(this).css('border-color','#FA5858');
                jQuery(this).focus();
                valid =  false;
            } else {
                jQuery(this).css('border-color','#F0F0F0');
            }
        });
        if (!valid) {
            systemessages({
                "error":"an input is empty or"
            });
        }
        return valid;
    },
    
    pay : function() {    
        if (this.enabled 
            && this.paymentCheck() 
            && this.validateBLZ() 
            && this.validateMonth()) 
        {
            buy();
        }
    }
}