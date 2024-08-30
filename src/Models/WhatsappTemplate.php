<?php

namespace Iutrace\Botmaker\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappTemplate extends Model
{
    protected $table = 'whatsapp_templates';

    protected $fillable = [
        'state',
        'name',
        'phone_lines_numbers',
        'bot_name',
        'category',
        'locale',
        'body',
    ];

    /**
     * Get the parent model that owns the template.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }
}
