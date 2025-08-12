<?php

namespace Iutrace\Botmaker\Events\WhatsappTemplate;

use Iutrace\Botmaker\Models\WhatsappTemplate;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Deleted
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public readonly WhatsappTemplate $whatsappTemplate
    ) {}
}
