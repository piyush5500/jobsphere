<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('chat.index') }}" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-lg font-semibold text-white">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <h2 class="font-semibold">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-500 capitalize">{{ $user->role }}</p>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            <div class="p-4 h-96 overflow-y-auto" id="chat-messages">
                @forelse($messages as $message)
                    <div class="mb-4 flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs lg:max-w-md {{ $message->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }} rounded-lg px-4 py-2">
                            <p>{{ $message->message }}</p>
                            <p class="text-xs mt-1 {{ $message->sender_id === auth()->id() ? 'text-blue-100' : 'text-gray-500' }}">
                                {{ $message->created_at->format('g:i A') }}
                                @if($message->sender_id === auth()->id() && $message->read_at)
                                    ✓✓
                                @elseif($message->sender_id === auth()->id())
                                    ✓
                                @endif
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-8">
                        <p>No messages yet. Start the conversation!</p>
                    </div>
                @endforelse
            </div>

            <!-- Message Form -->
            <div class="p-4 border-t">
                <form action="{{ route('chat.store', $user->id) }}" method="POST" class="flex space-x-4">
                    @csrf
                    <input 
                        type="text" 
                        name="message" 
                        class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Type your message..."
                        required
                        autocomplete="off"
                    >
                    <button 
                        type="submit" 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition"
                    >
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Auto-scroll to bottom of chat
        const messagesContainer = document.getElementById('chat-messages');
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    </script>
    @endpush
</x-app-layout>

