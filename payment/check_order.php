<?php
include "../pages/dbFunctions.php";
include "../pages/dbInfo.php";

header('Content-Type: application/json');

if ($conn->connect_error) {
    echo json_encode([
        "status" => "ERROR",
        "message" => "Database connection failed"
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "ERROR",
        "message" => "Invalid request method"
    ]);
    exit;
}

$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
$data = [];

if (stripos($contentType, 'application/json') !== false) {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);
} elseif (stripos($contentType, 'application/x-www-form-urlencoded') !== false) {
    $data = $_POST;
} else {
    echo json_encode([
        "status" => "ERROR",
        "message" => "Unsupported Content-Type"
    ]);
    exit;
}

if (!is_array($data)) {
    echo json_encode([
        "status" => "ERROR",
        "message" => "Invalid JSON data"
    ]);
    exit;
}

$user_token = $data['user_token'] ?? '';
$order_id   = $data['order_id'] ?? '';

if (empty($user_token) || empty($order_id)) {
    echo json_encode([
        "status" => "ERROR",
        "message" => "user_token and order_id are required"
    ]);
    exit;
}

$sql = "SELECT status, amount, utr, customer_mobile, remark1, remark2, create_date 
        FROM orders 
        WHERE user_token = ? AND order_id = ? 
        LIMIT 1";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "status" => "ERROR",
        "message" => "SQL prepare failed"
    ]);
    exit;
}

$stmt->bind_param("ss", $user_token, $order_id);
$stmt->execute();

$stmt->bind_result(
    $db_status,
    $amount,
    $utr,
    $customer_mobile,
    $remark1,
    $remark2,
    $create_date
);

if ($stmt->fetch()) {

    if ($db_status === 'SUCCESS') {

        echo json_encode([
            "status" => "COMPLETED",
            "message" => "Transaction Successfully",
            "result" => [
                "txnStatus" => "COMPLETED",
                "resultInfo" => "Transaction Success",
                "orderId" => $order_id,
                "status" => $db_status,
                "amount" => $amount,
                "date" => $create_date,
                "utr" => $utr,
                "customer_mobile" => $customer_mobile,
                "remark1" => $remark1,
                "remark2" => $remark2
            ]
        ]);
        exit;

    } elseif ($db_status === 'FAILED') {

        echo json_encode([
            "status" => "FAILURE",
            "message" => "Transaction Failed",
            "result" => [
                "txnStatus" => "FAILURE",
                "resultInfo" => "Transaction Failed",
                "orderId" => $order_id,
                "status" => $db_status,
                "amount" => $amount,
                "date" => $create_date,
                "utr" => $utr
            ]
        ]);
        exit;

    } elseif ($db_status === 'PENDING') {

        echo json_encode([
            "status" => "PENDING",
            "message" => "Transaction is pending",
            "result" => [
                "txnStatus" => "PENDING",
                "resultInfo" => "Transaction Pending",
                "orderId" => $order_id,
                "status" => $db_status,
                "amount" => $amount,
                "date" => $create_date,
                "utr" => $utr
            ]
        ]);
        exit;

    } else {

        echo json_encode([
            "status" => "PENDING",
            "message" => "Transaction status not updated yet",
            "result" => [
                "txnStatus" => "PENDING",
                "resultInfo" => "Waiting for payment update",
                "orderId" => $order_id,
                "status" => $db_status,
                "amount" => $amount,
                "date" => $create_date,
                "utr" => $utr
            ]
        ]);
        exit;
    }

} else {
    echo json_encode([
        "status" => "ERROR",
        "message" => "Order not found"
    ]);
    exit;
}
?>

