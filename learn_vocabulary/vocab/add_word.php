<?php 

session_start();

include '../database.php';
include 'vocab_db.php';


if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    // Xử lý cập nhật từ vựng đã tồn tại
    $vocab_id = $_POST['vocab_id'];
    $word = $_POST['word'];
    $meaning = $_POST['meaning'];
    $pronunciation = $_POST['pronunciation'];
    $example = $_POST['example'];
    $phrase = $_POST['phrase'];
    $note = $_POST['note'];
    
    // Thực hiện truy vấn UPDATE
    $query = "UPDATE vocab SET vocabulary='$word', mean='$meaning', pronunciation='$pronunciation', example='$example', phrase='$phrase', note='$note' WHERE vocab_id='$vocab_id' AND user_id='$user_id'";
    $result = mysqli_query($conn, $query);
    
    // Kiểm tra và thông báo kết quả cập nhật
    if ($result) {
        echo "Cập nhật từ vựng thành công.";
    } else {
        echo "Lỗi khi cập nhật từ vựng: " . mysqli_error($conn);
    }
} 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vocab = $_POST['word'];
    $example = $_POST['example'];
    $mean = $_POST['meaning'];
    $pronunciation = $_POST['pronunciation'];
    $phrase = $_POST['phrase'];
    $note = $_POST['note'];
    $date_added = $_POST['date_added'];
    $user_id = $_SESSION['id'];
    add_word($vocab, $pronunciation, $mean, $example, $phrase, $note, $date_added, $user_id);
    header("Location: index.php");
}

?>