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
 * TITLE: Lab Practice 3 Experiment 2 - SOAP RPC multiplication server (no WSDL)
 * OUTPUT (compilation): php -l multiply-server.php -> No syntax errors detected
 * OUTPUT (execution): multiply(5, 5) -> 25
 */

class MultiplicationService
{
    public function multiply($a, $b)
    {
        return (int) $a * (int) $b;
    }
}

$uri = 'http://127.0.0.1:8095/webservices-lab/soap-example/multiply-server.php';
$server = new SoapServer(null, array('uri' => $uri));
$server->setClass('MultiplicationService');
$server->handle();
