<?php

namespace Iutrace\Botmaker\Commands;

use Illuminate\Console\Command;
use Iutrace\Botmaker\Jobs\UpdateWhatsappTemplatesJob;

class UpdateWhatsappTemplatesCommand extends Command
{
    protected $signature = 'botmaker:update-whatsap-templates';

    protected $description = 'Update the states of WhatsApp templates by fetching changes from the API';

    public function handle()
    {
        UpdateWhatsappTemplatesJob::dispatch();

        $this->info('Botmaker templates update job dispatched successfully.');

        return Command::SUCCESS;
    }
}