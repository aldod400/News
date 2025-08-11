<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);
        $unreadCount = ContactMessage::unread()->count();
        
        return view('admin.contact-messages.index', compact('messages', 'unreadCount'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // Mark as read when viewed
        if (!$message->is_read) {
            $message->markAsRead();
        }
        
        return view('admin.contact-messages.show', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);
        
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
            'is_replied' => 'boolean'
        ]);
        
        $message->update([
            'admin_notes' => $request->admin_notes,
            'is_replied' => $request->has('is_replied')
        ]);
        
        return redirect()->back()->with('success', 'تم تحديث الرسالة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        
        return redirect()->route('admin.contact-messages.index')
                        ->with('success', 'تم حذف الرسالة بنجاح');
    }

    /**
     * Mark message as read
     */
    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->markAsRead();
        
        return response()->json(['success' => true]);
    }

    /**
     * Mark message as replied
     */
    public function markAsReplied($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->markAsReplied();
        
        return response()->json(['success' => true]);
    }

    /**
     * Get unread messages count for notification
     */
    public function getUnreadCount()
    {
        return response()->json([
            'count' => ContactMessage::unread()->count()
        ]);
    }
}
