<?php
session_start();
$user_id = $_SESSION['id'];
?>
<?php include '../database.php'; ?>
<?php include 'vocab_db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vocab_id = $_POST['vocab_id'];
    $word = $_POST['word'];
    $meaning = $_POST['meaning'];
    $pronunciation = $_POST['pronunciation'];
    $example = $_POST['example'];
    $phrase = $_POST['phrase'];
    $note = $_POST['note'];

    // Gọi hàm updateVocab để cập nhật từ vựng
    updateVocab($vocab_id, $word, $meaning, $pronunciation, $example, $phrase, $note, $user_id);

    // Chuyển hướng trở lại trang danh sách từ vựng sau khi cập nhật thành công
    // header("Location: index.php");
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
    exit();
}
?>
