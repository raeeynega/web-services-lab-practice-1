# Web Services Lab Practice 3

**GROUP NAME:** ______________________________

**GROUP MEMBERS NAME AND ID:**

| # | Name | ID |
|---|---|---|
| 1 | Bitanya Tigabe | 0248/15 |
| 2 | Mohammed Elias | 0766/15 |
| 3 | Awel Hussen | 0178/15 |
| 4 | Raeey Nega | 5307/16 |
| 5 | Hamdi Mohammes | 0505/15 |
| 6 | Heyru Jemal | 0546/15 |

**Course:** Web Services

**Date:** 20 November 2026

---

## Environment and Important Note

The lab guide uses:

- PHP with the SOAP extension (`extension=php_soap.dll` uncommented in `php.ini`)
- Tomcat/JWSDP on `http://localhost:8080` for the Java `RandService`
- Apache web root `C:\xampp\htdocs\webservices-lab\soap-example\`

On this machine the SOAP examples were run with the PHP 8.2.12 built-in server,
with the extension enabled at startup using `-d extension=php_soap.dll`:

- SOAP endpoints: `http://127.0.0.1:8095/webservices-lab/soap-example/`
- Client pages: `http://127.0.0.1:8094/webservices-lab/soap-example/`

Ports 8094/8095 avoid the Lab Practice 2 servers on 8090/8092. On a lab machine
use the guide values (Apache on port 80, Tomcat on 8080). The Java questions are
answered from the WSDL published in the lab guide; the ZIP with the `randTcat`
sources was not part of the files sent for this practice, so the Java service was
not deployed locally.

**Verification summary**

| Experiment | Status |
|---|---|
| 1. SOAP RPC subtraction (PHP) | Done - `The result of subtracting 5 and 5 is: 0` |
| 2. SOAP RPC multiplication (PHP) | Done - `The result of multiplying 5 and 5 is: 25` |
| 3. SOAP RPC division (PHP) | Done - `The result of dividing 5 and 5 is: 1` |
| 4. `curl ...?xsd=1` | Answered - generated XML Schema shown below |
| 5. Browser `?WSDL` | Answered - generated WSDL shown below |
| 6. Browser `?xsd=1` | Answered - same schema as experiment 4 |
| 7. Browser `/rand/RandPublisher` | Answered - HTTP 404, not a published endpoint |

---

## Experiment 1: SOAP RPC - Subtraction

### Aim

Define a remote method that subtracts two numbers on a SOAP server, register the
method with a `SoapServer`, and call it remotely with a `SoapClient`.

### Files

- `LabPractice3/php/webservices-lab/soap-example/subtract-server.php`
- `LabPractice3/php/webservices-lab/soap-example/subtract-client.php`

### Procedure

1. Declared `SubtractionService::subtract($a, $b)` on the server.
2. Created the server in no-WSDL mode:
   `new SoapServer(null, array('uri' => $uri))`, registered the class with
   `setClass('SubtractionService')`, and called `handle()`.
3. Created the client with `location` and `uri` pointing at the server script:
   `new SoapClient(null, array('location' => $endpoint, 'uri' => $endpoint, ...))`.
4. Called `$client->subtract(5, 5)` and printed the response. A `try/catch`
   block reports any `SoapFault`.

### Output

```text
The result of subtracting 5 and 5 is: 0
```

Compilation check:

```text
php -l subtract-server.php -> No syntax errors detected
php -l subtract-client.php -> No syntax errors detected
```

### Explanation

In non-WSDL mode the first argument to `SoapServer`/`SoapClient` is `null`, so
both sides agree on the `uri` and the client uses `location` to find the PHP
endpoint. `setClass()` exposes the public methods of the class as RPC
operations; `handle()` reads the SOAP request from `POST`, invokes `subtract`
and writes the SOAP response. The client sees `subtract` as if it were a local
method even though the subtraction runs on the other HTTP server.

---

## Experiment 2: SOAP RPC - Multiplication

### Aim

Do the same as Experiment 1 for multiplication of two numbers.

### Files

- `LabPractice3/php/webservices-lab/soap-example/multiply-server.php`
- `LabPractice3/php/webservices-lab/soap-example/multiply-client.php`

### Procedure

1. Declared `MultiplicationService::multiply($a, $b)` on the server.
2. Created a `SoapServer` in no-WSDL mode and registered the class.
3. Created a `SoapClient` pointing at `multiply-server.php`.
4. Called `$client->multiply(5, 5)` and printed the result.

### Output

```text
The result of multiplying 5 and 5 is: 25
```

Compilation check:

```text
php -l multiply-server.php -> No syntax errors detected
php -l multiply-client.php -> No syntax errors detected
```

