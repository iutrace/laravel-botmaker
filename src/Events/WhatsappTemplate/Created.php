<?php

namespace Iutrace\Botmaker\Events\WhatsappTemplate;

use Iutrace\Botmaker\Models\WhatsappTemplate;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Created
{
    use Dispatchable, SerializesModels;

    public $whatsappTemplate;

    /**
     * Crea una nueva instancia del evento.
     *
     * @param  WhatsappTemplate  $whatsappTemplate
     * @return void
     */
    public function __construct(WhatsappTemplate $whatsappTemplate)
    {
        $this->whatsappTemplate = $whatsappTemplate;
    }
}
