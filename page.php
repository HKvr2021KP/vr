<?php
	$my_name = "Kristi Pruul";
	$current_time = date("d.m.Y H:i:s");
	$time_html = "\n <p>Lehe avamise hetkel oli: " .$current_time .".</p> \n";
	$semester_begin = new DateTime("2021-1-25");
	$semester_end = new DateTime("2021-6-30");
	$semester_duration = $semester_begin-> diff($semester_end);
	$semester_duration_days = $semester_duration->format("%r%a");
	$semester_dur_html = "\n <p> 2021 kevadsemester kestus on " .$semester_duration_days ." päeva.</p> \n"
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="UTF-8">
	<title>Veebirakendused ja nende loomine 2021</title>
</head>
<body>
	<h1>
	<?php
		echo $my_name;
	?>
	</h1>
	<p>See leht on valminud õppetöö raames!</p>
	<?php
		echo $time_html;
		echo $semester_dur_html
	?>
	
</body>
</html>