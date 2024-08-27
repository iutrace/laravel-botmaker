<?php

namespace Iutrace\Botmaker\Services;

use Iutrace\Botmaker\Models\WhatsappTemplate;
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
            return new WhatsappTemplate($template);
        });
    }

    public function getWhatsappTemplate(string $templateName): WhatsappTemplate
    {
        $response = $this->client->get("/v2.0/whatsapp/templates/$templateName");   
        $data = json_decode($response->getBody()->getContents(), true);

        return new WhatsappTemplate($data);
    }
    
    public function createWhatsappTemplate($data): WhatsappTemplate
    {
        $data['phoneLineNumber'] = config('botmaker.whatsapp_number');
        
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'phoneLineNumber' => 'required|string|regex:/^\d+$/',
            'botName' => 'required|string',
            'category' => 'required|string',
            'optInImage' => 'required|url',
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