<?php

class FriendsController extends AppController {

    /**
     * @var type => String
     *      value => Name of the controller
     */
    public $name = 'Friends';
    public $uses = array('User');

    /**
     * "beforeFilter" for UsersController
     */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * Displayes list of friends request
     */
    public function admin_index() {
        $this->set('title_for_layout', ' - Users Management');
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.name')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //pr($this->request->data['User']['search']);die;
        if ($user_id) {
            $this->set('user_id', $user_id);

            $this->pagiante = array(
                'joins' => array(
                    array(
                        'table' => 'friends',
                        'alias' => 'Friend',
                        'type' => 'inner',
                        'conditions' => array(
                            'Friend.friend_id = User.id',
                            'AND' => array(
                                array('Friend.user_id' => $user_id),
                                array('Friend.request_status' => 1)
                            )
                        )
                    )
                ),
                'limit' => 10,
                'order' => array(
                    'User.id' => 'DESC'
                )
            );

            $this->Paginator->settings = $this->pagiante;
            $results = $this->paginate('User');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
        } else {
            $this->set('count', 0);
        }
        // }
        //pr($this->User->getDataSource()->getLog(true));
        ############################################################################################
        /* $this->Paginator->settings = $friends; //$this->paginate['User'];
          $results = $this->paginate('User');
          $this->set('results', $results);
          $this->set('count', count($results)); */
    }

    public function admin_add() {
        $this->loadModel('Friend');
        $users = $this->User->find('list', array(
            'fields' => array('User.name')));
        $this->set('users', $users);
        $friends = $this->User->find('list', array(
            'fields' => array('User.name')));
        //$this->set('friends', $friends);
        //pr($this->request->data);
        if ($this->request->is('post')) {
            //die;
            //pr($this->request->data);
            if ($this->request->data['User']['user'] == $this->request->data['User']['friend']) {
                $this->Session->setFlash($this->errorMessage('user_friend_not_same'), 'admin/notifications/message-error', array(), 'notification');
            } else {
                $friends = $this->Friend->query("select * from `friends`  WHERE `friends`.`friend_id` ='" . $this->request->data['User']['friend'] . "' and `friends`.`user_id`='" . $this->request->data['User']['user'] . "'");
                if (count($friends) == 0) {
                    $user['Friend'] = array(
                        'user_id' => $this->request->data['User']['user'],
                        'friend_id' => $this->request->data['User']['friend'],
                        'request_status' => 1,
                        'creation_date' => date('Y-m-d h:i:s')
                    );
                    $this->Friend->save($user);
                    $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                    $this->redirect(array('action' => 'index', 'admin' => TRUE));
                } else {
                    $this->Session->setFlash($this->errorMessage('already_friend'), 'admin/notifications/message-success', array(), 'notification');
                }
            }
        }
    }

    public function admin_delete($user_id = null, $friend_id = null) {
        $this->loadModel('Friend');
        if (!$user_id && !$friend_id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        } else {
            $this->Friend->query("delete from `friends`  WHERE `friends`.`friend_id` ='" . $friend_id . "' and `friends`.`user_id`='" . $user_id . "'");
            $this->Friend->query("delete from `friends`  WHERE `friends`.`friend_id` ='" . $user_id . "' and `friends`.`user_id`='" . $friend_id . "'");
            $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
            //$this->redirect($this->referer());
            $this->redirect(array('controller' => 'friends', 'action' => 'index', $user_id, 'admin' => TRUE));
        }

        /* $this->User->delete($id); */
    }

    public function admin_friends_delete($user_id = null, $friend_id = null) {
        $this->loadModel('Friend');
        if (!$user_id && !$friend_id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        } else {
            $this->Friend->query("delete from `friends`  WHERE `friends`.`friend_id` ='" . $friend_id . "' and `friends`.`user_id`='" . $user_id . "'");
            $this->Friend->query("delete from `friends`  WHERE `friends`.`friend_id` ='" . $user_id . "' and `friends`.`user_id`='" . $friend_id . "'");
            $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
            //$this->redirect($this->referer());
            $this->redirect(array('controller' => 'friends', 'action' => 'friends_list', $user_id, 'admin' => TRUE));
        }

        /* $this->User->delete($id); */
    }

