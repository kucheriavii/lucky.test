<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<!--	<form action="script.php" method="POST">
		<input type="text" class="ball1" name="ball1">
		<input type="text" class="ball2" name="ball2">
		<input type="text" class="ball3" name="ball3">
		<input type="text" class="ball4" name="ball4">
		<input type="text" class="ball5" name="ball5">
		<input type="text" class="ball6" name="ball6">
		<input type="submit">
	</form> -->
	<script>
		//запускаємо скріпт при загрузці сторінки
		window.onload = function(){
			var result = document.getElementById('result')
			//шукаємо кнопку, щоб повісити хендлер
			var button = document.getElementById("button");
			//вішаємо хендлер
			button.addEventListener('click', ajaxPostReq);
			/*----------------------Формуэмо массив-----------*/
			//************************************
			//функція з запитом POST
			//************************************
			function ajaxPostReq () {
					var name = new Array();
					for(i=0; i<document.getElementsByClassName("ball").length; i++){
						name[i] = document.getElementsByClassName("ball")[i].value
					}
				 	var sendString = "name1="+ name[0] +
				 					"&name2=" + name[1] +
				 					"&name3=" + name[2] +
				 					"&name4=" + name[3] +
				 					"&name5=" + name[4] +
				 					"&name6=" + name[5];
				 	var ajax = new XMLHttpRequest();
				 	ajax.open("POST", "script.php", true);
				
				ajax.onreadystatechange = function(){
					if (ajax.readyState == 4){
						//виводимо результат
						var globo = ajax.responseText;
						console.log(globo);
					}
				}
					//ОБОВЯЗКОВО ПРОПИСУЄМО ЗАГОЛОВОК. БЕЗ НЬОГО ЗАПИТ НЕ ВІДПРАВИТЬСЯ.
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					//також може знадобитися слідуючий заголовок
					//ajax.setRequestHeader("Content-Length", sendString.length);
					//відправляємо стрічку з даними. Яку ми сформували в рядку 27-28
					ajax.send(sendString);
			}

				 	
				 	
				 	
				 	
				
				

			
		}
	</script>
		<input type="text" class="ball" name="ball1">
		<input type="text" class="ball" name="ball2">
		<input type="text" class="ball" name="ball3">
		<input type="text" class="ball" name="ball4">
		<input type="text" class="ball" name="ball5">
		<input type="text" class="ball" name="ball6">
		<input type="submit" id="button">
		<div id="result"></div>
</body>
</html>