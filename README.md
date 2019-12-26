1. Склонировать репозиторий
2. Запусить в командной строке composer install
3. Применить миграции: php yii migrate [yes]
4. Добавить свой API ключ от openweathermap в common/config/params-local.php ('weatherApiKey' => 'XXXXXXXXXXXXXXXXX')
5. Подгрузить данные с openweathermap в свою базу с помощью команды в консоли: php yii weather/upload

В классе Weather(common/models/Weather.php) в константах можно задать свои значения координат квадрата в котором
будут находиться наши города:

    const LON_LEFT = 72.237508;  //Долгота верхней левой точки 
    const LAT_BOTTOM = 54.315426;  //Широта левой нижней точки
    const LON_RIGHT = 77.477986;  //Долгота правой нижней
    const LAT_TOP = 55.831088;  //Широта верхней правой
    const ZOOM = 10;
    
Использовал: Call current weather data for several cities ->
             Cities within a rectangle zone