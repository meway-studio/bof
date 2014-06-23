<?php

/**
 * Created by PhpStorm.
 * User: egoss
 * Date: 21.04.14
 * Time: 20:00
 */
class ImageBehavior extends CActiveRecordBehavior
{
    public $filePath = '';
    public $fileField = 'file';
    protected $_current_image;

    public function afterFind( $event )
    {
        $this->_current_image = $this->owner->{$this->fileField};
    }

    public function beforeSave( $event )
    {
        $filePath = $this->owner->{$this->fileField};
        if ($file = CUploadedFile::getInstance( $this->owner, $this->fileField )) {
            $filename = strtolower(
                substr( md5( $file->name ), 0, 7 ) . '.' . pathinfo( $file->name, PATHINFO_EXTENSION )
            );
            $path = $this->getImageDirPath( null, false, $filename );
            if (!file_exists( $path )) {
                mkdir( $path, 0777, true );
            }

            $file->saveAs( $this->getImagePath( null, false, $filename ) );
            $this->owner->{$this->fileField} = $filename;
        } elseif ($filePath && file_exists( $filePath )) {
            $filename = strtolower(
                substr( md5( $filePath ), 0, 7 ) . '.' . pathinfo( $filePath, PATHINFO_EXTENSION )
            );
            $path = $this->getImageDirPath( null, false, $filename );
            if (!file_exists( $path )) {
                mkdir( $path, 0777, true );
            }
            if (copy( $filePath, $this->getImagePath( null, false, $filename ) )) {
                $this->owner->{$this->fileField} = $filename;
            }
        } else {
            $this->owner->{$this->fileField} = $this->_current_image;
        }
    }

    public function beforeDelete( $event )
    {
        $this->deleteFile();
    }

    public function deleteFile()
    {
        $path = $this->getImagePath();

        if (file_exists( $path ) AND is_file( $path )) {
            @unlink( $path );
        }

        $this->owner->{$this->fileField} = '';
    }

    /**
     * Get url to product image. Enter $size to resize image.
     * @param mixed $size New size of the image. e.g. '150x150'
     * @param mixed $resizeMethod Resize method name to override config. resize/adaptiveResize
     * @param mixed $random Add random number to the end of the string
     * @return string
     */
    public function getImageUrl( $size = false, $resizeMethod = 'adaptiveResize', $random = false )
    {

        if (empty($this->owner->{$this->fileField})) {
            return $this->placehold( $size );
        }

        if ($size !== false) {

            $thumbPath = $this->getImageDirPath( $size );

            if (!file_exists( $thumbPath )) {
                mkdir( $thumbPath, 0777, true );
            }

            // Path to source image
            $fullPath = $this->getImagePath();

            if (!file_exists( $fullPath )) {
                return $this->placehold( $size );
            }

            // Path to thumb
            $thumbPath = $this->getImagePath( $size );

            if (!file_exists( $thumbPath )) {
                // Resize if needed
                Yii::import( 'ext.phpthumb.PhpThumbFactory' );
                $sizes = explode( 'x', $size );
                $thumb = PhpThumbFactory::create( $fullPath );
                $thumb->$resizeMethod( $sizes[ 0 ], $sizes[ 1 ] )->save( $thumbPath );
            }

            return $this->getImagePath( $size, true );
        }

        if ($random === true) {
            return $this->getImagePath( null, true ) . '?' . rand( 1, 10000 );
        }

        return $this->getImagePath( null, true );
    }

    /**
     * Get url to product image. Enter $size to resize image.
     * @param mixed $size New size of the image. e.g. '150x150'
     * @param bool $wmImagePath
     * @param mixed $resizeMethod Resize method name to override config. resize/adaptiveResize
     * @param mixed $random Add random number to the end of the string
     * @return string
     */
    public function getWMImageUrl( $wmImagePath = false, $size = false, $resizeMethod = 'resize', $random = false )
    {

        if (empty($this->owner->{$this->fileField})) {
            return $this->placehold( $size );
        }

        if ($size !== false) {

            $thumbPath = $this->getImageDirPath( $size );

            if (!file_exists( $thumbPath )) {
                mkdir( $thumbPath, 0777, true );
            }

            // Path to source image
            $fullPath = $this->getImagePath();

            if (!file_exists( $fullPath )) {
                return $this->placehold( $size );
            }

            // Path to thumb
            $thumbPath = $this->getImagePath( $size );

            if (!file_exists( $thumbPath )) {
                // Resize if needed
                Yii::import( 'ext.phpthumb.PhpThumbFactory' );
                $sizes = explode( 'x', $size );
                $thumb = PhpThumbFactory::create( $fullPath );
                $thumb->$resizeMethod( $sizes[ 0 ], $sizes[ 1 ] );
                if ($wmImagePath && file_exists( $wmImagePath )) {
                    $thumb->createWatermark( $wmImagePath, 10, 10 );
                }
                $thumb->save( $thumbPath );
            }

            return $this->getImagePath( $size, true );
        }

        if ($random === true) {
            return $this->getImagePath( null, true ) . '?' . rand( 1, 10000 );
        }

        return $this->getImagePath( null, true );
    }

    public function getImagePath( $size = null, $toUrl = false, $filename = null )
    {
        if (!$filename) {
            $filename = $this->owner->{$this->fileField};
        }

        $imagePath = $this->getImageDirPath( $size, $toUrl, $filename ) . DIRECTORY_SEPARATOR . $filename;

        if ($toUrl) {
            $imagePath = str_replace(
                array( Yii::getPathOfAlias( 'webroot' ), '\\' ),
                array( '', '/' ),
                $imagePath
            );
        }
        return $imagePath;
    }

    public function getImageDirPath( $size = null, $toUrl = false, $filename = null )
    {
        if (!$filename) {
            $filename = $this->owner->{$this->fileField};
        }

        $dirPath = Yii::getPathOfAlias( $this->filePath );
        $dirPath .= DIRECTORY_SEPARATOR . ($size ? 'resized' . DIRECTORY_SEPARATOR . $size : 'base');
        $dirPath .= DIRECTORY_SEPARATOR . $this->generatePath( $filename );

        if ($toUrl) {
            $dirPath = str_replace(
                array( Yii::getPathOfAlias( 'webroot' ), '\\' ),
                array( '', '/' ),
                $dirPath
            );
        }
        return $dirPath;
    }

    public function getImageSizeDirPath( $size )
    {
        return
            Yii::getPathOfAlias( $this->filePath )
            . "/resized/{$size}/"
            . $this->generatePath( $this->owner->{$this->fileField} )
            . '/'
            . $this->owner->{$this->fileField};
    }

    protected function generatePath( $name )
    {
        $crc64 = base_convert( ('0x' . hash( 'crc32', $name ) . hash( 'crc32b', $name )), 16, 10 );
        return trim( preg_replace( '~(.{2})~U', "\\1/", substr( str_pad( $crc64, 20, "0", STR_PAD_LEFT ), 0, 10 ) ), '/' );
    }

    protected function placehold( $size = false )
    {
        return 'http://placehold.it/' . ($size == false ? '100x100' : $size);
    }
}