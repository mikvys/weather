<?php
namespace console\controllers;

use common\models\Weather;
use Yii;
use yii\console\Controller;
use yii\console\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\httpclient\Client;

class WeatherController extends Controller
{
    /**
     * @return \yii\httpclient\Response
     * @throws Exception
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function actionUpload() {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://api.openweathermap.org/data/2.5/box/city?bbox='. Weather::LON_LEFT .','. Weather::LAT_BOTTOM .','. Weather::LON_RIGHT .','. Weather::LAT_TOP .','. Weather::ZOOM .'&appid=' . Yii::$app->params['weatherApiKey'])
            ->send();

        if ($response->isOk) {
            $weatherData = Json::decode($response->content);
            if (!empty(Weather::find()->all())) {
                Weather::deleteAll();
            }
            foreach ($weatherData['list'] as $data) {
                $model = new Weather([
                    'name' => $data['name'],
                    'data' => Json::encode($data),
                ]);
                $model->save(false);
            }

        } else {
            throw new Exception('Не удалось получить данные с сервера');
        }
    }
}