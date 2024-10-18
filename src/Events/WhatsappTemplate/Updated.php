<?php

namespace App\Events\WhatsappTemplate;

use Iutrace\Botmaker\Models\WhatsappTemplate;
use Illuminate\Foundation\Events\Dispatchable;

class Updated
{
    use Dispatchable;

    public $whatsappTemplate;

    public function __construct(WhatsappTemplate $whatsappTemplate)
    {
        $this->whatsappTemplate = $whatsappTemplate;
    }
}
