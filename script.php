<?php error_reporting( E_ERROR ); ?>
<?php
		function get_the_data($file_name){
		//запишемо результати для опрацювання в змінну і врахуємо що кодування в windows-1251
			if (file_exists($file_name)){ //якщо файл існує то обробляємо його
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
			} else {
				return "Файл .cls не знайдено";//якщо файла не знайшов то вернемо таку стрічку
			}
		}
		//print_r($result);
		function sort_wons($last_lothery_results)
		{
			//$last_lothery_results - містить в собі або оброблений масив або дані про помилку
			//якщо в змінній $last_lothery_results дані про помилку завершуємо роботу і передаємо рядок з помилкою
			if ($last_lothery_results == "Файл .cls не знайдено"){
				return "Файл .cls не знайдено";
			}
	//		$result = get_the_data("SuperLoto_Results__1-538.csv");
	/*Приймаємо дані передані користувачем з index.php*/
			$players_balls = array(
				$_POST['name1'],
				$_POST['name2'],
				$_POST['name3'],
				$_POST['name4'],
				$_POST['name5'],
				$_POST['name6']);
			$how_many = $_POST['how_many'];//скільки останніх результатів дивитися
			$sorted_results = array(0,0,0,0,0,0);
//			foreach ($last_lothery_results as $key => $value) {
for($i=0; $i<$how_many; $i++){
				$repeats =  array_intersect($last_lothery_results[$i], $players_balls);//це базова ф-ція. Перевіряє кількість співпавших знаків в массивах
//в $repeats зберігається кількість збігів для конкретного розіграшу,
//оскільки ми ЗАРАЗ бігаємо в массиві з всіма розіграшами
//то розсортувавши дані отримані з $repeats ми отримаєми скільки і яких збігів було
				switch (count($repeats)) {
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
						// тут можна рахувати 0, щоб в результаті отримати кількість останніх лотерей
						break;
				}
			}
			//сформуємо массив який передамо аяксом для обробки
				return "$sorted_results[0],$sorted_results[1],$sorted_results[2],$sorted_results[3],$sorted_results[4],$sorted_results[5]";
		}
		$result = get_the_data("SuperLoto_Results__1-538.csv");
		print_r(sort_wons($result));

	 ?>
