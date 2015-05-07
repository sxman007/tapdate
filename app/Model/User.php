<?php

/*
 * Model ::  User
 * Table ::  users
 */

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $name = 'User';
    
   /* public $hasMany= array(
        'Friend'=> array(
            'className'=>'Friend',
            'foreignKey'=>'user_id'
        )
    );*/
    
    public $validate = array(
        'user_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter username'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This username is already registered'
            )
        ),
        'email_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter valid email'
            ),
            'email_id' => array(
                'rule' => 'email',
                'message' => 'Please enter valid email'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This email is already registered'
            )
        ),
        'password' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter password'
        ),
        'first_name' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter first name'
        ),
        'last_name' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter last name'
        ),
        'dob' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter dob'
        ),
        'gender' => array(
            'rule' => 'notEmpty',
            'message' => 'Please select gender'
        ),
        'location' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter location'
        )
    );
    
    
    
    public function checkDuplicate($check){
        return $this->find('count',array(
            'conditions' => array(
                'email_id' => $check['email_id']
            )
        ));
    }

    

    /**
     * 
     * @param type $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
    public function __construct($id = false, $table = null, $ds = null) {
    parent::__construct($id, $table, $ds);

    // This is for MySQL, change for whatever DB flavour you're using.
    $this->virtualFields = array(
      'name' => "CONCAT(`{$this->alias}`.`first_name`, ' ', `{$this->alias}`.`last_name`)"
  );
}

}
