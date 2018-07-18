<?php

namespace Phpcollective\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

    protected $table = 'collective_settings';

    protected $primaryKey = 'key';

    public $incrementing = false;

    protected $fillable = ['key', 'value'];
}
