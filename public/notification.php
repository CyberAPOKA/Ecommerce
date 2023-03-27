<?php

use App\Models\Order;

error_log("cheguei em notification.php");

require_once '../app/Models/Order.php';

// Verifica se a requisição foi feita via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log("entrei no 1º if");
    // Recupera o corpo da requisição
    $payload = file_get_contents('php://input');

    // Converte o JSON para um objeto PHP
    $data = json_decode($payload);

    // Verifica se o x-seller-token está correto
    $x_seller_token = "343cf74f-fdc5-4a25-93df-4ef4838b133b";
    $header_token = isset($_SERVER['HTTP_X_SELLER_TOKEN']) ? $_SERVER['HTTP_X_SELLER_TOKEN'] : '';
    if ($x_seller_token !== $header_token) {
        http_response_code(401); // Unauthorized
        die('Invalid x-seller-token');
    }

    // Atualiza o status da ordem com base na notificação recebida
    $referenceId = $data->referenceId;
    $authorizationId = $data->authorizationId;
    $status = getStatus($referenceId);
    error_log("status - " . $status);
    if ($status === 'paid') {
        Order::where('reference_id', $referenceId)->update(['status' => $status, 'authorization_id' => $authorizationId]);
    } else {
        Order::where('reference_id', $referenceId)->update(['status' => $status]);
    }

    // Retorna HTTP Status 200 para confirmar o recebimento da notificação
    http_response_code(200);
} else {
    error_log("não é post");
}

// Função para obter o status atual do pagamento no PicPay
function getStatus($referenceId)
{
    error_log("cheguei em getStatus");
    error_log($referenceId);
    $x_picpay_token = "9079c047-6827-4be2-a4d5-99974f551245";
    $url = "https://appws.picpay.com/ecommerce/public/payments/$referenceId/status";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-picpay-token: ' . $x_picpay_token));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_CAINFO, "cacert.pem");
    $res = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($res);
    return $data->status;
}
