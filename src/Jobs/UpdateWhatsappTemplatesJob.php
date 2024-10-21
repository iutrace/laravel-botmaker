<?php

namespace Iutrace\Botmaker\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Iutrace\Botmaker\Models\WhatsappTemplate;
use Iutrace\Botmaker\Enums\WhatsappTemplateState;
use Iutrace\Botmaker\Facades\Botmaker;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateWhatsappTemplatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
     
    public function handle()
    {
        $pendingTemplates = WhatsappTemplate::where('state', WhatsappTemplateState::BOTMAKER_PENDING)->get();

        foreach ($pendingTemplates as $template) {
            try {

                $botmakerTemplate = Botmaker::getWhatsappTemplate($template->name);

                if($botmakerTemplate->state != WhatsappTemplateState::BOTMAKER_PENDING){

                    $template->state = WhatsappTemplateState::getState($botmakerTemplate->state);
                    $template->save();
                }

            } catch (\Exception $e) {

                error_log('Error updating template state: ' . $template->id . ' - ' . $e->getMessage());
            }
        }
    }
}