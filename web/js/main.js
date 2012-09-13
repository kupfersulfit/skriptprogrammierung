var holeRolle = 'homeTab';
var messageTimeout;

function openLoginContainer() {

    jQuery('#loginContainer').show();
    jQuery('#registerContainer').hide();
    jQuery('#container').fadeIn('slow');
    jQuery('#container').css('bottom','-193px');
    jQuery('#register_login').css('background-position','0 0');
    activeTab('loginTab');
    jQuery('#register_login').html('register');
}

function containerDisplay() {
    if (jQuery('#container').css('display') == 'none') {
        openLoginContainer();
    } else {
        jQuery('#container').fadeOut('slow');
        activeTab(holeRolle);
    }
}

function activeTab(tabName) {
    jQuery('#menu ul li').removeClass('active');
    if (typeof tabName != 'undefined') {
        jQuery('#' + tabName).addClass('active');
        if (tabName != 'loginTab') {
            holeRolle = tabName;
        }
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
            jQuery('#page').html(data);
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
            jQuery('#page').html(data);
            getUserManagement();
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

var messageDisplayTime = 0;  
var messageDisplayInterval;

function timerHelper() {
    messageDisplayTime = 0;
    messageDisplayInterval = window.setInterval(
        function () {
            if (messageDisplayTime == 5) {
                jQuery('#messages').slideUp("slow");
                window.clearInterval(messageDisplayInterval);
            } else {
                ++messageDisplayTime;
                console.debug(count); 
            }
        }, 1000);
}

function systemessages(json) {
    for (var attr in json) {
        jQuery('#messages').html(json[attr]);
        if (json.error) {
            jQuery('#messages').attr('class', 'error_message');
            jQuery('#messages').slideDown("slow");
            if (messageDisplayTime == 0) {
                timerHelper();
            } else {
                messageDisplayTime = 0;
            }
        } else if(json.success) {
            jQuery('#messages').attr('class', 'success_message');
            jQuery('#messages').slideDown("slow");
            if (messageDisplayTime == 0) {
                timerHelper();
            } else {
                messageDisplayTime = 0;
            }
        } else {
            jQuery('#messages').removeAttr('class');
            jQuery('#messages').slideUp("slow");
        }
    }
}

jQuery(document).on('click', "input[name='send']", 
    function() {
        var id=this.id.substr(1,this.id.length);
        getKunde(id);
    }
    );
jQuery(document).on('click', "input[name='aendereKunde']", 
    function() {
        var id=this.id.substr(1,this.id.length);
        Customer.create(id, $("#kundenNameId").val(), $("#kundenVornameId").val(), $("#kundenStrasseId").val(), $("#kundenPlzId").val(), $("#kundenZusatzId").val(), $("#kundenEmailId").val(), $("#kundenPwId").val());
        refreshKunde(Customer);
        alert("Kunde ist ge�ndert worden.");
    }

    );
    
jQuery(document).on('click', "input[name='loescheKunde']", 
    function() {
        var id=this.id.substr(1,this.id.length);
        Customer.create(id, $("#kundenNameId").val(), $("#kundenVornameId").val(), $("#kundenStrasseId").val(), $("#kundenPlzId").val(), $("#kundenZusatzId").val(), $("#kundenEmailId").val(), $("#kundenPwId").val());
        deleteKunde(Customer);
        alert("Kunde ist gel�scht worden.");
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
