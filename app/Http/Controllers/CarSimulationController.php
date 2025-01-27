<?php

namespace App\Http\Controllers;


use App\Services\CarEventProcessor;
use Illuminate\Http\Request;

class CarSimulationController extends Controller
{
    public function simulate(): \Illuminate\Http\JsonResponse
    {
        $events = [
            ['driver-turns-car-on', true],
            ['add-fuel', 20.2],
            ['drive', 'drive'],
            ['driver-turns-car-off', true],
            ['driver-locks-doors', true]
        ];

        $processor = new CarEventProcessor();
        foreach ($events as $event) {
            $processor->getEventHandler()->handleEvent($event[0], $event[1]);
        }

        return response()->json($processor->getEventHandler()->getStatus());
    }

    /**
     * @throws \Exception
     */
    public function simulateFromCSV(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $csvFilePath = storage_path('app/merged_events.csv');

            $processor = new CarEventProcessor();
            $status = $processor->processCSV($csvFilePath);

            return response()->json($status);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
