<?php

namespace App;

class Setting extends EditableModel
{
    protected $fillable = ['setting', 'setting_type', 'value', 'secured'];

    protected $casts = [
        'history' => 'array',
        'secured' => 'boolean'
    ];
}
