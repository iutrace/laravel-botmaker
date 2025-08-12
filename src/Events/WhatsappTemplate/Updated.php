<?php

namespace Iutrace\Botmaker\Events\WhatsappTemplate;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Iutrace\Botmaker\Models\WhatsappTemplate;

class Updated
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public readonly WhatsappTemplate $whatsappTemplate
    ) {}
}
