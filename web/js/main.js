function openLoginContainer() {
    jQuery('#loginContainer').show();
    jQuery('#registerContainer').hide();
    jQuery('#container').fadeIn('slow');
    jQuery('#container').css('bottom','-178px');
    jQuery('#register_login').css('background-position','0 0');
    activeTab('loginTab');
    jQuery('#registerLink').html('register');
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
        getCustomerContent(lhref[1]);
    } 
    else {
        activeTab('homeTab');
        getCustomerContent('home');
        setAnker('home');
    }
    interval = window.setInterval(function () {
        if (Article.Instances.length > 0) {
            window.clearInterval(interval);
            getShopping_cart();
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

var ShopingCard = {
    articles : new Array(),    
    addArticle : function(article) {
        this.articles.push({
            'id' : article.id, 
            'verfuegbar': 1
        });
    },
    removeArticle : function(id) {
        for (var i = 0; i < this.articles.length; ++i) {
            console.debug(this.articles[i]);
            if (this.articles[i].id == id) {
                delete this.articles[i];
            }
        }
    },
    getArticlesJSONstring : function () {
        var jsonStr = '[';
        
        for (var i = 0; i < this.articles.length; ++i) {
            if (typeof this.articles[i] != 'undefined') {
                jsonStr += '{"id":' + this.articles[i].id + ', "verfuegbar":"' + this.articles[i].verfuegbar + '"}';
                if (i != this.articles.length - 1) {
                    jsonStr += ', ';
                }
            }
        }
        
        jsonStr += ']';
        return jsonStr;
    }
    
}
