jQuery(document).ready(function (){
    refreshHandling();
    getCustomerInformation();
    getCustomerPosition();
    
    jQuery('#loginTab').click(containerDisplay);
    
    jQuery('#profileTab').click(function() {
        activeTab('profileTab');
        jQuery('#container').fadeOut('slow');
        Payment.closePayment();
        getCustomerContent('profile');
        setAnker('profile')
    });
    
    jQuery('#homeTab').click(function() {
        activeTab('homeTab');
        jQuery('#container').fadeOut('slow');
        getCustomerContent('home');
        setAnker('home');
    });
    
    jQuery('#adminTab').click(function() {
        activeTab('adminTab');
        jQuery('#container').fadeOut('slow');
        getAdminContent('admin');
        Payment.closePayment();
        setAnker('admin');
    });
    
    jQuery('#order_managementTab').click(function() {
        activeTab('order_managementTab');
        jQuery('#container').fadeOut('slow');
        getAdminContent('order_management');
        setAnker('order_management');
        jQuery('#shoping_cart').hide();
    });
    
    jQuery('#register_login').click(function(){
        if (jQuery('#loginContainer').css('display') == 'none') {
            openLoginContainer()
        } else {
            jQuery('#registerContainer').show();
            jQuery('#loginContainer').hide();
            jQuery('#container').css('bottom','-600px');
            jQuery('#register_login').css('background-position','0 -40px');
            jQuery('#register_login').html('login');
        }
    });
    
    jQuery('#loginButton').click(function() {
        login();
    });
});

jQuery(document).on('click', "input[name='send']", 
    function() {
        var id=this.id.substr(1,this.id.length);
        getKunde(id);
    }
);
    
jQuery(document).on('click', "input[name='aendereKunde']", 
    function() {
        var id=this.id.substr(1,this.id.length);
        Customer.create(
            id,
            jQuery("#kundenNameId").val(),
            jQuery("#kundenVornameId").val(),
            jQuery("#kundenStrasseId").val(),
            jQuery("#kundenPlzId").val(),
            jQuery("#kundenZusatzId").val(),
            jQuery("#kundenEmailId").val(),
            jQuery("#kundenPwId").val()
            );
        refreshKunde(Customer);
        systemessages({
            "success":"customer got updated"
        });
    }
);
    
jQuery(document).on('click', "input[name='loescheKunde']", 
    function() {
        var id=this.id.substr(1,this.id.length);
        Customer.create(id, jQuery("#kundenNameId").val(), jQuery("#kundenVornameId").val(), jQuery("#kundenStrasseId").val(), jQuery("#kundenPlzId").val(), jQuery("#kundenZusatzId").val(), jQuery("#kundenEmailId").val(), jQuery("#kundenPwId").val());
        deleteKunde(Customer);
        systemessages({
            "success":"customer got deleted"
        });
    }	
);
    
jQuery(document).on('click', "input[name='aendereArtikel']", 
    function() {
        var id = this.id.substr(1,this.id.length);
        modifyArticle(id);
    }
);
jQuery(document).on('click', "input[name='aktualisiereArtikel']", 
    function() {
        var id = this.id.substr(1,this.id.length);
        updateArticle(id);
    }
);
jQuery(document).on('click', "input[name='loescheArtikel']", 
    function() {
        var id = this.id.substr(1,this.id.length);
        deleteArticle(id);
    }
); 
