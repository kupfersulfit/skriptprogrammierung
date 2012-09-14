Order = function() {
        
    this.id                  = '';
    this.kundenid            = '';
    this.bestelldatum        = '';
    this.statusid            = '';
    this.zahlungsmethodeid   = '';
    this.lieferungsmethodeid = '';
}
    
Order.prototype.classname = 'Order';

Order.prototype.create = function(json) {

    this.id                  = json['id'];
    this.kundenid            = json['kundenid'];
    this.bestelldatum        = json['bestelldatum'];
    this.statusid            = json['statusid'];
    this.zahlungsmethodeid   = json['zahlungsmethodeid'];
    this.lieferungsmethodeid = json['lieferungsmethodeid'];

}

Order.prototype.getJSONstring = function() {
    var JSONstr = '{';
    for (var key in this) { 
        if (typeof this[key] != 'function' && typeof this[key] != 'object') {
            JSONstr += '"' + key + '":"' + this[key] + '",';
        }
    }
    JSONstr = JSONstr.substring(0, (JSONstr.length -1));
    JSONstr += '}';
    return JSONstr;
}

Article.prototype.createtemporyIntance = function(id, kundenid, bestelldatum, statusid, zahlungsmethodeid, lieferungsmethodeid) {
    this.id                  = id;
    this.kundenid            = kundenid;
    this.bestelldatum        = bestelldatum;
    this.statusid            = statusid;
    this.zahlungsmethodeid   = zahlungsmethodeid;
    this.lieferungsmethodeid = lieferungsmethodeid;
}


