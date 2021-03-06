<?php
    require 'dbconfig.php';
    $mysqli = new mysqli($servername,$username,$password,$dbname);
    if (mysqli_connect_errno( )) die("Failed to connect to database");

    $sql = "SELECT value FROM config WHERE ID = 'temp'";
    $stmt = $mysqli -> prepare($sql);
    $stmt -> execute();
    $stmt -> bind_result ($temp);
    $stmt -> fetch();
    $stmt -> free_result();

    $sql = "SELECT value FROM config WHERE ID = 'humidity'";
    $stmt = $mysqli -> prepare($sql);
    $stmt -> execute();
    $stmt -> bind_result ($humidity);
    $stmt -> fetch();
    $stmt -> free_result();

    $sql = "SELECT value FROM config WHERE ID = 'mintemp'";
    $stmt = $mysqli -> prepare($sql);
    $stmt -> execute();
    $stmt -> bind_result ($min);
    $stmt -> fetch();
    $stmt -> free_result();

    $sql = "SELECT value FROM config WHERE ID = 'heating'";
    $stmt = $mysqli -> prepare($sql);
    $stmt -> execute();
    $stmt -> bind_result ($heating);
    $stmt -> fetch();
    $stmt -> free_result();
    
    $sql = "SELECT value FROM config WHERE ID = 'watering'";
    $stmt = $mysqli -> prepare($sql);
    $stmt -> execute();
    $stmt -> bind_result ($watering);
    $stmt -> fetch();
    $stmt -> free_result();

    $stmt -> close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Orbitron&display=swap" rel="stylesheet">

    <title>Pi Home</title>
</head>

<body>
    
    <div class="border rounded mx-auto my-3 box ">
        <h1 class="text-center my-3"><a href="<?php echo $_SERVER["REQUEST_URI"]; ?>">Pi Home</a></h1>
    </div>

    <div class="border border-3  <?php if($heating=='T') echo 'border-danger'?> rounded mx-auto my-3 box">

        <div class="row mx-5 mt-4 mb-1">
            <div class="col border">
                <p class="text-center my-auto justify-content-cente"> Current <?php echo $temp ?> &degC</p>
            </div>
        </div>  

        <div class="row mx-5 mb-2" >
            <div class="col border">
                <p class="text-center my-auto justify-content-cente"> Minimum <?php echo $min ?> &degC</p>
            </div>
        </div>  

        <div class="col text-center">
            <form action="process.php" method="POST">
                <input type="submit" name="heat1"  class="btn warm btn-lg my-2" value="Heat 1 Hour"> <br>
                <input type="submit" name="heat2"  class="btn hot btn-lg mb-2" value="Heat 2 Hours"> <br>
        </div>

        <div class="row mx-5 my-3">
            <div class="col border">
                <p class="text-center my-auto justify-content-cente"> <?php echo $humidity ?>% Humidity</p>
            </div>
        </div>
    </div>

    <div class="border border-3 <?php if($watering=='T') echo 'border-success'?> rounded mx-auto my-3 box">
          <div class="col text-center">
                <input type="submit" name="waterVegs" class="btn btn-primary btn-lg mt-3 mb-1" value="Water Vegs"> <br>
                <input type="submit" name="waterBerries" class="btn btn-primary btn-lg mb-3" value="Water Berries"> <br>
                <input type="submit" name="skip1" class="btn cool btn-lg mb-1" value="Skip One"> <br>
                <input type="submit" name="skip2" class="btn cold btn-lg mb-3" value="Skip Two"> 
            </form>
        </div>
    </div>
</body>

</html>