<?php

class weatherBox extends CWidget
{
    public $cacheTime = 3600;
    protected $location;
    protected $weather;
    protected $assets_path;

    public function init()
    {
        $this->registerAssets();

        $default = array(
            'location' => array(
                'countryCode'  => '',
                'countryCode3' => '',
                'countryName'  => '',
                'region'       => '',
                'regionName'   => '',
                'city'         => '',
                'postalCode'   => '',
                'latitude'     => '',
                'longitude'    => '',
                'areaCode'     => '',
                'dmaCode'      => '',
            ),
            'weather'  => array(
                'date' => date( 'U' ),
                'data' => array(
                    'humidity'         => '',
                    'observation_time' => '',
                    'precipMM'         => '',
                    'pressure'         => '',
                    'temp_C'           => '',
                    'temp_F'           => '',
                    'visibility'       => '',
                    'weatherCode'      => '',
                    'weatherDesc'      => '',
                    'winddir16Point'   => '',
                    'winddirDegree'    => '',
                    'windspeedKmph'    => '',
                    'windspeedMiles'   => '',
                    'weatherIconUrl'   => $this->setIcon(),
                ),
            ),

        );

        $session = new CHttpSession;
        $session->open();

        if (!isset($session[ 'weather' ]) OR (date( 'U' ) - $session[ 'weather' ][ 'date' ]) > $this->cacheTime) {

            $location = Yii::app()->geoip->lookupLocation();

            if ($location) {

                $session[ 'location' ] = array(
                    'countryCode'  => $location->countryCode,
                    'countryCode3' => $location->countryCode3,
                    'countryName'  => $location->countryName,
                    'region'       => $location->region,
                    'regionName'   => $location->regionName,
                    'city'         => $location->city,
                    'postalCode'   => $location->postalCode,
                    'latitude'     => $location->latitude,
                    'longitude'    => $location->longitude,
                    'areaCode'     => $location->areaCode,
                    'dmaCode'      => $location->dmaCode,
                );

                $weather = Yii::app()->weather->city( $location->city );

                if (isset($weather->data->current_condition[ 0 ])) {

                    $session[ 'weather' ] = array(
                        'date' => date( "U" ),
                        'data' => array(

                            'cloudcover'       => $weather->data->current_condition[ 0 ]->cloudcover,
                            'humidity'         => $weather->data->current_condition[ 0 ]->humidity,
                            'observation_time' => $weather->data->current_condition[ 0 ]->observation_time,
                            'precipMM'         => $weather->data->current_condition[ 0 ]->precipMM,
                            'pressure'         => $weather->data->current_condition[ 0 ]->pressure,
                            'temp_C'           => $weather->data->current_condition[ 0 ]->temp_C,
                            'temp_F'           => $weather->data->current_condition[ 0 ]->temp_F,
                            'visibility'       => $weather->data->current_condition[ 0 ]->visibility,
                            'weatherCode'      => $weather->data->current_condition[ 0 ]->weatherCode,
                            'weatherDesc'      => $weather->data->current_condition[ 0 ]->weatherDesc,
                            'winddir16Point'   => $weather->data->current_condition[ 0 ]->winddir16Point,
                            'winddirDegree'    => $weather->data->current_condition[ 0 ]->winddirDegree,
                            'windspeedKmph'    => $weather->data->current_condition[ 0 ]->windspeedKmph,
                            'windspeedMiles'   => $weather->data->current_condition[ 0 ]->windspeedMiles,
                            'weatherIconUrl'   => $this->setIcon( $weather->data->current_condition[ 0 ]->weatherCode ),
                        ),
                    );
                } else {
                    $session[ 'weather' ] = $default[ 'weather' ];
                }
            } else {

                $session[ 'weather' ] = $default[ 'weather' ];
                $session[ 'location' ] = $default[ 'location' ];
            }
        }

        $this->location = $session[ 'location' ];
        $this->weather = $session[ 'weather' ];
    }

    public function run()
    {
        $this->render(
            'view',
            array(
                'weather'  => $this->weather[ 'data' ],
                'location' => $this->location,
            )
        );
    }

    /**
     * Register icon files.
     */
    protected function registerAssets()
    {
        $assets_path = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'assets';

        $this->assets_path = Yii::app()->assetManager->publish( $assets_path, false, -1, true );
    }

    protected function setIcon( $code = null )
    {
        $setting = array(
            395 => '16.png',
            392 => '16.png',
            389 => '00.png',
            386 => '00.png',
            377 => '42.png',
            374 => '42.png',
            371 => '42.png',
            368 => '07.png',
            365 => '07.png',
            362 => '07.ong',
            359 => '12.png',
            356 => '01.png',
            353 => '01.png',
            350 => '06.png',
            338 => '43.png',
            335 => '43.png',
            332 => '16.png',
            329 => '16.png',
            326 => '16.png',
            323 => '16.png',
            320 => '05.png',
            317 => '05.png',
            314 => '07.png',
            311 => '07.png',
            308 => '01.png',
            305 => '01.png',
            302 => '01.png',
            299 => '39.png',
            296 => '39.png',
            293 => '39.png',
            281 => '07.png',
            266 => '01.png',
            263 => '39.png',
            260 => '26.png',
            248 => '26.png',
            230 => '15.png',
            227 => '15.png',
            200 => '04.png',
            185 => '42.png',
            182 => '05.png',
            179 => '16.png',
            176 => '01.png',
            143 => '26.png',
            122 => '26.png',
            116 => '28.png',
            113 => '32.png',
        );

        return $this->assets_path . '/icons/' . (isset($setting[ $code ]) ? $setting[ $code ] : 'na.png');
    }
}