<?php
	require_once "usesession.php";		// ainult sisseloginud kasutajale
	require_once "../../../conf.php";
	require_once "fnc_general.php";	
							// paneme juhise kus on serveri andmed/
	$photo_upload_error = null;
	$image_file_type = null;
	$image_file_name = null;
	$file_name_prefix = "vr_";
	$file_size_limit = 2 * 1024 * 1024;

	if(isset($_POST["photo_submit"])){
		//var_dump($_POST);
		//var_dump($_FILES);
		//kas üldse on pilt
		$check = getimagesize($_FILES["file_input"]["tmp_name"]);
		if ( $check !== false) {
			//kontorllime, kas aktsepteeritud failivorming ja fikseerime laiendi
			if ($check["mime"] == "image/jpeg") {	$image_file_type = "jpg";	
			} elseif ($check["mime"] == "image/png") {
				$image_file_type = "png";
			} elseif ($check["mime"] == "image/jpg") {
				$image_file_type = "jpg";
			} else {
				$photo_upload_error = "Pole sobiv formaat ainult jpg ja png on lubatud";
			}
		} else {
			$photo_upload_error = "Tegemist ei ole pildifailiga";
		}
		//alustame kontrolli
		if(empty($photo_upload_error)) {
			//ega pole liiga suur fail
			if($_FILES["file_input"]["size"] > $file_size_limit) {
				$photo_upload_error = "Valitud fail on liiga suur lubatud kuni 2MB!";
			}

			if(empty($photo_upload_error)){
			//loome oma failinime:
				$timestamp = microtime(1) * 10000;
				$image_file_name = $file_name_prefix .$timestamp ."." .$image_file_type;


				//$target_file = "../upload_photos.orig/" .$_FILES["file_input"] ["name"];
				$target_file = "../upload_photos.orig/" .$image_file_name;
				// faili olemasolu kontroll
				//if(file_exists($target_file))
				if (move_uploaded_file($_FILES["file_input"]["tmp_name"], $target_file)) {
					$photo_upload_error = "Foto üleslaadimine õnnestus!";
				} else {
					$photo_upload_error .= "Foto üleslaadimine ebaõnnestus!";
				}
			}
		}
	}



?>

<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="UTF-8">
	<title>Veebirakendused ja nende loomine 2021</title>
</head>
<body>
	<h1>Fotode üleslaadimine</h1>
	<p>See leht on valminud õppetöö raames!</p>
	<hr>

	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		<label for="file_input">Vali foto fail!</label>
		<input id="file_input" name="file_input" type="file">
		<br>
		<input type="submit" name="photo_submit" value="Lae pilt üles!">
		<br>
	</form>
	<p><?php echo $photo_upload_error; ?></p>
	<p> <a href="home.php">Tagasi avalehele</a></p>
	<p><a href="?logout=1">Logi välja</a></p>
</body>
</html>