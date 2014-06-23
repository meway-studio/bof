<?php

/**
 * This is the model class for table "{{eav_rules}}".
 *
 * The followings are the available columns in table '{{eav_rules}}':
 * @property integer $id
 * @property string $create_date
 * @property string $update_date
 * @property integer $attribute_id
 * @property integer $entity_id
 * @property string $name
 * @property string $param
 * @property string $value
 * @property integer $enabled
 */
class EavRules extends CActiveRecord
{
    public $standartRules = array(
        /**
         * CBooleanValidator,
         * проверят, что значение переменной равняется trueValue или falseValue.
         */
        'boolean' => array(
            'allowEmpty', // может ли значение равняться null или быть пустым.
            'falseValue', // значение falseValue.
            'strict', // является ли сравнение строгим: должны совпадать не только значения, но и их тип.
            'trueValue', // значение trueValue.
        ),
        /**
         * CCaptchaValidator, проверяет,
         * что значение поля модели соответствует проверочному коду CAPTCHA.
         */
        'captcha' => array(
            'allowEmpty', // может ли значение равняться null или быть пустым.
            'captchaAction', // ID действия, показывающего изображение CAPTCHA.
            'caseSensitive', // использовать ли регистрозависимую проверку.
        ),
        /**
         * CCompareValidator, сравнивает значение указанного
         * поля модели с значением другого поля и проверяет, равны ли они.
         */
        'compare' => array(
            'allowEmpty', // может ли значение равняться null или быть пустым.
            'compareAttribute', // имя атрибута, с которым будет производится сравнение.
            'compareValue', // постоянное значение, с которым будет производится сравнение.
            'operator', // оператор, используемый при сравнении.
            'strict', // является ли сравнение строгим: должны совпадать не только значения, но и их тип.
        ),
        /**
         * CDefaultValueValidator, инициализирует атрибуты указанным значением.
         * Валидацию при этом не выполняет. Нужен для указания значений по умолчанию.
         */
        'default' => array(
            'setOnEmpty', // устанавливать значение по умолчанию только если значение равно null или пустой строке.
            'value', // значение по умолчанию.
        ),
        /**
         * CEmailValidator, проверяет, что значение является адресом email.
         */
        'email' => array(
            'allowEmpty', // может ли значение равняться null или быть пустым.
            'allowName', // разрешать ли включать имя в адрес email.
            'checkMX', // проверять ли запись MX.
            'checkPort', // проверять ли 25-й порт.
            'fullPattern', // регулярное выражение, используемое для проверки адреса с именем.
            'pattern', // регулярное выражение, используемое для проверки адреса без имени.
            'validateIDN', // проверять ли адрес с IDN (internationalized domain names, интернационализованные доменные имена). По умолчанию адрес содержащий IDN всегда будет неверным (значение false). Появилось в версии 1.1.13.
        ),
        /**
         * CDateValidator, проверяет, что значение является датой, временем или и тем и другим вместе.
         */
        'date' => array(
            'allowEmpty', // может ли значение равняться null или быть пустым.
            'format', // формат значения. Может быть массивом или строкой. По умолчанию равняется 'MM/dd/yyyy'. Остальные форматы описаны в API CDateTimeParser.
            'timestampAttribute', // имя атрибута, в который будет записан результат разбора даты. По умолчанию равен null.
        ),
        /**
         * CExistValidator, проверяет, есть ли значение атрибута в определённой таблице.
         */
        'exist' => array(
            'allowEmpty', // может ли значение равняться null или быть пустым.
            'attributeName', // имя атрибута класса ActiveRecord, используемое для проверки значения.
            'className', // имя класса ActiveRecord, используемого для проверки.
            'criteria', // дополнительный критерий запроса.
        ),
        /**
         * CFileValidator, проверяет, был ли загружен файл.
         */
        'file' => array(
            'allowEmpty', // можно ли не загружать файл и оставить поле пустым.
            'maxFiles', // максимальное количество файлов.
            'maxSize', // максимальный размер в байтах.
            'minSize', // минимальный размер в байтах.
            'tooLarge', // сообщение об ошибке, выдаваемое если файл слишком большой.
            'tooMany', // сообщение, выдаваемое если загружено слишком много файлов.
            'tooSmall', // сообщение, выдаваемое если загруженный файл слишком мал.
            'types', // список расширений файлов, которые позволено загружать.
            'wrongType', // сообщение, выдаваемое если данный тип файла загружать нельзя.
            'mimeTypes', // список MIME-типов файлов, которые позволено загружать. Можно использовать при условии, что установлено PECL-расширение fileinfo. Появилось в версии 1.1.11.
            'wrongMimeType', // сообщение, выдаваемое если данный тип файла загружать нельзя. Можно использовать при условии, что установлено PECL-расширение fileinfo. Появилось в версии 1.1.11.
        ),
        /**
         * CFilterValidator, применяет к данным фильтр.
         */
        'filter' => array(
            'filter', // метод-фильтр.
        ),
        /**
         * CRangeValidator, проверяет, входит ли значение в заданный интервал или список значений.
         */
        'in' => array(
            'allowEmpty', // может ли значение равняться null или быть пустым.
            'range', // список допустимых значений или допустимый интервал.
            'strict', // является ли сравнение строгим: должны совпадать не только значения, но и их тип.
            'not', // позволяет проверить исключение из интервала вместо вхождения в него.
        ),
        /**
         * CStringValidator, проверяет, что количество введённых символов соответствует некоторому значению.
         */
        'length' => array(
            'allowEmpty', // может ли значение равняться null или быть пустым.
            'encoding', // кодировка проверяемой строки.
            'is', // точное количество символов.
            'max', // максимальное количество символов.
            'min', // минимальное количество символов.
            'tooShort', // сообщение об ошибке, выдаваемое если количество символов слишком мало.
            'tooLong', // сообщение об ошибке, выдаваемое если количество символов слишком велико.
        ),
        /**
         * CNumberValidator, проверяет, что значение является числом в определённом интервале.
         */
        'numerical' => array(
            'allowEmpty', // может ли значение равняться null или быть пустым.
            'integerOnly', // только целые числа.
            'max', // максимальное значение.
            'min', // минимальное значение.
            'tooBig', // сообщение об ошибке, выдаваемое если значение слишком велико.
            'tooSmall', // сообщение об ошибке, выдаваемое если значение слишком мало.
            'integerPattern', // регулярное выражение, используемое для валидации целых чисел. Используется тогда, когда integerOnly равно true. Появилось в версии 1.1.7.
            'numberPattern', // регулярное выражение, используемое для валидации чисел с плавающей точкой. Используется тогда, когда integerOnly равно false. Появилось в версии 1.1.7.
        ),
        /**
         * CRegularExpressionValidator, проверяет, совпадает ли значение с регулярным выражением.
         */
        'match' => array(
            'allowEmpty', // может ли значение равняться null или быть пустым.
            'pattern', // регулярное выражение.
            'not', // инвертировать ли логику валидации. Если значение равно true, то проверяемое значение не должно совпадать с регулярным выражением. Значение по умолчанию: false. Появилось в версии 1.1.5.
        ),
        /**
         * CRequiredValidator, проверяет, что значение не равно null и не является пустым.
         */
        'required' => array(
            'requiredValue', // значение, которое должен иметь атрибут.
            'strict', // является ли сравнение строгим: должны совпадать не только значения, но и их тип.
        ),
        /**
         * CTypeValidator, сверяет тип атрибута с указанным (integer, float, string, date, time, datetime).
         * Для валидации дат с версии 1.1.7 лучше использовать CDateValidator.
         */
        'type' => array(
            'allowEmpty', // может ли значение равняться null или быть пустым.
            'dateFormat', // формат для валидации дат.
            'datetimeFormat', // формат для валидации даты и времени.
            'timeFormat', // формат для валидации времени.
            'type', // тип данных.
        ),
        /**
         * CUniqueValidator, проверяет значение на уникальность.
         */
        'unique' => array(
            'allowEmpty', // может ли значение равняться null или быть пустым.
            'attributeName', // имя атрибута класса ActiveRecord, используемое для проверки значения.
            'caseSensitive', // является ли сравнение регистронезависимым.
            'className', // имя класса ActiveRecord, используемого для проверки.
            'criteria', // дополнительный критерий запроса.
        ),
        /**
         * CUrlValidator, проверяет, что значения является верным URL http или https.
         */
        'url' => array(
            'allowEmpty', // может ли значение равняться null или быть пустым.
            'pattern', // регулярное выражение, используемое при валидации.
            'validSchemes', // массив с названиями допустимых схем. Схемы, допустимые по умолчанию: http и https. Появилось в версии 1.1.7.
            'validateIDN', // проверять ли URL с IDN (internationalized domain names, интернационализованные доменные имена). По умолчанию URL содержащий IDN всегда будет неверным (значение false). Появилось в версии 1.1.13.
        ),
        /**
         * CUnsafeValidator, помечает атрибут небезопасным для массового присваивания.
         */
        'unsafe' => array(),
        /**
         * CSafeValidator, помечает атрибут безопасным для массового присваивания.
         */
        'safe' => array(),
    );

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{eav_rules}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('attribute_id, entity_id', 'required'),
			array('attribute_id, entity_id, enabled', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
			array('param', 'length', 'max'=>50),
			array('value', 'length', 'max'=>255),
			array('create_date, update_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_date, update_date, attribute_id, entity_id, name, param, value, enabled', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'attribute_id' => 'Attribute',
			'entity_id' => 'Entity',
			'name' => 'Name',
			'param' => 'Param',
			'value' => 'Value',
			'enabled' => 'Enabled',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('attribute_id',$this->attribute_id);
		$criteria->compare('entity_id',$this->entity_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('param',$this->param,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('enabled',$this->enabled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EavRules the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
