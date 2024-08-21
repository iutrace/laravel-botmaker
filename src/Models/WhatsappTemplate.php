<?php

namespace Iutrace\Botmaker\Models;

use Iutrace\Botmaker\Enums\WhatsappTemplateState;

class WhatsappTemplate
{
    public $name;
    public $state;
    public $phoneLinesNumbers;
    public $botName;
    public $category;
    public $locale;
    public $body;

    public function __construct(array $attributes = [])
    {
        $state = $attributes['state'] ?? WhatsappTemplateState::ACCOUNT_PENDING;

        if(!in_array($state, WhatsappTemplateState::allStates())){
            throw new \Exception("invalid state");
        }

        $this->state = $state;
        $this->name = $attributes['name'] ?? null;
        $this->phoneLinesNumbers = $attributes['phoneLinesNumbers'] ?? null;
        $this->botName = $attributes['botName'] ?? null;
        $this->category = $attributes['category'] ?? null;
        $this->locale = $attributes['locale'] ?? null;
        $this->body = $attributes['body'] ?? null;
    }
}
