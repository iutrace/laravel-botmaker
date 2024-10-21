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

    /**
     * Get the parent model that owns the template.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * The "boot" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($whatsappTemplate) {
            Event::dispatch(new Created($whatsappTemplate));
        });

        static::updated(function ($whatsappTemplate) {
            Event::dispatch(new Updated($whatsappTemplate));
        });

        static::deleted(function ($whatsappTemplate) {
            Event::dispatch(new Deleted($whatsappTemplate));
        });
    }
}
