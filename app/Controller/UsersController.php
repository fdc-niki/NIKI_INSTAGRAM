<?php
class UsersController extends AppController {

    public $uses = array("User", "Album");

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array(
            "login",
            "register",
            "delete_user",
            "edit_user"
        ));
    }

    public function home(){
        $view_user = $this->User->find('first', array(
            'conditions' => array(
                'User.user_id' => $this->Auth->User('user_id')
            ),
            'fields' => array(
                'user_id',
                'user_name',
                'user_email',
                'user_image_path',
                'user_created',
                'user_modified'
            )
        ));
        $this->set('view_user', $view_user);
    }

    public function register(){
        if($this->Auth->User("user_id")){
            $this->redirect(array(
                "controller" => "users",
                "action" => "index"
            ));
        }
        $image_path = "";
        if($this->request->is("post")){
            echo "<pre>";
            // check if there is tmp_name and proceed
            if(isset($_FILES["input_user_image"]["tmp_name"]) && !empty($_FILES["input_user_image"]["tmp_name"])){
                $source_file = $_FILES["input_user_image"]["tmp_name"];
                $target_file = ROOT."/app/webroot/profile_pictures/" . $_FILES["input_user_image"]["name"];
                move_uploaded_file($source_file, $target_file);
                $image_path = $_FILES["input_user_image"]["name"];

            }
            $data = $this->request->data;
            $this->User->create();
            $this->User->set(array(
                "user_name" => $data["input_user_name"],
                "user_email" => $data["input_user_email"],
                "user_password" => $data["input_user_password"],
                "user_status" => 1,
                "user_created" => date("Y-m-d H:i:s"),
                "user_image_path" => $image_path
            ));
            // save user and make a variable
            $user = $this->User->save();
            // get the variable and login
            $this->Auth->login($user["User"]);

            $this->redirect("/users/home");
        }
    }

    public function edit_profile_image(){
        $image_path = "";
        if($this->request->is("post")){
            $user_id = $this->Auth->User('user_id');
            if(isset($_FILES["new_profile_image"]["tmp_name"]) && !empty($_FILES["new_profile_image"]["tmp_name"])){
                $source_file = $_FILES["new_profile_image"]["tmp_name"];
                $target_file = ROOT."/app/webroot/profile_pictures/" . $_FILES["new_profile_image"]["name"];
                move_uploaded_file($source_file, $target_file);
                $image_path = $_FILES["new_profile_image"]["name"];

            }
            $data = $this->request->data;
            $this->User->read(null, $user_id);
            $this->User->set(array(
                'user_image_path' => $image_path,
                "user_modified" => date("Y-m-d H:i:s")
            ));

            $user = $this->User->save();
            $this->redirect('/users/home');
        }
    }

    public function login(){
        if($this->Auth->User("user_id")){
            $this->redirect(array(
                "controller" => "users",
                "action" => "home"
            ));
        }
        $email = $this->request->data('login_user_email');
        $password = $this->request->data('login_user_password');
        if($this->request->is("post")){
            $check_email_password = $this->User->find("first", array(
                "conditions" => array(
                    "user_email" => $email,
                    "user_password" => $password
                )
            ));
            if($check_email_password){
                $this->Auth->login($check_email_password["User"]);
                $this->redirect(array(
                    "controller" => "images",
                    "action" => "index"
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
                "controller" => "users",
                "action" => "login"
            ));
        }
    }



    public function upload_image($filename = ""){
    	return pathinfo($filename, PATHINFO_EXTENSION);

        if($this->request->is("post")){
            $file = $this->request->data["new_image"];
            $extension = upload_image($file["input_image_title"]);
            if ($extension == "jpg" || $extension == "jpeg") {
              $is_valid_extension = true;
            }
            $data = $this->request->data;
            // $album_id = ;
            $this->Image->create();
            $this->Image->set(array(
                "image_title" => $data["input_image_title"],
                "image_description" => $data["input_image_description"],
                "image_status" => 1,
                "image_created" => date("Y-m-d H:i:s"),
                "album_id" => $album_id
            ));
            // save user and make a variable
            $album = $this->Image->save();
            move_uploaded_file(
              $file["tmp_name"],
              "./assets/" . $last_insert_id . "." . $extension
            );
            $this->redirect("/Users/");
        }
    }

    public function manage_users(){
        if(!$this->Auth->User('admin_id')){
            return $this->redirect("/");
        }
        $search = $this->request->query("search");
        if(empty($search)){
            $search = "";
        }
        if($this->request->is("get") && !empty($search)) {
            $this->paginate = array(
                "conditions" => array(
                    "user_status" => 1,
                    "OR" => array(
                        "user_name LIKE" => "%$search%",
                        "user_email LIKE" => "%$search%"
                    )
                ),
                "order" => array(
                    "user_id desc"
                ),
                "fields" => array(
                    "user_id",
                    "user_name",
                    "user_email",
                    "user_created",
                    "user_modified",
                    "user_image_path"
                ),
                "limit" => 5,
                "paramType" => "querystring"
            );
            $search_users = $this->paginate("User");
            $this->set("view_users", $search_users);
        } else {
            $this->paginate = array(
                'conditions' => array(
                    'user_status' => 1
                ),
                'fields' => array(
                    'user_id',
                    'user_name',
                    'user_email',
                    'user_created',
                    'user_modified',
                    'user_image_path'
                ),
                'order' => array(
                    'user_id DESC'
                ),
                "limit" => 5,
                "paramType" => "querystring"
            );
            $view_users = $this->paginate("User");
            $this->set('view_users', $view_users);
        }
    }

    // public function edit_user($user_id = null){
    //     if(!$user_id){
    //         throw new NotFoundException(__('Invalid user'));
    //     }
    //
    //     $user = $this->User->findByUserId($user_id);
    //     if(!$user){
    //         throw new NotFoundException(__('Invalid user'));
    //     }
    //     if($this->request->is(array('post', 'put'))){
    //         $this->User->read(null, $user_id);
    //         $this->User->set(array(
    //             "user_modified" => date("Y-m-d H:i:s")
    //         ));
    //         if($this->User->save($this->request->data)){
    //             $this->Flash->success(__('The user has been updated.'));
    //             return $this->redirect(array('action' => 'manage_users'));
    //         }
    //         $this->Flash->error(__('Unable to update the user.'));
    //     }
    //
    //     if(!$this->request->data){
    //         $this->request->data = $user;
    //     }
    //     $this->set("view_user", $user);
    // }

    public function edit_user(){
        $user_id = $this->request->query('user_id');
        if($this->request->is("post") || $this->request->is("put")){
            $data = $this->request->data;
            // null part is $fields
            $this->User->read(null, $user_id);
            $this->User->set(array(
                "user_name" => $data["input_edit_user_name"],
                "user_email" => $data["input_edit_user_email"],
                "user_password" => $data["input_new_user_password"],
                "user_modified" => date("Y-m-d H:i:s")
            ));

            $user_password = $this->User->find('first', array(
                'conditions' => array(
                    'User.user_id' => $user_id,
                    'User.user_password' => $data['input_current_user_password']
                )
            ));

            if(!$user_password){
                $this->Flash->error(__('The password you entered was wrong.'));
            } else if($this->Auth->User('admin_id')){
                $this->User->save();
                $this->Flash->success(__('The user has been updated.'));
                $this->redirect("/users/manage_users");
            } else {
                $this->User->save();
                $this->Flash->success(__('The user has been updated.'));
                $this->redirect("/users/home");
            }
        }

        $user = $this->User->find("first", array(
            "conditions" => array(
                'User.user_id' => $user_id
            ),
            'fields' => array(
                'user_id',
                'user_name',
                'user_email'
            )
        ));
        $this->set("view_user", $user);
    }


    public function delete_user($user_id = null){
        if(!$this->Auth->User('admin_id')){
            return $this->redirect("/");
        }
        $user_id = $this->request->query("user_id");
        if($this->request->is(array('post', 'put'))){
            $this->User->read(null, $user_id);
            $this->User->set(array(
                "user_status" => 0,
                "user_modified" => date("Y-m-d H:i:s")
            ));
            if($this->User->save($this->request->data)){
                $this->Flash->success(__('The user has been deleted.'));
                return $this->redirect(array('action' => 'manage_users'));
            }
            $this->Flash->error(__('Unable to delete the user.'));
        }
    }



}
 ?>
