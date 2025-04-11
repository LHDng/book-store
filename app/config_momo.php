<?php
// Thông tin sandbox test - không dùng cho production
define('MOMO_PARTNER_CODE', 'MOMOBKUN20180529');
define('MOMO_ACCESS_KEY', 'klm05TvNBzhg7h7j');
define('MOMO_SECRET_KEY', 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa');
define('MOMO_ENDPOINT', 'https://test-payment.momo.vn/v2/gateway/api/create');

// Hàm xử lý thanh toán Momo
function processMomoPayment($orderId, $amount, $orderInfo, $returnUrl, $notifyUrl) {
    $requestId = time() . "";
    $extraData = "";
    
    $rawHash = "accessKey=" . MOMO_ACCESS_KEY .
               "&amount=" . $amount .
               "&extraData=" . $extraData .
               "&ipnUrl=" . $notifyUrl .
               "&orderId=" . $orderId .
               "&orderInfo=" . $orderInfo .
               "&partnerCode=" . MOMO_PARTNER_CODE .
               "&redirectUrl=" . $returnUrl .
               "&requestId=" . $requestId .
               "&requestType=captureWallet";
    
    $signature = hash_hmac("sha256", $rawHash, MOMO_SECRET_KEY);
    
    $data = array(
        'partnerCode' => MOMO_PARTNER_CODE,
        'partnerName' => "Test Merchant",
        'storeId' => "store001",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $returnUrl,
        'ipnUrl' => $notifyUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => 'captureWallet',
        'signature' => $signature
    );
    
    $ch = curl_init(MOMO_ENDPOINT);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($data)))
    );
    
    $result = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($result, true);
}
?>