    /**
     * Displayes list of friends request
     */
    public function admin_friends_list() {
        $this->set('title_for_layout', ' - Users Management');
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.name')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //pr($this->request->data['User']['search']);die;
        if ($user_id) {
            $this->set('user_id', $user_id);

            $this->pagiante = array(
                'joins' => array(
                    array(
                        'table' => 'friends',
                        'alias' => 'Friend',
                        'type' => 'inner',
                        'conditions' => array(
                            'Friend.friend_id = User.id',
                            'AND' => array(
                                array('Friend.user_id' => $user_id),
                                array('Friend.reply_status' => 1)
                            )
                        )
                    )
                ),
                'limit' => 10,
                'order' => array(
                    'User.id' => 'DESC'
                )
            );

            $this->Paginator->settings = $this->pagiante;
            $results = $this->paginate('User');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
        } else {
            $this->set('count', 0);
        }
        // }
        //pr($this->User->getDataSource()->getLog(true));
        ############################################################################################
        /* $this->Paginator->settings = $friends; //$this->paginate['User'];
          $results = $this->paginate('User');
          $this->set('results', $results);
          $this->set('count', count($results)); */
    }

    public function admin_activate($user_id = null, $friend_id = null, $status = null) {
        if (!$user_id || !$friend_id || !$status) {
            die('Invalid Request');
        }
        $this->loadModel('Friend');
        if ($status == 1) {
            $friends = $this->Friend->query("select * from `friends`  WHERE `friends`.`friend_id` ='" . $user_id . "' and `friends`.`user_id`='" . $friend_id . "'");
            if (count($friends) == 0) {
                $user['Friend'] = array(
                    'user_id' => $friend_id,
                    'friend_id' => $user_id,
                    'request_status' => 2,
                    'reply_status' => 1,
                    'creation_date' => date('Y-m-d h:i:s')
                );
                $this->Friend->save($user);
            } else {
                $this->Friend->query("UPDATE `friends` SET `reply_status` = '1',`request_status` = '2' WHERE `friends`.`friend_id` ='" . $user_id . "' and `friends`.`user_id`='" . $friend_id . "'");
            }
        }
        /*         * ** for block ************** */
        if ($status == 3) {
            $friends = $this->Friend->query("select * from `friends`  WHERE `friends`.`friend_id` ='" . $user_id . "' and `friends`.`user_id`='" . $friend_id . "'");
            if (count($friends) == 0) {
                $user['Friend'] = array(
                    'user_id' => $friend_id,
                    'friend_id' => $user_id,
                    'request_status' => 2,
                    'reply_status' => 3,
                    'creation_date' => date('Y-m-d h:i:s')
                );
                $this->Friend->save($user);
            } else {
                $this->Friend->query("UPDATE `friends` SET `reply_status` = '3',`request_status` = '2' WHERE `friends`.`friend_id` ='" . $user_id . "' and `friends`.`user_id`='" . $friend_id . "'");
            }
        }
        /*         * ********** friend table update reply status ************ */
        $this->Friend->query("UPDATE `friends` SET `reply_status` = '" . $status . "',`request_status` = '2' WHERE `friends`.`friend_id` ='" . $friend_id . "' and `friends`.`user_id`='" . $user_id . "'");


        if ($status == 1)
            $msg = 'accept';
        elseif ($status == 3)
            $msg = 'block';

        $this->Session->setFlash($this->errorMessage($msg), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect(array('controller' => 'friends', 'action' => 'index', $user_id, 'admin' => TRUE));
    }

    /**
     * Displayes Block list of friends
     */
    public function admin_block_list() {
        $this->set('title_for_layout', ' - Users Management');
        /* show all users */
        $users = $this->User->find('list', array(
            'fields' => array('User.name')));
        $this->set('options', $users);
        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['User'];
        } else {
            $this->request->data['User'] = $this->request->query;
        }
        //if ($this->request->is('post')) {   
        if ($this->params['pass']) {
            $user_id = $this->params['pass'][0];
            $this->set('selected', $user_id);
        } else {
            $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
            $this->set('selected', $user_id);
        }
        //pr($this->request->data['User']['search']);die;
        if ($user_id) {
            $this->set('user_id', $user_id);

            $this->pagiante = array(
                'joins' => array(
                    array(
                        'table' => 'friends',
                        'alias' => 'Friend',
                        'type' => 'inner',
                        'conditions' => array(
                            'Friend.user_id = User.id',
                            'AND' => array(
                                array('Friend.friend_id' => $user_id),
                                array('Friend.reply_status' => 3)
                            )
                        )
                    )
                ),
                'limit' => 10,
                'order' => array(
                    'User.id' => 'DESC'
                )
            );

            $this->Paginator->settings = $this->pagiante;
            $results = $this->paginate('User');
            //pr($results);
            $this->set('results', $results);
            $this->set('count', count($results));
        } else {
            $this->set('count', 0);
        }
        // }
        //pr($this->User->getDataSource()->getLog(true));
        ############################################################################################
        /* $this->Paginator->settings = $friends; //$this->paginate['User'];
          $results = $this->paginate('User');
          $this->set('results', $results);
          $this->set('count', count($results)); */
    }

