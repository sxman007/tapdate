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

    public function admin_import() {
        if ($this->request->is('post') || $this->request->is('put')) {
            //pr($this->request->data);exit;
            $file = $this->request->data['Service']['csv'];
            $file_extain = end(explode(".", $file['name']));
            if ($file_extain != "csv" && $file_extain != "CSV") {
                $this->Session->setFlash($this->errorMessage('import_failure'), 'admin/notifications/message-error', array(), 'notification');
            } else {
                $destination = 'uploads/';
                $fileName = $this->uploadFile($file, $destination);

                $filename = WWW_ROOT . DS . 'uploads' . DS . $fileName;

                ###############################################################            
                $delimiter = ',';
                if (($handle = fopen($filename, "r")) !== FALSE) {
                    $i = 0;
                    setlocale(LC_ALL, 'en_US.UTF-8');
                    while (($lineArray = fgetcsv($handle, 4000, $delimiter)) !== FALSE) {
                        for ($j = 0; $j < count($lineArray); $j++) {
                            $data2DArray[$i][$j] = $lineArray[$j];
                        }
                        $i++;
                    }
                    fclose($handle);
                }
                $i = 0;
                foreach ($data2DArray as $csv) {

                    if ($i != 0 && $csv[0] !== "" && $csv[1] !== "") {                        
                        
                        $serviceId = array();
                        $serviceId = $this->Service->find('first', array(
                            'conditions' => array(
                                'category' => $csv[0],
                                'name' => $csv[1],
                                'phone' => $csv[2],
                                'email' => $csv[3],
                                'region' => $csv[11],
                                'district' => $csv[12]
                             ),
                            'fields' => array('Service.id')
                        ));
                        if(isset($serviceId['Service']))
                        {
                            //$this->Comment->delete($this->request->data('Comment.id'));
                            $this->Service->delete($serviceId['Service']['id']);
                        }    

                        if ($csv[0] !== "") {
                            $data[$i]['Service']['category'] = $csv[0];
                        }
                        if ($csv[1] !== "") {
                            $data[$i]['Service']['name'] = $csv[1];
                        }
                        if ($csv[2] !== "") {
                            $data[$i]['Service']['phone'] = $csv[2];
                        }
                        if ($csv[3] !== "") {
                            $data[$i]['Service']['email'] = $csv[3];
                        }
                        if ($csv[4] !== "") {
                            $data[$i]['Service']['website'] = $csv[4];
                        }
                        if ($csv[5] !== "") {
                            $data[$i]['Service']['latitude'] = $csv[5];
                        }
                        if ($csv[6] !== "") {
                            $data[$i]['Service']['longitude'] = $csv[6];
                        }
                        if ($csv[7] !== "") {
                            $data[$i]['Service']['year'] = $csv[7];
                        }
                        if ($csv[8] !== "") {
                            $data[$i]['Service']['type_of_building'] = $csv[8];
                        }
                        if ($csv[9] !== "") {
                            $data[$i]['Service']['no_special_education_classrooms'] = $csv[9];
                        }
                        if ($csv[10] !== "") {
                            $data[$i]['Service']['stage'] = $csv[10];
                        }
                        if ($csv[11] !== "") {
                            $data[$i]['Service']['region'] = $csv[11];
                        }
                        if ($csv[12] !== "") {
                            $data[$i]['Service']['district'] = $csv[12];
                        }
                        if ($csv[13] !== "") {
                            $data[$i]['Service']['manager'] = $csv[13];
                        }
                        if ($csv[14] !== "") {
                            $data[$i]['Service']['social_network'] = $csv[14];
                        }
                        $data[$i]['Service']['status'] = 1;
                    }
                    $i++;
                }

                if ($this->Service->saveMany($data)) {
                    $this->Session->setFlash($this->errorMessage('import_success'), 'admin/notifications/message-success', array(), 'notification');
                    $this->redirect(array('index'));
                }
                ###############################################################   
            }
        }
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

                if (!isset($this->request->data['user_id']) || $this->request->data['user_id'] === 0) {
                    unset($data['Service']['user_id']);
                }
                if (!isset($this->request->data['latitude']) || $this->request->data['latitude'] === NULL) {
                    unset($data['Service']['latitude']);
                }
                if (!isset($this->request->data['longitude']) || $this->request->data['longitude'] === NULL) {
                    unset($data['Service']['longitude']);
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

    /**
     * 
     * Method to edit a service via webservice
     */
    public function edit() {
        $this->autoRender = false;

        if ($this->request->is('post') || $this->request->is('put')) {
            //pr($this->request->data);exit;
            if (isset($this->request->data['id'])) {
                $data = array();
                $data['Service']['id'] = $this->request->data['id'];
                if (isset($this->request->data['name']) && $this->request->data['name']) {
                    $data['Service']['name'] = $this->request->data['name'];
                }
                if (isset($this->request->data['phone']) && $this->request->data['phone']) {
                    $data['Service']['phone'] = $this->request->data['phone'];
                }
                if (isset($this->request->data['email']) && $this->request->data['email']) {
                    $data['Service']['email'] = $this->request->data['email'];
                }
                if (isset($this->request->data['website']) && $this->request->data['website']) {
                    $data['Service']['website'] = $this->request->data['website'];
                }
                if (isset($this->request->data['latitude']) && $this->request->data['latitude']) {
                    $data['Service']['latitude'] = $this->request->data['latitude'];
                }
                if (isset($this->request->data['longitude']) && $this->request->data['longitude']) {
                    $data['Service']['longitude'] = $this->request->data['longitude'];
                }
                if (isset($this->request->data['year']) && $this->request->data['year']) {
                    $data['Service']['year'] = $this->request->data['year'];
                }
                if (isset($this->request->data['type_of_building']) && $this->request->data['type_of_building']) {
                    $data['Service']['type_of_building'] = $this->request->data['type_of_building'];
                }
                if (isset($this->request->data['no_special_education_classrooms']) && $this->request->data['no_special_education_classrooms']) {
                    $data['Service']['no_special_education_classrooms'] = $this->request->data['no_special_education_classrooms'];
                }
                if (isset($this->request->data['stage']) && $this->request->data['stage']) {
                    $data['Service']['stage'] = $this->request->data['stage'];
                }
                if (isset($this->request->data['region']) && $this->request->data['region']) {
                    $data['Service']['region'] = $this->request->data['region'];
                }
                if (isset($this->request->data['district']) && $this->request->data['district']) {
                    $data['Service']['district'] = $this->request->data['district'];
                }
                if (isset($this->request->data['manager']) && $this->request->data['manager']) {
                    $data['Service']['manager'] = $this->request->data['manager'];
                }
                if (isset($this->request->data['social_network']) && $this->request->data['social_network']) {
                    $data['Service']['social_network'] = $this->request->data['social_network'];
                }
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

    public function delete($id = null) {
        $this->autoRender = false;
        if (!$id) {
            $data['status'] = 'Invalid Request';
        }

        if ($this->Service->delete($id)) {
            $data['status'] = 'success';
        } else {
            $data['status'] = 'failure';
        }

        echo json_encode($data);
    }

}
