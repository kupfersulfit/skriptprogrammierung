jQuery(document).ready(function (){
    refreshHandling();
    
    jQuery('#loginTab').click(function() {
        if (jQuery('#container').css('display') == 'none') {
            openLoginContainer();
        } else {
            jQuery('#container').fadeOut('slow');
            activeTab();
        }
    });
    
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
        get
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
            jQuery('#container').css('bottom','-578px');
            jQuery('#register_login').css('background-position','0 -30px');
            jQuery('#registerLink').html('login');
        }
    });
    
    jQuery('#loginButton').click(function() {
        login();
    });
});
