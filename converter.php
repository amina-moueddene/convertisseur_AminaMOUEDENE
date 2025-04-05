<?php
// filepath: converter-cli/converter.php

function showMenu() {
    echo "=== Converter CLI ===\n";
    echo "1. Convert Temperature (°C ↔ °F)\n";
    echo "2. Convert Distance (Km ↔ Miles)\n";
    echo "3. Convert Currency (EUR ↔ USD)\n";
    echo "4. Convert Mass (Kg ↔ Lb)\n";
    echo "5. Show Conversion History\n";
    echo "6. Exit\n";
    echo "Choose an option: ";
}

function convertTemperature() {
    echo "Enter temperature in Celsius: ";
    $celsius = trim(fgets(STDIN));
    $fahrenheit = ($celsius * 9/5) + 32;
    echo "$celsius °C = $fahrenheit °F\n";
    logHistory("Temperature: $celsius °C = $fahrenheit °F");
}

function convertDistance() {
    echo "Enter distance in kilometers: ";
    $km = trim(fgets(STDIN));
    $miles = $km * 0.621371;
    echo "$km Km = $miles Miles\n";
    logHistory("Distance: $km Km = $miles Miles");
}

function convertCurrency() {
    echo "Enter amount in EUR: ";
    $eur = trim(fgets(STDIN));
    echo "Enter conversion rate (1 EUR = ? USD): ";
    $rate = trim(fgets(STDIN));
    $usd = $eur * $rate;
    echo "$eur EUR = $usd USD\n";
    logHistory("Currency: $eur EUR = $usd USD (Rate: $rate)");
}

function convertMass() {
    echo "Enter mass in kilograms: ";
    $kg = trim(fgets(STDIN));
    $lb = $kg * 2.20462;
    echo "$kg Kg = $lb Lb\n";
    logHistory("Mass: $kg Kg = $lb Lb");
}

function showHistory() {
    if (file_exists("history.txt")) {
        $history = file_get_contents("history.txt");
        echo "=== Conversion History ===\n";
        echo $history;
    } else {
        echo "No history available.\n";
    }
}

function logHistory($entry) {
    $timestamp = date("Y-m-d H:i:s");
    $log = "$timestamp - $entry\n";
    file_put_contents("history.txt", $log, FILE_APPEND);
}

// Main loop
do {
    showMenu();
    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case 1:
            convertTemperature();
            break;
        case 2:
            convertDistance();
            break;
        case 3:
            convertCurrency();
            break;
        case 4:
            convertMass();
            break;
        case 5:
            showHistory();
            break;
        case 6:
            echo "Goodbye!\n";
            break;
        default:
            echo "Invalid option. Please try again.\n";
    }
    echo "\n";
} while ($choice != 6);