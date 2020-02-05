<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
 class AppController extends Controller {
     public $components = array(
         'Flash',
         'Auth' => array(
             // entrance to the system
             'loginRedirect' => array(
                 'controller' => '',
                 'action' => ''
             ),
             // exit from the system
             'logoutRedirect' => array(
                 'controller' => '',
                 'action' => '',
             ),
             //illegally access to the page, forcefully redirect to this page
             'loginAction' => array(
                'controller' => 'users',
                'action' => 'login'
             )
         )
     );

     public $uses = array("User", "Album", "Image");

    //  public function isAuthorized($admin_id = null) {
    //     // 登録済みユーザーなら誰でも公開機能にアクセス可能です。
    //     if (empty($this->request->params['admin_id'])) {
    //         return true;
    //     }
    //
    //     // admin ユーザーだけが管理機能にアクセス可能です。
    //     if (isset($this->request->params['admin_id'])) {
    //         return (bool)($user['role'] === 'admin_id');
    //     }
    //
    //     // デフォルトは拒否
    //     return false;
    // }

     public function beforeFilter(){
        // $this->Auth->authenticate = array('Form');
        // $this->Auth->authenticate = array(
        //     AuthComponent::ALL => array(
        //         'adminModal' => 'Admin'
        //     ),
        //     'Form'
        // );
        // $this->Auth->authenticate = array(
        //     AuthComponent::ALL => array(
        //         'userModel' => 'User'
        //     ),
        //     'Form'
        // );
         $this->Auth->allow('index', 'login');
         $this->set("current_user", $this->Auth->User('user_id'));
         $this->set('current_admin', $this->Auth->User('admin_id'));

         if ($this->Auth->User('admin_id')) {
             $this->layout = 'admin_layout';
         } else if($this->Auth->User('user_id')){
             $this->layout = 'user_layout';
         } else {
             $this->layout = 'default';
         }

         if($this->Auth->User('user_id')){
             $user_info = $this->User->find('first', array(
                 'conditions' => array(
                     'User.user_id' => $this->Auth->User('user_id')
                 ),
                 'fields' => array(
                     'user_name',
                     'user_image_path'
                 )
             ));
             $this->set('user_info', $user_info);
         }
     }
 }
