//Controller Ajax Anfragen
function getArticleList() {
    jQuery.ajax({
        type : 'GET',
        url : 'lib/controller.php', 
        data : {
            'action' : 'zeigeVeroeffentlichteArtikel'
        },
        dataType : 'json',
        success : function (json) {
            jQuery('#articleList').html(json);
            
            for (var i = 0; i < json.length; ++i) {
                var article = new Article();
                article.create(json[i]);
                jQuery('#articleList').append(article.renderHTML());
//                if (i%2 != 0) {
//                    jQuery('#articleList').append('<div class="clear" ></div>');
//                }
            }
            suggest();
        },
        error : function (json) {
            console.debug(json);
        }
    });
}

function login() {
    var valid = true;
    if (!jQuery('#email').val()) {
        jQuery('#email').css('border-color','#FA5858');   
        valid = false;
    } else {
        jQuery('#email').css('border-color','#FFFFFF');
    }
    
    if (!jQuery('#password').val()) {
        jQuery('#password').css('border-color','#FA5858');  
        valid = false;
    } else {
        jQuery('#password').css('border-color','#FFFFFF');        
    } 
    
    if (valid) {
        jQuery.ajax({
            type : 'POST',
            url : 'lib/controller.php', 
            data : {
                'action' : 'login',
                'email' : jQuery('#email').val(),
                'passwort' : jQuery('#password').val()
            },
            dataType : 'json',
            success : function (json) {
                console.debug(json);
                if (json['error']) {
                    jQuery('#email, #password').css('border-color','#FA5858');
                } else {
                    jQuery('#email, #password').css('border-color','#FFFFFF');
                    jQuery('#email').val('');
                }
            },
            error : function (json) {
                console.debug(json);
            }
        });
    }
    jQuery('#password').val('');
}

function logout() {
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php', 
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

function registerCustomer() {
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php', 
        data : {
            'action' : 'registriereKunde',
            'kunde' : Customer.getJSONstring()
        },
        dataType : 'json',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

function getCustomerInformation() {
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php', 
        data : {
            'action' : 'holeKunde'
        },
        dataType : 'json',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

function modifyCustomer() {
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php', 
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

function getShoping_cart() {
    jQuery.ajax({
        type : 'GET',
        url : 'lib/controller.php', 
        data : {
            'action' : 'holeWarenkorb'
        },
        dataType : 'json',
        success : function (json) {
            for (var article in json) {
                var obj = jQuery('#article' + json[article].id + ' .pin')[0];
                Article.pin(obj, json[article].id, true);
            }
        },
        error : function (json) {
        
        }
    });
}

function modifyShoping_cart() {    
    jQuery.ajax({
        type : 'GET',
        url : 'lib/controller.php', 
        data : {
            'action' : 'aktualisiereWarenkorb',
            'warenkorb' : ShopingCard.getArticlesJSONstring()
        },
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}



/* ADMIN */
function getUserManagement() {
    jQuery.ajax({
        type : 'GET',
        url : 'templates/admin/user_management.php', 
        dataType : 'html',
        success : function (html) {
            jQuery('#adminContent').html(html);
            getAlleKunden();
        },
        error : function (json) {
        
        }
    });
}

function getArticleManagement() {
    jQuery.ajax({
        type : 'GET',
        url : 'templates/admin/article_management.html',
        dataType : 'html',
        success : function (html) {
            jQuery('#adminContent').html(html);
        },
        error : function (json) {
        
        }
    });
}