<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $senderName = htmlspecialchars($_POST['sender_name']);
    
    foreach ($_POST['answers'] as $questionId => $answer) {
        $message = "Q: " . getQuestionText($questionId) . "\nA: " . htmlspecialchars($answer);
        $db->saveMessage($senderName, $message);
    }
    
    header('Location: ../index.php?success=1');
    exit;
}

function getQuestionText($questionId) {
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT question_text FROM questions WHERE id = ?");
    $stmt->bind_param("i", $questionId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()['question_text'];
}
?>