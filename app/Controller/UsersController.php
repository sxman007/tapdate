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
     * Displayes Login for webservice
     */
    public function login() {
        $this->autoRender = FALSE;
//echo Security::hash('admin', null, true).'<br>';
//echo  AuthComponent::password('admin');exit;
        $email = isset($this->request->data['email_id']) ? $this->request->data['email_id'] : '';
        $password = isset($this->request->data['password']) ? $this->request->data['password'] : '';

        if ($email && $password) {
            $data['status']=array();
            $data['user']=array();
            $user = $this->User->find('first', array(
                'fields' => array(
                    'User.id',
                    'User.user_name',
                    'User.email_id',
                    'User.first_name',
                    'User.status'
                ),
                'conditions' => array(
                    'User.email_id' => $email,
                    'User.password' => AuthComponent::password($password),
                    'User.status' => 1
                )
            ));
App::uses('MyClass', 'MyDir');
            if (!isset($user['User'])) {
                $data['status'] = 'failure';
            } else {
                $data['status'] = 'success';
                $data['user'] = $user['User'];
            }
        } else {
            $data['status'] = 'failure';
        }

        echo json_encode($data);
    }

    /**
     *  Register for webservice
     */
    public function register() {
        $this->autoRender = FALSE;
        $user_name = strtolower(isset($this->request->data['user_name']) ? $this->request->data['user_name'] : '');
        $first_name = isset($this->request->data['first_name']) ? $this->request->data['first_name'] : '';
        $last_name = isset($this->request->data['last_name']) ? $this->request->data['last_name'] : '';
        $email = isset($this->request->data['email_id']) ? $this->request->data['email_id'] : '';
        $password = isset($this->request->data['password']) ? $this->request->data['password'] : '';
        $dob = isset($this->request->data['dob']) ? $this->request->data['dob'] : '';
        $gender = isset($this->request->data['gender']) ? $this->request->data['gender'] : '';
        $location = isset($this->request->data['location']) ? $this->request->data['location'] : '';
        //$device_type = isset($this->request->data['device_type']) ? $this->request->data['device_type'] : '';
        $lat = isset($this->request->data['lat']) ? $this->request->data['lat'] : '';
        $long = isset($this->request->data['long']) ? $this->request->data['long'] : '';
        if ($gender == 'Male') {
            $gender = 'Female';
        } else {
            $gender == 'Male';
        }
        if ($email && $password && $user_name) {
            $checkusername = $this->User->query("select * from `users`  WHERE `users`.`user_name` ='" . $user_name . "'");
            if (count($checkusername) == 0) {
                $user['User'] = array(
                    'user_name' => $user_name,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email_id' => $email,
                    'password' => $password,
                    'dob' => date('Y-m-d', strtotime($dob)),
                    'gender' => $gender,
                    'search_by_gender' => $gender,
                    'profile_status' => 1,
                    'search_limit' => 100,
                    'location' => $location,
                    //'device_type' => $device_type,
                    'lat' => $lat,
                    'long' => $long,
                    'status' => 1,
                    'creation_date' => date('Y-m-d h:i:s')
                );
                if ($this->User->save($user)) {
                    $data['status'] = 'success';
                } else {

                    $data['status'] = 'already_register';
                }
            } else {
                $data['status'] = 'username_already_exists';
            }
        } else {
            $data['status'] = 'failure';
        }

        echo json_encode($data);
    }

    /**
     *  edit profile for web service
     */
    public function edit_profile() {
        $this->autoRender = FALSE;
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        $first_name = isset($this->request->data['first_name']) ? $this->request->data['first_name'] : '';
        $last_name = isset($this->request->data['last_name']) ? $this->request->data['last_name'] : '';
        $email = isset($this->request->data['email_id']) ? $this->request->data['email_id'] : '';
        $dob = isset($this->request->data['dob']) ? $this->request->data['dob'] : '';
        $gender = isset($this->request->data['gender']) ? $this->request->data['gender'] : '';
        $relationship_status = isset($this->request->data['relationship_status']) ? $this->request->data['relationship_status'] : '';
        $interested_in = isset($this->request->data['interested_in']) ? $this->request->data['interested_in'] : '';
        $my_ethnicity = isset($this->request->data['my_ethnicity']) ? $this->request->data['my_ethnicity'] : '';
        $my_sextual_orientation = isset($this->request->data['my_sextual_orientation']) ? $this->request->data['my_sextual_orientation'] : '';
        $my_height = isset($this->request->data['my_height']) ? $this->request->data['my_height'] : '';
        $my_body_type = isset($this->request->data['my_body_type']) ? $this->request->data['my_body_type'] : '';
        $hobbies = isset($this->request->data['hobbies']) ? $this->request->data['hobbies'] : '';
        $about_me = isset($this->request->data['about_me']) ? $this->request->data['about_me'] : '';

        /*         * ****** check device ************** */
        $device_type = isset($this->request->data['device_type']) ? $this->request->data['device_type'] : '';
        if ($device_type == 'ios') {

            /*             * *********** get image from ios ******************* */
            $logo = isset($_FILES['image']) ? $_FILES['image'] : '';
            if ($logo) {
                $imageextention = explode('.', $logo['name']);
                $logoname = time() . rand(00000, 99999) . '.' . $imageextention[1];
                $logo_tempname = $logo['tmp_name'];
                $filepath = WWW_ROOT . 'uploads/users/images/' . $logoname;

                $filename = $logoname;
                move_uploaded_file($logo_tempname, $filepath);
            } else {
                $filename = '';
            }
        } else {
            $image = isset($this->request->data['image']) ? $this->request->data['image'] : '';
            //echo $image;
            //exit;
            if ($image) {
                /*                 * * $this->base64_to_jpeg function created in  app controller for base 64 encode to image and return file name********* */
                $filename = $this->base64_to_jpeg($image);
                //echo $image.'<br>M';
                // exit;
                /*                 * ********End************** */
            } else {
                $filename = '';
            }
            //echo $filename;
        }
        if ($id) {
            $user['User'] = array(
                'id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'dob' => date('Y-m-d', strtotime($dob)),
                'gender' => $gender,
                'relationship_status' => $relationship_status,
                'interested_in' => $interested_in,
                'my_ethnicity' => $my_ethnicity,
                'my_sextual_orientation' => $my_sextual_orientation,
                'my_height' => $my_height,
                'my_body_type' => $my_body_type,
                'hobbies' => $hobbies,
                'about_me' => $about_me,
                'image' => $filename,
                'modification_date' => date('Y-m-d h:i:s')
            );
            if ($this->User->save($user)) {
                $data['status'] = 'success';
            } else {
                $data['status'] = 'failure';
            }
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    /**
     *  remove edit profile image for web service
     */
    public function remove_profile_image() {
        $this->autoRender = FALSE;
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        if ($id) {
            $user['User'] = array(
                'id' => $id,
                'image' => ''
            );
            if ($this->User->save($user)) {
                $data['status'] = 'success';
            } else {

                $data['status'] = 'failure';
            }
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    /**
     *  view profile for web service
     */
    public function view_profile() {
        $this->autoRender = FALSE;
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        if ($id) {
            $data['status']=array();
            $data['user']=array();
            $userdetails = $this->User->findById($id);
            if ($userdetails['User']['image']) {
                $userdetails['User']['image'] = ROOT_URL . '/uploads/users/images/' . $userdetails['User']['image']; //$this->here;//WWW_ROOT . 'uploads/users/images/' .$userdetails['User']['image'];
            }
            $data['user'] = $userdetails['User'];
            $data['status'] = 'success';
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    /**
     *  forgot for web service
     */
    public function forgot_password1() {
        $this->autoRender = FALSE;
        $this->loadModel('Admin');
//echo Security::hash('admin', null, true);exit;
        $email = isset($this->request->data['email_id']) ? $this->request->data['email_id'] : '';
        $password = isset($this->request->data['password']) ? $this->request->data['password'] : '';
        $userdetails = $this->User->find('first', array('conditions' => array('User.email_id' => $email)));
        if ($userdetails) {
            $admin_data = $this->Admin->find('first');
            $admin_email = $admin_data['Admin']['admin_email'];
            $email_template = "<div style='width:800px;
margin:0 auto'>
	<div style='background-color:#f10a4f; color:#fff; font-size:30px; padding:15px 0; text-align:center; display:block !important;'>
<!--<img alt = '' src = 'http://phppowerhousedemo.com/webroot/team23/palstake/img/frontend_images/logo.png' />-->TapDate
</div>
<div style = 'background-color:#9e9e9e; padding:10px; font-family:Arial, Helvetica, sans-serif; color:#5a3333; font-size:13px; line-height:16px;'>
<div style = 'background-color:#fff; padding:10px;'>
<p>
Hi, <a href = '' style = 'color:#CC6699; text-decoration:none;'>[EMAIL]</a></p>
<p>
Your New password generate successfully.</p>
<p>This is your New Password : [NEW_PASSWORD]</p>
<p>
For confirm your password please click button below.</p>
<div style = 'border-radius: 5px;width:120px; height:20px; background-color:#E00041; text-align:center; color:#fff; padding-top:5px; font-weight:bold;'>
<a href = '[LINK]' style = 'cursor:pointer; color:#ffffff; text-decoration:none;'><span style = 'color:#ffffff;'>Click to confirm </span> </a></div>
</div>
</div>
<div style = 'background-color:#dbdbdb; border-top:1px solid #9e9e9e; padding:5px 0; text-align:center; font-size:11px; color:#9a7788; font-family:Arial, Helvetica, sans-serif;'>
copyright text &copy; 2014</div>
</div>
<p>
&nbsp;
</p>
";
            $page_link = ROOT_URL . 'users/email_confirmation/' . base64_encode($email) . '/' . base64_encode($password);
            $template1 = str_replace('[EMAIL]', ucfirst($userdetails['User']['first_name']) . ' ' . ucfirst($userdetails['User']['last_name']), $email_template);
            $template2 = str_replace('[LINK]', $page_link, $template1);
            $template3 = str_replace('[NEW_PASSWORD]', $password, $template2);
            $template_last = htmlentities('<html><head></head><body>') . $template3 . htmlentities('</body></html>');
            $subject = 'Password Change Request';
            $Email = new CakeEmail();
            $Email->emailFormat('html');
            $Email->from($admin_email);
            $Email->to($userdetails['User']['email_id']);
            $Email->subject($subject);
            $Email->send(html_entity_decode($template_last));
            $data['status'] = 'success';
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    public function forgot_password() {
        $random = substr(md5(rand()), 0, 7);
        $this->autoRender = FALSE;
        $this->loadModel('Admin');
        $email = isset($this->request->data['email_id']) ? $this->request->data['email_id'] : '';
        //$password = isset($this->request->data['password']) ? $this->request->data['password'] : '';
        $userdetails = $this->User->find('first', array('conditions' => array('User.email_id' => $email)));
        if ($userdetails) {
            $userdetails['User']['security_code'] = $random;
            $this->User->save($userdetails);
            $admin_data = $this->Admin->find('first');
            $admin_email = $admin_data['Admin']['admin_email'];
            $email_template = "<div style='width:800px;
margin:0 auto'>
	<div style='background-color:#f10a4f; color:#fff; font-size:30px; padding:15px 0; text-align:center; display:block !important;'>
<!--<img alt = '' src = 'http://phppowerhousedemo.com/webroot/team23/palstake/img/frontend_images/logo.png' />-->TapDate
</div>
<div style = 'background-color:#9e9e9e; padding:10px; font-family:Arial, Helvetica, sans-serif; color:#5a3333; font-size:13px; line-height:16px;'>
<div style = 'background-color:#fff; padding:10px;'>
<p>
Hi, <a href = '' style = 'color:#CC6699; text-decoration:none;'>[EMAIL]</a></p>
<p>
Your security code generate successfully.</p>
<p>This is your security code : [NEW_PASSWORD]</p>


</div>
</div>
<div style = 'background-color:#dbdbdb; border-top:1px solid #9e9e9e; padding:5px 0; text-align:center; font-size:11px; color:#9a7788; font-family:Arial, Helvetica, sans-serif;'>
copyright text &copy; 2014</div>
</div>
<p>
&nbsp;
</p>
";
            // $page_link = ROOT_URL . 'users/email_confirmation/' . base64_encode($email) . '/' . base64_encode($password);
            $template1 = str_replace('[EMAIL]', ucfirst($userdetails['User']['first_name']) . ' ' . ucfirst($userdetails['User']['last_name']), $email_template);
            // $template2 = str_replace('[LINK]', $page_link, $template1);
            $template3 = str_replace('[NEW_PASSWORD]', $random, $template1);
            $template_last = htmlentities('<html><head></head><body>') . $template3 . htmlentities('</body></html>');
            $subject = 'Forgot password';
            $Email = new CakeEmail();
            $Email->emailFormat('html');
            $Email->from($admin_email);
            $Email->to($userdetails['User']['email_id']);
            $Email->subject($subject);
            $Email->send(html_entity_decode($template_last));
            $data['email'] = $email;
            $data['status'] = 'success';
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    public function security_check() {
        $this->autoRender = FALSE;
        //$email = isset($this->request->data['email_id']) ? $this->request->data['email_id'] : '';
        $password = isset($this->request->data['password']) ? $this->request->data['password'] : '';
        $security_code = isset($this->request->data['security_code']) ? $this->request->data['security_code'] : '';
        if ($password && $security_code) {
            $userdetails = $this->User->find('first', array('conditions' => array('User.security_code' => $security_code)));
            if ($userdetails) {
                //if ($userdetails['User']['security_code'] == $security_code) {
                    $userdetails['User']['password'] = $password;
                    //$userdetails['User']['security_code'] = '';
                    if ($this->User->save($userdetails)) {
                        $data['status'] = 'success';
                    } else {
                        $data['status'] = 'failure';
                    }
                //} else {
                  //  $data['status'] = 'not_match';
                //}
            } else {
                $data['status'] = 'not_match';
            }
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    public function email_confirmation($email, $password) {

        //$this->autoRender = FALSE;
        //$this->loadModel('Member'); 
        //echo  sha1(mt_rand(100,999));
        $username = base64_decode($email);
        $password = base64_decode($password);
        $userdetails = $this->User->find('first', array('conditions' => array('User.email_id' => $username)));
        if ($userdetails) {
            $userdetails['User']['password'] = $password;
            $this->User->save($userdetails);
            $this->set('userdetails', $userdetails);
            //$this->set('count', count($results));
        }
    }

    /*     * *********** view profile upload user profile image *************** */

    public function upload_image() {
        $this->autoRender = FALSE;
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        //$image = isset($this->request->data['image']) ? $this->request->data['image'] : '';
        /*         * ****** check device ************** */
        $device_type = isset($this->request->data['device_type']) ? $this->request->data['device_type'] : '';
        if ($device_type == 'ios') {

            /*             * *********** get image from ios ******************* */
            $logo = isset($_FILES['image']) ? $_FILES['image'] : '';
            if ($logo) {
                $imageextention = explode('.', $logo['name']);
                $logoname = time() . rand(00000, 99999) . '.' . $imageextention[1];
                $logo_tempname = $logo['tmp_name'];
                $filepath = WWW_ROOT . 'uploads/users/images/' . $logoname;

                $filename = $logoname;
                move_uploaded_file($logo_tempname, $filepath);
            } else {
                $filename = '';
            }
        } else {
            $image = isset($this->request->data['image']) ? $this->request->data['image'] : '';
            //echo $image;
            //exit;
            if ($image) {
                /*                 * * $this->base64_to_jpeg function created in  app controller for base 64 encode to image and return file name********* */
                $filename = $this->base64_to_jpeg($image);
                /*                 * ********End************** */
            } else {
                $filename = '';
            }
            //echo $filename;
        }
        if ($id) {

            /* if ($image) {
              $filename = $this->base64_to_jpeg($image);
              } else if ($logo) {
              $filename = $logoname;
              } else {
              $filename = '';
              } */


            /*             * * $this->base64_to_jpeg function created in  app controller for base 64 encode to image and return file name********* */
            //$filename = $this->base64_to_jpeg($image);
            /*             * ********End************** */
            $this->request->data['id'] = $id;
            $this->request->data['image'] = $filename;

            if ($this->User->save($this->request->data)) {
                //move_uploaded_file($logo_tempname, $filepath);
                $data['status'] = 'success';
            } else {
                $data['status'] = 'failure';
            }
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    /**
     *  search friends for webservice
     */
    public function search_friends() {
        $this->autoRender = FALSE;
        $req_id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        $search_value = isset($this->request->data['search_value']) ? $this->request->data['search_value'] : '';
        $search_tab = isset($this->request->data['tab']) ? $this->request->data['tab'] : '';
        if ($req_id) {
            $data['status']=array();
            $data['User']=array();
            
            $user = $this->User->findById($req_id);
            $search_by_gender = $user['User']['search_by_gender'];
            $options['fields'] = array('Friend.*', 'User.*', 'Like.*');

            $options['joins'] = array(
                array('table' => 'friends',
                    'alias' => 'Friend',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Friend.friend_id = User.id',
                        'AND' => array(
                            array('Friend.user_id' => $req_id),
                        //array('Friend.reply_status !=' => array(1, 3))
                        )
                    )
                ),
                array(
                    'alias' => 'Like',
                    'table' => 'likes',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Like.friend_id = User.id',
                        'AND' => array(
                            array('Like.user_id' => $req_id)
                        )
                    )
            ));
            $options['conditions'] = array(
                'User.id !=' => $req_id,
                'User.gender' => $search_by_gender
            );
            if ($search_value && $search_tab == 'all') {
                $options['conditions']['OR'] = array(
                    "User.first_name LIKE" => "%" . $search_value . "%",
                    "User.last_name LIKE" => "%" . $search_value . "%",
                    "User.hobbies LIKE" => "%" . $search_value . "%",
                    "User.location LIKE" => "%" . $search_value . "%",
                );
            } else if ($search_value && $search_tab == 'name') {
                $options['conditions']['OR'] = array(
                    "User.first_name LIKE" => "%" . $search_value . "%",
                    "User.last_name LIKE" => "%" . $search_value . "%",
                );
            } else if ($search_value && $search_tab == 'hobbies') {
                $options['conditions']['OR'] = array(
                    "User.hobbies LIKE" => "%" . $search_value . "%"
                );
            } else if ($search_value && $search_tab == 'place') {
                $options['conditions']['OR'] = array(
                    "User.location LIKE" => "%" . $search_value . "%"
                );
            }
            $alluser = array();
            $alluser = $this->User->find('all', $options);
            if (is_array($alluser) && count($alluser) > 0) {
                foreach ($alluser as $key => $value) {
                    //$alluser[$key]['User']['reply_status'] = $value['Friend']['reply_status'];
                    if ($value['Friend']['request_status'] == null) {
                        $request_status = '';
                    } else {
                        $request_status = $value['Friend']['request_status'];
                    }
                    $alluser[$key]['User']['request_status'] = $request_status;
                    if ($value['Like']['is_notified'] == null) {
                        $notify = '';
                    } else {
                        $notify = $value['Like']['is_notified'];
                    }
                    $alluser[$key]['User']['is_notified'] = $notify;
                    if ($alluser[$key]['User']['image']) {
                        $alluser[$key]['User']['image'] = ROOT_URL . '/uploads/users/images/' . $alluser[$key]['User']['image'];
                    }
                    if ($value['Friend']['reply_status'] == 1 || $value['Friend']['reply_status'] == 3) {
                        unset($alluser[$key]);
                    }
                    unset($alluser[$key]['Friend']);
                    unset($alluser[$key]['Like']);
                }
            }

            if (count($alluser) > 0) {
                $data['status'] = 'success';
                /** for json format ******** */
                $data['User'] = Hash::extract($alluser, '{n}.User');
                //$data['user'] = $search;
            } else {
                $data['status'] = 'no_result';
            }

            //pr($search);
        } else {
            $data['status'] = 'failure';
        }

        echo json_encode($data);
    }

    /**
     *  update lat long in a particular time for webservice
     */
    public function update_latlong() {
        $this->autoRender = FALSE;
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        $lat = isset($this->request->data['lat']) ? $this->request->data['lat'] : '';
        $long = isset($this->request->data['long']) ? $this->request->data['long'] : '';
        if ($id) {
            if ($this->User->save($this->request->data)) {
                //move_uploaded_file($logo_tempname, $filepath);
                $data['status'] = 'success';
            } else {
                $data['status'] = 'failure';
            }
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    /**
     *  friends list for webservice
     */
    public function friends_list() {
        $this->autoRender = FALSE;
        //$this->loadModel = 'Friend';
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        if ($id) {
            $data['status']=array();
            $data['User']=array();
            
            $options['fields'] = array('User.*', 'Like.*');
            $options['joins'] = array(
                array('table' => 'friends',
                    'alias' => 'Friend',
                    'type' => 'inner',
                    'conditions' => array(
                        'Friend.friend_id = User.id',
                        'AND' => array(
                            array('Friend.user_id' => $id),
                            array('Friend.reply_status' => 1)
                        )
                    )
                ),
                array(
                    'alias' => 'Like',
                    'table' => 'likes',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Like.friend_id = User.id',
                        'AND' => array(
                            array('Like.user_id' => $id)
                        )
                    )
                )
            );
            $friends = $this->User->find('all', $options);
            foreach ($friends as $key => $value) {
                //$alluser[$key]['User']['reply_status'] = $value['Friend']['reply_status'];
                //$friends[$key]['User']['request_status'] = $value['Friend']['request_status'];
                if ($value['Like']['is_notified'] == null) {
                    $notify = '';
                } else {
                    $notify = $value['Like']['is_notified'];
                }
                $friends[$key]['User']['is_notified'] = $notify;
                if ($friends[$key]['User']['image']) {
                    $friends[$key]['User']['image'] = ROOT_URL . '/uploads/users/images/' . $friends[$key]['User']['image'];
                }
                //if($value['Friend']['reply_status'] ==1 || $value['Friend']['reply_status'] ==3 ) {
                //  unset($alluser[$key]);
                // }
                // unset($alluser[$key]['Friend']);
                unset($friends[$key]['Like']);
            }
            if (count($friends) > 0) {
                //$data['user'] = $friends;
                $data['status'] = 'success';
                $data['User'] = Hash::extract($friends, '{n}.User');
            } else {
                $data['status'] = 'no_result';
            }

            /* for ($i = 0; $i < count($friends); $i++) {
              $data['user'][] = $friends[$i]['User'];
              if ($data['user'][$i]['image']) {
              $data['user'][$i]['image'] = ROOT_URL . '/uploads/users/images/' . $data['user'][$i]['image'];
              }
              //echo $i;
              // pr($search[$i]['users']);
              } */
            // pr($friends);
        } else {
            $data['status'] = 'failure';
        }
        /** for json format ******** */
        //pr($data);
        echo json_encode($data);
    }

    /**
     *  view friends profile for webservice
     */
    /*  public function view_friend_profile() {
      $this->autoRender = FALSE;
      $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
      if ($id) {
      $userdetails = $this->User->findById($id);
      $userdetails['User']['image'] = ROOT_URL . '/uploads/users/images/' . $userdetails['User']['image']; //$this->here;//WWW_ROOT . 'uploads/users/images/' .$userdetails['User']['image'];
      $data['user'] = $userdetails['User'];
      $data['status'] = 'success';
      } else {
      $data['status'] = 'failure';
      }
      echo json_encode($data);
      } */

    /**
     *  add friend for webservice
     */
    public function add_friend() {
        $this->autoRender = FALSE;
        $this->loadModel('Friend');
        $user_id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        $friend_id = isset($this->request->data['friend_id']) ? $this->request->data['friend_id'] : '';
        if ($user_id && $friend_id) {
            $friends = $this->Friend->query("select * from `friends`  WHERE `friends`.`friend_id` ='" . $friend_id . "' and `friends`.`user_id`='" . $user_id . "'");
            if (count($friends) == 0) {
                $user['Friend'] = array(
                    'user_id' => $user_id,
                    'friend_id' => $friend_id,
                    'request_status' => 1,
                    'creation_date' => date('Y-m-d h:i:s')
                );
                if ($this->Friend->save($user)) {
                    $data['status'] = 'success';
                } else {
                    $data['status'] = 'failure';
                }
            } else {
                $this->Friend->query("UPDATE `friends` SET `reply_status` = '0',`request_status` = '1' WHERE `friends`.`friend_id` ='" . $friend_id . "' and `friends`.`user_id`='" . $user_id . "'");
                $data['status'] = 'success';
            }
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    /**
     *  Lets date (like )for webservice
     */
    public function like() {
        $this->autoRender = FALSE;
        $this->loadModel('Like');
        $user_id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        $friend_id = isset($this->request->data['friend_id']) ? $this->request->data['friend_id'] : '';
        if ($user_id && $friend_id) {
            $friends_like = $this->Like->query("select * from `likes`  WHERE `likes`.`friend_id` ='" . $friend_id . "' and `likes`.`user_id`='" . $user_id . "'");
            if (count($friends_like) == 0) {
                $user['Like'] = array(
                    'user_id' => $user_id,
                    'friend_id' => $friend_id,
                    'is_notified' => 1,
                    'creation_date' => date('Y-m-d h:i:s')
                );
                if ($this->Like->save($user)) {
                    $data['status'] = 'success';
                } else {
                    $data['status'] = 'failure';
                }
            } else {
                $data['status'] = 'failure';
            }
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    /**
     *  Date Prospects for webservice
     */
    public function date_prospects() {
        $this->autoRender = FALSE;
        $this->loadModel('Like');
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        if ($id) {
            $data['status']=array();
            $data['Friend']=array();
            $data['Like']=array();
            /*             * ********** like table update ************ */
            $this->Like->query("UPDATE `likes` SET `is_notified` = '2' WHERE `likes`.`friend_id` ='" . $id . "'");
            /*             * ********** for date prospects(like ) list ************ */

            $options['fields'] = array('Like.*', 'User.*');
            $options['joins'] = array(
                array('table' => 'likes',
                    'alias' => 'Like',
                    'type' => 'inner',
                    'conditions' => array(
                        'Like.user_id = User.id',
                        'AND' => array(
                            array('Like.friend_id' => $id),
                        //array('Like.is_notified' => )
                        )
                    )
                )
            );
            $options['order'] = array('Like.creation_date' => 'desc');
            $likes = $this->User->find('all', $options);
            foreach ($likes as $key => $value) {
                if ($likes[$key]['User']['image']) {
                    $likes[$key]['User']['image'] = ROOT_URL . 'uploads/users/images/' . $likes[$key]['User']['image'];
                }
                /* time calculation Like Time ******** */
                $likedate = new DateTime($likes[$key]['Like']['creation_date']);
                $currentdate = new DateTime();
                $difftime = $likedate->diff($currentdate);
                $likes[$key]['User']['hour'] = $difftime->h;
                $likes[$key]['User']['minitues'] = $difftime->i;
                $likes[$key]['User']['day'] = $difftime->d;
                unset($likes[$key]['Like']);
            }
            /*             * ******** for show friend request ************* */
            $friendsrequest['fields'] = array('User.*', 'Friend.*');
            $friendsrequest['joins'] = array(
                array('table' => 'friends',
                    'alias' => 'Friend',
                    'type' => 'inner',
                    'conditions' => array(
                        'Friend.user_id = User.id',
                        'AND' => array(
                            array('Friend.friend_id' => $id),
                            array('Friend.request_status' => 1)
                        )
                    )
            ));
            $friendsrequest['order'] = array('Friend.creation_date' => 'desc');
            $friends = $this->User->find('all', $friendsrequest);
            foreach ($friends as $key => $value) {
                if ($friends[$key]['User']['image']) {
                    $friends[$key]['User']['image'] = ROOT_URL . 'uploads/users/images/' . $friends[$key]['User']['image'];
                }
                /* time calculation Like Time ******** */
                /* $likedate=new DateTime($likes[$key]['Like']['creation_date']);
                  $currentdate=new DateTime();
                  $difftime = $likedate->diff($currentdate);
                  $likes[$key]['User']['hour']=$difftime->h;
                  $likes[$key]['User']['minitues']=$difftime->i;
                  $likes[$key]['User']['day']=$difftime->d; */
                unset($friends[$key]['Friend']);
            }
            if (count($friends) > 0 || count($likes) > 0) {
                $data['status'] = 'success';
            } else {
                $data['status'] = 'no_result';
            }
            if (count($friends) > 0) {
                $data['Friend'] = Hash::extract($friends, '{n}.User');
            }
            // pr($friends);
            /*  foreach($friends['User'] as $like) {
              $creationtime=$like['Like']['creation_date'];
              $data['User']['Letsdate_Time']=$creationtime;
              pr($crea */
            if (count($likes) > 0) {
                $data['Like'] = Hash::extract($likes, '{n}.User');
            }
        } else {
            $data['status'] = 'failure';
        }
        // pr($this->User->getDataSource()->getLog(true));
        // pr($data);
        echo json_encode($data);
    }

    /**
     *  Friends request  for webservice
     */
    public function friends_request_status() {
        $this->autoRender = FALSE;
        $this->loadModel('Friend');
        $user_id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        $friend_id = isset($this->request->data['friend_id']) ? $this->request->data['friend_id'] : '';
        $status = isset($this->request->data['status']) ? $this->request->data['status'] : '';
        if ($user_id && $friend_id && $status) {
            /*             * ******** for accept ********** */
            if ($status == 1) {
                $friends = $this->Friend->query("select * from `friends`  WHERE `friends`.`friend_id` ='" . $friend_id . "' and `friends`.`user_id`='" . $user_id . "'");
                if (count($friends) == 0) {
                    $user['Friend'] = array(
                        'user_id' => $user_id,
                        'friend_id' => $friend_id,
                        'request_status' => 2,
                        'reply_status' => 1,
                        'creation_date' => date('Y-m-d h:i:s')
                    );
                    $this->Friend->save($user);
                } else {
                    $this->Friend->query("UPDATE `friends` SET `reply_status` = '1',`request_status` = '2' WHERE `friends`.`friend_id` ='" . $friend_id . "' and `friends`.`user_id`='" . $user_id . "'");
                }
            }
            /*             * ** for block ************** */
            if ($status == 3) {
                $friends = $this->Friend->query("select * from `friends`  WHERE `friends`.`friend_id` ='" . $friend_id . "' and `friends`.`user_id`='" . $user_id . "'");
                if (count($friends) == 0) {
                    $user['Friend'] = array(
                        'user_id' => $user_id,
                        'friend_id' => $friend_id,
                        'request_status' => 2,
                        'reply_status' => 3,
                        'creation_date' => date('Y-m-d h:i:s')
                    );
                    $this->Friend->save($user);
                } else {
                    $this->Friend->query("UPDATE `friends` SET `reply_status` = '3',`request_status` = '2' WHERE `friends`.`friend_id` ='" . $friend_id . "' and `friends`.`user_id`='" . $user_id . "'");
                }
            }
            /*             * ********** friend table update reply status ************ */
            $this->Friend->query("UPDATE `friends` SET `reply_status` = '" . $status . "',`request_status` = '2' WHERE `friends`.`friend_id` ='" . $user_id . "' and `friends`.`user_id`='" . $friend_id . "'");

            $data['status'] = 'success';
        } else {
            $data['status'] = 'failure';
        }

        echo json_encode($data);
    }

    /**
     *  Count Notification  for webservice
     */
    public function count_notifications() {
        $this->autoRender = FALSE;
        $this->loadModel('Friend');
        $this->loadModel('Like');
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        if ($id) {
            $data['status']=array();
            $data['notifications']=array();
            $options['conditions'] = array(
                'Friend.friend_id' => $id,
                'AND' => array('Friend.request_status' => 1)
            );
            $like['conditions'] = array(
                'Like.friend_id' => $id,
                'AND' => array('Like.is_notified' => 1)
            );
            $friends_count = $this->Friend->find('all', $options);
            $likess_count = $this->Like->find('all', $like);
            $total_notification = (count($likess_count) + count($friends_count));
            $data['status'] = 'success';
            $data['notifications'] = $total_notification;
            //pr($this->User->getDataSource()->getLog(true));
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    /**
     *  Suggest  for webservice
     */
    public function suggest() {
        $this->autoRender = FALSE;
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        if ($id) {
            $data['status']=array();
            $data['user']=array();
            $user = $this->User->findById($id);
            $relationship_status = $user['User']['relationship_status'];
            $interested_in = $user['User']['interested_in'];
            $my_ethnicity = $user['User']['my_ethnicity'];
            $my_sextual_orientation = $user['User']['my_sextual_orientation'];
            $my_body_type = $user['User']['my_body_type'];
            $gender = $user['User']['gender'];
            $location = $user['User']['location'];
            $search_by_gender = $user['User']['search_by_gender'];
            /*   if($gender=='Male') {
              $gender='Female';
              }
              else {
              $gender=='Male';
              } */
            $options['fields'] = array('Friend.*', 'User.*', 'Like.*');

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
                array(
                    'alias' => 'Like',
                    'table' => 'likes',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Like.friend_id = User.id',
                        'AND' => array(
                            array('Like.user_id' => $id)
                        )
                    )
            ));
            $options['conditions']['AND'] = array(
                'User.id !=' => $id,
                'User.gender' => $search_by_gender
            );
            $options['conditions']['OR'] = array(
                "User.gender LIKE" => $search_by_gender,
                "User.location LIKE" => $location,
                "User.relationship_status" => $relationship_status,
                "User.interested_in " => $interested_in,
                "User.my_ethnicity LIKE" => $my_ethnicity,
                "User.my_sextual_orientation LIKE" => $my_sextual_orientation,
                "User.my_body_type LIKE" => $my_body_type,
                    //"User.gender LIKE" => $gender,
                    // "User.location LIKE" => $location,
            );
            /* $options['conditions']['AND'] = array(
              'User.search_by_gender'=> $search_by_gender

              //'User.search_by_gender'=> $search_by_gender
              ); */
            $suggest_persons = $this->User->find('all', $options);
            /*             * ********* set image url ************* */
            foreach ($suggest_persons as $key => $value) {
                if ($value['Friend']['request_status'] == null) {
                    $request_status = '';
                } else {
                    $request_status = $value['Friend']['request_status'];
                }
                $suggest_persons[$key]['User']['request_status'] = $request_status;
                if ($value['Like']['is_notified'] == null) {
                    $notify = '';
                } else {
                    $notify = $value['Like']['is_notified'];
                }
                $suggest_persons[$key]['User']['is_notified'] = $notify;
                if ($suggest_persons[$key]['User']['image']) {
                    $suggest_persons[$key]['User']['image'] = ROOT_URL . 'uploads/users/images/' . $suggest_persons[$key]['User']['image'];
                }
                unset($suggest_persons[$key]['Friend']);
                unset($suggest_persons[$key]['Like']);
            }
            if (count($suggest_persons) > 0) {
                $data['status'] = 'success';
                $data['user'] = Hash::extract($suggest_persons, '{n}.User');
            } else {
                $data['status'] = 'no_result';
            }
            //pr($data);
            //pr($this->User->getDataSource()->getLog(true));
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
        // pr($this->User->getDataSource()->getLog(true));
        // pr($data);
    }

    /* public function block_list() {
      $this->autoRender = FALSE;
      //$this->loadModel = 'Friend';
      $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
      if ($id) {
      $options['fields'] = array('User.*', 'Friend.*');
      $options['joins'] = array(
      array('table' => 'friends',
      'alias' => 'Friend',
      'type' => 'inner',
      'conditions' => array(
      'Friend.user_id = User.id',
      'AND' => array(
      array('Friend.friend_id' => $id),
      array('Friend.reply_status' => 3)
      )
      )
      )
      );
      $block_friends = $this->User->find('all', $options);
      pr($block_friends);
      if (count($block_friends) > 0) {
      //$data['user'] = $friends;
      $data['status'] = 'success';
      $data['user'] = Hash::extract($block_friends, '{n}.User');
      } else {
      $data['status'] = 'no_result';
      }

      /* for ($i = 0; $i < count($friends); $i++) {
      $data['user'][] = $friends[$i]['User'];
      if ($data['user'][$i]['image']) {
      $data['user'][$i]['image'] = ROOT_URL . '/uploads/users/images/' . $data['user'][$i]['image'];
      }
      //echo $i;
      // pr($search[$i]['users']);
      } */
    // pr($friends);
    /*  } else {
      $data['status'] = 'failure';
      }
      /** for json format ******** */
    //pr($data);
    /*   echo json_encode($data);
      } */

    /**
     *  unfriend for web service
     */
    public function unfriend() {
        $this->autoRender = FALSE;
        $this->loadModel('Friend');
        $user_id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        $friend_id = isset($this->request->data['friend_id']) ? $this->request->data['friend_id'] : '';
        if ($user_id && $friend_id) {
            $this->Friend->query("delete from `friends`  WHERE `friends`.`friend_id` ='" . $friend_id . "' and `friends`.`user_id`='" . $user_id . "'");
            $this->Friend->query("delete from `friends`  WHERE `friends`.`friend_id` ='" . $user_id . "' and `friends`.`user_id`='" . $friend_id . "'");
            $data['status'] = 'success';
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    /**
     *  change password for administrator
     */
    /* public function change_password() {
      $this->autoRender = FALSE;
      $user_id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
      $password = isset($this->request->data['password']) ? $this->request->data['password'] : '';
      if ($user_id && $password) {
      $userdetails = $this->User->findById($user_id);
      if ($userdetails) {
      $userdetails['User']['password'] = $password;
      if ($this->User->save($userdetails)) {
      $data['status'] = 'success';
      } else {
      $data['status'] = 'failure';
      }
      //$this->set('userdetails', $userdetails);
      //$this->set('count', count($results));
      } else {
      $data['status'] = 'failure';
      }
      } else {
      $data['status'] = 'failure';
      }
      echo json_encode($data);
      } */

    /**
     *  setting view for web service *
     */
    public function setting() {
        $this->autoRender = FALSE;
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        if ($id) {
            $data['status']=array();
            $data['user']=array();
            $data['block']= array();
            $userdetails = $this->User->findById($id);
            if ($userdetails) {
                $data['user'] = $userdetails['User'];
                $data['status'] = 'success';
            }
            /*             * *********** for block list ************ */
            $options['fields'] = array('User.*', 'Friend.*');
            $options['joins'] = array(
                array('table' => 'friends',
                    'alias' => 'Friend',
                    'type' => 'inner',
                    'conditions' => array(
                        'Friend.user_id = User.id',
                        'AND' => array(
                            array('Friend.friend_id' => $id),
                            array('Friend.reply_status' => 3)
                        )
                    )
                )
            );
            $block_friends = $this->User->find('all', $options);
            //pr($block_friends);
            if (count($block_friends) > 0) {
                //$data['user'] = $friends;
                $data['status'] = 'success';
                $data['block'] = Hash::extract($block_friends, '{n}.User');
            }
            //pr($data);
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    /**
     *  setting_update for webservice
     */
    public function setting_update() {
        $this->autoRender = FALSE;

        //pr($user);die;
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        $search_by_gender = isset($this->request->data['search_by_gender']) ? $this->request->data['search_by_gender'] : '';
        $profile_status = isset($this->request->data['profile_status']) ? $this->request->data['profile_status'] : '';
        $search_limit = isset($this->request->data['search_limit']) ? $this->request->data['search_limit'] : '';
        $password = isset($this->request->data['password']) ? $this->request->data['password'] : '';
        if ($id && $search_by_gender && $profile_status && $search_by_gender) {
            if ($password) {
                $user['User'] = array(
                    'id' => $id,
                    'password' => $password,
                    'search_by_gender' => $search_by_gender,
                    'search_limit' => $search_limit,
                    'profile_status' => $profile_status,
                    'modification_date' => date('Y-m-d h:i:s')
                );
                //pr($user);die;
            } else {
                $user['User'] = array(
                    'id' => $id,
                    // 'password' => $password,
                    'search_by_gender' => $search_by_gender,
                    'search_limit' => $search_limit,
                    'profile_status' => $profile_status,
                    'modification_date' => date('Y-m-d h:i:s')
                );
            }
            // pr($user);die;
            if ($this->User->save($user)) {
                $data['status'] = 'success';
            } else {
                $data['status'] = 'failure';
            }
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);
    }

    /**
     *  delete block list 
     */
    public function block_delete() {
        $this->autoRender = FALSE;
        $this->loadModel('Friend');
        $user_id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        $friend_id = isset($this->request->data['friend_id']) ? $this->request->data['friend_id'] : '';
        if ($user_id && $friend_id) {
            //$this->Friend->query("delete from `friends`  WHERE `friends`.`friend_id` ='" . $friend_id . "' and `friends`.`user_id`='" . $user_id . "'");
            $this->Friend->query("delete from `friends`  WHERE `friends`.`friend_id` ='" . $user_id . "' and `friends`.`user_id`='" . $friend_id . "'");
            $data['status'] = 'success';
        } else {
            $data['status'] = 'failure';
        }
        echo json_encode($data);

        /* $this->User->delete($id); */
    }

    /**
     *  map 
     */
    public function map() {
        $this->autoRender = FALSE;

        //$this->loadModel('User');
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : '';
        //$friend_id = isset($this->request->data['friend_id']) ? $this->request->data['friend_id'] : '';
        if ($id) {
            $data['status'] = array();
            $data['user'] = array();
            $users = $this->User->findById($id);
            $lat = $users['User']['lat'];
            $long = $users['User']['long'];
            $search_limit = $users['User']['search_limit'];
            $allusers = $this->User->query("SELECT *, ( 6371 * acos( cos( radians('" . $lat . "') ) * cos( radians( lat ) ) * cos( radians( `long` ) - radians('" . $long . "') ) + sin( radians('" . $lat . "') ) * sin( radians( lat ) ) ) ) AS distance FROM users HAVING distance <='" . $search_limit . "' and id !='" . $id . "' ORDER BY distance LIMIT 0 , 20
");
            $data['status'] = 'success';
            if (count($allusers) > 0) {
                foreach ($allusers as $key => $value) {
                    if ($allusers[$key]['users']['image']) {
                        $allusers[$key]['users']['image'] = ROOT_URL . 'uploads/users/images/' . $allusers[$key]['users']['image'];
                    }
                }
                //$allusers['users']['image'] = ROOT_URL . 'uploads/users/images/' . $allusers['users']['image'];
                $data['user'] = Hash::extract($allusers, '{n}.users');
            }
        } else {
            $data['status'] = 'failure';
        }
        // pr($allusers);
        echo json_encode($data);
        //pr($this->User->getDataSource()->getLog(true));

        /* $this->User->delete($id); */
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
            'limit' => 10,
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
                "User.first_name LIKE" => "%" . $search . "%",
                "User.email_id LIKE" => "%" . $search . "%",
                "User.last_name LIKE" => "%" . $search . "%"
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

            //$password = $this->getMicrotime();
            // $this->request->data['User']['password'] = $password;
            //echo $this->request->data['User']['image'];
            if ($this->request->data['User']['gender'] == 'Male') {
                $this->request->data['User']['search_by_gender'] = 'Female';
            } else {
                $this->request->data['User']['search_by_gender'] == 'Male';
            }
            $this->request->data['User']['search_limit'] = 100;
            $this->request->data['User']['dob'] = date('Y-m-d', strtotime($this->request->data['User']['dob']));
            $this->request->data['User']['creation_date'] = date('Y-m-d h:i:s');
            $logo = $this->request->data['User']['image'];
            $logo_tempname = $logo['tmp_name'];
            $this->request->data['User']['image'] = $this->request->data['User']['image']['name'];
            if ($this->User->save($this->request->data)) {

                /*                 * ***************file Upload ********************* */
                /* $uploadPath = 'users/images/';
                  $resizeOptions['width'] = 100;
                  $resizeOptions['height'] = 100;
                  $resizeOptions['destination'] = 'users/images/';
                  $logo = $this->uploadImage($logo, $uploadPath, TRUE, $resizeOptions);  //Calling uploadImage function defined in AppController.php */
                $filename = WWW_ROOT . '/uploads/users/images/' . $logo['name'];
                move_uploaded_file($logo_tempname, $filename);

                //$this->User->updateAll(array('User.image' => '\'' . $logo . '\''), array('User.id' => $this->User->id));
                /*                 * ***************Confimation mail ******************************* */
                /*  $Email = new CakeEmail();
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
                  ->send(); */
                /*                 * ***************Confimation mail ******************************* */


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
            $logo = $this->request->data['User']['image'];
            // pr($logo);die;
            $logoname = $logo['name'];
            $logo_tempname = $logo['tmp_name'];
            if (!empty($logoname)) {
                $this->request->data['User']['image'] = $this->request->data['User']['image']['name'];
            } else {
                unset($this->request->data['User']['image']);
            }
            $this->request->data['User']['modification_date'] = date('Y-m-d h:i:s');
            $this->request->data['User']['dob'] = date('Y-m-d', strtotime($this->request->data['User']['dob']));
            // pr($this->request->data);die;
            if ($this->User->save($this->request->data)) {
                if ($logoname != "") {

                    if ((int) $logo['error'] == 0) {
                        // $uploadPath = 'users/images/';
                        //$resizeOptions['width'] = 100;
                        // $resizeOptions['height'] = 100;
                        //$resizeOptions['destination'] = 'users/images/';
                        // $logo = $this->uploadFile($logo, $uploadPath);
                        //$logo = $this->uploadImage($logo, $uploadPath, TRUE, $resizeOptions); //Calling uploadImage function defined in AppController.php
                        $filename = WWW_ROOT . 'uploads/users/images/' . $logoname;
                        move_uploaded_file($logo_tempname, $filename);
                        //$this->User->updateAll(array('User.image' => '\'' . $this->request->data['User']['image'] . '\''), array('User.id' => $id));
                    }
                    $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
                    $this->redirect(array('action' => 'index', 'admin' => TRUE));
                }
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

        $this->User->updateAll(
                array('User.status' => $status), array('User.id' => $id)
        );

        if ($status == 0)
            $msg = 'record_inactive';
        elseif ($status == 1)
            $msg = 'record_active';

        $this->Session->setFlash($this->errorMessage($msg), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect($this->referer());
    }

    public function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }

        $this->User->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect($this->referer());
    }

    public function activate($id = null) {
        if (!$id || !$this->User->find('count', array('conditions' => array('User.id' => $id)))) {
            die('Invalid Request');
        }

        $this->User->updateAll(array(
            'User.status' => 1
                ), array(
            'User.id' => $id
        ));
    }

}
