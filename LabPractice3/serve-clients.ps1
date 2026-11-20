param(
    [int]$Port = 8094
)

$ErrorActionPreference = "Stop"
$root = Split-Path -Parent $MyInvocation.MyCommand.Path
$docroot = Join-Path $root "php"

$php = "C:\xampp\php\php.exe"
if (-not (Test-Path -LiteralPath $php)) {
    $php = (Get-Command php -ErrorAction Stop).Source
}

Write-Host "Starting Lab 3 client pages on http://127.0.0.1:$Port ..."
Write-Host "Document root: $docroot"
$process = Start-Process -FilePath $php -ArgumentList @(
    "-d", "extension=php_soap.dll",
    "-d", "soap.wsdl_cache_enabled=0",
    "-S", "127.0.0.1:$Port",
    "-t", "`"$docroot`""
) -WindowStyle Hidden -PassThru
$process.Id | Set-Content -LiteralPath (Join-Path $env:TEMP "ws-lab3-clients.pid")
Start-Sleep -Seconds 2

Write-Host "Client process id: $($process.Id)"
Write-Host "Open http://127.0.0.1:$Port/webservices-lab/soap-example/"
Write-Host "Stop with: Stop-Process -Id (Get-Content `"$env:TEMP\ws-lab3-clients.pid`")"
