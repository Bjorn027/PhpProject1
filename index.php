<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="index.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
  </head>
  <body>
  <nav class="navbar">
    <span class="navbar-brand mb-0 h1">M</span>
  </nav>
  <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <div class="fadeIn first"><h3 class="brighten">
      Mafia Game</h3>
    </div>
    <br>

    <!-- Login Form -->
    <form>
      <input type="text" id="username" class="fadeIn second"  placeholder="username">
      <input type="password" id="password" class="fadeIn third"  placeholder="password">
      <input type="button" onclick="register()" class="fadeIn fourth btn-outline-danger" value="Register">
      <input type="button" onclick="login()" class="fadeIn fourth btn-outline-danger" value="Log In">
    </form>

    

  </div>
</div>
  <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Mafia Game</h3>
        </div>

        <ul class="list-unstyled test components">
            <br><br><br>
            
            
        </ul>

    </nav>
    <!-- Page Content -->
    <div id="content">

        
    </div>
</div>

  
  <?php
    session_start();
    if ($_SESSION){
      header("location:crime.php");
    }
        $dbhost = "localhost";
        $dbname = "usermoney";
        $dbuser = "root";
        
        $con = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser);
        
        ?>
        <main>
            <table>
        <tr>
            
            
        </tr>
        <?php
            $query = "SELECT Name, Money FROM cash WHERE Name = 'Alucard'";
            $stm = $con->prepare($query);
            $stm->execute();
            $stm->setFetchMode(PDO::FETCH_ASSOC);
            
            while($row = $stm->fetch()){
                echo "<tr>"
                
                . "<td>{$row['Name']}</td>"
                . "<td>{$row['Money']}</td>"
                . "</tr>";
            }
        ?>
    </table>
        </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
     var server = 'actions.php'
     
function register(){
  var data = {
    action: "register",
    username: $('#username').val(),
    password: $('#password').val()
  }
  $.post(server, data, (res) => {
    $('#res').html(res)
     if (res.success == true){
       window.location.href='/PhpProject1/crime.php'
     }
     else{
       alert(res.message)
     }
  })
  
}

function login(){
  var data = {
    action: "login",
    username: $('#username').val(),
    password: $('#password').val()
  }
  $.post(server, data, (res) => {
    $('#res').html(res)
    
    if (res.success == true){
       window.location.href='/PhpProject1/crime.php'
     }
     else{
       alert(res.message)
     }

  })
  
}

function logout(){
  var data = {
    action: "logout"
  }
  $.post(server, data, (res) => {
    $('#res').html(res)
  })
}


    </script>
  </body>
</html>