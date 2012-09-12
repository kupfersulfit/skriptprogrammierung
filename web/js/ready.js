jQuery(document).ready(function (){
    refreshHandling();
    getCustomerInformation();
    
    jQuery('#loginTab').click(containerDisplay);
    
    jQuery('#profileTab').click(function() {
        activeTab('profileTab');
        jQuery('#container').fadeOut('slow');
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
        setAnker('admin');
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
