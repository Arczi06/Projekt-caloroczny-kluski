<?php
include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];
$sql = "SELECT login_time FROM user_activity WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$activity_data = [];
while ($row = $result->fetch_assoc()) {
    $date = date('Y-m-d', strtotime($row['login_time']));
    if (!isset($activity_data[$date])) {
        $activity_data[$date] = 0;
    }
    $activity_data[$date]++;
}

echo json_encode($activity_data);

$stmt->close();
$conn->close();
?>
