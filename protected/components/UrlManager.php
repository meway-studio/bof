<?php

/**
 * Manager urls
 */
class UrlManager extends CUrlManager
{
    /**
     * Languages list
     * @var array
     */
    public $languages = array( 'en' );

    /**
     * Set current language
     * @access public
     */
    public function init()
    {
        Yii::app()->language = ($language = $this->parseDomain()) ? $language : $this->languages[ 0 ];
        return parent::init();
    }

    /**
     * Search language prefix in URI
     * @param CHttpRequest $request
     * @return array|string
     */
    public function parseUrl( $request )
    {
        $baseUrl = $request->getBaseUrl();
        if (preg_match( '/^\/(\w+)/i', $_SERVER[ 'REQUEST_URI' ], $matches )) {
            $lang = $matches[ 1 ];
            if (in_array( $lang, $this->languages )) {
                Yii::app()->language = $lang;
                $request->setBaseUrl( "/{$lang}" );
            }
        }
        $path = parent::parseUrl( $request );
        $request->setBaseUrl( $baseUrl );
        return $path;
    }

    /**
     * Add language prefix
     * @param string $route
     * @param array $params
     * @param string $ampersand
     * @return string
     */
    public function createUrl( $route, $params = array(), $ampersand = '&' )
    {
        $result = parent::createUrl( $route, $params, $ampersand );
        if (Yii::app()->language !== $this->languages[ 0 ]) {
            $result = '/' . Yii::app()->language . '/' . ltrim( $result, '/' );
        }
        return $result;
    }

    /**
     * Search language prefix in subdomain
     * example: en.domain.com
     * @return mixed|null
     */
    public function parseDomain()
    {
        $host = explode( ".", $_SERVER[ 'HTTP_HOST' ] );
        $language = array_shift( $host );
        return in_array( $language, $this->languages ) ? $language : null;
    }
}
