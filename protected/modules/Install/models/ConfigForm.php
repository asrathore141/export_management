<?php

class ConfigForm extends CFormModel {
    public $baseUrl='http://';
    public $host="localhost";
    public $port="3306";
    public $dbName;
    public $username="root";

    public $full_name;
    public $user_name;
    public $password;
    public $gender;
            
    public function rules() {
        return array(
            array('port', 'numerical', 'integerOnly'=>true),
//            array('baseUrl','url'),
        );
    }
    
    /**
     * Returns the attribute labels.
     * Attribute labels are mainly used in error messages of validation.
     * By default an attribute label is generated using {@link generateAttributeLabel}.
     * This method allows you to explicitly specify attribute labels.
     *
     * Note, in order to inherit labels defined in the parent class, a child class needs to
     * merge the parent labels with child labels using functions like array_merge().
     *
     * @return array attribute labels (name=>label)
     * @see generateAttributeLabel
     */
    public function attributeLabels() {
        return array(
            'baseUrl'=>'Base Url',
            'host'=>'Database Host',
            'port'=>'Port',
            'dbName'=>'Database Name',
            'username'=>'User Name',
            'password'=>'Password',

            'full_name' => 'Full Name',
            'user_name' => 'User Name',
            'password' => 'Password',
            'gender' => 'Gender',
        );
    }
    
    /**
    * check connection to database available
    * 
    * @return boolean
    */
    public function checkConnection() {
        $valid = true;
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbName}";
            $connection=new CDbConnection($dsn, $this->username, $this->password);
            $connection->active=true;
        } catch (Exception $e){
            $valid = false;
        }
        
        return $valid;
    }
}