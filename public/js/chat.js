
// const socket = io('http://localhost:6001')
const messageForm = document.querySelector('#message-from')
const messagesBox = document.querySelector('#messages')

messageForm.addEventListener('submit', e => {
  e.preventDefault()
  let params = {
    sender_id: 2,
    receiver_id: messageForm.receiver_id.value,
    messages: messageForm.message.value
  }
  let tempMessage = factory.message(params, true, true)
  messagesBox.appendChild(tempMessage)
  axios.post('/api/message-personal', params)
    .then(response => {
      tempMessage.classList.remove('temp')
    })
    .catch(error => {
      tempMessage.classList.remove('temp')
      tempMessage.classList.add('error')
    })
})
const factory = {
  message (data, owner = false, temp = false) {
    let element = document.createElement('div')
    element.classList.add('item')
    owner ? element.classList.add('owner') : element.classList.add('guest')
    if (temp) {
      element.classList.add('temp')
    }
    element.innerHTML = data.messages
    return element
  }
}
// socket.on('laravel_database_kiddihub:message',function(data) {
//   messagesBox.appendChild(factory.message(data, false))
//   console.log(data)
// })