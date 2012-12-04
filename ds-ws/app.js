
/**
 * Module dependencies.
 */

var _ = require('underscore');

var express = require('express')
  , routes = require('./routes')
  , user = require('./routes/user')
  , http = require('http')
  , path = require('path')
  , place = require('./place-data.js');

var app = express();

//CORS middleware
var allowCrossDomain = function(req, res, next) {
	res.header('Access-Control-Allow-Origin', '*');
	res.header('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE');
	res.header('Access-Control-Allow-Headers', 'Content-Type');
	
	next();
};

app.configure(function(){
	app.set('port', process.env.PORT || 3000);
	app.set('views', __dirname + '/views');
	app.set('view engine', 'jade');
	app.use(express.favicon());
	app.use(express.logger('dev'));
	app.use(express.bodyParser());
	app.use(express.methodOverride());
	app.use(allowCrossDomain);
	app.use(app.router);
	app.use(express.static(path.join(__dirname, 'public')));
});

app.configure('development', function(){
  app.use(express.errorHandler());
});

/// Routes
function dataCallback(res) {
    return function(err, data) {
        if (err) {
            res.send({error : err});
        } else {
            res.send(data);
        }
    };
}

function getPlacesInfo(data) {
	return placesInfo;
}

function placesDataCallback(res) {
	return function(err, data) {
		var placesInfo = {};
		placesInfo.data = data;
		placesInfo.providers = [];
		for(var p in placesInfo.data) {
			if(placesInfo.data[p].providers) {
				placesInfo.data[p].providers = _.map(placesInfo.data[p].providers.split(/\+/), function(str){return Number(str);} );
				placesInfo.providers = _.union(placesInfo.providers, placesInfo.data[p].providers);
			}
		}
		placesInfo.providers = _.uniq(placesInfo.providers);
		dataCallback(res).apply(null, [err, placesInfo]);
	};
}

nearbyResultsHandler = function(req, res) {
	// Ratio used to extend distance
	var ext_ratio = 1.7;
	// Min-max distances
	var min_dist = 500, max_dist = 50000;
	// Max results to fetch
	var max_count = 50;
	// Init
	var dist = min_dist, count = max_count;
	_callback = function(err, data){
		if(err){
			dataCallback(res).apply(null, [err, data]);
		} else {
			console.log('Dist: '+dist+' -> '+data.length+' places');
			if(dist < max_dist && data.length < count) {
				dist *= ext_ratio;
				count = Math.max(1,Math.round(max_count/(dist/min_dist)));
				place.findNearby(req.params.lat, req.params.lng, dist, count, _callback);
			}
			else{
				placesDataCallback(res).apply(null, [err, data]);
			}
		}
	};
	place.findNearby(req.params.lat, req.params.lng, dist, count, _callback);
}

app.get('/', routes.index);
app.get('/users', user.list);
app.get('/place/nearby/ll/:lat,:lng', nearbyResultsHandler);
app.get('/place/area/zip/:zip', function(req, res) {
	place.findByZip(req.params.zip, -1, placesDataCallback(res));
});

http.createServer(app).listen(app.get('port'), function(){
  console.log("Express server listening on port " + app.get('port'));
});
