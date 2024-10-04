<?php

namespace Iutrace\Botmaker\Services;

use Iutrace\Botmaker\Models\WhatsappTemplate;
use Iutrace\Botmaker\Enums\WhatsappTemplateState;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class BotmakerService
{
    public $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('botmaker.base_url'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'access-token' => config('botmaker.access_token'),
            ],
        ]);
    }

    public function listWhatsappTemplates(): Collection
    {
        $response = $this->client->get("/v2.0/whatsapp/templates");
        $data = json_decode($response->getBody()->getContents(), true);

        return collect($data['items'])->map(function ($template) {

            return new WhatsappTemplate([
                'state' => WhatsappTemplateState::getState($template['state']),
                'name' => $template['name'] ?? null,
                'phone_line_number' => $template['phoneLinesNumbers'][0],
                'bot_name' => $template['botName'] ?? null,
                'category' => $template['category'] ?? null,
                'locale' => $template['locale'] ?? null,
                'body' => trim($template['body']['text'], '"'),
            ]);
        });
    }

    public function getWhatsappTemplate(string $templateName): WhatsappTemplate
    {
        $response = $this->client->get("/v2.0/whatsapp/templates/$templateName");   
        $template = json_decode($response->getBody()->getContents(), true);

        return new WhatsappTemplate([
            'state' => WhatsappTemplateState::getState($template['state']),
            'name' => $template['name'] ?? null,
            'phone_lines_numbers' => $template['phoneLinesNumbers'][0],
            'bot_name' => $template['botName'] ?? null,
            'category' => $template['category'] ?? null,
            'locale' => $template['locale'] ?? null,
            'body' => trim($template['body']['text'], '"'),
        ]);
    }
    
    public function createWhatsappTemplate($data)
    {            
        $response = $this->client->post('/v2.0/whatsapp/templates', [
            'body' => json_encode($data),
        ]);

        $newTemplate = json_decode($response->getBody()->getContents(), true);

        return new WhatsappTemplate([
            'state' => WhatsappTemplateState::getState($newTemplate['state']),
            'name' => $newTemplate['name'] ?? null,
            'phone_line_number' => $newTemplate['phoneLinesNumbers'][0],
            'bot_name' => $newTemplate['botName'] ?? null,
            'category' => $newTemplate['category'] ?? null,
            'locale' => $newTemplate['locale'] ?? null,
            'body' => trim($newTemplate['body']['text'], '"'),
        ]);
    }

    public function deleteWhatsappTemplate(string $templateName)
    {
        $response = $this->client->delete("/v2.0/whatsapp/templates/$templateName"); 
        return $response->getBody();
    }
}