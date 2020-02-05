<?php
class AdminsController extends AppController {

    public $uses = array("Admin", "User", "Album", "Image");

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array(
            "login",
            "register",
            "create_album",
            "add_image",
            "edit_album",
            "edit_image",
            "delete_album",
            "delete_image",
            "manage_albums",
            "manage_images",
            'manage_users',
            'delete_user',
            'edit_user'
        ));
    }

    public function home(){
        $today = date('Y-m-d');
        $count_images = $this->Image->find('count', array(
            'conditions' => array(
                'image_status' => 1,
                'image_created between ? and ?' => array(
                    $today.' 00:00:00', $today.' 23:59:59'
                )
            )
        ));
        $this->set('count_images', $count_images);

        $count_albums = $this->Album->find('count', array(
            'conditions' => array(
                'album_status' => 1,
                'album_created between ? and ?' => array(
                    $today.' 00:00:00', $today.' 23:59:59'
                )
            )
        ));
        $this->set('count_albums', $count_albums);

        $count_users = $this->User->find('count', array(
            'conditions' => array(
                'user_status' => 1,
                'user_created between ? and ?' => array(
                    $today.' 00:00:00', $today.' 23:59:59'
                )
            )
        ));
        $this->set('count_users', $count_users);

    }


    public function login(){
        if($this->Auth->User("admin_id")){
            $this->redirect(array(
                "controller" => "admins",
                "action" => "home"
            ));
        }
        $email = $this->request->data('login_admin_email');
        $password = $this->request->data('login_admin_password');
        if($this->request->is("post")){
            $check_email_password = $this->Admin->find("first", array(
                "conditions" => array(
                    "admin_email" => $email,
                    "admin_password" => $password
                )
            ));
            if($check_email_password){
                $this->Auth->login($check_email_password["Admin"]);
                $this->redirect(array(
                    "controller" => "admins",
                    "action" => "home"
                ));
            } else {
                $this->Flash->error(__("Invalid email or password, try again"));
            }
        }
    }

    public function logout(){
        if($this->request->is("post")){
            $this->Auth->logout();
            $this->redirect(array(
                "controller" => "admins",
                "action" => "login"
            ));
        }
    }
}
 ?>
