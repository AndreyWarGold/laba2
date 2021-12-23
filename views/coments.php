<?php
$isRestricted = false;
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
   $isRestricted = true;
}?>

<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <style>
       body{
           padding-top: 3rem;
       }
       .container {
           width: 400px;
       }
       .header {
        background: #FFFFFF;
       }
       .header a{
        color: #000000;
       }
   </style>
   <header>
          <nav class="header">
              <ul>
                <li><a href="">
        <img src="public/images/logo.jpg" alt="logo" width="50" height="50">
      </a></li>
                <?php if($isRestricted == false):?>
                  <li><a href="?controller=index">Sign in</a></li>
                  <li><a href="?controller=users&action=addForm">Sign up</a></li>
                  <?php else:?>
                    <li><a href="?controller=users&action=logout">Sign out</a></li>
                    <?php endif;?>
               <li><a href="?controller=users">Користувачі</a></li>
               <li><a href="?controller=roles">Ролі</a></li>
               <li><a href="?controller=index">На початок</a></li>
              </ul>
          </nav>
  </header>
</head>
<body style="padding-top: 3rem;">

<div class="container">
   <div class="row">
       <table>
        <?php require_once 'config/db.php';
              $db = new Db();
              $conn = $db->getConnect(); ?>
           <?php foreach ($coments as $coment):?>
            <?php include_once 'app/Models/UserModel.php';
            $user = (new User())::byId($conn, $coment['user_id']) ?>
              <tr>
                <td><?=$coment['timec']?></td>
                <td><?=$user['name']?></td>
                <td><img src=<?='public/images/' . $user['path_to_img']?> height='50' width='50'></td>
              </tr>
              <tr>
                <td><?=$coment['textc']?></td>
                <?php if($_SESSION['id'] == $coment['user_id'] || $_SESSION['role'] == 'admin'):?>
                  <td><a href="?controller=coments&action=delete&id=<?=$coment['id']?>">X</a></td>
                  <td><a href="?controller=coments&action=show&id=<?=$coment['id']?>">edit</a></td>
                <?php endif;?>
              </tr>
           <?php endforeach;?>
       </table>
   </div>
<a class="btn" href="?controller=coments&action=addForm&id=<?=$_GET['id']?>">add new coment</a>
   <a class="btn" href="?controller=index">return back</a>
</div>
</body>
</html>
