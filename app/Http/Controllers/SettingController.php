<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
      
        $settings = [
            'phone'    => Setting::get('phone'),
            'email'    => Setting::get('email'),
            'facebook' => Setting::get('facebook'),
            'instagram'=> Setting::get('instagram'),
            'twitter'  => Setting::get('twitter'),
            'whatsapp' => Setting::get('whatsapp'),
        ];

        return view('settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'phone'     => 'nullable|string|max:50',
            'email'     => 'nullable|email',
            'facebook'  => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'twitter'   => 'nullable|string|max:255',
            'whatsapp'  => 'nullable|string|max:255',
        ]);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()
            ->with('success', __('messages.updated_successfully'));
    }
}
