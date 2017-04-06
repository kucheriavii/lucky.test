<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<script>
		//запускаємо скріпт при загрузці сторінки
		window.onload = function(){
			var result = document.getElementById('result')
			//шукаємо кнопку, щоб повісити хендлер
			var button = document.getElementById("button");
			var inputs = document.getElementsByClassName("ball");
			//вішаємо хендлери
			//на ентер
			document.onkeyup = function (e) {
				e = e || window.event;
				if (e.keyCode === 13) {
					ajaxPostReq();
				}
				return false;
			}
			//на сабміт
			button.addEventListener('click', ajaxPostReq);
			how_many = 538;// Якщо вдруг захочеться рахувати не по всіх, а по якійсь кількості. То ця змінна регулює такі запитання
			/*----------------------Аякс запит-----------*/
			function ajaxPostReq () {
				var name = new Array();
				for(i=0; i<document.getElementsByClassName("ball").length; i++){
					name[i] = document.getElementsByClassName("ball")[i].value
				}
				/*Формую строку запиту яку відсилатиму POSTом*/
			 	var sendString = "name1="+ name[0] +
			 					"&name2=" + name[1] +
			 					"&name3=" + name[2] +
			 					"&name4=" + name[3] +
			 					"&name5=" + name[4] +
			 					"&name6=" + name[5] +
								"&how_many=" + how_many;

			 	var ajax = new XMLHttpRequest();
			 	ajax.open("POST", "script.php", true);

				ajax.onreadystatechange = function(){
					validator = 0
					repeatFlag = false
					incorrectFlag = false
					lessFlag = false
					/*Валидація даних*/
					/*Перевірка чи в діапазоні*/
					for (var i = 0; i < name.length; i++) {
						if (name[i]=="") {
							lessFlag = true
							validator = 0;
						}
						else if (parseInt(name[i])>=1 && parseInt(name[i])<=52){
							validator = 1;
						} else {
							validator = 0;
							incorrectFlag = true
						}
					}
					/*перевірка чи немає дублікатів*/
					for (var i = 0; i < name.length; i++) {
						for(var j = 0; j<name.length; j++){
							if (parseInt(name[i]) == parseInt(name[j]) && i!=j){
								validator = 0;
								repeatFlag = true
							}
						}
					}
					/*кінець валідації*/
					if (ajax.readyState == 4 && lessFlag == false && incorrectFlag == false && repeatFlag == false){
						//виводимо результат
						var wons = ajax.responseText;
						console.log(wons);
						wons = wons.split(",");
						var resultMessage = "";
						for (var i = 0; i < wons.length; i++) {
							resultMessage += "<tr><td>"+(i+1)+" з 52</td><td>"+wons[i]+"</td></tr>";
						}
						if (wons[0] == "Файл .cls не знайдено")
							resultMessage = "Файл .cls не знайдено"

						result.innerHTML = "<p>За результатами "+how_many+" останніх лотерей</p><table>"+resultMessage+"</table>"
					}else{
						var errorMessage = "";
						if (incorrectFlag){
							console.log('incorrect');
							errorMessage += "<p>Введене число повинно знаходитися в діапазоні від 1 до 52</p>"
						};
						if (repeatFlag){
							console.log('repeat')
							errorMessage += "<p>Введені числа не повинні повторюватися</p>"
						};
						if (lessFlag){
							console.log('not full data')
							errorMessage += "<p>Введені не всі числа</p>"
						};
						result.innerHTML = errorMessage;
					}
				}
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send(sendString);
			}
		}
	</script>
	<div class="box">
		<input type="text" class="ball" name="ball1">
		<input type="text" class="ball" name="ball2">
		<input type="text" class="ball" name="ball3">
		<input type="text" class="ball" name="ball4">
		<input type="text" class="ball" name="ball5">
		<input type="text" class="ball" name="ball6">
		<input type="submit" id="button">
		<div id="result"></div>
	</div>
</body>
</html>
