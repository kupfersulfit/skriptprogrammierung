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
                if (i != 0 && i%2 == 0) {
                    jQuery('#articleList').append('<div class="clear" ></div>');
                }
            }
            console.debug(json)
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
            dataType : 'jsonp',
            success : function (json) {
                console.debug(json);
                jQuery('#email, #password').css('border-color','#FFFFFF');
                jQuery('#email').val('');
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