    public function admin_block_delete($user_id = null, $friend_id = null) {
        $this->loadModel('Friend');
        if (!$user_id && !$friend_id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        } else {
            //$this->Friend->query("delete from `friends`  WHERE `friends`.`friend_id` ='" . $friend_id . "' and `friends`.`user_id`='" . $user_id . "'");
            $this->Friend->query("delete from `friends`  WHERE `friends`.`friend_id` ='" . $user_id . "' and `friends`.`user_id`='" . $friend_id . "'");
            $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
            //$this->redirect($this->referer());
            $this->redirect(array('controller' => 'friends', 'action' => 'block_list', $user_id, 'admin' => TRUE));
        }

        /* $this->User->delete($id); */
    }

    public function admin_friends_ajax() {
        //$this->autoRender = FALSE;
        $this->loadModel('User');
        $id = $this->request->data['id'];
        $options['fields'] = array('Friend.*', 'User.*');
        //echo $id;
        $options['joins'] = array(
            array('table' => 'friends',
                'alias' => 'Friend',
                'type' => 'LEFT',
                'conditions' => array(
                    'Friend.friend_id = User.id',
                    'AND' => array(
                        array('Friend.user_id' => $id),
                    //array('Friend.reply_status !=' => array(1, 3))
                    )
                )
            ),
            
        );
        $options['conditions'] = array(
                'User.id !=' => $id
                
            );
        $alluser = $this->User->find('all', $options);
       // pr($alluser);
        if (is_array($alluser) && count($alluser) > 0) {
            foreach ($alluser as $key => $value) {
                if ($value['Friend']['reply_status'] == 1 || $value['Friend']['reply_status'] == 3 || $value['Friend']['request_status']==1 ) {
                    unset($alluser[$key]);
                }
                unset($alluser[$key]['Friend']);
                //unset($alluser[$key]['Like']);
               
            }
            foreach ($alluser as $key => $value) {
                $id = $alluser[$key]['User']['id'];
                $name = $alluser[$key]['User']['name'];
                $list[$id] = $name;
            }
        }
        //$alluser = $this->User->find('list', $alluser);
        //echo $this->Form->input('friend', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => '','required'=>'true', 'id' => 'friend','options' => $list ));
       $this->set(compact('list'));
    }

}

?>