<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index($receiverId = null)
    {
        $authId = Auth::id(); // Menggunakan user yang login
        $authUser = User::find($authId);

        // Filter kontak berdasarkan role
        if ($authUser && $authUser->role === 'admin') {
            $contacts = User::where('id', '!=', $authId)->get();
        } else {
            $contacts = User::where('role', 'admin')->get();
        }

        // Tentukan kontak yang sedang aktif (diklik)
        $activeContact = $receiverId ? User::find($receiverId) : $contacts->first();

        $messages = [];
        if ($activeContact) {
            $messages = Message::where(function ($q) use ($authId, $activeContact) {
                $q->where('sender_id', $authId)->where('receiver_id', $activeContact->id);
            })->orWhere(function ($q) use ($authId, $activeContact) {
                $q->where('sender_id', $activeContact->id)->where('receiver_id', $authId);
            })->orderBy('created_at', 'asc')->get();
        }

        return view('pesan.index', compact('contacts', 'activeContact', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return redirect()->back();
    }
}