const http = require('http');

const server = http.createServer((req, res)=>{
    res.end("Hello App: \n"+Date(),"utf-8")
});

server.listen(process.env.PORT || process.env.port || 8080);