<?php
class ImagesController extends AppController {

    public $uses = array("User", "Album", "Image");
    public $components = array('Flash', 'Paginator');
    public $paginate = array(
        'limit' => 5,
        'order' => array(
            'Image.image_id' => 'desc'
        )
    );


    public function index(){

        $search = $this->request->query("search");
        if(empty($search)){
            $search = "";
        }
        if($this->request->is("get") && !empty($search)) {
            $this->Paginator->settings = array(
                "conditions" => array(
                    "image_status" => 1,
                    "OR" => array(
                        "image_title LIKE" => "%$search%",
                        "image_description LIKE" => "%$search%"
                    )
                ),
                "order" => array(
                    "image_id desc"
                ),
                "fields" => array(
                    "image_id",
                    "image_title",
                    "image_description",
                    "image_path"
                ),
                "limit" => 5,
                "paramType" => "querystring"
            );
            $search_posts = $this->Paginator->paginate("Image");
            $this->set("view_posts", $search_posts);
        } else {
            $this->Paginator->settings = array(
                "conditions" => array(
                    "image_status" => 1
                ),
                "order" => array(
                    "image_id desc"
                ),
                "fields" => array(
                    "image_id",
                    "image_title",
                    "image_description",
                    "image_path"
                ),
                "limit" => 5,
                "paramType" => "querystring"
            );
            $posts = $this->Paginator->paginate("Image");
            $this->set("view_posts", $posts);
        }
    }

    public function home(){

        $album_id = $this->request->query("album_id");
        $album_title = $this->Album->find('first', array(
            "conditions" => array(
                "Album.album_id" => $album_id
            ),
            "fields" => array(
                "album_title"
            )
        ));
        $this->set("album_title", $album_title);

        $search = $this->request->query("search");
        if(empty($search)){
            $search = "";
        }
        if($this->request->is("get") && !empty($search)) {
            $this->Paginator->settings = array(
                "conditions" => array(
                    "Album.album_id" => $album_id,
                    "image_status" => 1,
                    "OR" => array(
                        "image_title LIKE" => "%$search%",
                        "image_description LIKE" => "%$search%"
                    )
                ),
                "order" => array(
                    "image_id desc"
                ),
                "fields" => array(
                    "image_id",
                    "image_title",
                    "image_description",
                    "image_path",
                    "image_created",
                    "image_modified",
                    "Album.album_id"
                ),
                "limit" => 5,
                "paramType" => "querystring"
            );
            $search_images = $this->Paginator->paginate("Image");
            $this->set("view_all_images", $search_images);
        } else {
            $this->Paginator->settings = array(
                "conditions" => array(
                    "Album.album_id" => $album_id,
                    "image_status" => 1
                ),
                "order" => array(
                    "image_id desc"
                ),
                'fields' => array(
                    "image_id",
                    "image_title",
                    "image_description",
                    "image_path",
                    "image_created",
                    "image_modified",
                    "Album.album_id"
                ),
                "limit" => 5,
                "paramType" => "querystring"
            );
            $view_all_images = $this->Paginator->paginate("Image");
            $this->set("view_all_images", $view_all_images);
        }
    }

    public function add_image(){
        $image_path = "";
        $album_id = $this->request->query('album_id');
        $album_title = $this->Album->find('first', array(
            "conditions" => array(
                "Album.album_id" => $album_id
            ),
            "fields" => array(
                "album_title"
            )
        ));
        $this->set("album_title", $album_title);
        $this->set("album_id", $album_id);
        if($this->request->is("post")){
            echo "<pre>";
            // check if there is tmp_name and proceed
            if(isset($_FILES["input_add_image"]["tmp_name"]) && !empty($_FILES["input_add_image"]["tmp_name"])){
                $source_file = $_FILES["input_add_image"]["tmp_name"];
                $target_file = ROOT."/app/webroot/post_images/" . $_FILES["input_add_image"]["name"];
                move_uploaded_file($source_file, $target_file);
                $image_path = $_FILES["input_add_image"]["name"];

            }
            $data = $this->request->data;
            $this->Image->create();
            $this->Image->set(array(
                "image_title" => $data["input_image_title"],
                "image_description" => $data["input_image_description"],
                "image_status" => 1,
                "image_created" => date("Y-m-d H:i:s"),
                "album_id" => $album_id,
                "image_path" => $image_path
            ));
            // save user and make a variable
            $image = $this->Image->save();
            $this->redirect("/images/home?album_id=$album_id");
        }
        // if($this->request->is("post")){
        //     $data = $this->request->data;
        //     $album_id = $album["Album"]["album_id"];
        //     $this->Image->create();
        //     $this->Image->set(array(
        //         "image_title" => $data["input_image_title"],
        //         "image_description" => $data["input_image_description"],
        //         "image_status" => 1,
        //         "image_created" => date("Y-m-d H:i:s"),
        //         "album_id" => $album_id
        //     ));
        //     // save user and make a variable
        //     $image = $this->Image->save();
        //     $this->redirect("/images/index");
        // }
    }

