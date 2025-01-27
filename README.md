<<<<<<< HEAD
# Car Simulation

This project is a car simulation implemented in a fresh Laravel project. The simulation includes various features such as controlling doors, windows, entertainment unit, fuel management, and driving the car. The simulation processes a list of events provided in a CSV file and returns the status of the car after the last event.

## Features

### 1. Doors
- The car has doors that can be opened and closed with a key.
- Possible events:
  - `driver-unlocks-doors`: true
  - `driver-locks-doors`: true
  - `driver-turns-car-on`: true
  - `driver-turns-car-off`: true
- The status of the doors and car is returned after processing the events.

### 2. Entertainment Unit
- The default selection in a new car is the Radio. The driver can switch between Radio, CD, and Spotify.
- Possible events:
  - `driver-listen-radio`: true
  - `driver-listen-cd`: true
  - `driver-listen-radio`: false
  - `driver-listen-cd`: false
  - `driver-listen-spotify`: true
- The simulation returns what the driver is listening to and disregards any illogical events (e.g., controlling the Entertainment Unit while the car is off). The Entertainment Unit remembers the last selection before it turns off.

### 3. Fuel
- A new car has a fuel tank with a capacity of 50 liters, initially filled with 10 liters. The car consumes fuel when driving.
- Possible events:
  - `add-fuel`: 0.1 (of full capacity)
  - `add-fuel`: 1 (full, ignore excess above full capacity)
- The simulation returns the fuel level and reports an error if the event is illogical (e.g., refueling while driving, driving without fuel). Excess fuel above capacity is ignored.

### 4. Windows
- The car is fitted with electric windows that can be lowered or raised independently in 2 steps (50% each).
- A new car starts with all windows raised 100%.
- Windows can only be lowered or raised when the car is on.
- Possible events:
  - `driver-lowers-windows`: "left" / "right"
  - `driver-raises-windows`: "left" / "right"
- The simulation returns the status of the windows in percent and disregards any illogical events (e.g., lowering windows already at 0% or raising windows already at 100%). The windows retain their last state when the car is turned off.

### 5. Bonus Part - Drive
- The driver can drive or stop the car.
- Possible events:
  - `drive`: "drive"
  - `drive`: "stop"
- Fuel economy is 10 liters per 100 km.
- Every time the car starts driving, it drives for 25 km.
