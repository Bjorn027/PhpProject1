<!doctype html>
<html lang="en">
  <head>
    <title>Mafia Game</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="index.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
  </head>
  <body>
  <?php
    session_start();
    if (!$_SESSION){
      header("location:index.php");
    }
        $dbhost = "localhost";
        $dbname = "usermoney";
        $dbuser = "root";
        
        $con = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser);
        
        ?>
  <nav class="navbar">
    <span class="navbar-brand mb-0 h1">M</span>
  </nav>

  <div class="testy">
  <form>
  <div class="form-group container wrapper fadeInDown">
      <div id="formContent">
      
        <label class="fadeIn first"><br><h5>Store</h5></label><br>
        <small class="fadeIn second" id="alert4">Hello stranger buy whatever you need.</small>
        <form>
        <div class="custom-control custom-radio fadeIn second">
  
<br>
<button type="button" onclick="refill();" id="fill" value="'refill stam'" class="btn  btn-outline-danger fadeIn second">Refill Stamina - $5000</button><br>
<br>

        </form>
      </div>
    </div>
  </div>
  
</form>
            
        </div>

  <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Mafia Game</h3>
        </div>
        <?php
        date_default_timezone_set("America/Moncton");
        $now = new DateTime();
        echo $now->format("Y-m-d H:i:s") . '<br>';
        ?>

        <ul class="list-unstyled test components">
            <br><br>
    <table>
        <tr>
            
            
        </tr>
        
        <tr>
        <td>
        <h5>&nbsp;
        <?php
        
          echo $_SESSION['username'];
          
            
         ?>
         </h5>
        </td>
        </tr>
        
        <?php
            $query = "SELECT username, money, stam FROM user WHERE username = '$_SESSION[username]'";
            $stm = $con->prepare($query);
            $stm->execute();
            $stm->setFetchMode(PDO::FETCH_ASSOC);
            
                        
            while($row = $stm->fetch()){
                echo "<tr>"
                
                . "<td>Money".":"."</td>"
                . "<td>"  ."$" ."{$row['money']}</td>"
                . "</tr>"
                . "<td>&nbsp;&nbsp;Stamina".":"."</td>"
                . "<td>" . "{$row['stam']}</td>";
            }
        ?>
        
    </table>
            <br>
            <li>
            <button type="button" onclick="location.href='/PhpProject1/crime.php'" class="btn btn-outline-danger btn-block">Crime</button>
            </li>
            <li>
            <button type="button" onclick="location.href='/PhpProject1/mug.php'" class="btn btn-outline-danger btn-block">Mug</button>
            </li>
            <li>
            <button type="button" onclick="location.href='/PhpProject1/shoot.php'" class="btn btn-outline-danger btn-block">Shoot</button>
            </li>
            <li>
            <button type="button" onclick="location.href='/PhpProject1/store.php'" class="btn btn-outline-danger btn-block">Store</button>
            </li>
            
            <li>
            <button type="button" onclick="location.href='/PhpProject1/userlist.php'" class="btn btn-outline-danger btn-block">Userlist</button>
            </li>
            <li>
            <button type="button" onclick="logout()" class="btn btn-outline-danger btn-block">Logout</button>
            </li>
        </ul>

    </nav>
    <!-- Page Content -->
    <div id="content">

        
    </div>
</div>

  
  
        <main>
            
        </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>

var server = 'actions.php'


  function logout(){
  var data = {
    action: "logout"
  }
  $.post(server, data, (res) => {
    $('#res').html(res)
    if(res.success == true){
      window.location.href='/PhpProject1/index.php'
    }
  })
}

function refill(){
  
  var data = {
    action: "refill",
    refillS: $('#fill').val()
  }
  $.post(server, data, (res) => {
    $('#res').html(res)
     if (res.success == true){
       document.getElementById("alert4").innerHTML = res.message;
     }
          else {
            document.getElementById("alert4").innerHTML = "You are too broke to afford that, get lost!"
          }
  })
  
}

    </script>
  </body>
</html>