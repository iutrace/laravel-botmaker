<?php

namespace Iutrace\Botmaker\Traits;

use Iutrace\Botmaker\Models\WhatsappTemplate;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasWhatsappTemplates
{
    public function whatsappTemplates(): MorphMany
    {
        return $this->morphMany(WhatsappTemplate::class, 'model');
    }
}