### Explanation

Only the operation name and implementation change; the SOAP plumbing is the
same as in Experiment 1. This shows that a SOAP server can register any class
and that the client only needs the endpoint and URI to call the published
methods.

---

## Experiment 3: SOAP RPC - Division

### Aim

Do the same as Experiment 1 for division of two numbers.

### Files

- `LabPractice3/php/webservices-lab/soap-example/divide-server.php`
- `LabPractice3/php/webservices-lab/soap-example/divide-client.php`

### Procedure

1. Declared `DivisionService::divide($a, $b)` on the server.
2. Rejected a zero divisor with `SoapFault` so the error is returned as a SOAP
   fault rather than a PHP warning.
3. Created the `SoapServer` and registered the class.
4. Created the `SoapClient`, called `$client->divide(5, 5)`, and printed the
   result.

### Output

```text
The result of dividing 5 and 5 is: 1
```

Compilation check:

```text
php -l divide-server.php -> No syntax errors detected
php -l divide-client.php -> No syntax errors detected
```

### Explanation

The return value is cast to `float`, so `5 / 5` is printed as `1`. Throwing
`SoapFault` on the server turns an invalid argument into a structured SOAP
fault, which the client catches and prints as `SOAP Fault: ...`.

---

## Experiment 4: SOAP Client Java - `curl http://localhost:8080/rand/?xsd=1`

### Aim

Inspect the XML Schema that JAX-WS generates dynamically for `RandService`.

### Procedure

1. Build and deploy `randTcat` as in the guide (`ant -Dwar.name=rand deploy`).
2. Confirm the service is running: `curl http://localhost:8080/rand/?wsdl`.
3. Request the schema:

```powershell
curl http://localhost:8080/rand/?xsd=1
```

### Output

```xml
<?xml version='1.0' encoding='UTF-8'?>
<!-- Published by JAX-WS RI at http://jax-ws.dev.java.net. RI's version is JAX-WS RI 2.2.1-hudson-28-. -->
<xs:schema xmlns:tns="http://rand/" xmlns:xs="http://www.w3.org/2001/XMLSchema" version="1.0" targetNamespace="http://rand/">
  <xs:element name="next1" type="tns:next1"/>
  <xs:element name="next1Response" type="tns:next1Response"/>
  <xs:element name="nextN" type="tns:nextN"/>
  <xs:element name="nextNResponse" type="tns:nextNResponse"/>
  <xs:complexType name="nextN">
    <xs:sequence>
      <xs:element name="arg0" type="xs:int" minOccurs="0"/>
    </xs:sequence>
  </xs:complexType>
  <xs:complexType name="nextNResponse">
    <xs:sequence>
      <xs:element name="return" type="tns:arrayOfint" minOccurs="0"/>
    </xs:sequence>
  </xs:complexType>
  <xs:complexType name="arrayOfint">
    <xs:sequence>
      <xs:element name="item" type="xs:int" minOccurs="0" maxOccurs="unbounded"/>
    </xs:sequence>
  </xs:complexType>
  <xs:complexType name="next1">
    <xs:sequence/>
  </xs:complexType>
  <xs:complexType name="next1Response">
    <xs:sequence>
      <xs:element name="return" type="xs:int"/>
    </xs:sequence>
  </xs:complexType>
</xs:schema>
```

### Explanation

The `xsd=1` query asks the JAX-WS runtime for the first schema document of the
deployed endpoint. It is generated from the Java method signatures:

- `int next1()` becomes an empty request element and an `xs:int` `return`.
- `int[] nextN(int n)` becomes a request with `arg0: xs:int` and a response
  containing `arrayOfint`, whose `item` can repeat (the array elements).

The WSDL imports this schema with
`<xsd:import namespace="http://rand/" schemaLocation="http://localhost:8080/rand?xsd=1"/>`.
Exact comment text can differ between JAX-WS RI versions; the element and type
definitions are the same.

---

## Experiment 5: SOAP Client Java - `localhost:8080/rand/?WSDL`

### Aim

View the WSDL document published by the deployed `RandService`.

### Procedure

Open `http://localhost:8080/rand/?WSDL` in the browser (uppercase `WSDL` is
accepted by the JAX-WS HTTP adapter).

### Output

