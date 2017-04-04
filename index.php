<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php 
		function get_the_data($file_name){
		//запишемо результати для опрацювання в змінну і врахуємо що кодування в windows-1251 
			$result_of_prev_loto = iconv('windows-1251', 'utf-8', file_get_contents($file_name));
			$result_array = explode("\n", $result_of_prev_loto);
			array_shift($result_array); //канєшно не гарно дивиться, але треба вирізати ту хню (першу строчку) з масиву

			//потрібно розбити стрьомний масив на такий як мені потрібно. Тобто лише з номерами кульок. Тому я переберу масив з строк і при цьому кожну ітерацію перетворюватиму строку в масив по знаку ";" і збиратиму лише потрібні мені елементи в новий масив; 
			foreach ($result_array as $key => $value) {
				$parser = explode(";", $value); //ріжу строку на масиви
				$result_array[$key] = [
										$parser[4],
										$parser[5],
										$parser[6],
										$parser[7],
										$parser[8],
										$parser[9]
										];/*забираю лише потрібні елементи*/

			}
			return($result_array);
		}
		$result = get_the_data("SuperLoto_Results__1-538.csv");
		//print_r($result);
		$array2 = array(42, 18, 39, 10, 27, 2);
		print_r($array2);
		foreach ($result as $key => $value) {
			$a =  array_intersect($result[$key], $array2);
			echo count($a) . " совпадений. \n";
		}
	 ?>
</body>
</html>