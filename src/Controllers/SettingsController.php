<?php

namespace Phpcollective\Settings\Controllers;

use Illuminate\Routing\Controller;
use Phpcollective\Settings\Models\Setting;
use Phpcollective\Settings\Requests\SettingsRequest as Request;
use Cache;

class SettingsController extends Controller {
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $settings = Setting::all();

        return view('vendor.phpcollective.settings.settings.index', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        Setting::truncate();
        Cache::forget('settings');
        $kyes = $request->key;
        $values = $request->value;
        $existingKeys = [];
        if(count($kyes) > 0) {
            foreach ($kyes as $i => $kye) {
                if(!empty(trim($kye)) && !in_array(trim($kye), $existingKeys)) {

                    $setting = new Setting(['key' => trim($kye), 'value' => $values[$i]]);
                    if($setting->save()) {
                        $existingKeys[] = trim($kye);
                    }
                }
            }
        }

        return redirect()->route('setting')->with('flash_message', 'Setting updated!');
    }
}
