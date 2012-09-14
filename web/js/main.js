var holeRolle = 'homeTab';
var messageTimeout;

function submitOnEnter(event, fn) {
    if (event.keyCode == 13) {
        fn();
    }
    
}

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
        if (lhref[1] == 'admin' || lhref[1] == 'order_management') {
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
//            if (typeof Article != 'undefined' && Article.Instances.length == 0) {
                Article.Instances = new Array();    
                getArticleList();
//            } else if (pageName == 'home') {
//                for (var i = 0; i < Article.Instances.length; ++i) {
//                    jQuery('#articleList').append(Article.Instances[i].renderHTML());
//                    if (ShopingCard.findArticle(Article.Instances[i].id) != -1) {
//                        jQuery('#article' + Article.Instances[i].id + ' .pin').css('background-position','0px 40px');
//                    }
//                }
//            }
            if(pageName == 'home') {
                interval = window.setInterval(function () {
                    if (typeof Article != 'undefined' && Article.Instances.length > 0) {
                        window.clearInterval(interval);
                        if (ShopingCard.articles.length == 0) {
                            getShoping_cart();
                        }
                        jQuery('#shoping_cart').show();
                    }
                }, 200);
            } else if (pageName == 'profile') {
                jQuery('#shoping_cart').hide();
                getOrders();
                fillProfile();
            } else if(pageName == 'admin') {
                jQuery('#shoping_cart').hide();
            }
        }
    });
}

function renderOrders(json) {
    for (var i = 0; i < json.length; ++i) {
        var bestellungMetaData = json[i][0];
        var article = json[i][1];
        var date = bestellungMetaData.bestelldatum.split(' ')[0];
        date     = date.split('-');
        date     = date[2] + '.' + date[1] + '.' + date[0];
        
        var strHTML = '<div class="order">';
        strHTML    += '<div class="orderHead"><div class="orderTitle">Order ' + bestellungMetaData.id + '</div><div class="orderDate"> ' + date + ' </div></div>'
        for (var j = 0; j < article.length; ++j) {
            
        }
        strHTML += '</div>'; 
        jQuery('#orders').append(strHTML);
    }
}

function fillProfile() {
    for (var key in Customer) { 
        if (typeof Customer[key] != 'function'
            && key != 'position') 
            {
            var value = Customer[key];
            if (key == 'registriertseit') {
                value = Customer[key].split(' ')[0];
                value = value.split('-');
                value = value[2] + '.' + value[1] + '.' + value[0];
            } else if (key == 'strasse') {
                value = value.split(' ');
                if (typeof value[1] != undefined && value != '') {
                    jQuery('#profile_nr').val(value[1]);
                }
                value = value[0];
            }
            jQuery('#profile_'+key).val(value);
        }
    }
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

function resetUserchange() {
    fillProfile();
    jQuery('#profile_newEmail').val('');
    jQuery('#profile_newEmailValid').val('');
    jQuery('#profile_newPasswort').val('');
    jQuery('#profile_newPasswortValid').val('');
    
}

function changeUserInformation() {
    var valid = true;
    var changes = false;
    
    var newEMail = jQuery('#profile_newEmail').val();
    var newEmailValid = jQuery('#profile_ne wEmailValid').val();
    var newPasswort = jQuery('#profile_newPasswort').val();
    var newPasswortValid = jQuery('#profile_newPasswortValid').val();
    
    if (newEMail != '') { 
        if(newEMail == newEmailValid) {
            Customer.email = newEMail; 
            changes = true;
        } else {
            systemessages({
                "error":"emails does not match"
            });
            valid = false;
        }
    }
    if (newPasswort != '') {
        if (newPasswort == newPasswortValid) {
            Customer.passwort = newPasswort;
            changes = true;
        } else {
            systemessages({
                "error":"passwords does not match"
            });
            valid = false;
        }
    }
    
    var surname = jQuery('#profile_name').val();
    var givenname = jQuery('#profile_vorname').val();
    var street = jQuery('#profile_strasse').val() + ' ' + jQuery('#profile_nr').val();
    var zip = jQuery('#profile_plz').val();
    
    if (surname != '' && surname != Customer.name) {
        Customer.name    = surname;
        changes = true;
    }
    if (givenname != '' && givenname != Customer.vorname) {
        Customer.vorname = givenname;
        changes = true;
    }
    if (street != '' && street != Customer.strasse) {
        Customer.strasse  = street;
        changes = true;
    }
    if (zip != '' && zip != Customer.plz) {
        Customer.plz  = zip;
        changes = true;
    }
    
    if (valid && changes) {
        modifyCustomer();
    }
}

/* --- admin --- */

function getAdminContent(pageName) {
    jQuery.ajax({
        url: 'templates/admin/' + pageName + ".php",
        success: function (data) {
            jQuery('#page').html(data);
            if (pageName == 'admin') {
                getUserManagement();
                setAdminTabActive('usermanagement');
            } else if (pageName == 'order_management') {
                getAllOrders();
                jQuery('#shoping_cart').hide();
            }
        }
    });
}

function setAdminTabActive(id) {
    jQuery('.admin_tab').removeClass('active');
    jQuery('#' + id).addClass('active');
} 
