<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Start a Conversation</h1>
            <a href="{{ route('chat.index') }}" class="text-blue-500 hover:underline">
                Back to Messages
            </a>
        </div>

        @if($users->isEmpty())
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-gray-500">No users available to chat with.</p>
            </div>
        @else
            <div class="bg-white rounded-lg shadow overflow-hidden">
                @foreach($users as $user)
                    <a href="{{ route('chat.start', $user->id) }}" 
                       class="flex items-center justify-between p-4 border-b hover:bg-gray-50 transition">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-xl font-semibold text-white">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <h3 class="font-semibold">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-500 capitalize">{{ $user->role }}</p>
                                <p class="text-sm text-gray-400">{{ $user->email }}</p>
                            </div>
                        </div>
                        <span class="text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>

