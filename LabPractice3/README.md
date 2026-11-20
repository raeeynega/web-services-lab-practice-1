# Web Services Lab Practice 3

Lab Practice 3 covers SOAP clients in PHP and Java:

- **1.** PHP SOAP RPC - subtraction: `subtract-server.php`, `subtract-client.php`
- **2.** PHP SOAP RPC - multiplication: `multiply-server.php`, `multiply-client.php`
- **3.** PHP SOAP RPC - division: `divide-server.php`, `divide-client.php`
- **4-7.** SOAP client Java - `RandService` WSDL/XSD and endpoint questions

The full write-up with procedures, code references, and observed output is in
`../LAB_PRACTICE_3_REPORT.md`.

## Layout

```text
LabPractice3/
  php/
    webservices-lab/soap-example/   SOAP servers, clients, and index page
  serve-clients.ps1                 Start the client pages (port 8094)
  serve-soap.ps1                    Start the SOAP endpoints (port 8095)
```

Every source file starts with the required group name, member names and IDs,
program title, and compilation/output note.

## Quick start on this machine

Apache on port 5000 and MySQL on 3307 are not needed for these examples. The PHP
built-in server is enough, and `php_soap.dll` is enabled with `-d extension=php_soap.dll`:

```powershell
.\serve-soap.ps1
.\serve-clients.ps1
```

Then open <http://127.0.0.1:8094/webservices-lab/soap-example/>.

On a normal lab machine, use the guide values: Apache on port 80 with the files
under `C:\xampp\htdocs\webservices-lab\soap-example\`, Tomcat/JWSDP on port 8080,
and `http://localhost/...` URLs in the clients.