    public function edit_image($image_id = null){
        $image_id = $this->request->query('image_id');
        $image = $this->Image->findByImageId($image_id);
        if(!$image){
            throw new NotFoundException(__('Invalid post'));
        }

        $album_id = $this->request->query('album_id');
        if($this->request->is(array('post', 'put'))){
            $data = $this->request->data;
            $this->Image->read(null, $image_id);
            $this->Image->set(array(
                "image_title" => $data["input_edit_image_title"],
                "image_description" => $data["input_edit_image_description"],
                "image_modified" => date("Y-m-d H:i:s")
            ));
            if($this->Image->save($this->request->data)){
                if ($this->Auth->User('admin_id')) {
                    $this->Flash->success(__('The image has been updated.'));
                    return $this->redirect(array('action' => 'manage_images'));
                } else if($this->Auth->User('user_id')){
                    $this->Flash->success(__('Your image has been updated.'));
                    return $this->redirect(array('action' => 'home?album_id=' . $album_id));
                }
            }
            $this->Flash->error(__('Unable to update your image.'));
        }

        if(!$this->request->data){
            $this->request->data = $image;
        }

        $this->set("view_image", $image);
    }

    // public function edit_image(){
    //     $image_id = $this->request->query('image_id');
    //     $album_id = $this->request->query('album_id');
    //     $album_title = $this->Album->find('first', array(
    //         "conditions" => array(
    //             "Album.album_id" => $album_id
    //         ),
    //         "fields" => array(
    //             "Album.album_title"
    //         )
    //     ));
    //     $this->set("album_title", $album_title);
    //     $this->set("album_id", $album_id);
    //
    //     if($this->request->is("post") || $this->request->is("put")){
    //         $data = $this->request->data;
    //         // null part is $fields
    //         $this->Image->read(null, $image_id);
    //         $this->Image->set(array(
    //             "image_title" => $data["input_edit_image_title"],
    //             "image_description" => $data["input_edit_image_description"],
    //             "image_modified" => date("Y-m-d H:i:s")
    //         ));
    //         $this->Image->save($this->request->data);
    //         if($this->Auth->User('admin_id')){
    //             $this->redirect("/images/manage_images?album_id=".$album_id);
    //         } else if($this->Auth->User('user_id')){
    //             $this->redirect("/images/home?album_id=".$album_id);
    //         }
    //     }
    //
    //     $image = $this->Image->find("first", array(
    //         "conditions" => array(
    //             "image_id" => $image_id
    //         )
    //     ));
    //     $this->set("view_image", $image);
    // }


    public function delete_image($image_id = null){
        $image_id = $this->request->query("image_id");
        $album_id = $this->request->query("album_id");
        if($this->request->is(array('post', 'put'))){
            $this->Image->read(null, $image_id);
            $this->Image->set(array(
                "image_status" => 0,
                "image_modified" => date("Y-m-d H:i:s")
            ));
            if($this->Image->save()){
                if($this->Auth->User('admin_id')){
                    $this->Flash->success(__('The image has been deleted.'));
                    return $this->redirect(array('action' => 'manage_images'));
                } else if($this->Auth->User('user_id')){
                    $this->Flash->success(__('Your image has been deleted.'));
                    return $this->redirect(array('controller' => 'images', 'action' => 'home?album_id='.$album_id));
                } else {
                    $this->Flash->error(__('Unable to delete your album.'));
                }
            }
        }
    }

    public function manage_images(){
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
                    "image_status" => 1,
                    "OR" => array(
                        "image_id" => $search,
                        "image_title LIKE" => "%$search%",
                        "image_description LIKE" => "%$search%"
                        // "image_created between ? and ?" => $search
                    )
                ),
                "order" => array(
                    "image_id desc"
                ),
                "fields" => array(
                    "image_id",
                    "image_title",
                    "image_description",
                    "image_path",
                    "image_created",
                    "image_modified",
                    "album_id",
                    "Album.album_title"
                ),
                "limit" => 5,
                "paramType" => "querystring"
            );
            $search_posts = $this->Paginator->paginate("Image");
            $this->set("view_posts", $search_posts);
        } else {
            $this->Paginator->settings = array(
                "conditions" => array(
                    "image_status" => 1
                ),
                "order" => array(
                    "image_id desc"
                ),
                "fields" => array(
                    "image_id",
                    "image_title",
                    "image_description",
                    "image_path",
                    "image_created",
                    "image_modified",
                    "album_id",
                    "Album.album_title"
                ),
                "limit" => 5,
                "paramType" => "querystring"
            );
            $posts = $this->Paginator->paginate("Image");
            $this->set("view_posts", $posts);
        }
    }
}
