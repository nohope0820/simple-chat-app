import Echo from "laravel-echo"
window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: 'http://localhost:6001'
});