<?php
header('Content-Type: application/json');

// Function to get the IP of a specific interface
function getInterfaceIP($interface = 'wlan0') {
    $ip = null;

    // Use shell command to get IP
    $output = [];
    exec("ip addr show $interface", $output);

    foreach ($output as $line) {
        $line = trim($line);
        if (strpos($line, 'inet ') === 0) {
            // Split the line and get the IP before the slash
            preg_match('/inet ([0-9.]+)\//', $line, $matches);
            if (isset($matches[1])) {
                $ip = $matches[1];
                break;
            }
        }
    }
    return $ip;
}

// Example: get wlan0 IP
$lan_ip = getInterfaceIP('wlan0');

echo json_encode([
    "lan_ip" => $lan_ip
]);
