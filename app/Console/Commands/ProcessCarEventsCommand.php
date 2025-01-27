<?php

namespace App\Console\Commands;

use App\Services\CarEventProcessor;
use Illuminate\Console\Command;

class ProcessCarEventsCommand extends Command
{
    protected $signature = 'car:process-events {file}';
    protected $description = 'Process car events from a CSV file';

    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        $filePath = $this->argument('file');

        $processor = new CarEventProcessor();
        $status = $processor->processCSV($filePath);

        // Преобразуем массив windows в строку
        $status['windows'] = json_encode($status['windows']);

        $this->info("Final car status:");
        $this->table(array_keys($status), [$status]);
    }
}
