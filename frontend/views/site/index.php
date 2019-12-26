<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Weather;
/* @var $this yii\web\View */
/* @var $cities array */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <p>Приветствуем вас, <?=Yii::$app->user->isGuest ? 'Гость' : Yii::$app->user->identity->username?></p>
    <? if (Yii::$app->user->isGuest) : ?>
    <p>Для того, чтобы воспользоваться сервисом, необходимо <?= Html::a('авторизоваться', [Url::to('/site/login')]) ?> или <?= Html::a('зарегистрироваться', [Url::to('/site/signup')]) ?>.</p>
    <? else: ?>
    <p>Ваш API key: <?=Yii::$app->user->identity->api_key?></p>
    <? endif; ?>

    <p>Для того, чтобы получить информацию о погоде, необходимо сформировать в адресной строке браузера запрос вида:</p>
    <pre>
        <?= 'http://weather.local/site/get-weather?city={{Omsk}}&api={{APIkey}}' ?>
    </pre>

    <p>В настоящее время информация о погоде доступна для городов:</p>
    <table>
        <? foreach ($cities as $city): ?>
        <tr>
            <td style="padding: 0 10px"><?=$city['city']?></td>
            <td><?=Html::a('http://weather.local/site/get-weather?city='.$city['city'].'&apiKey='. Yii::$app->user->identity->api_key,
                        ['@web/site/get-weather?city='.$city['city'].'&apiKey='. Yii::$app->user->identity->api_key])?>

            </td>
        </tr>
        <? endforeach; ?>
    </table>

</div>
