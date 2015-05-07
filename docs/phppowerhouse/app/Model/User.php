<?php

/*
 * Model ::  User
 * Table ::  users
 */

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $name = 'User';
    
    public $validate = array(
        'email' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter valid email'
            ),
            'email' => array(
                'rule' => 'email',
                'message' => 'Please enter valid email'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This email is already registered'
            )
        ),
        'name' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter name'
        )
    );
    
    
    
    public function checkDuplicate($check){
        return $this->find('count',array(
            'conditions' => array(
                'email' => $check['email']
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

}
