<?php

/**
 * FileUploadAction class file.
 * @author egoss <dev@egoss.ru>
 */
class FileUploadAction extends CAction
{
    public $attribute;
    public $filepath;
    public $allowMime;
    public $minsize;
    public $maxsize;
    public $redactor = false;
    public $filelink = 'filelink';
    public $resize = false;
    public $resizeMethod = 'adaptiveResize';
    public $resizeWidth = 100;
    public $resizeHeight = 100;

    public function run()
    {

        $file = CUploadedFile::getInstanceByName( $this->attribute );
        $status = false;
        $filename = '';
        $filepath = Yii::getPathOfAlias( $this->filepath ) . DIRECTORY_SEPARATOR;
        $error = false;
        $messages = array();
        $webpath = '';

        if ($file != null) {

            // check mime type
            $filemime = $file->getType();

            if (is_array( $this->allowMime ) AND !in_array( $filemime, $this->allowMime )) {
                $error = true;
                $messages[ ] = Yii::t( 'FileUploadAction', 'Формат файла не поддерживается.' );
            }

            // check size
            $filesize = $file->getSize();

            if (is_numeric( $this->maxsize ) AND $filesize > $this->maxsize) {
                $error = true;
                $messages[ ] = Yii::t( 'FileUploadAction', 'Максимальный размер файла {size} байт', array( '{size}' => $this->maxsize ) );
            }

            if (is_numeric( $this->minsize ) AND $filesize < $this->minsize) {
                $error = true;
                $messages[ ] = Yii::t( 'FileUploadAction', 'Минимальный размер файла {size} байт', array( '{size}' => $this->minsize ) );
            }

            if ($error == false) {
                $filename = strtolower( uniqid() . '.' . $file->getExtensionName() );
                $status = $file->saveAs( $filepath . $filename );
                $fullPath = $filepath . $filename;

                if ($this->resize) {
                    $thumbPath = $filepath . 'resized' . DIRECTORY_SEPARATOR . $this->resizeWidth . 'x' . $this->resizeHeight;

                    if (!file_exists( $thumbPath )) {
                        @mkdir( $thumbPath, 0777, true );
                    }

                    $thumbPath .= DIRECTORY_SEPARATOR . $filename;

                    Yii::import( 'ext.phpthumb.PhpThumbFactory' );
                    $thumb = PhpThumbFactory::create( $fullPath );
                    $thumb->{$this->resizeMethod}( $this->resizeWidth, $this->resizeHeight )->save( $fullPath = $thumbPath );
                }

                $webpath = str_replace(
                    array( Yii::getPathOfAlias( 'webroot' ), '\\' ),
                    array( '', '/' ),
                    $fullPath
                );
            }
        }

        if ($this->redactor) {

            $data = array(
                $this->filelink => $webpath,
            );
        } else {

            $data = array(
                'status'         => $status,
                'messages'       => $messages,
                $this->attribute => array( 'filename' => $filename, 'src' => $webpath ),
            );
        }

        echo CJSON::encode( $data );

        Yii::app()->end();
    }
}
