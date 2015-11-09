# Forecast the Open Data Euskadi
======================
Practica que obtiene la previsión del tiempo de Open Data Euskadi(https://core.telegram.org/bots/api)
## 
Instrucciones
============

Lanzar en la consola de comandos el fichero PHP forecast.php (php forecast.php) añadiendo uno de los siguientes parámetros

   - Bilbao : Muestra el tiempo en Bilbao. 
   - San Sebastian : Muestra el tiempo en San Sebastián. El parámetro debería estar entre comillas dobles para indicar que es un solo parámetro aunque también se permite el uso de 2 parámetros siendo el primero San y el segundo Sebastián. 
   - Vitoria-Gasteiz : Muestra el tiempo en Vitoria-Gasteiz. 

Nota: Para responder mejor a las expectativas del usuario se aceptan también otros valores como "Vitoria" , "Gasteiz" , "Donostia" , "Bilbo", "Donostia - San Sebastian".
      Sin embargo y para evitar problemas con las codificaciones y no teniendo definido el entorno final de la aplicación no se permite el uso de tildes en los parámetros.

Ejemplos:
	- php forecast.php Bilbao
	- php forecast.php "San Sebastian"
	- php forecast.php Vitoria-Gasteiz