<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ServicesController extends AppController {

    /**
     * @var type => String
     *      value => Name of the controller
     */
    public $name = 'Services';

    /**
     * Models to use
     */
    public $uses = array('Service', 'User');

    /**
     * "beforeFilter" for Controller
     */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * Displayes list of services
     */
    public function admin_index() {
        $this->set('title_for_layout', ' - Services Management');

        $this->paginate['Service'] = array(
            'limit' => 15,
            'order' => array(
                'Service.id' => 'DESC'
            )
        );

        ############################################################################################
        // Search & pagination --- start
        if ($this->request->is('post')) {
            $this->request->query = $this->request->data['Service'];
        } else {
            $this->request->data['Service'] = $this->request->query;
        }

        $search = isset($this->request->data['Service']['search']) ? $this->request->data['Service']['search'] : isset($this->request->query['search']) ? $this->request->query['search'] : '';
        $category = isset($this->request->data['Service']['category']) ? $this->request->data['Service']['category'] : isset($this->request->query['category']) ? $this->request->query['category'] : '';

        if ($category) {
            $this->paginate['Service']['conditions']['Service.category'] = $category;
        }
        if ($search) {
            $this->paginate['Service']['conditions']['OR'] = array(
                "LOWER(Service.name) LIKE" => "%" . $search . "%",
                "LOWER(Service.region) LIKE" => "%" . $search . "%",
                "LOWER(Service.district) LIKE" => "%" . $search . "%"
            );
        }

        ############################################################################################

        $this->Paginator->settings = $this->paginate['Service'];
        $results = $this->Paginator->paginate('Service');
        $this->set('results', $results);
        $this->set('count', count($results));
    }

    /**
     * 
     * Method to add new service
     */
    public function admin_add() {
        $this->set('title_for_layout', ' - Add a Service');

        if ($this->request->is('post') || $this->request->is('put')) {

            if (!isset($this->request->data['Service']['year']) || $this->request->data['Service']['year'] === '') {
                unset($this->request->data['Service']['year']);
            }
            //pr($this->request->data);exit;
            if ($this->Service->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
            } else {
                $this->Session->setFlash($this->errorMessage('update_error'), 'admin/notifications/message-error', array(), 'notification');
            }
            $this->redirect(array('action' => 'index', 'admin' => TRUE));
        }
    }

    /**
     * 
     * Method to edit a service
     * 
     * @param type $id
     */
    public function admin_edit($id = null) {
        if (!$id) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }

        $this->set('title_for_layout', ' - Edit a Service');

        $this->Service->id = $id;

        if ($this->request->is('post') || $this->request->is('put')) {
            //pr($this->request->data);exit;

            if (!isset($this->request->data['Service']['year']) || $this->request->data['Service']['year'] === '') {
                unset($this->request->data['Service']['year']);
            }

            if ($this->Service->save($this->request->data)) {
                $this->Session->setFlash($this->errorMessage('update_success'), 'admin/notifications/message-success', array(), 'notification');
            } else {
                $this->Session->setFlash($this->errorMessage('update_error'), 'admin/notifications/message-error', array(), 'notification');
            }
            $this->redirect(array('action' => 'index', 'admin' => TRUE));
        }

        $this->request->data = $this->Service->read();
    }

    public function admin_change_status($id, $status) {
        if (!$id || !isset($status)) {
            $this->Session->setFlash($this->errorMessage('missing_parameter'), 'admin/notifications/message-error', array(), 'notification');
            $this->redirect($this->referer());
        }

        $this->Service->updateAll(
                array('Service.status' => $status), array('Service.id' => $id)
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

        $this->Service->delete($id);
        $this->Session->setFlash($this->errorMessage('record_delete'), 'admin/notifications/message-success', array(), 'notification');
        $this->redirect($this->referer());
    }

    public function error() {
        throw new NotFoundException('404');
    }

    public function index($type = null) {
        $this->autoRender = FALSE;
        $data = array();
        if (!$type) {
            $data['error'] = 'Invalid Request';
        }

        $services = $this->Service->find('all', array(
            'fields' => array(
                'Service.id',
                'Service.name'
            ),
            'conditions' => array(
                'Service.status' => 1,
                'Service.category' => $type
            )
        ));

        foreach ($services as $service) {
            $data[] = $service['Service'];
        }

        echo json_encode($data);
    }

    public function details($id) {
        $this->autoRender = false;

        if (!$id) {
            $data['error'] = 'Invalid Request';
        }

        $service = $this->Service->findById($id);

        echo json_encode($service['Service']);
    }

    /**
     * 
     * Method to add new service via webservice
     */
    public function add() {
        $this->autoRender = false;

        if ($this->request->is('post') || $this->request->is('put')) {
            //pr($this->request->data);exit;
            if (isset($this->request->data['category']) && isset($this->request->data['name'])) {
                $data = array();
                $data['Service']['user_id'] = isset($this->request->data['user_id']) ? $this->request->data['user_id'] : 0;
                $data['Service']['category'] = $this->request->data['category'];
                $data['Service']['name'] = $this->request->data['name'];
                $data['Service']['phone'] = isset($this->request->data['phone']) ? $this->request->data['phone'] : '';
                $data['Service']['email'] = isset($this->request->data['email']) ? $this->request->data['email'] : '';
                $data['Service']['website'] = isset($this->request->data['website']) ? $this->request->data['website'] : '';
                $data['Service']['latitude'] = isset($this->request->data['latitude']) ? $this->request->data['latitude'] : '';
                $data['Service']['longitude'] = isset($this->request->data['longitude']) ? $this->request->data['longitude'] : '';
                $data['Service']['year'] = isset($this->request->data['year']) ? $this->request->data['year'] : '';
                $data['Service']['type_of_building'] = isset($this->request->data['type_of_building']) ? $this->request->data['type_of_building'] : '';
                $data['Service']['no_special_education_classrooms'] = isset($this->request->data['no_special_education_classrooms']) ? $this->request->data['no_special_education_classrooms'] : '';
                $data['Service']['stage'] = isset($this->request->data['stage']) ? $this->request->data['stage'] : '';
                $data['Service']['region'] = isset($this->request->data['region']) ? $this->request->data['region'] : '';
                $data['Service']['district'] = isset($this->request->data['district']) ? $this->request->data['district'] : '';
                $data['Service']['manager'] = isset($this->request->data['manager']) ? $this->request->data['manager'] : '';
                $data['Service']['social_network'] = isset($this->request->data['social_network']) ? $this->request->data['social_network'] : '';
                $data['Service']['status'] = 1;

                if (!isset($this->request->data['year']) || $this->request->data['year'] === '') {
                    unset($data['Service']['year']);
                }

                if ($this->Service->save($data)) {
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

}
