function openLoginContainer() {
    jQuery('#loginContainer').show();
    jQuery('#registerContainer').hide();
    jQuery('#container').fadeIn('slow');
    jQuery('#container').css('bottom','-193px');
    jQuery('#register_login').css('background-position','0 0');
    activeTab('loginTab');
    jQuery('#register_login').html('register');
}

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
        if (lhref[1] == 'admin') {
            getAdminContent(lhref[1]);
        } else {
            getCustomerContent(lhref[1]);
        }
    } 
    else {
        activeTab('homeTab');
        getCustomerContent('home');
        setAnker('home');
    }
    interval = window.setInterval(function () {
        if (typeof Article != 'undefined' && Article.Instances.length > 0) {
            window.clearInterval(interval);
            getShoping_cart();
        }
    }, 200);
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
            if(pageName == 'home') {
                getArticleList();
            }
        }
    });
}

function getAdminContent(pageName) {
    jQuery.ajax({
        url: 'templates/admin/' + pageName + ".php",
        success: function (data) {
            jQuery('#left').html(data);
        }
    });
}

function suggest() {
    var availableTags = new Array();
    for (var i = 0; i < Article.Instances.length; ++i) {
        availableTags.push(Article.Instances[i].name);
    }
        
    jQuery( "#search" ).autocomplete({
        source: availableTags
    });
}

function search() {
    var search = jQuery('#search').val();
    var article = Article.findForSearch(search);    
    
    if (search == '') {
        jQuery('.article').show(); 
    } else if (article) {
        jQuery('.article').hide();
        for (var i = 0; i < article.length; ++i) {
            jQuery('#article' + article[i].id).show();
        }
    } else {
        jQuery('.article').hide();
    }
}

jQuery(document).on('click', "input[name='send']", 
    function() {
        var id=this.id.substr(1,this.id.length);
        getKunde(id);
    }
);
jQuery(document).on('click', "input[name='kundenSend']", 
    function() {
        //					alert("Kunde ist ge�ndert worden.");
        refreshKunde();
        alert("Kunde ist ge�ndert worden.");
    }
);