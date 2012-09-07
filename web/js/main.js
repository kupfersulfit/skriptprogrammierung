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
            if (typeof this.articles[i] != 'undefined') {
                if (this.articles[i].id == id) {
                    delete this.articles[i];
                }
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

var Customer = {
    id : '',
    name : '',
    vorname : '',
    strasse : '',
    plz : '',
    zusatz : '',  
    email : '',
    passwort : '',
    regiestriertseit : '',
    register : function() {
        var valid = true;
        jQuery('#registerContainer input:text').each(function(){
            var val = this.value;
            if (val == '') {
                jQuery(this).css('border-color','#FA5858');
                valid = false;
            } else {
                jQuery(this).css('border-color','#FFFFFF');
            }
        });
        valid = this.validMail();
        valid = this.validPassword();
        
        if (valid) {
            
    }
    //        this.id = jQuery()
    },
    validMail : function() {
        var email = jQuery('#registerEmail').val();
        var vEmail = jQuery('#validEmail').val();
        
        if (email == '' || vEmail == '' || email != vEmail) {
            jQuery('#registerEmail').css('border-color','#FA5858');
            jQuery('#validEmail').css('border-color','#FA5858');
            return false;
        } else {
            this.email = email;
            jQuery('#registerEmail').css('border-color','#FFFFFF');
            jQuery('#validEmail').css('border-color','#FFFFFF');
            return true;
        }
    },
    validPassword : function() {
        var password = jQuery('#registerPassword').val();
        var vpassword = jQuery('#validPassword').val();
        
        if (password == '' || vpassword == '' || password != vpassword) {
            jQuery('#registerPassword').css('border-color','#FA5858');
            jQuery('#validPassword').css('border-color','#FA5858');
            return false;
        } else {
            this.password = password;
            jQuery('#registerPassword').css('border-color','#FFFFFF');
            jQuery('#validPassword').css('border-color','#FFFFFF');
            return true;
        }
    },
    passwordStrength : function() {
        var pwLength = jQuery('#registerPassword').val().length;
            
        if (pwLength == 0) {
            jQuery('#registerPassword').css('background-color','white');
        } else if (pwLength < 4) {
            jQuery('#registerPassword').css('background-color','orange');
        } else if (pwLength < 6) {
            jQuery('#registerPassword').css('background-color','yellow');
        } else if (pwLength >= 6) {
            jQuery('#registerPassword').css('background-color','lawngreen');
        }
    },
    create : function(id, name, vorname, strasse, plz, zusatz, email, passwort) {
        this.id = id;
        this.name = name;
        this.vorname = vorname;
        this.strasse = strasse;
        this.plz = plz;
        this.zusatz = zusatz;
        this.email = email;
        this.passwort = passwort;
    }
}