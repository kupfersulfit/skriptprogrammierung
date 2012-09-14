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

function formatDate(date) {
    date = date.split(' ')[0];
    date     = date.split('-');
    date     = date[2] + '.' + date[1] + '.' + date[0];
    return date;
}

function renderOrders(json) {
    
    for (var i = 0; i < json.length; ++i) {
        var bestellungMetaData = json[i][0];
        var article = json[i];
        var date = formatDate(bestellungMetaData.bestelldatum);
        
        var state = 'new';
        switch (parseInt(bestellungMetaData.statusid)) {
            case 1:
                state = 'new';
                break;
            case 2:
                state = 'in progress';
                break;
                 
            case 3:
                state = 'delivered';
                break;
            default:
                break;
        }
        
        var deliver = 'standard';
        var deliver_cost = 5;
        switch (parseInt(bestellungMetaData.lieferungsmethodid)) {
            case 1:
                deliver = 'standard';
                deliver_cost = 9.99;
                break;
            case 2:
                deliver = 'express';
                deliver_cost = 14.99;
                break;
                 
            case 3:
                deliver = 'overnight';
                deliver_cost = 19.99;
                break;
            default:
                break;
        }
        
        var totalPrice = deliver_cost;
        
        var strHTML = '<div class="order state' + bestellungMetaData.statusid + '" id="order' + bestellungMetaData.id + '" onclick="orderDisplay(this);" >';
        strHTML    +=   '<div class="order_head state' + bestellungMetaData.statusid + '" title="open/close" >';
        strHTML    +=       '<div class="order_title">Order ' + bestellungMetaData.id + '</div>';
        strHTML    +=       '<div class="order_state">' + state + '</div>';
        strHTML    +=       '<div class="order_date"> ' + date + ' </div>';
        strHTML    +=   '</div>';
        strHTML    +=   '<div class="order_articles">';
        for (var j = 1; j < article.length; ++j) {
            strHTML +=      '<div class="order_article">';
            strHTML +=         '<div class="article_name">' + article[j].name + '</div>';
            strHTML +=         '<div class="article_details">';
            strHTML +=             '<p>description</p>';
            strHTML +=             '<div class="article_description">' + article[j].beschreibung + '</div>';
            strHTML +=             '<p>published since</p>';
            strHTML +=             '<div class="article_since">' + formatDate(article[j].seit) + '</div>';
            strHTML +=         '</div>';
            strHTML +=         '<div class="article_paymethod">';
            strHTML +=              '<p>payment method</p>';
            strHTML +=              '<div class="cells" >' + deliver + ' (' + deliver_cost  + '&euro;) </div>';
            strHTML +=         '</div>';
            strHTML +=         '<div class="article_delivermethod">';
            strHTML +=              '<p>deliver method</p>';
            strHTML +=              '<div class="cells" >' + (bestellungMetaData.zahlungsmethodeid == 1 ? 'bank transfer' : 'creditcard') + ' </div>';
            strHTML +=         '</div>';
            strHTML +=         '<div class="article_amount">';
            strHTML +=             '<p>amount</p>';
            strHTML +=             '<div class="cells" >' + article[j].verfuegbar + '</div>';
            strHTML +=         '</div>';
            strHTML +=         '<div class="article_price">';
            strHTML +=             '<p>price</p>';
            strHTML +=             '<div class="cells" >' + article[j].preis + ' &euro;</div>';
            strHTML +=         '</div>';
            strHTML +=         '<div class="clear"></div>';
            strHTML +=      '</div>';
            
            totalPrice += parseFloat((article[j].preis * article[j].verfuegbar).toFixed(2));
        }
        strHTML    +=   '</div>';
        strHTML    +=   '<div class="order_foot state' + bestellungMetaData.statusid + '">';
        
        totalPrice = '' + totalPrice;
        if (!totalPrice.match(/[0-9]{1,}\.[0-9]{2}/)) {
            totalPrice += '.00';
        }
    
        strHTML    +=       '<div class="total_price">total price <span>' + totalPrice + '</span> &euro; (inc. delivery charges)</div>'
        strHTML    +=   '</div>';
        strHTML    += '</div>'; 
        jQuery('#orders').append(strHTML);
    }
}

function orderDisplay(obj) {
    if (jQuery('#' + obj.id + ' .order_articles').css('display') == 'none') {
        jQuery('#' + obj.id + ' .order_articles').slideDown('slow');
    } else {
        jQuery('#' + obj.id + ' .order_articles').slideUp('slow');
    }
}

function fillProfile() {
    for (var key in Customer) { 
        if (typeof Customer[key] != 'function'
            && key != 'position') 
            {
            var value = Customer[key];
            if (key == 'registriertseit') {
                value = formatDate(Customer[key]);
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
