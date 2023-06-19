<?php session_start(); 
$user_id = $_SESSION['id'];
?>
<?php include '../database.php'; ?>
<?php include 'vocab_db.php'; ?>
<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LEARN VOCABULARY</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="main.css">
	<script src="https://kit.fontawesome.com/836b3963ac.js" crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar">
		<h2>Sắp xếp theo:</h2>
		<ul>
			<li><a href="?action=orderby_date"><i class='fas fa-calendar-alt'></i>Ngày tháng</a></li>
			<li><a href="?action=orderby_english"><i class='fas fa-headphones'></i>Tiếng Anh</a></li>
			<li><a href="?action=orderby_vietnam"><i class='fas fa-qrcode'></i>Tiếng Việt</a></li>
		</ul>
	</nav>
	<main>
		
		<h2>Thêm từ mới</h2>
	    <form method="post" action="add_word.php">
		    <div class="form-container">
			  <div class="form-row">
			    <label for="word">Vocabulary:</label>
			    <input type="text" name="word" id="word" autocomplete="off" required>
			  </div>

			  <div class="form-row">
			    <label for="meaning">Meaning:</label>
			    <input type="text" name="meaning" id="meaning" autocomplete="off" required>
			  </div>

			  <div class="form-row">
			    <label for="pronunciation">Pronunciation:</label>
			    <input type="text" name="pronunciation" id="pronunciation" autocomplete="off">
			  </div>

			  <div class="form-row">
			    <label for="example">Example:</label>
			    <input type="text" name="example" id="example" autocomplete="off">
			  </div>

			  <div class="form-row">
			    <label for="phrase">Phrase:</label>
			    <input type="text" name="phrase" id="phrase" autocomplete="off">
			  </div>

			  <div class="form-row">
			    <label for="note">Note:</label>
			    <input type="text" name="note" id="note" autocomplete="off">
			  </div>
			</div>

			<input type="hidden" name="date_added" value="<?php echo date('Y-m-d h:i:s'); ?>">
			<input type="submit" value="Thêm từ">
	    </form>

	    <div class="inline">
	    	<h2>Danh sách từ vựng</h2>
		    <div class="dropdown">
			  <button onclick="myFunction()" class="dropbtn">Sorted</button>
			  <div id="myDropdown" class="dropdown-content">
			    <a href="?action=orderby_date"><i class='fas fa-calendar-alt'></i>Ngày tháng</a>
			    <a href="?action=orderby_english"><i class='fas fa-headphones'></i>Tiếng Anh</a>
				<a href="?action=orderby_vietnam"><i class='fas fa-qrcode'></i>Tiếng Việt</a>
			  </div>
			</div>
	    </div>
	    <?php
		    if(isset($_POST['action'])){
				$action = $_POST['action'];
			}else if (isset($_GET['action'])) {
				$action = $_GET['action'];
			}else {
				$action = 'orderby_date';
			}

			if ($action == 'orderby_date'){
		    	$result = orderbyID($user_id);
			}else if ($action == 'orderby_english'){
				$result = orderbyEnglish($user_id);
			}else if ($action == 'orderby_vietnam'){
				$result = orderbyVietNam($user_id);
			}
	    	if (mysqli_num_rows($result) > 0) {
	    		echo "<div class='table-wrapper'>";
		        echo "<table>";
		        echo "<tr><th class='width_ten'>Vocabulary</th><th class='width_ten'>Meaning</th><th class='width_ten'>Pronunciation</th><th>Example</th><th>Phrase</th><th>Note</th><th class='width_small'>Date</th></tr>";
		        while ($row = mysqli_fetch_assoc($result)) {
		            echo "<tr>";
		            echo "<td class='width_ten'>".$row['vocabulary']."</td>";
		            echo "<td class='width_ten'>".$row['mean']."</td>";
		            echo "<td class='width_ten'>".$row['pronunciation']."</td>";
		            echo "<td>".$row['example']."</td>";
		            echo "<td>".$row['phrase']."</td>";
					echo "<td>".$row['note']."</td>";
		            echo "<td class='width_small'>".$row['date_added']."</td>";
					echo "<td style='width: 0px;'><a href='edit_word.php?vocab_id=".$row['word_count']."'><i class='fas fa-edit'></i></a></td>";
		            echo "</tr>";
		        }
		        echo "</table>";
		        echo "</div>";
		    } else {
		        echo "Không có từ vựng nào.";
		    }

	     ?>
	     <?php

			// Lấy ngày hôm nay
			$today = date('Y-m-d');

			// Truy vấn từ vựng đã học trong ngày hôm nay
			$query = "SELECT COUNT(*) AS total FROM vocab WHERE DATE(date_added) = '$today' AND user_id='$user_id'";
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($result);
			$totalToday = $row['total'];

			// Lấy ngày gần nhất đã học từ
			$query = "SELECT MAX(date_added) AS last_date FROM vocab WHERE user_id='$user_id'";
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($result);
			$lastDate = $row['last_date'];

			// Tính số ngày chênh lệch giữa ngày hôm nay và ngày gần nhất đã học từ
			$diffDays = date_diff(date_create($lastDate), date_create($today))->days;

			// Hiển thị thông tin
			echo "Số từ đã học trong ngày hôm nay: $totalToday<br>";
			echo "Khoảng cách từ ngày hôm nay đến lần cuối học từ: $diffDays ngày";
			?>
		<script>
		/* When the user clicks on the button, 
		toggle between hiding and showing the dropdown content */
		function myFunction() {
		  document.getElementById("myDropdown").classList.toggle("show");
		}

		// Close the dropdown if the user clicks outside of it
		window.onclick = function(event) {
		  if (!event.target.matches('.dropbtn')) {
		    var dropdowns = document.getElementsByClassName("dropdown-content");
		    var i;
		    for (i = 0; i < dropdowns.length; i++) {
		      var openDropdown = dropdowns[i];
		      if (openDropdown.classList.contains('show')) {
		        openDropdown.classList.remove('show');
		      }
		    }
		  }
		}
		</script>
	</main>
</body>
</html>