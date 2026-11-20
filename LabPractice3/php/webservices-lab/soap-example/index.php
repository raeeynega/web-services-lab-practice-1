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
 * TITLE: Lab Practice 3 - SOAP client examples index
 * OUTPUT (compilation): php -l index.php -> No syntax errors detected
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Lab Practice 3 - SOAP Clients</title>
<style>
  body { font-family: Segoe UI, Arial, sans-serif; margin: 2rem; line-height: 1.5; }
  code { background: #f2f2f2; padding: 2px 5px; border-radius: 3px; }
  li { margin: .4rem 0; }
</style>
</head>
<body>
<h1>Lab Practice 3 - SOAP Clients (PHP RPC)</h1>
<p>Clients are on port <code>8094</code>; the SOAP server endpoints are on port <code>8095</code>.</p>

<h2>Experiments</h2>
<ul>
  <li><a href="subtract-client.php">subtract-client.php</a> &rarr; subtract-server.php
      (The result of subtracting 5 and 5 is: 0)</li>
  <li><a href="multiply-client.php">multiply-client.php</a> &rarr; multiply-server.php
      (The result of multiplying 5 and 5 is: 25)</li>
  <li><a href="divide-client.php">divide-client.php</a> &rarr; divide-server.php
      (The result of dividing 5 and 5 is: 1)</li>
</ul>

<h2>Server endpoints</h2>
<ul>
  <li><a href="http://127.0.0.1:8095/webservices-lab/soap-example/subtract-server.php">subtract-server.php</a></li>
  <li><a href="http://127.0.0.1:8095/webservices-lab/soap-example/multiply-server.php">multiply-server.php</a></li>
  <li><a href="http://127.0.0.1:8095/webservices-lab/soap-example/divide-server.php">divide-server.php</a></li>
</ul>
</body>
</html>
