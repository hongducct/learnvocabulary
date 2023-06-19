<?php 

function add_word($vocab, $pronunciation, $mean, $example, $phrase, $note, $date_added, $user_id) {
	global $conn;
	$query = "INSERT INTO vocab (`vocabulary`, `pronunciation`, `mean`, `example`, `phrase`, `note`, `date_added`, `user_id`) 
				VALUES ('$vocab','$pronunciation','$mean','$example','$phrase','$note','$date_added' ,'$user_id')";
	mysqli_query($conn, $query);
}

function orderbyID($user_id) {
	global $conn;
	$query = "SELECT * FROM vocab WHERE user_id='$user_id' ORDER BY word_count DESC";

	$result = mysqli_query($conn, $query);
	return $result;
}

function orderbyEnglish($user_id) {
	global $conn;
	$query = "SELECT * FROM vocab WHERE user_id='$user_id' ORDER BY vocabulary";

	$result = mysqli_query($conn, $query);
	return $result;
}

function orderbyVietNam($user_id) {
	global $conn;
	$query = "SELECT * FROM vocab WHERE user_id='$user_id' ORDER BY mean";

	$result = mysqli_query($conn, $query);
	return $result;
}

function getVocabById($vocab_id, $user_id){
	global $conn;
	$query = "SELECT * FROM vocab WHERE word_count='$vocab_id' AND user_id='$user_id'";

	$result = mysqli_query($conn, $query);
	$result = mysqli_fetch_assoc($result);
	return $result;
}

function updateVocab($vocab_id, $word, $meaning, $pronunciation, $example, $phrase, $note, $user_id){
	global $conn;
	$query = "UPDATE vocab SET vocabulary='$word', mean='$meaning', pronunciation='$pronunciation', 
				example='$example', phrase='$phrase', note='$note' 
				WHERE word_count='$vocab_id' AND user_id='$user_id'";
	
	mysqli_query($conn, $query);
}

?>