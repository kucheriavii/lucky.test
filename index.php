<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
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
			button.addEventListener('click', ajaxPostReq);
			for (var i = 0; i < inputs.length; i++) {
				inputs[i].addEventListener('blur', validator)
			}
			/*Валідатор*/
			var validation = true;
			function validator() {

			}
			/*----------------------Аякс запит-----------*/
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
					validator = 0;
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
							if (name[i] == name[j] && i!=j){
								validator = 0;
								repeatFlag = true
							}
						}
					}
					if (incorrectFlag){console.log('incorrect')}
					if (repeatFlag){console.log('repeat')}
					if (lessFlag){console.log('not full data')}
					/*кінець валідації*/
					if (ajax.readyState == 4 && validator==1){
						//виводимо результат
						var globo = ajax.responseText;
						console.log(globo);
					}
				}
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
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
