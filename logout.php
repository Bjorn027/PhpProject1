<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
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
  <nav class="navbar">
    <span class="navbar-brand mb-0 h1">M</span>
  </nav>
  <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>My Game</h3>
        </div>

        <ul class="list-unstyled test components">
            <br><br><br>
            <li>
            <button type="button" onclick="location.href='/PhpProject1/index.php'" class="btn btn-outline-danger btn-block">Login</button>
            </li>
            
        </ul>

    </nav>
    <!-- Page Content -->
    <div id="content">

        
    </div>
</div>

  
  <?php
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>