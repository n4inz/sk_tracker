<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
class ChatController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Chat');
    }

    public function storeChat(Request $request)
    {
       
        $user = $request->user();
        $request->validate([
            'body' => 'required'  
        ]);

        Chat::create([
            'user_id' => $user->id,
            'body' => $request->body
        ]);

        return Redirect::route('chat')->with('success', 'Data berhasil disimpan!');
    }

    public function getMessages(Request $request)
    {
       
        $messages = Chat::query()->with('user:id,username')->select('body', 'user_id')->get();
        // return $messages;

        return response()->json([
            'data' => $messages
        ]);
       
        
    }
}
