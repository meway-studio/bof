<?php
/**
 * FileUploadAction class file.
 *
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
	
	public function run(){
		
		$file      = CUploadedFile::getInstanceByName($this->attribute);
		$status    = false;
		$filename  = '';
		$filepath  = Yii::getPathOfAlias($this->filepath) . DIRECTORY_SEPARATOR;
		$error     = false;
		$messages  = array();
		$webpath   = '';
		
		if($file!=null){
			
			// check mime type
			$filemime = $file->getType();
			
			if(is_array($this->allowMime) AND !in_array($filemime, $this->allowMime)){
				$error = true;
				$messages[] = Yii::t('FileUploadAction', 'Формат файла не поддерживается.');
			}
			
			// check size
			$filesize = $file->getSize();
			
			if(is_numeric($this->maxsize) AND $filesize > $this->maxsize){
				$error = true;
				$messages[] = Yii::t('FileUploadAction', 'Максимальный размер файла {size} байт', array('{size}'=>$this->maxsize));
			}
			
			if(is_numeric($this->minsize) AND $filesize < $this->minsize){
				$error = true;
				$messages[] = Yii::t('FileUploadAction', 'Минимальный размер файла {size} байт', array('{size}'=>$this->minsize));
			}
			
			if($error==false){
				$filename = strtolower(uniqid().'.'.$file->getExtensionName());
				$status   = $file->saveAs($filepath.$filename);
				$webpath  = str_replace(Yii::getPathOfAlias('webroot'), '', $filepath.$filename);
			}
		}
		
		if($this->redactor){
		
			$data = array(
				$this->filelink => $webpath,
			);
			
		}else{
		
			$data = array(
				'status'         => $status,
				'messages'       => $messages,
				$this->attribute => array('filename'=>$filename, 'src'=>$webpath),
			);
		}
		
		echo CJSON::encode($data);
		
		Yii::app()->end();
	}
}
