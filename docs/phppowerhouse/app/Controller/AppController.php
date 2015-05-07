<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    /**
     * @var components => Includes specified components in entire project's scope
     * 
     * i.e. All these components listed here will be available to all the controllers 
     */
    public $components = array(
        'Session',
        'Cookie',
        'Auth',
        'Paginator',
        'RequestHandler'
    );
    
    
    /**
     *
     * @var components => Includes specified helpers in entire project's scope
     */
    public $helpers = array('Html', 'Form', 'Text');
    
    
    
    /**
     * Setting the pagination object with the sorting & pagination limit criteria
     */
    public $paginate = array(
        'order' => array(
            'id' => 'DESC'
        ),
        'limit' => 15
    );
    
    




    /**
     * "beforefilter" method for AppController
     */
    public function beforeFilter() {
        parent::beforeFilter();
        

        /*pr($this);
        die('End of $this Array');*/
        
        /**
         * Checking if routing prefix is enabled & is set to 'admin';
         * 
         * If prefix is 'admin' then set the 'layout' to 'admin',
         * otherwise set 'layout' as 'default'
         */
        if (isset($this->request->params['admin']) && $this->request->params['admin']){
            $this->layout = 'admin';
            AuthComponent::$sessionKey = 'Auth.Admin';
            $this->Auth->loginAction = array('controller' => 'admins', 'action' => 'login', 'admin' => TRUE);
            $this->Auth->loginRedirect = array('controller' => 'admins', 'action' => 'dashboard', 'admin' => TRUE);
            $this->Auth->logoutRedirect = array('controller' => 'admins', 'action' => 'login', 'admin' => TRUE);
            $this->Auth->authenticate = array(
                'Form' => array(
                    'fields' => array('username' => 'email'),
                    'userModel' => 'Admin',
                    'scope' => array('Admin.is_active' => 1)
                )
            );
        } else {
            $this->layout = 'ajax';
            $this->Auth->allow();
        }
    }
    
    
    
    public function beforeRender() {
        //$this->layout = ($this->request->is("ajax")) ? "ajax" : $this->layout;
    } 
    
    
    
    public function errorMessage($type){
        $msg = '';
        switch ($type) {
            case 'update_success':
                
                $msg = __('Record updated successfully.');
                
                break;
            
            case 'update_error':
                
                $msg = __('Error in updation.');
                
                break;
            
            case 'missing_parameter':
                
                $msg = __('Error! Some parameters are missing.');
                
                break;
            
            case 'record_inactive':
                
                $msg = __('Record is now inactive.');
                
                break;
            
            case 'record_active':
                
                $msg = __('Record is now active.');
                
                break;
            
            case 'record_delete':
                
                $msg = __('Record deleted successfully.');
                
                break;
            
            case 'old_password_mismatch':
                
                $msg = __('Old password is wrong. Please provide the correct password and then try again.');
                
                break;
            
            case 'nothing_updated':
                
                $msg = __('Nothing updated.');
                
                break;
            
            case 'eep_code_generation_success':
                
                $msg = __('Eep code(s) generated successfully.');
                
                break;
            
            case 'import_success':
                
                $msg = __('Record imported successfully.');
                
                break;
            
            case 'import_failure':
                
                $msg = __('Given File Type Is Invalid.Please Upload a CSV File');
                
                break;

            default:
                break;
            
        }
        
        return $msg;
    }
    
    
    
    /**
     * 
     * @param type $file  =>  Contains array returned from $_FILES
     * @param type $destination  =>  Path to upload the file. Default is /webroot/uploads/
     */
    public function uploadFile($file, $destination){
       
        $rootPath = WWW_ROOT;
        if(!$file || !is_array($file))
            return false;
        
        $uploadPath = $rootPath . $destination;
        $fileName = '';
        
       // pr($file);
        
       // echo $uploadPath;
        if(move_uploaded_file($file['tmp_name'], $uploadPath."".$file['name'] )){
            $fileName = $file['name'];
            
        }
       //echo $fileName;
        //exit;
        return $fileName;
    }
    
    
    
    /**
     * Return middle part of microtime() returned string
     * @return type
     */
    public function getMicrotime(){
        $microtime = microtime();
        $microtime = explode(' ', $microtime);
        $microtime = explode('.', $microtime[0]);
        return $microtime[1];
    }
    
    
    
    /*public function get_option($option){
        $this->loadModel('Setting');
        $option = $this->Setting->find('first',array(
            'conditions' => array(
                'Setting.option_name' => $option
            )
        ));
        return $option['Setting']['option_value'];
    }*/
    
}
