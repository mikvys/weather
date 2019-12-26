<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * User model
 *
 * @property integer $id
 * @property string $data
 * @property string $city
 */
class Weather extends ActiveRecord
{
    const LON_LEFT = 72.237508;
    const LAT_BOTTOM = 54.315426;
    const LON_RIGHT = 77.477986;
    const LAT_TOP = 55.831088;
    const ZOOM = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%weather}}';
    }

    /**
     * Weather constructor.
     * @param array $params
     * @param array $config
     */
    public function __construct($params = [], $config = [])
    {
        if (!empty($params)) {
            $this->city = $params['name'];
            $this->data = $params['data'];
        }

        parent::__construct($config);
    }


    /**
     * Finds by city
     *
     * @param string $city
     * @return static|null
     */
    public static function findByCityName($city)
    {
        return static::findOne(['city' => $city]);
    }

    public static function getAllCities() {
        return static::find()->select(['city'])->asArray()->all();
    }
}
