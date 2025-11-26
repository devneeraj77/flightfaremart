<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    /**
     * Store a new contact message in the database.
     */
    public function store(Request $request)
    {
        // 1. Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'g-recaptcha-response' => 'nullable|recaptcha', // Optional: Add reCAPTCHA validation if you configure it
        ]);

        if ($validator->fails()) {
            return redirect()->route('contact.create')
                ->withErrors($validator)
                ->withInput();
        }

        // 2. Data Storage
        try {
            ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            // 3. Redirect with success message
            return redirect()->route('contact.create')->with('success', 'Thank you for your message! We will get back to you soon.');
        } catch (\Exception $e) {
            // Handle potential database errors
            return redirect()->route('contact.create')->with('error', 'An error occurred while saving your message. Please try again.');
        }
    }
}
