<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::all(); // Fetch all contact messages
        return view('admin.contact.contact_messages', compact('messages'));
    }
    public function destroy($id)
{
    $message = ContactMessage::findOrFail($id);
    $message->delete();

    return redirect()->back()->with('success', 'Message deleted successfully!');
}

}
