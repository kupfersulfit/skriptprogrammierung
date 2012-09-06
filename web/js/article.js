Article = function() {
    this.beschreibung    = 'Eine Beschreibung liegt leider nicht vor.';
    this.bildpfad        = 'default.png';
    this.id              = '';
    this.kategoryId      = '';
    this.name            = '';
    this.preis           = '';
    this.seit            = '';
    this.verfuegbar      = '';
    this.veroeffentlicht = '1';
}

Article.prototype.create = function(json) {
    if (json['beschreibung'] != 'null' 
        && json['beschreibung'] != null 
        && json['beschreibung'] == '') {
        this.beschreibung = json['beschreibung'];
    }
    
    if (json['bildpfad'] != 'null' 
        && json['bildpfad'] != null 
        && json['bildpfad'] == '') {
        this.bildpfad = json['bildpfad'];
    }
    
    this.id              = json['id'];
    this.kategoryId      = json['kategoryId'];
    this.name            = json['name'];
    this.preis           = json['preis'];
    this.seit            = json['seit'];
    this.verfuegbar      = json['verfuegbar'];
    this.veroeffentlicht = json['verfuegbar'];
}

Article.prototype.renderHTML = function() {
    var strHTML = '<section id="article'+ this.id +'" >';
    strHTML +=      '<div class="articleTitel" >' + this.name + '</div>';
    strHTML +=      '<div class="articleContent">';
    strHTML +=          '<div class="articleImg"><img src="media/'+ this.bildpfad +'" width="300" height="300" />';
    strHTML +=          '<div class="articleDetails"><ul>'; 
    strHTML +=          '<li>price ' + this.preis + '</li>';
    strHTML +=          '<li>category ' + this.kategoryId + '</li>';
    strHTML +=          '<li>' + this.seit + '</li>';
    strHTML +=          '<li>' + this.verfuegbar + '</li>';
    strHTML +=          '</ul></div>';
    strHTML +=          '<div class="articleDescription">'+ this.beschreibung +'</div>';
    strHTML +=      '</div>'
    strHTML += '</section>';
}