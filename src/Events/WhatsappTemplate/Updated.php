<?php

namespace Iutrace\Botmaker\Events\WhatsappTemplate;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Iutrace\Botmaker\Models\WhatsappTemplate;

class Updated
{
    use Dispatchable, SerializesModels;

    public $whatsappTemplate;

    public function __construct(WhatsappTemplate $whatsappTemplate)
    {
        $this->whatsappTemplate = $whatsappTemplate;
    }
}
