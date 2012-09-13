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
            }
            suggest();
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

function login(email, password) {
    var valid = true;
    if (typeof email == 'undefined') {
        if (!jQuery('#email').val()) {
            jQuery('#email').css('border-color','#FA5858');   
            valid = false;
        } else {
            jQuery('#email').css('border-color','#FFFFFF');
        }
    }
    
    if (typeof password == 'undefined') {
        if (!jQuery('#password').val()) {
            jQuery('#password').css('border-color','#FA5858');  
            valid = false;
        } else {
            jQuery('#password').css('border-color','#FFFFFF');        
        } 
    }
    
    if (valid) {
        jQuery.ajax({
            type : 'POST',
            url : 'lib/controller.php', 
            data : {
                'action' : 'login',
                'email' : (typeof email != 'undefined' ? email : jQuery('#email').val()),
                'passwort' : (typeof password != 'undefined' ? password : jQuery('#password').val())
            },
            dataType : 'json',
            success : function (json) {
                if (json.error) {
                    systemessages(json);
                    jQuery('#email, #password').css('border-color','#FA5858');
                } else {
                    jQuery('#email, #password').css('border-color','#FFFFFF');
                    jQuery('#email').val('');
                    systemessages({
                        'success' : "you're logged in"
                    }); 
                    containerDisplay();
                    getCustomerInformation();
                    getCustomerPositionAtLogin()
                }
            },
            error : function () {
                systemessages({
                    'error' : 'something with the server went wront'
                });
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
        dataType : 'json',
        success : function (json) {
            if (json.error) {
                systemessages(json);
            } else {
                getCustomerInformation();
                jQuery('#adminTab').hide();
                jQuery('#loginTab').unbind('click');
                jQuery('#loginTab').click(containerDisplay);
                Payment.enabled = false;
                systemessages({
                    'success' : "you're logged out"
                });
                jQuery('#homeTab').click();
            }     
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
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
            if (json.error) {
                systemessages(json);
            } else {
                systemessages({
                    'success' : 'registration successful'
                });
                
                login(Customer.getEmail(), Customer.getPasswort());
            }   
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

function getCustomerInformation() {
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php', 
        data : {
            'action' : 'holeAngemeldetenKunde'
        },
        dataType : 'json',
        success : function (json) {
            if (json.error) {
                systemessages(json);
            } else {
                Customer.createWithJSON(json);
                if (Customer.vorname) {
                    jQuery('#customer span').html(Customer.vorname + ', ' + Customer.name);
                } else {
                    jQuery('#customer span').html(Customer.name);
                }
            }
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

function getCustomerPosition() {
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php', 
        data : {
            'action' : 'holeRolle'
        },
        dataType : 'json',
        success : function (json) {
            if (json.error) {
                systemessages(json);
            } else {
                if (json.rolle == 'admin') {
                    jQuery('#adminTab').show();
                    jQuery('#loginTab').unbind('click');
                    jQuery('#loginTab').click(logout);
                    Payment.enabled = true;
                } else if (json.rolle == 'nutzer') {
                    jQuery('#loginTab').unbind('click');
                    jQuery('#loginTab').click(logout);
                    Payment.enabled = true;
                }
                Customer.position = json.rolle;
            }
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

function getCustomerPositionAtLogin() {
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php', 
        data : {
            'action' : 'holeRolle'
        },
        dataType : 'json',
        success : function (json) {
            if (json.error) {
                systemessages(json);
            } else {
                if (json.rolle == 'admin') {
                    jQuery('#adminTab').show();
                    jQuery('#loginTab').unbind('click');
                    jQuery('#loginTab').click(logout);
                    Payment.enabled = true;
                    jQuery('#adminTab').click();
                } else if (json.rolle == 'nutzer') {
                    jQuery('#loginTab').unbind('click');
                    jQuery('#loginTab').click(logout);
                    Payment.enabled = true;
                }
                Customer.position = json.rolle;
            }
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
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
            if (json.error) {
                systemessages(json);
            } else {
                systemessages({
                    'success' : 'changes done'
                });
            }
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

function getShoping_cart() {
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php', 
        data : {
            'action' : 'holeWarenkorb'
        },
        dataType : 'json',
        success : function (json) {
            if (json.error) {
                systemessages(json);
            } else {
                for (var article in json) {
                    var obj = jQuery('#article' + json[article].id + ' .pin')[0];
                    Article.pin(obj, json[article].id, true);
                }
            }
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

function modifyShoping_cart() {  
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php', 
        data : {
            'action' : 'aktualisiereWarenkorb',
            'warenkorb' : ShopingCard.getArticlesJSONstring()
        },
        dataType : 'json',
        success : function (json) {

            if (json.error) {
                systemessages(json);
            } else {
                systemessages({
                    'success' : 'shopingcard updated'
                });
            }
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
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
        }
    });
}

function getOrderManagement() {
    jQuery.ajax({
        type : 'GET',
        url : 'templates/admin/order_management.html',
        dataType : 'html',
        success : function (html) {
            jQuery('#adminContent').html(html);
        }
    });
}