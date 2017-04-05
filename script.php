<?php error_reporting( E_ERROR ); ?>
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
		//print_r($result);
		function sort_wons($last_lothery_results)
		{
	//		$result = get_the_data("SuperLoto_Results__1-538.csv");
			$players_balls = array(
				$_POST['name1'],
				$_POST['name2'],
				$_POST['name3'],
				$_POST['name4'],
				$_POST['name5'],
				$_POST['name6']);
				//$players_balls = array(53,38,28,18,5,44);
			$sorted_results = array(0,0,0,0,0,0);
			foreach ($last_lothery_results as $key => $value) {
				$a =  array_intersect($last_lothery_results[$key], $players_balls);
				switch (count($a)) {
					case "1":
						$sorted_results[0]++;
						break;
					case "2":
						$sorted_results[1]++;
						break;
					case "3":
						$sorted_results[2]++;
						break;
					case "4":
						$sorted_results[3]++;
						break;
					case "5":
						$sorted_results[4]++;
						break;
					case "6":
						$sorted_results[5]++;
						break;

					default:
						# code...
						break;
				}
				//echo count($a) . " совпадений. \n";

			}
				return "$sorted_results[0],$sorted_results[1],$sorted_results[2],$sorted_results[3],$sorted_results[4],$sorted_results[5]";
		}
		$result = get_the_data("SuperLoto_Results__1-538.csv");
		print_r(sort_wons($result));

	 ?>
