<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Demo</title>
        
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        

        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
        <?php             
            echo "<link rel='stylesheet' type='text/css' href='assets/css/" . $pagename . ".css'>";
        ?>
    </head>
    <body>
        <div class="top-content">
            
            <div class="inner-bg">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>Welcome <?= $userData['fname']." ".$userData['lname'] ?></h1>
                            <?= $msg; ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <a href="logout">Logout</a>
                        <br><br>
                        <div style='text-align: left; width: 70%; margin: auto;'>
                        	<h3> Personal Details </h3>
                        	<p><strong>First Name: </strong> <?= $userData['fname'] ?></p>
                        	<p><strong>Last Name: </strong> <?= $userData['lname'] ?></p>
                        	<p><strong>Date of Birth: </strong> <?= $userData['dob'] ?></p>
                        	<p><strong>Email: </strong> <?= $userData['email'] ?></p>
                        	<p><strong>Mobile: </strong> <?= $userData['mobile'] ?></p>
                        	<p><strong>Gender: </strong> <?= $userData['gender'] ?></p>
                        	<p><strong>Nationality: </strong> <?= $userData['nationality'] ?></p>
                        </div>
                    </div>
                    
                </div>
            </div>            
        </div>
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.alert.js"></script> 
        <?php
            echo "<script src='assets/js/". $pagename .".js'></script>";
        ?>      
    </body>
</html>