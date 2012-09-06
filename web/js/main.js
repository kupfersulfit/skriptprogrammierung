jQuery(document).ready(function (){
    refreshHandling();
    
    jQuery('#loginTab').click(function() {
        if (jQuery('#container').css('display') == 'none') {
            jQuery('#loginContainer').show();
            jQuery('#registerContainer').hide();
            jQuery('#container').fadeIn('slow');
            jQuery('#container').css('bottom','-168px');
            activeTab('loginTab');
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
    });
    
    jQuery('#register_login').click(function(){
        if (jQuery('#loginContainer').css('display') == 'none') {
            jQuery('#loginContainer').show();
            jQuery('#registerContainer').hide();
            jQuery('#container').css('bottom','-168px');
        } else {
            jQuery('#registerContainer').show();
            jQuery('#loginContainer').hide();
            jQuery('#container').css('bottom','-556px');
        }
    });
});

function activeTab(tabName) {
    jQuery('#menu ul li').removeClass('active');
    if (typeof tabName != 'undefined') {
        jQuery('#' + tabName).addClass('active');
    } else {
        jQuery('#homeTab').addClass('active');
    }
}

function refreshHandling() {
    var lhref = location.href.split('#');
    if (lhref.length > 1) {
        activeTab(lhref[1] + 'Tab');
        getCustomerContent(lhref[1]);
    } 
    else {
        activeTab('homeTab');
        getCustomerContent('home');
        setAnker('home');
    }
}

function setAnker(anker) {
    var lhref = location.href.split('#'); 
    
    if (lhref.length > 1) {
        location.href = lhref[0] + '#' + anker;
    } else {
        location.href += '#' + anker;
    }
}

function getCustomerContent(pageName) {
    jQuery.ajax({
        url: 'templates/customer/' + pageName + ".php",
        success: function (data) {
            jQuery('#left').html(data);
        }
    });
}


//Controller Ajax Anfragen
function getArticleList() {
    jQuery.ajax({
        type : 'GET',
        url : 'Controler.php', 
        data : {
            'action' : 'zeigeArtikel'
        },
        dataType : 'jsonp',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

function login() {
    jQuery.ajax({
        type : 'POST',
        url : 'web/Controler.php', 
        data : {
            'action' : 'login'
        },
        dataType : 'jsonp',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

function logout() {
    jQuery.ajax({
        type : 'POST',
        url : 'web/Controler.php', 
        data : {
            'action' : 'logout'
        },
        dataType : 'jsonp',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

function searchArticle() {
    jQuery.ajax({
        type : 'GET',
        url : 'web/Controler.php', 
        data : {
            'action' : 'sucheArtikel'
        },
        dataType : 'jsonp',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

function registerCustomer() {
    jQuery.ajax({
        type : 'POST',
        url : 'web/Controler.php', 
        data : {
            'action' : 'registriereKunde'
        },
        dataType : 'jsonp',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

function getCustomerInformation() {
    jQuery.ajax({
        type : 'POST',
        url : 'web/Controler.php', 
        data : {
            'action' : 'holeKunde'
        },
        dataType : 'jsonp',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

function modifyCustomer() {
    jQuery.ajax({
        type : 'POST',
        url : 'web/Controler.php', 
        data : {
            'action' : 'aktualisiereKunde'
        },
        dataType : 'jsonp',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

/* ADMIN */
function createArticle() {
    jQuery.ajax({
        type : 'POST',
        url : 'web/Controler.php', 
        data : {
            'action' : 'erstelleArtikel'
        },
        dataType : 'jsonp',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

function deleteArticle() {
    jQuery.ajax({
        type : 'POST',
        url : 'web/Controler.php', 
        data : {
            'action' : 'loescheArtikel'
        },
        dataType : 'jsonp',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

function getShopping_cart() {
    jQuery.ajax({
        type : 'GET',
        url : 'web/Controler.php', 
        data : {
            'action' : 'holeWarenkorb'
        },
        dataType : 'jsonp',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

function modifyShopping_cart() {
    jQuery.ajax({
        type : 'GET',
        url : 'web/Controler.php', 
        data : {
            'action' : 'aktualisiereWarenkorb'
        },
        dataType : 'jsonp',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}