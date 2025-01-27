<?php

namespace App\Models;

class Car
{
    // Состояние автомобиля
    public bool $isOn = false;
    public bool $doorsLocked = true;
    public float $fuelLevel = 10.0; // Начальный уровень топлива (литры)
    public float $odometer = 0.0; // Пробег (километры)
    public int $speed = 0; // Скорость (км/ч)
    public string $entertainment = 'radio'; // По умолчанию радио
    public array $windows = ['left' => 100, 'right' => 100]; // Окна (в процентах)

    // Включить автомобиль
    public function turnOn(): void
    {
        if (!$this->isOn) {
            $this->isOn = true;
        }
    }

    // Выключить автомобиль
    public function turnOff(): void
    {
        if ($this->isOn) {
            $this->isOn = false;
            $this->speed = 0;
        }
    }

    // Заблокировать двери
    public function lockDoors(): void
    {
        if ($this->isOn) {
            $this->doorsLocked = true;
        }
    }

    // Разблокировать двери
    public function unlockDoors(): void
    {
        if ($this->isOn) {
            $this->doorsLocked = false;
        }
    }

    // Управление окнами
    public function adjustWindows(string $action, string $side): void
    {
        if ($this->isOn) {
            if ($action === 'lower' && $this->windows[$side] > 0) {
                $this->windows[$side] = max(0, $this->windows[$side] - 50);
            } elseif ($action === 'raise' && $this->windows[$side] < 100) {
                $this->windows[$side] = min(100, $this->windows[$side] + 50);
            }
        }
    }

    // Добавить топливо
    public function addFuel(float $amount): void
    {
        $this->fuelLevel = min(50, $this->fuelLevel + $amount);
    }

    // Изменить источник развлечений
    public function changeEntertainment(string $source): void
    {
        if ($this->isOn) {
            $this->entertainment = $source;
        }
    }

    // Движение автомобиля
    public function drive(): void
    {
        if ($this->isOn && $this->fuelLevel >= 2.5) { // Расход топлива: 10 л/100 км, 25 км = 2.5 л
            $this->odometer += 25;
            $this->fuelLevel -= 2.5;
            $this->speed = 60; // Средняя скорость 60 км/ч
        }
    }

    // Остановка автомобиля
    public function stop(): void
    {
        if ($this->isOn && $this->speed > 0) {
            $this->speed = 0;
        }
    }

    // Получить статус автомобиля
    public function getStatus(): array
    {
        return [
            'isOn' => $this->isOn,
            'doorsLocked' => $this->doorsLocked,
            'fuelLevel' => $this->fuelLevel,
            'odometer' => $this->odometer,
            'speed' => $this->speed,
            'entertainment' => $this->entertainment,
            'windows' => $this->windows,
        ];
    }
}
