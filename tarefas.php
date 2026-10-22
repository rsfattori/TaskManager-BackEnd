<?php

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
	http_response_code(405);
	echo json_encode(["mensagem" => "Método não permitido"]);
	exit;
}

if (isset($_GET["erro"])) {
	http_response_code(500);
	echo json_encode(["mensagem" => "Erro interno no servidor"]);
	exit;
}

if (isset($_GET["vazio"])) {
	echo json_encode([]);
	exit;
}

$conteudo = file_get_contents(__DIR__ . "/tarefas.json");
$tarefas = json_decode($conteudo, true);

if ($tarefas === null) {
	http_response_code(500);
	echo json_encode(["mensagem" => "Não foi possível ler as tarefas"]);
	exit;
}

echo json_encode($tarefas);
