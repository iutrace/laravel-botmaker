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
                'phone_lines_numbers' => json_encode($template['phoneLinesNumbers']),
                'bot_name' => $template['botName'] ?? null,
                'category' => $template['category'] ?? null,
                'locale' => $template['locale'] ?? null,
                'body' => json_encode($template['body']),
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
            'phone_lines_numbers' => json_encode($template['phoneLinesNumbers']),
            'bot_name' => $template['botName'] ?? null,
            'category' => $template['category'] ?? null,
            'locale' => $template['locale'] ?? null,
            'body' => json_encode($template['body']),
        ]);
    }
    
    public function createWhatsappTemplate($data): WhatsappTemplate
    {
        $data['phone_lines_numbers'] ?? config('botmaker.whatsapp_number');
        
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'phone_lines_numbers' => 'required|string|regex:/^\d+$/',
            'bot_name' => 'required|string',
            'category' => 'required|string',
            'locale' => 'required|string',
            'body.text' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        $response = $this->client->post('/v2.0/whatsapp/templates', [
            'body' => json_encode($data),
        ]);
        $newTemplate = json_decode($response->getBody()->getContents(), true);

        return new WhatsappTemplate($newTemplate);
    }

    public function deleteWhatsappTemplate(string $templateName)
    {
        $response = $this->client->delete("/v2.0/whatsapp/templates/$templateName"); 
        return $response->getBody();
    }
}