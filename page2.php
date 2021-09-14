<?php
	$author_name = "Snufkin";
	$today = null; //$todays_evaluation ="";
	$inserted_adjective = null;
	$adjective_error = null;
	
	//Kontrollin kas on klikitud submit nuppu
	if(isset($_POST["todays_adjective_input"])){
		//echo "Klikiti nuppu!";
		//Kas kirjutati ka
		if(!empty($_POST["adjective_input"])){
			$today = "<p>tänane päev on <strong>" .$_POST["adjective_input"]."</strong>.</p>";
			$inserted_adjective = $_POST["adjective_input"];
		}else {
		$adjective_error = "Palun kirjuta tänase kohta sobiv omadussõna";}
	}
	// var_dump($_POST);
	
	// loeme kataloogi sisu 
	$photo_files = [];
	$photo_dir = "photos/";
	$allowed_photo_types = ["image/jpeg", "image/png"];
	$all_files = array_slice(scandir($photo_dir), 2);
	//<img src="pilt.jpg" alt="photo">
	foreach($all_files as $file){
		$file_info = getimagesize($photo_dir .$file);
		if(isset($file_info["mime"])){
			if(in_array($file_info["mime"],$allowed_photo_types)){
				array_push($photo_files, $file);
		
		}
		}	
	}
	
	//sõelun välja ainult lubatud pildid
	$limit = count($photo_files);
	$pic_num = mt_rand(0, $limit);
	$pic_file = $photo_files[$pic_num];
	$pic_html = '<img src="' .$photo_dir .$pic_file .'" alt="photo">';
	//fotode nimekiri
	//<p>Valida on järgmised fotod: <strong>foto1.jpg</strong>, <strong> jne...
	//<ul>Valida on järgmised fotod: <li>photo1.jpg</li>, <li>photo2.jpg</li>, <li>photo3.jpg</li></ul>
	$list_html = "<ul>";
	for($i = 0; $i < $limit; $i ++){
		$list_html .= "<li>" .$photo_files[$i] ."</li>";
	}
	$list_html .= "</ul>";

	$photo_select_html ='<select name="photo_select">'; 
	for($i = 0; $i < $limit; $i ++){
		// <option value="0">fail.jpg</option>
		$photo_select_html .= '<option value="' .$i .'">' .$photo_files[$i] ."</option>";
	}
	$photo_select_html .= "</select> \n";
?>	
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="UTF-8">
	<title><?php echo $author_name;?> Thomas Saar, veebiprogrammeerimine</title>

<body>
	<b style="font-size:60px" style="bold">Tere</b>
	<p style="background-color:tomato" style="font-size:10px">See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
	<p>Õpptetöö toimus <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank">Tallinna Ülikooli Digitehnoloogia instituudis</a></p>
	<img src=https://c.tenor.com/4gPD1ccxrVgAAAAC/rick-ashley-dance.gif alt="Spinning man on a chair" width="900" height="450">
	<hr>
	<form method="POST">
		<input type="text" name="adjective_input" placeholder="omadussõna tänase kohta" value="<?php echo $inserted_adjective; ?>"> 
		<input type="submit" name="todays_adjective_input" value="Saada ära!">
		<span><?php echo $adjective_error; ?></span>
	</form>
	<hr>
	<h2>Don't worry</h2>
	<ul>
	<li>Here enjoy a picture of a tree</li>
	</ul>
	<?php
		echo $today	;
	?>
	<form method="POST">
		<?php echo $photo_select_html; ?>
	</form>
	<?php	echo $pic_html;
		echo $list_html;
	?>
</body>
</html>