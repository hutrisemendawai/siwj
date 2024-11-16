<link rel="stylesheet" href="css/chat-style.css">

<x-app-layout>
    <div class="chat-container">
        <h2 class="chat-title">Group Chat</h2>
        <div id="chat-messages" class="chat-messages">
            <!-- Chat Messages -->
            @foreach($messages as $message)
                <div class="chat-message {{ $message->user->id == auth()->id() ? 'chat-message-sent' : 'chat-message-received' }}">
                    <img src="{{ $message->user->profile_photo ? asset('storage/profile_photos/' . $message->user->profile_photo) : asset('storage/profile_photos/default.jpg') }}" 
                         alt="{{ $message->user->name }}" 
                         class="chat-profile-image">
                    <div class="chat-message-content">
                        <div class="chat-message-header">
                            <span class="chat-username">{{ $message->user->name }}</span>
                            <span class="chat-timestamp" data-timestamp="{{ $message->created_at }}">{{ $message->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="chat-message-text">{{ $message->message }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Message Input -->
        <div class="chat-input-container">
            <input type="text" id="chat-message-input" placeholder="Type your message" class="chat-message-input">
            <button id="chat-send-button" class="chat-send-button">Send</button>
        </div>
    </div>

    <!-- Moment.js and Moment Timezone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.34/moment-timezone.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatMessages = document.getElementById('chat-messages');

            // Function to scroll to the bottom of chat messages
            function scrollToBottom() {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // Function to update timestamps to "time ago" format
            function updateTimestamps() {
                document.querySelectorAll('.chat-timestamp').forEach(timestamp => {
                    const time = timestamp.getAttribute('data-timestamp');
                    timestamp.textContent = moment.tz(time, 'UTC').tz('Asia/Jakarta').fromNow();
                });
            }

            // Scroll to the bottom when the page loads and update timestamps
            scrollToBottom();
            updateTimestamps();

            // Add event listener to the send button
            document.getElementById('chat-send-button').addEventListener('click', sendMessage);

            function sendMessage() {
                let message = document.getElementById('chat-message-input').value;
                axios.post('/chat', { message }).then(response => {
                    document.getElementById('chat-message-input').value = '';
                    scrollToBottom(); // Scroll to the bottom after sending a message
                });
            }

            // Listen for new messages on the Echo channel
            window.Echo.channel('public-chat')
                .listen('.message.sent', (e) => {
                    console.log('Message received:', e);
                    chatMessages.innerHTML += `
                        <div class="chat-message ${e.user.id == {{ auth()->id() }} ? 'chat-message-sent' : 'chat-message-received'}">
                            <img src="${e.user.profile_photo ? '/storage/profile_photos/' + e.user.profile_photo : '/storage/profile_photos/default.jpg'}" 
                                 alt="${e.user.name}" 
                                 class="chat-profile-image">
                            <div class="chat-message-content">
                                <div class="chat-message-header">
                                    <span class="chat-username">${e.user.name}</span>
                                    <span class="chat-timestamp" data-timestamp="${e.message.created_at}">${moment.tz(e.message.created_at, 'UTC').tz('Asia/Jakarta').fromNow()}</span>
                                </div>
                                <p class="chat-message-text">${e.message.message}</p>
                            </div>
                        </div>`;
                    scrollToBottom(); // Scroll to the bottom after receiving a new message
                    updateTimestamps(); // Update timestamps for new messages
                });

            // Update timestamps periodically (e.g., every minute) for accuracy
            setInterval(updateTimestamps, 60000); // every 60 seconds
        });
    </script>
</x-app-layout>
