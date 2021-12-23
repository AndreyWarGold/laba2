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
           <?php foreach ($users as $user):?>
              <tr><td><a href="?controller=users&action=show&id=<?=$user['id']?>"><?php echo $user['id']; ?></a></td>
                <td><a href="?controller=coments&id=<?=$user['id']?>">Coments</a></td>
                <td><?=$user['name']?></td>
                  <td><?=$user['email']?></td>
                  <td><?=$user['gender']?></td>
                  <td><img src=<?='public/images/' . $user['path_to_img']?> height='50' width='50'></td>
                  <td><a href="?controller=users&action=delete&id=<?=$user['id']?>">X</a></td>
              </tr>
           <?php endforeach;?>
       </table>
   </div>
<a class="btn" href="?controller=users&action=addForm">add new user</a>
   <a class="btn" href="?controller=index">return back</a>
</div>
</body>
</html>
