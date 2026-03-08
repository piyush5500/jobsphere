<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display a list of all conversations for the current user.
     * Optimized to reduce N+1 queries
     */
    public function index()
    {
        $userId = Auth::id();
        
        // Get all unique user IDs from both sent and received messages in one query
        $userIds = Message::selectRaw('DISTINCT CASE 
            WHEN sender_id = ? THEN receiver_id 
            ELSE sender_id 
        END as partner_id', [$userId])
        ->where(function ($q) use ($userId) {
            $q->where('sender_id', $userId)
              ->orWhere('receiver_id', $userId);
        })
        ->pluck('partner_id')
        ->unique()
        ->values();

        if ($userIds->isEmpty()) {
            return view('chat.index', ['conversations' => collect()]);
        }
        
        // Get all users in one query
        $users = User::whereIn('id', $userIds)->get()->keyBy('id');
        
        // Get last messages for all conversations in a single query
        $lastMessages = Message::select('id', 'sender_id', 'receiver_id', 'message', 'created_at')
            ->whereIn('sender_id', $userIds)
            ->orWhereIn('receiver_id', $userIds)
            ->where(function ($q) use ($userId) {
                $q->where('sender_id', $userId)
                  ->orWhere('receiver_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($msg) use ($userId) {
                return $msg->sender_id === $userId ? $msg->receiver_id : $msg->sender_id;
            })
            ->map(function ($messages) {
                return $messages->first(); // Get the most recent
            });

        // Get unread counts in a single optimized query
        $unreadCounts = Message::select('sender_id', DB::raw('COUNT(*) as count'))
            ->where('receiver_id', $userId)
            ->whereNull('read_at')
            ->groupBy('sender_id')
            ->pluck('count', 'sender_id');

        // Build conversations collection
        $conversations = $userIds->map(function ($partnerId) use ($users, $lastMessages, $unreadCounts, $userId) {
            $user = $users->get($partnerId);
            $lastMessage = $lastMessages->get($partnerId);
            $unreadCount = $unreadCounts->get($partnerId, 0);
            
            return [
                'user' => $user,
                'last_message' => $lastMessage,
                'unread_count' => $unreadCount,
            ];
        })->sortByDesc(function ($conv) {
            return $conv['last_message'] ? $conv['last_message']->created_at->timestamp : 0;
        })->values();

        return view('chat.index', compact('conversations'));
    }

    /**
     * Display messages with a specific user.
     */
    public function show(User $user)
    {
        $currentUserId = Auth::id();
        
        // Get all messages between current user and the specified user
        $messages = Message::where(function ($q) use ($currentUserId, $user) {
            $q->where('sender_id', $currentUserId)->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($currentUserId, $user) {
            $q->where('sender_id', $user->id)->where('receiver_id', $currentUserId);
        })->orderBy('created_at', 'asc')->get();
        
        // Mark unread messages as read using optimized update
        Message::where('sender_id', $user->id)
            ->where('receiver_id', $currentUserId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('chat.show', compact('messages', 'user'));
    }

    /**
     * Send a message to a user.
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'message' => $request->message,
        ]);

        return redirect()->route('chat.show', $user->id)->with('success', 'Message sent successfully!');
    }

    /**
     * Get list of all users to start a new conversation.
     */
    public function getUsers()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('chat.users', compact('users'));
    }

    /**
     * Start a conversation with a specific user.
     */
    public function startConversation(User $user)
    {
        return redirect()->route('chat.show', $user->id);
    }
}

