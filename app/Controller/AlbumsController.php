<?php
class AlbumsController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash', 'Paginator');
    public $paginate = array(
        'limit' => 5,
        'order' => array(
            'Album.album_id' => 'desc'
        )
    );

    public $uses = array("User", "Album", "Admin");

    public function home(){
        if($this->Auth->User("user_id") == null){
            $this->redirect(array(
                "controller" => "users",
                "action" => "login"
            ));
        }

        $user_id = $this->Auth->User("user_id");
        $search = $this->request->query("search");
        if(empty($search)){
            $search = "";
        }
        if($this->request->is("get") && !empty($search)) {
            $this->Paginator->settings = array(
                "conditions" => array(
                    "User.user_id" => $user_id,
                    "album_status" => 1,
                    "OR" => array(
                        "album_title LIKE" => "%$search%",
                        "album_description LIKE" => "%$search%"
                    )
                ),
                "order" => array(
                    "album_id desc"
                ),
                "fields" => array(
                    "album_id",
                    "album_title",
                    "album_description",
                    "album_created",
                    "album_modified"
                ),
                "limit" => 5,
                "paramType" => "querystring"
            );
            $search_albums = $this->Paginator->paginate("Album");
            $this->set("view_all_albums", $search_albums);
        } else {
            $this->Paginator->settings = array(
                "conditions" => array(
                    "User.user_id" => $user_id,
                    "album_status" => 1
                ),
                "order" => array(
                    "album_id DESC"
                ),
                "fields" => array(
                    "album_id",
                    "album_title",
                    "album_description",
                    "album_created",
                    "album_modified"
                ),
                "limit" => 5,
                "paramType" => "querystring"
            );
            $view_all_albums = $this->Paginator->paginate("Album");
            $this->set("view_all_albums", $view_all_albums);
        }
    }

    public function create_album(){
        if($this->request->is("post")){
            $data = $this->request->data;
            $user_id = $this->Auth->User("user_id");
            $this->Album->create();
            $this->Album->set(array(
                "album_title" => $data["input_album_title"],
                "album_description" => $data["input_album_description"],
                "album_status" => 1,
                "album_created" => date("Y-m-d H:i:s"),
                "user_id" => $user_id
            ));
            // save user and make a variable
            $album = $this->Album->save();
            $this->redirect("/albums/home");
        }
    }

    public function edit_album($album_id = null){
        if(!$album_id){
            throw new NotFoundException(__('Invalid post'));
        }

        $album = $this->Album->findByAlbumId($album_id);
        if(!$album){
            throw new NotFoundException(__('Invalid post'));
        }

        if($this->request->is(array('post', 'put'))){
            $this->Album->read(null, $album_id);
            $this->Album->set(array(
                "album_modified" => date("Y-m-d H:i:s")
            ));
            if($this->Album->save($this->request->data)){
                if ($this->Auth->User('admin_id')) {
                    $this->Flash->success(__('The album has been updated.'));
                    return $this->redirect(array('action' => 'manage_albums'));
                } else if($this->Auth->User('user_id')){
                    $this->Flash->success(__('Your album has been updated.'));
                    return $this->redirect(array('action' => 'home'));
                }
            }
            $this->Flash->error(__('Unable to update your album.'));
        }

        if(!$this->request->data){
            $this->request->data = $album;
        }

        // $album_id = $this->request->query("album_id");
        // if($this->request->is(array('post', 'put'))){
        //     // $data = $this->request->data;
        //     // null part is $fields
        //     // $this->Album->read(null, $album_id);
        //     $this->Album->album_id = $album_id;
        //     $this->Album->set(array(
        //         "album_title" => $data["input_edit_album_title"],
        //         "album_description" => $data["input_edit_album_description"],
        //         "album_modified" => date("Y-m-d H:i:s")
        //     ));
        //     $this->Album->save();
        //     $this->redirect("/albums/home");
        // }

        // $album = $this->Album->findById($album_id);
        $this->set("view_album", $album);
    }


    public function delete_album($album_id = null){
        $album_id = $this->request->query("album_id");
        if($this->request->is(array('post', 'put'))){
            $this->Album->read(null, $album_id);
            $this->Album->set(array(
                "album_status" => 0,
                "album_modified" => date("Y-m-d H:i:s")
            ));
            if($this->Album->save()){
                if ($this->Auth->User('admin_id')) {
                    $this->Flash->success(__('The album has been deleted.'));
                    return $this->redirect(array('action' => 'manage_albums'));
                } else if($this->Auth->User('user_id')){
                    $this->Flash->success(__('Your album has been deleted.'));
                    return $this->redirect(array('action' => 'home'));
                }
            }
            $this->Flash->error(__('Unable to delete your album.'));
        }
    }

    public function manage_albums(){
        if(!$this->Auth->User('admin_id')){
            return $this->redirect("/");
        }

        $search = $this->request->query("search");
        if(empty($search)){
            $search = "";
        }
        if($this->request->is("get") && !empty($search)) {
            $this->Paginator->settings = array(
                "conditions" => array(
                    "album_status" => 1,
                    "OR" => array(
                        "album_title LIKE" => "%$search%",
                        "album_description LIKE" => "%$search%"
                    )
                ),
                "order" => array(
                    "album_id desc"
                ),
                "fields" => array(
                    "Album.album_id",
                    "album_title",
                    "album_description",
                    "album_created",
                    "album_modified",
                    "Album.user_id",
                    "User.user_name"
                ),
                "limit" => 5,
                "paramType" => "querystring"
            );
            $search_albums = $this->Paginator->paginate('Album');
            $this->set('view_all_albums', $search_albums);

            // $this->paginate = array(
            //     "conditions" => array(
            //         "album_status" => 1,
            //         "OR" => array(
            //             "album_title LIKE" => "%$search%",
            //             "album_description LIKE" => "%$search%"
            //         )
            //     ),
            //     "order" => array(
            //         "album_id desc"
            //     ),
            //     "fields" => array(
            //         "album_id",
            //         "album_title",
            //         "album_description",
            //         "album_created",
            //         "album_modified",
            //         "user_id",
            //         "user_name"
            //     ),
            //     "limit" => 5,
            //     "paramType" => "querystring"
            // );
            // $search_albums = $this->paginate("Album");
            // $this->set("view_all_albums", $search_albums);
        } else {
            $this->Paginator->settings = array(
                "conditions" => array(
                    "album_status" => 1
                ),
                "order" => array(
                    "album_id desc"
                ),
                "fields" => array(
                    "Album.album_id",
                    "album_title",
                    "album_description",
                    "album_created",
                    "album_modified",
                    "Album.user_id",
                    "User.user_name"
                ),
                "limit" => 5,
                "paramType" => "querystring"
            );
            $view_all_albums = $this->Paginator->paginate('Album');
            $this->set('view_all_albums', $view_all_albums);

            // $this->paginate = array(
            //     "conditions" => array(
            //         "album_status" => 1
            //     ),
            //     "order" => array(
            //         "album_id DESC"
            //     ),
            //     "fields" => array(
            //         "user_id",
            //         "user_name",
            //         "album_id",
            //         "album_title",
            //         "album_description",
            //         "album_created",
            //         "album_modified"
            //     ),
            //     "limit" => 5,
            //     "paramType" => "querystring"
            // );
            // $view_all_albums = $this->paginate("Album");
            // $this->set("view_all_albums", $view_all_albums);
        }
    }
}

?>
