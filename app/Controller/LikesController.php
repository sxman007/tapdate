<?php

class LikesController extends AppController {

    /**
     * @var type => String
     *      value => Name of the controller
     */
    public $name = 'Likes';
    public $uses = array('User');

    /**
     * "beforeFilter" for UsersController
     */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * Displayes list of friends
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
        //pr($this->params['pass']);
        if ($this->params['pass']) {
        $user_id=$this->params['pass'][0];
        $this->set('selected', $user_id);
        }
        else {
        $user_id = isset($this->request->data['User']['search']) ? $this->request->data['User']['search'] : '';
        $this->set('selected', $user_id);
        }
        //pr($this->request->data['User']['search']);die;
        if ($user_id) {
            $this->set('user_id', $user_id);

            $this->pagiante = array(
                'joins' => array(
                    array(
                        'table' => 'likes',
                        'alias' => 'Like',
                        'type' => 'inner',
                        'conditions' => array(
                            'Like.friend_id = User.id',
                            'AND' => array(
                                array('Like.user_id' => $user_id),
                                //array('Like.reply_status' => 1)
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
        $this->loadModel('Like');
        $users = $this->User->find('list', array(
            'fields' => array('User.name')));
        $this->set('users', $users);
        $friends = $this->User->find('list', array(
            'fields' => array('User.name')));
       // $this->set('friends', $friends);

        if ($this->request->is('post')) {
            //pr($this->request->data);
            if ($this->request->data['User']['user'] == $this->request->data['User']['friend']) {
                $this->Session->setFlash($this->errorMessage('user_friend_not_same'), 'admin/notifications/message-error', array(), 'notification');
            } else {
                $friends_like = $this->Like->query("select * from `likes`  WHERE `likes`.`friend_id` ='" . $this->request->data['User']['friend'] . "' and `likes`.`user_id`='" . $this->request->data['User']['user'] . "'");
                 if (count($friends_like) == 0) {
                $user['Like'] = array(
                    'user_id' => $this->request->data['User']['user'],
                    'friend_id' => $this->request->data['User']['friend'],
                    'is_notified' => 1,
                    'creation_date' => date('Y-m-d h:i:s')
                );
                $this->Like->save($user);
                    $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                    $this->redirect(array('action' => 'index', 'admin' => TRUE));
                } else {
                    $this->Session->setFlash($this->errorMessage('already_like'), 'admin/notifications/message-success', array(), 'notification');
                }
            }
        }
    }

    public function admin_delete($user_id = null, $friend_id = null) {
         $this->autoRender = FALSE;
        $this->loadModel('Like');
        if (!$user_id && !$friend_id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        } else {
            $this->Like->query("delete from `likes`  WHERE `likes`.`friend_id` ='" . $friend_id . "' and `likes`.`user_id`='" . $user_id . "'");
            $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
            //$this->redirect($this->referer());
            $this->redirect(array('controller' => 'likes','action' => 'index',$user_id,'admin' => TRUE));
        }

        /* $this->User->delete($id); */
    }
    public function admin_likes_ajax() {
        //$this->autoRender = FALSE;
        $this->loadModel('User');
        $id = $this->request->data['id'];
        $options['fields'] = array('Like.*', 'User.*');
        //echo $id;
        $options['joins'] = array(
           array(
                    'alias' => 'Like',
                    'table' => 'likes',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Like.friend_id = User.id',
                        'AND' => array(
                            array('Like.user_id' => $id),
                            //array('Like.is_notified'=>'')
                        )
                    )
            )
            
        );
        $options['conditions'] = array(
                'User.id !=' => $id
                
            );
        $alluser = $this->User->find('all', $options);
        //pr($alluser);
        if (is_array($alluser) && count($alluser) > 0) {
            foreach ($alluser as $key => $value) {
                if ($value['Like']['is_notified'] == 1 || $value['Like']['is_notified'] == 2 ) {
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
     // pr($list);die;
        $this->set(compact('list'));
    }

}

?>