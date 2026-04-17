<x-app-layout>
    <div class="dashboard-container" style="max-width:760px;">

        {{-- Chat Window --}}
        <div class="card" style="overflow:hidden;display:flex;flex-direction:column;height:calc(100vh - 160px);min-height:500px;">

            {{-- Header --}}
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:#2c3e50;border-bottom:3px solid #3498db;">
                <div style="display:flex;align-items:center;gap:14px;">
                    <a href="{{ route('chat.index') }}" style="color:rgba(255,255,255,0.7);display:flex;align-items:center;transition:color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;height:20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </a>
                    <div class="avatar" style="width:40px;height:40px;font-size:1rem;flex-shrink:0;background:{{ $user->role==='employer' ? 'linear-gradient(135deg,#27ae60,#219a52)' : 'linear-gradient(135deg,#3498db,#2980b9)' }};">
                        {{ strtoupper(substr($user->name,0,1)) }}
                    </div>
                    <div>
                        <div style="font-weight:600;color:white;font-size:0.95rem;">{{ $user->name }}</div>
                        <div style="font-size:0.78rem;color:rgba(255,255,255,0.6);">{{ ucfirst($user->role) }}</div>
                    </div>
                </div>
                <div style="width:8px;height:8px;background:#27ae60;border-radius:50;border-radius:50%;box-shadow:0 0 0 3px rgba(39,174,96,0.3);" title="Online"></div>
            </div>

            {{-- Messages --}}
            <div id="chat-messages" style="flex:1;overflow-y:auto;padding:20px;background:#f5f6fa;display:flex;flex-direction:column;gap:12px;">
                @forelse($messages as $message)
                @php $isMine = $message->sender_id === auth()->id(); @endphp
                <div style="display:flex;justify-content:{{ $isMine ? 'flex-end' : 'flex-start' }};">
                    @if(!$isMine)
                    <div class="avatar" style="width:32px;height:32px;font-size:0.8rem;flex-shrink:0;margin-right:10px;align-self:flex-end;background:linear-gradient(135deg,#3498db,#2980b9);">
                        {{ strtoupper(substr($user->name,0,1)) }}
                    </div>
                    @endif
                    <div style="max-width:68%;">
                        <div style="padding:10px 14px;border-radius:{{ $isMine ? '16px 16px 4px 16px' : '16px 16px 16px 4px' }};background:{{ $isMine ? '#2c3e50' : 'white' }};color:{{ $isMine ? 'white' : '#2c3e50' }};font-size:0.92rem;line-height:1.5;box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                            {{ $message->message }}
                        </div>
                        <div style="font-size:0.72rem;color:#7f8c8d;margin-top:4px;text-align:{{ $isMine ? 'right' : 'left' }};">
                            {{ $message->created_at->format('g:i A') }}
                            @if($isMine)
                                {{ $message->read_at ? ' ✓✓' : ' ✓' }}
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div style="text-align:center;color:#7f8c8d;padding:40px 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:48px;height:48px;margin:0 auto 12px;display:block;color:#dcdde1;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <p style="font-style:italic;">No messages yet. Say hello!</p>
                </div>
                @endforelse
            </div>

            {{-- Input --}}
            <div style="padding:14px 16px;background:white;border-top:1px solid #dcdde1;">
                <form action="{{ route('chat.store', $user->id) }}" method="POST" style="display:flex;gap:10px;align-items:center;">
                    @csrf
                    <input type="text" name="message" required autocomplete="off"
                        placeholder="Type your message..."
                        style="flex:1;padding:11px 16px;border:1.5px solid #dcdde1;border-radius:24px;font-size:0.92rem;font-family:inherit;color:#2c3e50;outline:none;transition:border-color 0.2s;"
                        onfocus="this.style.borderColor='#3498db'" onblur="this.style.borderColor='#dcdde1'">
                    <button type="submit"
                        style="width:44px;height:44px;background:#2c3e50;color:white;border:none;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:background 0.2s;"
                        onmouseover="this.style.background='#3498db'" onmouseout="this.style.background='#2c3e50'">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:18px;height:18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const el = document.getElementById('chat-messages');
        if (el) el.scrollTop = el.scrollHeight;
    </script>
    @endpush
</x-app-layout>
