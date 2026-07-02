<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    // Show settings edit form
    public function show()
    {
        $settings = [
            'bank_name' => Setting::getValue('bank_name', 'MB Bank'),
            'bank_id' => Setting::getValue('bank_id', 'MB'),
            'bank_account_no' => Setting::getValue('bank_account_no', '0987654321'),
            'bank_account_name' => Setting::getValue('bank_account_name', 'TRAN THI THUY TRANG'),
            'sepay_webhook_token' => Setting::getValue('sepay_webhook_token', 'CAPCUTSTORESECURETOKEN2026'),
            'groq_api_key' => Setting::getValue('groq_api_key', env('GROQ_API_KEY')),
        ];

        return view('admin.settings.show', compact('settings'));
    }

    // Save settings form values
    public function update(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:50',
            'bank_id' => 'required|string|max:50',
            'bank_account_no' => 'required|string|max:50',
            'bank_account_name' => 'required|string|max:255',
            'sepay_webhook_token' => 'required|string|max:255',
            'groq_api_key' => 'nullable|string|max:255',
            'favicon' => 'nullable|image|mimes:png,ico,jpeg,jpg|max:2048',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        Setting::setValue('bank_name', $request->bank_name);
        Setting::setValue('bank_id', strtoupper($request->bank_id));
        Setting::setValue('bank_account_no', $request->bank_account_no);
        Setting::setValue('bank_account_name', strtoupper($request->bank_account_name));
        Setting::setValue('sepay_webhook_token', $request->sepay_webhook_token);
        Setting::setValue('groq_api_key', $request->groq_api_key);

        // Upload Favicon
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $file->move(public_path(), 'favicon.png');
        }

        // Upload Logo
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $file->move(public_path(), 'logo.png');
        }

        return redirect()->back()->with('success_message', 'Cập nhật cấu hình hệ thống ngân hàng, Webhook SePay & File giao diện thành công!');
    }
}
