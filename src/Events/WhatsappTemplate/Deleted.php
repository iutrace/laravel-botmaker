<?php

namespace Iutrace\Botmaker\Events\WhatsappTemplate;

use Iutrace\Botmaker\Models\WhatsappTemplate;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Deleted
{
    use Dispatchable, SerializesModels;

    public $whatsappTemplate;

    public function __construct(WhatsappTemplate $whatsappTemplate)
    {
        $this->whatsappTemplate = $whatsappTemplate;
    }
}
