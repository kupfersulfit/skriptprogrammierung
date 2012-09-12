var Payment = {
    enabled : false,
    
    openPayment : function() {
        if (this.enabled) {
            jQuery('#payment').fadeIn('slow');
            this.creditCardValidTime();
        } else {
            alert('You need to login first.')
        }
    },
    
    creditCardValidTime : function() {
        for (var i = 1; i <= 12; ++i) {
            jQuery('#valid_month').append('<option value="' + i + '" >' + i + '</option>');
        }
        
        var date = new Date();
        date = date.getFullYear();
        
        for (var i = date; i <= date + 20; ++i) {
            jQuery('#valid_year').append('<option value="' + i + '" >' + i + '</option>');
        }
    },

    closePayment : function() {
        jQuery('#payment').fadeOut('slow');
    },
    
    changePaymentMethod : function() {
        var enabled  = '#bank_transfer input';
        var disabled = '#credit_card input';
        
        if (jQuery("input[name='paymentType']:checked").val() == 1) {
            enabled  = '#credit_card input';
            disabled = '#bank_transfer input';
        }


        jQuery(enabled).each(function() {
            jQuery(this).removeAttr('disabled'); 
        });

        jQuery(disabled).each(function () {
            jQuery(this).css('border-color', '#F0F0F0');
            jQuery(this).attr('disabled', disabled);
        });
        
        //unschön kann man vllt oben rausnehmen und garnicht erst disablen
        jQuery('#bank').removeAttr('disabled');
        jQuery('#card').removeAttr('disabled');
    },
    
    paymentCheck : function() {
        this.firstfocus = true;
        var valid = true;
    
        valid = this.checkInputs('personality', valid);
        
        if (jQuery("input[name='paymentType']:checked").val() == 0) {
            valid = this.checkInputs('bank_transfer', valid); 
        } else {    
            valid = this.checkInputs('credit_card', valid);
        }
    
        valid = this.checkInputs('delivery', valid);

        return valid;
    },
    
    validateBLZ : function() {
        var blz = jQuery('#bank_code').val();
        blz = blz.replace(/-/g,'');
        blz = jQuery.trim(blz);
        if (!(blz.match(/[0-9]{3} ?[0-9]{3} ?[0-9]{2}/) || blz.match(/^\d{8}$/))) {
            jQuery('#bank_code').css('border-color', '#FA5858');
            return false;
        }
        return true;
    },
    
    validateMonth : function() {
        var valid = true;
        var month = jQuery('#valid_month').val();
        var date = new Date();
        if ( month < date.getMonth() + 1) {
            jQuery('#valid_month').css('border-color','#FA5858');
            return false;
        }
        return true;;
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
        })
        return valid;
    },
    
    pay : function() {    
        if (this.enabled) {
            this.paymentCheck();
            this.validateBLZ();
            this.validateMonth();
        } else {
            alert('You need to login first.')
        }
    }
}