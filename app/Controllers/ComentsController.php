<?php
class ComentsController
{
   private $conn;
   public function __construct($db)
   {
       $this->conn = $db->getConnect();
   }

   public function index($id = 0)
   {
       include_once 'app/Models/ComentModel.php';

       // отримання користувачів
       $coments = (new Coment())::all($this->conn, $id);

       include_once 'views/coments.php';
   }

   public function addForm(){
        if($_SESSION['auth'] == true){
           include_once 'views/addComent.php';
        }else{
          header('Location: ?controller=coments&id='.$_SESSION['for_id']);
        }
   }

   public function add()
   {
       include_once 'app/Models/ComentModel.php';
       // блок з валідацією
       $textc = filter_input(INPUT_POST, 'textc', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $timec = date('l jS \of F Y h:i:s A');
       $for_id = $_SESSION['for_id'];
           // додати
           $coment_tmp = new Coment($_SESSION['id'], $textc, $timec);
           $coment_tmp->add($this->conn, $_SESSION['for_id']);
       header('Location: ?controller=coments&id='.$_SESSION['for_id']);
   }

   public function delete() {
    if($_SESSION['auth'] == true){
       include_once 'app/Models/ComentModel.php';
       // блок з валідацією
       //$_GET['controller']
       //$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       if (trim($id) !== "" && is_numeric($id)) {
           (new Coment())::delete($this->conn, $id);
       }
       header('Location: ?controller=coments&id='.$_SESSION['for_id']);
     }else{
      header('Location: ?controller=coments&id='.$_SESSION['for_id']);
     }
  }

  public function show(){
    include_once 'app/Models/ComentModel.php';
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);    
     if (trim($id) !== "" && is_numeric($id)) {
         $coment_tmp = (new Coment())::byId($this->conn, $id);
     }
     include_once 'views/showComent.php';
      //header('Location: ?controller=coments');
}

public function update()
   {
       include_once 'app/Models/ComentModel.php';
       // блок з валідацією
       $textc = filter_input(INPUT_POST, 'textc', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           // додати
           $coment_tmp = new Coment($_SESSION['id'], $textc);
           $coment_tmp->edit($this->conn, $id);
       header('Location: ?controller=coments&id='.$_SESSION['for_id']);
   }

}
