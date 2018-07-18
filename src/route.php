<?php
Route::namespace('Phpcollective\Settings\Controllers')
    ->prefix(config("settings.prefix", ''))
    ->middleware(['web', 'auth'])
    ->group(function () {
        Route::get('settings', 'SettingsController@index')->name('phpcollective-setting');
        Route::post('settings', 'SettingsController@update')->name('phpcollective-setting.update');
});