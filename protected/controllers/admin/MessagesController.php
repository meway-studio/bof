<?php

class MessagesController extends BackController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $defaultAction = 'upload';

    public function actionUpload()
    {
        $delimiter = Yii::app()->request->getParam( 'delimiter', ',' );
        $messagesPattern = "<?php return array(\n{rows}\n);";
        $messageRowPattern = "\t" . '"{key}" => "{value}",' . "\n{rows}";
        $result = array();

        if (!empty($_FILES[ 'file' ]) && ($handle = fopen( $_FILES[ 'file' ][ 'tmp_name' ], "r" )) !== false) {
            if ($keys = fgetcsv( $handle, 2000, $delimiter )) {
                $keys = array_flip( $keys );
                if (!isset($keys[ 'category' ]) || !isset($keys[ 'source_lang' ])) {
                    die('ERROR_FIRST_ROW_CATEGORY_AND_SOURCE_LANG');
                }
                $categoryKey = $keys[ 'category' ];
                $sourceLangKey = $keys[ 'source_lang' ];
                unset($keys[ 'category' ]);
                unset($keys[ 'source_lang' ]);
            } else {
                die('ERROR_FIRST_ROW');
            }
            while (($data = fgetcsv( $handle, 2000, $delimiter )) !== false) {
                $category = $data[ $categoryKey ];
                $sourceMessage = str_replace(
                    array( '\"', '"' ),
                    array( '"', '\"' ),
                    $data[ $sourceLangKey ]
                );
                foreach ($keys as $lang => $key) {
                    $message = str_replace(
                        array( '\"', '"' ),
                        array( '"', '\"' ),
                        $data[ $key ]
                    );
                    $row = str_replace(
                        array( '{key}', '{value}' ),
                        array( $sourceMessage, $message ),
                        $messageRowPattern
                    );
                    if (empty($result[ $lang ])) {
                        $result[ $lang ] = array();
                    }
                    $pattern = empty($result[ $lang ][ $category ]) ? $messagesPattern : $result[ $lang ][ $category ];
                    $result[ $lang ][ $category ] = str_replace(
                        '{rows}',
                        $row,
                        $pattern
                    );
                }
            }
            fclose( $handle );
        }

        if (count( $result )) {
            foreach ($result as $lang => $categoryData) {
                if (!is_array( $categoryData )) {
                    continue;
                }
                foreach ($categoryData as $category => $data) {
                    $data = str_replace( "\n{rows}", '', $data );
                    $filePath = Yii::app()->messages->getMessageFile( $category, $lang );
                    $dirPath = dirname( $filePath );
                    if (!file_exists( $dirPath )) {
                        @mkdir( $dirPath, 644, true );
                    }
                    file_put_contents( Yii::app()->messages->getMessageFile( $category, $lang ), $data );
                }
            }
        }
        $this->render( 'upload' );
    }

    public function actionDownload()
    {
        $result = array();
        $langs = array();
        $path = Yii::getPathOfAlias( 'application' ) . '/{modules/*/,}messages/*/*.php';
        $delimiter = Yii::app()->request->getParam( 'delimiter', ',' );
        $files = glob( $path, GLOB_BRACE );

        foreach ($files as $filePath) {
            $module = null;
            $shortPath = str_replace( Yii::getPathOfAlias( 'application' ) . '/', '', $filePath );
            $pathData = explode( '/', $shortPath );
            if (array_shift( $pathData ) == 'modules') {
                $module = ucfirst( array_shift( $pathData ) ) . 'Module';
                array_shift( $pathData );
            }
            $lang = array_shift( $pathData );
            $file = str_replace( '.php', '', array_shift( $pathData ) );
            $category = ($module ? $module . '.' : '') . $file;
            $fileData = require($filePath);
            foreach ($fileData as $sourceMessage => $message) {
                $message = str_replace(
                    array( '"', "\n", "\r" ),
                    array( '\"', '', '' ),
                    $message
                );
                $sourceMessage = str_replace(
                    array( '"', "\n", "\r" ),
                    array( '\"', '', '' ),
                    $sourceMessage
                );
                $result[ $category ][ $sourceMessage ][ $lang ] = $message;
                $langs[ $lang ] = $lang;
            }
        }

        header( "Content-type: text/csv" );
        header( "Content-Disposition: attachment; filename=messages.csv" );
        header( "Pragma: no-cache" );
        header( "Expires: 0" );

        $out = fopen( "php://output", 'w' );
        $row = array( "category", "source_lang" );
        foreach ($langs as $lang) {
            $row[ ] = $lang;
        }
        fputcsv( $out, $row, $delimiter );

        foreach ($result as $category => $source) {
            foreach ($source as $sourceMessage => $langData) {
                $row = array();
                $row[ ] = $category;
                $row[ ] = $sourceMessage;
                foreach ($langs as $lang) {
                    $message = !empty($langData[ $lang ]) ? $langData[ $lang ] : '';
                    $row[ ] = $message;
                }
                fputcsv( $out, $row, $delimiter );
            }
        }
        fclose( $out );
        Yii::app()->end();
    }
}