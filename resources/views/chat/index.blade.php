<x-app-layout>
    <div class="dashboard-container" style="max-width:760px;">

        <div class="page-header" style="display:flex;justify-content:space-between;align-items:center;">
            <div>
                <h1 style="font-family:'Playfair Display',serif;font-size:1.7rem;margin-bottom:4px;">Messages</h1>
                <p style="color:#7f8c8d;font-style:italic;">Your conversations with employers and job seekers</p>
            </div>
            <a href="{{ route('chat.users') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Conversation
            </a>
        </div>

        @if($conversations->isEmpty())
        <div class="empty-state card">
            <svg xmlns="http://www.w3.org/2000/svg" class="empty-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            <h3>No conversations yet</h3>
            <p>Start a conversation with an employer or job seeker.</p>
            <a href="{{ route('chat.users') }}" class="btn btn-primary">Start a Conversation</a>
        </div>
        @else
        <div class="card" style="overflow:hidden;">
            @foreach($conversations as $i => $conversation)
            <a href="{{ route('chat.show', $conversation['user']->id) }}"
               style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px;text-decoration:none;border-bottom:{{ !$loop->last ? '1px solid #dcdde1' : 'none' }};background:{{ $conversation['unread_count'] > 0 ? '#f0f7ff' : 'white' }};transition:background 0.15s;"
               onmouseover="this.style.background='#f5f6fa'" onmouseout="this.style.background='{{ $conversation['unread_count'] > 0 ? '#f0f7ff' : 'white' }}'">
                <div style="display:flex;align-items:center;gap:14px;">
                    <div class="avatar" style="width:46px;height:46px;font-size:1.1rem;flex-shrink:0;background:{{ $conversation['user']->role==='employer' ? 'linear-gradient(135deg,#27ae60,#219a52)' : 'linear-gradient(135deg,#3498db,#2980b9)' }};">
                        {{ strtoupper(substr($conversation['user']->name,0,1)) }}
                    </div>
                    <div>
                        <div style="font-weight:600;color:#2c3e50;font-size:0.95rem;margin-bottom:3px;">{{ $conversation['user']->name }}</div>
                        <div style="font-size:0.78rem;color:#7f8c8d;margin-bottom:4px;">
                            <span class="role-badge role-{{ $conversation['user']->role }}" style="font-size:0.7rem;padding:2px 8px;">{{ ucfirst($conversation['user']->role) }}</span>
                        </div>
                        @if($conversation['last_message'])
                        <div style="font-size:0.85rem;color:#7f8c8d;max-width:320px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                            {{ $conversation['last_message']->sender_id === auth()->id() ? 'You: ' : '' }}{{ $conversation['last_message']->message }}
                        </div>
                        @endif
                    </div>
                </div>
                <div style="display:flex;flex-direction:column;align-items:flex-end;gap:6px;flex-shrink:0;">
                    @if($conversation['last_message'])
                    <span style="font-size:0.78rem;color:#7f8c8d;">{{ $conversation['last_message']->created_at->diffForHumans() }}</span>
                    @endif
                    @if($conversation['unread_count'] > 0)
                    <span style="background:#3498db;color:white;font-size:0.72rem;font-weight:700;padding:2px 8px;border-radius:20px;min-width:22px;text-align:center;">
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