```xml
<?xml version='1.0' encoding='UTF-8'?>
<!-- Published by JAX-WS RI at http://jax-ws.dev.java.net. RI's version is JAX-WS RI 2.2.1-hudson-28-. -->
<!-- Generated by JAX-WS RI at http://jax-ws.dev.java.net. RI's version is JAX-WS RI 2.2.1-hudson-28-. -->
<definitions xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" xmlns:wsp="http://www.w3.org/ns/ws-policy" xmlns:wsp1_2="http://schemas.xmlsoap.org/ws/2004/09/policy" xmlns:wsam="http://www.w3.org/2007/05/addressing/metadata" xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/" xmlns:tns="http://rand/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="http://schemas.xmlsoap.org/wsdl/" targetNamespace="http://rand/" name="RandServiceService">
  <types>
    <xsd:schema>
      <xsd:import namespace="http://rand/" schemaLocation="http://localhost:8080/rand?xsd=1"/>
    </xsd:schema>
  </types>
  <message name="next1">
    <part name="parameters" element="tns:next1"/>
  </message>
  <message name="next1Response">
    <part name="parameters" element="tns:next1Response"/>
  </message>
  <message name="nextN">
    <part name="parameters" element="tns:nextN"/>
  </message>
  <message name="nextNResponse">
    <part name="parameters" element="tns:nextNResponse"/>
  </message>
  <portType name="RandService">
    <operation name="next1">
      <input wsam:Action="http://rand/RandService/next1Request" message="tns:next1"/>
      <output wsam:Action="http://rand/RandService/next1Response" message="tns:next1Response"/>
    </operation>
    <operation name="nextN">
      <input wsam:Action="http://rand/RandService/nextNRequest" message="tns:nextN"/>
      <output wsam:Action="http://rand/RandService/nextNResponse" message="tns:nextNResponse"/>
    </operation>
  </portType>
  <binding name="RandServicePortBinding" type="tns:RandService">
    <soap:binding transport="http://schemas.xmlsoap.org/soap/http" style="document"/>
    <operation name="next1">
      <soap:operation soapAction=""/>
      <input><soap:body use="literal"/></input>
      <output><soap:body use="literal"/></output>
    </operation>
    <operation name="nextN">
      <soap:operation soapAction=""/>
      <input><soap:body use="literal"/></input>
      <output><soap:body use="literal"/></output>
    </operation>
  </binding>
  <service name="RandServiceService">
    <port name="RandServicePort" binding="tns:RandServicePortBinding">
      <soap:address location="http://localhost:8080/rand"/>
    </port>
  </service>
</definitions>
```

### Explanation

The WSDL is the service contract. `portType` lists the two operations,
`binding` says they use SOAP 1.1 over HTTP with document/literal messages, and
`service/port` gives the physical endpoint `http://localhost:8080/rand`. The
`types` section imports the XSD from Experiment 4, which defines the request
and response elements.

---

## Experiment 6: SOAP Client Java - `localhost:8080/rand/?xsd=1`

### Aim

View the same generated XML Schema in the browser instead of `curl`.

### Output

The browser displays the XML from Experiment 4 (in browsers without an XML
stylesheet it is shown as the document tree). The document starts with
`<?xml version='1.0' encoding='UTF-8'?>` and its root is
`<xs:schema ... targetNamespace="http://rand/">` containing `next1`,
`next1Response`, `nextN`, `nextNResponse`, and `arrayOfint` definitions.

### Explanation

`curl` and the browser issue the same HTTP GET request, so the JAX-WS runtime
returns the same dynamically generated schema. The only difference is
presentation: `curl` prints the XML text while the browser renders it as XML.

---

## Experiment 7: SOAP Client Java - `http://localhost:8080/rand/RandPublisher`

### Aim

Check what happens when the publisher class name is requested as a URL.

### Output

```text
HTTP Status 404 - /rand/RandPublisher

type Status report
message /rand/RandPublisher
description The requested resource is not available.
```

### Explanation

`RandPublisher` is only a Java class with a `main` method that calls
`Endpoint.publish(url, new RandService())`. It is not a servlet and it is not
mapped in `web.xml`/`sun-jaxws.xml`. The only published endpoint is
`http://localhost:8080/rand` (with `?WSDL` and `?xsd=1` for metadata), so
`/rand/RandPublisher` has no handler and Tomcat responds with 404.

---

## How to Run the PHP Experiments

From the `LabPractice3` folder:

```powershell
.\serve-soap.ps1
.\serve-clients.ps1
```

Then open <http://127.0.0.1:8094/webservices-lab/soap-example/> and choose one
of the three clients. Stop the servers with:

```powershell
Stop-Process -Id (Get-Content "$env:TEMP\ws-lab3-soap.pid")
Stop-Process -Id (Get-Content "$env:TEMP\ws-lab3-clients.pid")
```

On a lab machine, copy `php/webservices-lab` into `C:\xampp\htdocs\`, enable
`extension=php_soap.dll` in `php.ini`, restart Apache, and open
`http://localhost/webservices-lab/soap-example/`.
