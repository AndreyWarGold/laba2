<?php
class Route{
   function loadPage($db, $controllerName, $actionName = 'index', $id = 0){
       include_once 'app/Controllers/IndexController.php';
       include_once 'app/Controllers/UsersController.php';
       include_once 'app/Controllers/RolesController.php';
       include_once 'app/Controllers/ComentsController.php';

       switch ($controllerName) {
           case 'users':
               $controller = new UsersController($db);
               break;
            case 'roles':
                $controller = new RolesController($db);
                break;
            case 'coments':
                $controller = new ComentsController($db);
                break;
           default:
               $controller = new IndexController($db);
       }
       // запускаємо необхідний метод
       if($actionName == 'index' && $controllerName == 'coments'){
        $_SESSION['for_id'] = $id;
       $controller->$actionName($id);
        }else{
          $controller->$actionName();
        }
   }
}
