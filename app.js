var app = require('express')();
var http = require('http');

// Sets the directory of this file as the root.
app.locals.basedir = __dirname;

// Instantiates the services.
// ...

app.get('/', function(req, res) {
    http.get('http://hacknotts2015-api.azurewebsites.net/hello', function(response) {
        var body = '';

        response.on('data', function(data) {
            body += data;
        });

        response.on('end', function() {
            res.json(JSON.parse(body));
        });
    }).on('error', function(error) {
        console.log('An error has occurred: ' + error);
    });
});

// Starts the server.
app.listen(process.env.PORT || 1234);