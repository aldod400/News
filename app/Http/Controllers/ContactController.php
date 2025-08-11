<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Store a new contact message
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة',
            'subject.required' => 'الموضوع مطلوب',
            'message.required' => 'الرسالة مطلوبة',
            'message.max' => 'الرسالة طويلة جداً',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'يرجى مراجعة البيانات المدخلة',
                'errors' => $validator->errors()
            ], 422, [
                'Content-Type' => 'application/json'
            ]);
        }

        try {
            // Create contact message
            $contactMessage = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Get company email from settings
            $companyEmail = SiteSetting::get('company_email', config('mail.from.address'));
            
            // Send email to company
            if ($companyEmail && filter_var($companyEmail, FILTER_VALIDATE_EMAIL)) {
                Mail::to($companyEmail)->send(new ContactFormMail($contactMessage));
            }

            return response()->json([
                'success' => true,
                'message' => 'شكراً لك! تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.',
            ], 200, [
                'Content-Type' => 'application/json'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500, [
                'Content-Type' => 'application/json'
            ]);
        }
    }
}
