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
 * TITLE: Lab Practice 3 Experiment 3 - SOAP RPC division server (no WSDL)
 * OUTPUT (compilation): php -l divide-server.php -> No syntax errors detected
 * OUTPUT (execution): divide(5, 5) -> 1
 */

class DivisionService
{
    public function divide($a, $b)
    {
        if ((float) $b == 0.0) {
            throw new SoapFault('Client', 'Division by zero is not allowed.');
        }

        return (float) $a / (float) $b;
    }
}

$uri = 'http://127.0.0.1:8095/webservices-lab/soap-example/divide-server.php';
$server = new SoapServer(null, array('uri' => $uri));
$server->setClass('DivisionService');
$server->handle();
