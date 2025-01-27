<?php

namespace App\Services;

use Exception;

class CarEventProcessor
{
    private CarEventHandler $carEventHandler;

    public function __construct()
    {
        $this->carEventHandler = new CarEventHandler();
    }

    /**
     * @throws Exception
     */
    public function processCSV(string $filePath): array
    {
        if (!file_exists($filePath)) {
            throw new Exception("File does not exist: $filePath");
        }

        $file = fopen($filePath, "r");

        // Пропускаем заголовок CSV
        fgetcsv($file, 1000, ",");

        while (($line = fgetcsv($file, 1000, ",")) !== false) {
            if (count($line) !== 2) continue;

            [$event, $value] = $line;

            // Преобразуем значения
            if ($value === 'true') {
                $value = true;
            } elseif ($value === 'false') {
                $value = false;
            } elseif (is_numeric($value)) {
                $value = floatval($value);
            }

            // Обрабатываем событие
            $this->carEventHandler->handleEvent($event, $value);
        }

        fclose($file);

        return $this->carEventHandler->getStatus();
    }

    public function getEventHandler(): CarEventHandler
    {
        return $this->carEventHandler;
    }
}
