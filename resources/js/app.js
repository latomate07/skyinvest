import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})

 // Enable pusher logging - don't include this in production
 function newMessage(logo, message, ownerMessageClass = null)
{
   const content = `<div class="chat-area-main"> 
                       <div class="chat-msg ${ownerMessageClass}">
                           <div class="chat-msg-profile">
                               <img id="user-logo" class="chat-msg-img" src="${logo}" alt="logo">
                           </div>
                           <div class="chat-msg-content">
                               <div class="chat-msg-text">${message}</div>
                           </div>
                       </div>
                   </div>`;
   return content;
}

 // Auto scroll to the newest message
function scrollToBottom()
{
    var chat = document.querySelector('.chat-area');
    chat.scrollTop = chat.scrollHeight - chat.clientHeight;
}

/**
 * Get and store data we need
 */
const messageInput = document.getElementById('messageContent');
const messageData = document.getElementById('messageData');
// Submit btn
const submitButton = document.getElementById('sendMessage');

submitButton.addEventListener('click', function(event){
    if(messageInput.value != "")
    {
        axios.post("/private/send-new-message", {
            logo: JSON.parse(messageData.value).user_logo,
            message: messageInput.value,
            messageData: JSON.parse(messageData.value)
        });
    }

    // Delete message content
    messageInput.value = "";

    // Check if welcome conversation is active
    if(document.getElementById('informations'))
    {
        document.getElementById('informations').style.display = "none";
    }
})

// Get current conversation id
const conversation_id = JSON.parse(messageData.value).conversation_id;
window.Echo.private('messagerie.' + conversation_id)
           .listen(".private.messagerie", (data) => {
                // Get user logo
                let logo = data.messageData.site_url+'/'+data.logo;
                if(data.message_from !== data.message_to)
                {
                    document.getElementById('chat-main-area').innerHTML += newMessage(logo, data.message);
                }
                else
                {
                    document.getElementById('chat-main-area').innerHTML += newMessage(logo, data.message, 'owner');
                }
                // Scroll to the newest message
                scrollToBottom();
            });
Pusher.logToConsole = true;