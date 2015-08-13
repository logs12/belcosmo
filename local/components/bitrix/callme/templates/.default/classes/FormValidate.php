<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19.05.2015
 * Time: 23:07
 */

class FormValidate
{
    /**
     * Массив полей, содержащих ошибки.
     * Ключи - имена полей,
     * значение - массив, ключи которого - имена функций валидации, а значения - сообщения об ошибке
     */
    public $fieldsError = array();

    /**
     * массив сообщений об ошибках, генерируются функциями фалидации.
     * @var array - ключи массива - имена функций валидации, а значения - сообщения об ошибке
     */
    public $errorMessage = array();

    /**
     * свойство содержит массив с названиями функций валидации
     * @var array - ключ - имя поля, значение - функция валидации
     */
    public $validationFunction = array();

    /**
     * @var array - ключ - имя поля, значение - значение поля
     */
    private $value = array();

    public function __construct($fields)
    {
        $this->arrRecurs($fields);
    }

    /**
     * @param $fields
     */
    public function arrRecurs($fields)
    {
        foreach ($fields as $key=>$val)
        {
            //кладем в свойство класса все функции валидации для полей формы если они заданы
            $this->validationFunction[$key]=$val['validationFunction'];
            //кладем в свойство класса все сообщения валидации для полей формы если они заданы
            $this->errorMessage[$key] = $val['errorMessage'];
            //собираем в свойство класса все обезвреженные значения
            $this->value[$key] = $this->getVal($key);
        }
    }

    public function validation($val,$key, $validationFunction)
    {
        $err = 0;
        foreach($validationFunction as $func=>$option)
        {
            if (!$this->$func($key, $val, $func))
                $err++;
        }
        if ($err>0)
            return false;
        else
            return true;
    }

    public function execute()
    {
        $file =$this->getFile();
        $err = 0;

        foreach ($this->value as $key=>$val)
        {
            if (!$this->validation($val,$key, $this->validationFunction[$key]))
                $err++;
        }
        if ($err>0)
            return false;
        else
            return $this->value;
        /*
        if (!empty($file))
        {
            if (!$this->validationFile($file)) {
                $this->fields_error['file'] = "Файл не загружен";
                $err++;
            } else $value['file'] = $file;
            if (!$this->validationFileError($file)) {
                $this->fields_error['file'] = "Ошибка загрузки";
                $err++;
            } else $value['file'] = $file;
            if (!$this->validationFileExt($file,array('png','jpg'))) {
                $this->fields_error['file'] = "Неверное расширение файла";
                $err++;
            } else $value['file'] = $file;
            if (!$this->validationFileSize($file,2))
            {
                $this->fields_error['file'] = "Превышен допустимый размер файла";
                $err++;
            } else $value['file'] = $file;
        }
        if ($err>0)
            return false;
        //echo 'false';
        else
            return $value;
        //var_dump($value);
        */
    }

    /**
     * @param $name - имя поля
     * @return array ($arrVal) - массив обезвреженных данных из REQUEST
     */
    public function getVal($name)
    {
        $val = $_REQUEST;
        if (!empty($val))
        {
            foreach ($val as $k => $v) {
                if ($k == $name) {
                    if (is_array($v))
                        $this->getVal();
                    else
                        $arrVal = htmlspecialchars($v);
                }
            }
        }
        return $arrVal;
    }
    /**
     * @return array - массив с данными о файле
     * upd - доработать рекурсивный обход массива FILES вида $_FILES['file']['name'][0]
     */
    public function getFile()
    {
        $filename = $_FILES['file']['name'];
        $type = $_FILES['file']['type'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $error = $_FILES['file']['error'];
        $size = $_FILES['file']['size'];
        return array('name'=>$filename, 'type'=>$type, 'tmp_name'=>$tmp_name, 'error'=>$error, 'size'=>$size);
    }
    ############## VALIDATION FUNCTION ###############
    /**
     * @param $data - value fields
     * @return bool true - не пустое, false - пустое значение
     */
    public function validationEmpty($key, $data)
    {
        if (empty($data) && !is_numeric($data))
        {
            $this->fieldsError[$key][__FUNCTION__] = $this->errorMessage[$key][__FUNCTION__];
            return false;
        }
        else return true;
    }

    /**
     * @param $data - value fields type test(name, login and others)
     * @return int
     */
    public function validationText($key, $data)
    {
        if (!preg_match("/^(?:[a-z]++(?:[ ][a-z]++)?|[а-яёії]++(?:[ ][а-яёії]++)?)$/Diux",$data))
        {
            $this->fieldsError[$key][__FUNCTION__] = $this->errorMessage[$key][__FUNCTION__];
            return false;
        }
        else return true;

    }

    /**
     * @param $data - value fields type tell validation
     * @return bool
     */
    public function validationPhone($key, $data)
    {
        $res = false;
        if ($data != '')
        {
            //if(!preg_match("/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/",$data))
            if(!preg_match("/^\d+$/",$data))
            {
                $this->fieldsError[$key][__FUNCTION__] = $this->errorMessage[$key][__FUNCTION__];
                $res = false;
            }
            else $res = true;
        }
        else $res = true;
        return $res;

    }

    /**
     * @param $data - value fields type email validation
     * @return bool
     */
    public function validationEmail($key, $data)
    {
        $res = false;
        if ($data != '')
        {
            if(!preg_match("/^[-0-9a-z_\.]+@[-0-9a-z^\.]+\.[a-z]{2,4}$/i",$data))
            {
                $this->fieldsError[$key][__FUNCTION__] = $this->errorMessage[$key][__FUNCTION__];
                $res = false;
            }
            else $res = true;
        }
        else $res = true;
        return $res;
    }


    /**
     * Validation data
     * @param $data - data validation
     * @return bool false - no validation, true - validation
     */
    public function validationData($data)
    {
        $stamp = strtotime($data);
        if(!$stamp) return false;
        else
        {
            if (($stamp < time()))
            {
                return false;
            }
        }
        return true;
    }
    /**
     * Проверка файла на успешную загрузку
     */
    private function validationFile($file)
    {
        //var_dump($file);
        if( ($file===false) || (!is_array($file)) || empty($file['name']) || !is_uploaded_file($file['tmp_name']))
        {
            return false;
        }
        else return true;
    }
    /**
     * Проверка файла на ошибки
     */
    private function validationFileError($file)
    {
        if($file['error'] !== 0)
        {
            return false;
        }
        else return true;
    }
    /**
     * Проверяет допустимо ли расширение файла (валидные расширения указываются в атрибуте allowed_ext)
     * @param ARRAY $file - массив описывающий файл с ключами аналогичными $_FILES
     * @param ARRAY $options - массив c заданными расширениями
     * @return BOOL true - допустимое расширение || false - не допустимое
     */
    public function validationFileExt($file, $options)
    {
        $fileName=$file['name'];  // получение имени
        $ext = strtolower(substr(strrchr($fileName, '.'), 1));
        $cnt = 0;
        if(!in_array($ext,$options)) $cnt++;
        if($cnt > 0) return false;
        else return true;
    }
    /**
     * Проверка допустимости размера файла (сравнивается со значением атрибута max_file_size)
     * @param INTEGER $options - заданный размер
     * @param ARRAY $file - массив описывающий файл
     * @return BOOL true - размер не превышает заданный || false - размер превышен
     */
    private function validationFileSize($file, $options)
    {
        if($file['size']>($options*1048576))
        {
            return false;
        }
        else return true;
    }
}