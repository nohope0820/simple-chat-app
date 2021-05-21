var io = require('socket.io')(6001, {
  cors: {origin: '*'}
})

console.log('Connected to port 6001')
var Redis = require('ioredis');
var redis = new Redis(6379, '10.5.0.10');

io.on('error',function(socket){
    console.log('error')
})
io.on('connection',function(socket){
    console.log('Co nguoi vua ket noi')
})

redis.subscribe()

redis.on('message',function (channel,message) {
  message = JSON.parse(message)
  io.emit(channel+":"+message.event,message.data.message)
  console.log('Sent')
})

