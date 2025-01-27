<?php

namespace App\Services;

use App\Models\Car;
use Illuminate\Support\Facades\Log;

class CarEventHandler
{
    private Car $car;

    public function __construct()
    {
        $this->car = new Car();
    }

    public function handleEvent(string $event, $value): void
    {
        // Логируем событие для отладки
        Log::info("Handling event: $event with value: $value");

        switch ($event) {
            case 'add-fuel':
                $this->car->addFuel((float) $value);
                break;
            case 'drive':
                if ($value === 'drive') {
                    $this->car->drive();
                } elseif ($value === 'stop') {
                    $this->car->stop();
                }
                break;
            case 'driver-listen-cd':
                if ($value) {
                    $this->car->changeEntertainment('cd');
                }
                break;
            case 'driver-listen-radio':
                if ($value) {
                    $this->car->changeEntertainment('radio');
                }
                break;
            case 'driver-listen-spotify':
                if ($value) {
                    $this->car->changeEntertainment('spotify');
                }
                break;
            case 'driver-locks-doors':
                if ($value) {
                    $this->car->lockDoors();
                }
                break;
            case 'driver-unlocks-doors':
                if ($value) {
                    $this->car->unlockDoors();
                }
                break;
            case 'driver-turns-car-on':
                if ($value) {
                    $this->car->turnOn();
                }
                break;
            case 'driver-turns-car-off':
                if ($value) {
                    $this->car->turnOff();
                }
                break;
            case 'driver-lowers-windows':
                $this->car->adjustWindows('lower', $value);
                break;
            case 'driver-raises-windows':
                $this->car->adjustWindows('raise', $value);
                break;
            default:
                Log::warning("Unknown event: $event with value: $value");
                break;
        }
    }

    public function getStatus(): array
    {
        return $this->car->getStatus();
    }
}
