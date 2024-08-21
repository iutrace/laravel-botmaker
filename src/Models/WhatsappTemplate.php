<?php

namespace Iutrace\Botmaker\Models;
use Illuminate\Support\Collection;
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
        $this->name = $attributes['name'] ?? null;
        $this->state = $attributes['state'] ?? null;
        $this->phoneLinesNumbers = $attributes['phoneLinesNumbers'] ?? null;
        $this->botName = $attributes['botName'] ?? null;
        $this->category = $attributes['category'] ?? null;
        $this->locale = $attributes['locale'] ?? null;
        $this->body = $attributes['body'] ?? null;
    }
}
