<!doctype html>
<html lang="en">
  <head>
    <title>Mafia Game</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
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
      <div id="formContent"
      
        <label class="fadeIn first"><h5>Crime</h5></label><br>
        <form>
        <div class="custom-control custom-radio fadeIn second">
  
<br>
<button type="button" onclick="crime()" id="bank" value="'Rob a local bank'" class="btn  btn-outline-danger fadeIn second">Rob a local bank</button><br>
<button type="button" onclick="crime2()" id="store" value="'Rob a liquorstore'" class="btn  btn-outline-danger fadeIn third">Rob a liquorstore</button>
<button type="button" onclick="crime3()" id="protect" value="'Get protection cash'" class="btn  btn-outline-danger fadeIn fourth">Get protection cash</button>
<button type="button" onclick="crime4()" id="purse" value="'Snatch a lady's purse'" class="btn  btn-outline-danger fadeIn fifth">Snatch a lady's purse</button><br><br>
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
            $query = "SELECT username, money FROM user WHERE username = '$_SESSION[username]'";
            $stm = $con->prepare($query);
            $stm->execute();
            $stm->setFetchMode(PDO::FETCH_ASSOC);
            
            while($row = $stm->fetch()){
                echo "<tr>"
                
                . "<td>Money".":"."</td>"
                . "<td>"  ."$" ."{$row['money']}</td>"
                . "</tr>";
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

function crime(){
  
  var data = {
    action: "crime",
    crimeType: $('#bank').val()
  }
  $.post(server, data, (res) => {
    $('#res').html(res)
     if (res.success == true){
       alert(res.message)
     }
          
  })
  
}

function crime2(){
  
  var data = {
    action: "crime2",
    crimeType2: $('#store').val()
  }
  $.post(server, data, (res) => {
    $('#res').html(res)
     if (res.success == true){
       alert(res.message)
     }
          
  })
  
}

function crime3(){
  
  var data = {
    action: "crime3",
    crimeType3: $('#protect').val()
  }
  $.post(server, data, (res) => {
    $('#res').html(res)
     if (res.success == true){
       alert(res.message)
     }
          
  })
  
}

function crime4(){
  
  var data = {
    action: "crime4",
    crimeType4: $('#purse').val()
  }
  $.post(server, data, (res) => {
    $('#res').html(res)
     if (res.success == true){
       alert(res.message)
     }
          
  })
  
}
    </script>
  </body>
</html>