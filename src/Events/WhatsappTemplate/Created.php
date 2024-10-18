<?php

namespace App\Events\WhatsappTemplate;

use Iutrace\Botmaker\Models\WhatsappTemplate;
use Illuminate\Foundation\Events\Dispatchable;

class Created
{
    use Dispatchable;

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
