// On utilise notre enveloppe sur node-mysql
var db = require('./db.js');
 
// On veut pouvoir tester la validité des noms de colonnes pour se protéger
// des injections SQL.
var columnNameRegex = /^([a-zA-Z0-9_$]{1,64}\.)?[a-zA-Z0-9_$]{1,64}$/;
function checkColumnName(name) {
	return columnNameRegex.test(name);
}
 
function checkColumns(obj) {
	for (var key in obj) {
		if (!checkColumnName(key)) {
			return false;
		}
	}
	return true;
}

exports.findNearby = function(lat, lng, dist, max, callback) {

	if(dist == null)
		dist = 500;
	if(max == null)
		max = 50;
	
	var q = "SELECT p.*, GROUP_CONCAT(pp.provider_id SEPARATOR '+') AS providers " +
	"FROM place p LEFT JOIN place_provider pp ON pp.place_id=p.place_id " +
	"WHERE geodist(lat,lng,?,?)<=? " +
	"GROUP BY p.place_id " +
	"ORDER BY geodist(lat,lng,?,?) " +
	"LIMIT ?";
	
	db.query(q, [lat, lng, dist, lat, lng, max], callback);
	
}

exports.findByZip = function(zip, max, callback) {
	
	if(zip == null || !/^[0-9]+$/.test(zip)){
		return;
	}
	
	if(max == null)
		max = 500;
	
	if(zip == 75000)
		zip = 75;
	
	var q = "SELECT p.*, GROUP_CONCAT(pp.provider_id SEPARATOR '+') AS providers " +
	"FROM place p LEFT JOIN place_provider pp ON pp.place_id=p.place_id ";
	var limit = '';
	if(max >= 0)
		limit = 'LIMIT ?';
	
	if(zip.length == 2) {
		q += "WHERE zipcode BETWEEN ? AND ? " +
		"GROUP BY p.place_id " +
		limit;
		db.query(q, [1*zip*1000, (1*zip+1)*1000 - 1, max], callback);
	}
	else {
		q += "WHERE zipcode = ? " +
		"GROUP BY p.place_id " +
		limit;
		db.query(q, [1*zip, max], callback);
	}
	
}