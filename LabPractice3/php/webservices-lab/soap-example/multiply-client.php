<?php
/*
 * GROUP NAME: ______________________________
 * GROUP MEMBERS NAME AND ID:
 *   1. Bitanya Tigabe      - 0248/15
 *   2. Mohammed Elias      - 0766/15
 *   3. Awel Hussen         - 0178/15
 *   4. Raeey Nega          - 5307/16
 *   5. Hamdi Mohammes      - 0505/15
 *   6. Heyru Jemal         - 0546/15
 * TITLE: Lab Practice 3 Experiment 2 - SOAP RPC multiplication client (no WSDL)
 * OUTPUT (compilation): php -l multiply-client.php -> No syntax errors detected
 * OUTPUT (execution): The result of multiplying 5 and 5 is: 25
 */

$endpoint = 'http://127.0.0.1:8095/webservices-lab/soap-example/multiply-server.php';

$client = new SoapClient(null, array(
    'location' => $endpoint,
    'uri' => $endpoint,
    'trace' => 1,
    'exceptions' => true
));

try {
    $result = $client->multiply(5, 5);
    echo 'The result of multiplying 5 and 5 is: ' . (int) $result;
} catch (SoapFault $fault) {
    echo 'SOAP Fault: ' . htmlspecialchars($fault->getMessage(), ENT_QUOTES, 'UTF-8');
}
