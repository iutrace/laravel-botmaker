<?php

namespace Iutrace\Botmaker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Iutrace\Botmaker\Events\WhatsappTemplate\Updated;
use Iutrace\Botmaker\Events\WhatsappTemplate\Created;
use Iutrace\Botmaker\Events\WhatsappTemplate\Deleted;

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

    protected $casts = [
        'phone_lines_numbers' => 'array',
    ];

    /**
     * Get the parent model that owns the template.
     */
    public function model(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(function (WhatsappTemplate $whatsappTemplate) {
            Event::dispatch(new Created($whatsappTemplate));
        });

        static::updated(function (WhatsappTemplate $whatsappTemplate) {
            Event::dispatch(new Updated($whatsappTemplate));
        });

        static::deleted(function (WhatsappTemplate $whatsappTemplate) {
            Event::dispatch(new Deleted($whatsappTemplate));
        });
    }
}
