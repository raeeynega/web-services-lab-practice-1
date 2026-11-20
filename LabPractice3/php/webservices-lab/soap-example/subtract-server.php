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
 * TITLE: Lab Practice 3 Experiment 1 - SOAP RPC subtraction server (no WSDL)
 * OUTPUT (compilation): php -l subtract-server.php -> No syntax errors detected
 * OUTPUT (execution): subtract(5, 5) -> 0
 */

class SubtractionService
{
    public function subtract($a, $b)
    {
        return (int) $a - (int) $b;
    }
}

$uri = 'http://127.0.0.1:8095/webservices-lab/soap-example/subtract-server.php';
$server = new SoapServer(null, array('uri' => $uri));
$server->setClass('SubtractionService');
$server->handle();
