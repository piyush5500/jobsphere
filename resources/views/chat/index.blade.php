<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Messages</h1>
            <a href="{{ route('chat.users') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                New Conversation
            </a>
        </div>

        @if($conversations->isEmpty())
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-gray-500 mb-4">No conversations yet.</p>
                <a href="{{ route('chat.users') }}" class="text-blue-500 hover:underline">
                    Start a new conversation
                </a>
            </div>
        @else
            <div class="bg-white rounded-lg shadow overflow-hidden">
                @foreach($conversations as $conversation)
                    <a href="{{ route('chat.show', $conversation['user']->id) }}" 
                       class="flex items-center justify-between p-4 border-b hover:bg-gray-50 transition {{ $conversation['unread_count'] > 0 ? 'bg-blue-50' : '' }}">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-xl font-semibold text-white">
                                    {{ strtoupper(substr($conversation['user']->name, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <h3 class="font-semibold">{{ $conversation['user']->name }}</h3>
                                <p class="text-sm text-gray-500 capitalize">{{ $conversation['user']->role }}</p>
                                @if($conversation['last_message'])
                                    <p class="text-sm text-gray-600 truncate max-w-xs">
                                        {{ $conversation['last_message']->sender_id === auth()->id() ? 'You: ' : '' }}
                                        {{ $conversation['last_message']->message }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col items-end">
                            @if($conversation['last_message'])
                                <span class="text-xs text-gray-400">
                                    {{ $conversation['last_message']->created_at->diffForHumans() }}
                                </span>
                            @endif
                            @if($conversation['unread_count'] > 0)
                                <span class="mt-1 bg-blue-500 text-white text-xs px-2 py-1 rounded-full">
                                    {{ $conversation['unread_count'] }}
                                </span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>

