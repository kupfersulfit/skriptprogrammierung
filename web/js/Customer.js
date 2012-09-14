var Customer = {
    id : '',
    name : '',
    vorname : '',
    strasse : '',
    plz : '',
    zusatz : '',  
    email : '',
    passwort : '',
    registriertseit : '',
    position : '',
    register : function() {
        var firstfocus = true;
        var valid = true;
        jQuery('#registerContainer input:text').each(function(){
            var val = this.value;
            if (val == '') {
                jQuery(this).css('border-color','#FA5858');
                if (firstfocus) {
                    jQuery(this).focus();
                    firstfocus = false;
                }
            } else {
                jQuery(this).css('border-color','#FFFFFF');
            }
        });
        if (!valid) {
            systemessages({
                "error":"an input is empty or"
            });
        }
        valid = valid && (this.validMail() & this.validPassword());
        
        if (valid) {
            Customer.create(
                '',
                jQuery('#surname').val(),
                jQuery('#givenname').val(),
                jQuery('#street').val() + ' ' + jQuery('#nr').val(),
                jQuery('#zip').val(),
                jQuery('#addition').val(),
                jQuery('#registerEmail').val(),
                jQuery('#registerPassword').val()
                );
            registerCustomer();   
        }
    },
    validMail : function() {
        var email = jQuery('#registerEmail').val();
        var vEmail = jQuery('#validEmail').val();
        
        if (email == '' || vEmail == '' || email != vEmail) {
            jQuery('#registerEmail').css('border-color','#FA5858');
            jQuery('#validEmail').css('border-color','#FA5858');
            systemessages({
                'error' : "emails doesn't match or is empty"
            });
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
            systemessages({
                'error' : "passwords doesn't match or is empty"
            });
            return false;
        } else {
            this.passwort = password;
            jQuery('#registerPassword').css('border-color','#FFFFFF');
            jQuery('#validPassword').css('border-color','#FFFFFF');
            return true;
        }
    },
    passwordStrength : function(obj) {
        var pwLength = jQuery(obj).val().length;
            
        if (pwLength == 0) {
            jQuery(obj).css('background-color','#E0F1FF');
        } else if (pwLength < 4) {
            jQuery(obj).css('background-color','orange');
        } else if (pwLength < 6) {
            jQuery(obj).css('background-color','yellow');
        } else if (pwLength >= 6) {
            jQuery(obj).css('background-color','lawngreen');
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
    },
    createWithJSON : function(json) {
        for (var attr in json) {
            this[attr] = json[attr];
        }
    },
    getJSONstring : function() {
        var JSONstr = '{';
        for (var key in Customer) { 
            if (typeof Customer[key] != 'function') {
                JSONstr += '"' + key + '":"' + Customer[key] + '",';
            }
        }
        JSONstr = JSONstr.substring(0, (JSONstr.length -1));
        JSONstr += '}';
        return JSONstr;
    },
    
    getEmail : function() {
        return this.email;
    },
    
    getPasswort : function() {
        return this.passwort;
    },
    
    reset : function() {
        this.id = '';
        this.name = '';
        this.vorname = '';
        this.strasse = '';
        this.plz = '';
        this.zusatz = '';
        this.email = '';
        this.passwort = '';
    }
}