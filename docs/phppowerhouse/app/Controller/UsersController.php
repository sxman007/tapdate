<?php

App::uses('CakeEmail', 'Network/Email');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UsersController extends AppController {

    /**
     * @var type => String
     *      value => Name of the controller
     */
    public $name = 'Users';

    /**
     *
     * @var type => Array
     *      value => Loads models required for this controller
     */
    public $uses = array('User');

    /**
     * "beforeFilter" for UsersController
     */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function uniqueEmail() {
        $this->autoRender = false;
        $this->layout = 'ajax';

        $email = $this->data['email'];
        $options['conditions'] = array(
            'email' => $email,
        );

        $searchresult = $this->User->find('count', $options);
        if ($searchresult) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * Displayes Login for admin
     */
    public function login() {
        $this->autoRender = FALSE;
        
        $email = isset($this->request->data['email']) ? $this->request->data['email'] : '';
        $password = isset($this->request->data['password']) ? $this->request->data['password'] : '';
        
        if($email && $password){
            $user = $this->User->find('first',array(
                'fields' => array(
                    'User.id',
                    'User.email',
                    'User.name'
                ),
                'conditions' => array(
                    'User.email' => $email,
                    'User.password' => AuthComponent::password($password)
                )
            ));

            if(!isset($user['User'])){
                $data['status'] = 'failure';
            }else{
                $data['status'] = 'success';
                $data['user'] = $user['User'];
            }
        }else{
            $data['status'] = 'failure';
        }
        
        echo json_encode($data);
    }

    /**
     *  Logout method for administrator
     */
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Displayes list of users
     */
    public function admin_index() {
        $this->set('title_for_layout', ' - Users Management');

        $this->paginate['User'] = array(
            'limit' => 15,
            'order' => array(
                'User.id' => 'DESC'
            )
        );

        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }

        $search = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : isset($this->request->query['search']) ? $this->request->query['search'] : '';

        if ($search) {
            $this->paginate['User']['conditions']['OR'] = array(
                "User.name LIKE" => "%" . $search . "%",
                "User.email LIKE" => "%" . $search . "%"
            );
        }
        ############################################################################################

        $this->Paginator->settings = $this->paginate['User'];
        $results = $this->paginate('User');
        $this->set('results', $results);
        $this->set('count', count($results));
    }

    /**
     * 
     * Method to add a new user
     */
    public function admin_add() {
        if ($this->request->is('post') || $this->request->is('put')) {
            
            $password = $this->getMicrotime();
            $this->request->data['User']['password'] = $password;
            
            if ($this->User->save($this->request->data)) {

                /*****************Confimation mail ******************************* */
                $Email = new CakeEmail();
                $Email->subject('Registration Confirmation')
                        ->to($this->request->data['User']['email'])
                        ->template('registration_confirmation', 'default')
                        ->emailFormat('html')
                        ->viewVars(array(
                            'id' => $this->User->id,
                            'name' => $this->request->data['User']['name'],
                            'email' => $this->request->data['User']['email'],
                            'password' => $this->request->data['User']['password']
                        ))
                        ->from('admin@tawasal.com')
                        ->send();
                /*****************Confimation mail ********************************/


                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            }
        }
    }

    /**
     * 
     * Method to edit an user
     */
    public function admin_edit($id = null) {
        if (!$id) {
            $this->redirect($this->referer());
        }

        $this->User->id = $id;

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                $this->redirect(array('action' => 'index', 'admin' => TRUE));
            }
        }

        $this->request->data = $this->User->read();
    }

    /**
     * Update status of a record Active/Inactive/Remove (will work with all the models)
     * @param type $model
     * @param type $id
     * @param type $status
     */
    public function admin_change_status($id, $status) {
        if (!$id || !isset($status)) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }

        $this->$model->updateAll(
                array($model . '.status' => $status), array($model . '.id' => $id)
        );

        if ($status == 0)
            $msg = 'record_inactive';
        elseif ($status == 1)
            $msg = 'record_active';

        $this->Session->setFlash($this->errorMessage($msg), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect($this->referer());
    }
    
    
    
    public function admin_delete($id = null){
        if(!$id){
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }
        
        $this->User->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect($this->referer());
    }
    
    
    public function activate($id = null){
        if(!$id || !$this->User->find('count',array('conditions' => array('User.id' => $id)))){
            die('Invalid Request');
        }
        
        $this->User->updateAll(array(
            'User.status' => 1
        ),array(
            'User.id' => $id
        ));
    }

}
