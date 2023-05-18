<?php

$autoload = realpath(__DIR__ . "/../../../vendor/autoload.php");
if (!file_exists($autoload)) {
    die("Autoload file not found or on path <code>$autoload</code>.");
}
require_once $autoload;

use Efi\Exception\EfiPayException;
use Efi\EfiPay;

$options = __DIR__ . "/../../credentials/options.php";
if (!file_exists($options)) {
	die("Options file not found or on path <code>$options</code>.");
}
require $options;

$params = [
	"inicio" => "2022-01-22T00:00:00Z",
	"fim" => "2024-12-31T23:59:59Z",
	// "txid" => "00000000000000000000000000000000000",
	// "txIdPresente" => true,
	// "devolucaoPresente" => false,
	// "cpf" => "12345678909", // Filter by payer's CPF. It cannot be used at the same time as the CNPJ.
	// "cnpj" => "12345678909", // Filter by payer's CNPJ. It cannot be used at the same time as the CPF.
	// "paginacao.paginaAtual" => 1,
	// "paginacao.itensPorPagina" => 10
];

try {
	$api = EfiPay::getInstance($options);
	$response = $api->pixReceivedList($params);

	print_r("<pre>" . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</pre>");
} catch (EfiPayException $e) {
	print_r($e->code . "<br>");
	print_r($e->error . "<br>");
	print_r($e->errorDescription) . "<br>";
} catch (Exception $e) {
	print_r($e->getMessage());
}
