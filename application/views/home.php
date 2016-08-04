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
                            <h1>Demo Login &amp; Register Form</h1>
                            <?= $msg; ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-5">
                            
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Login to our site</h3>
                                        <p>Enter username and password to log on:</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-key"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form role="form" action="login" method="post" class="login">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-username">Username</label>
                                            <input type="text" name="form-username" placeholder="Username..." class="form-username form-control" id="form-username">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-password">Password</label>
                                            <input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-captcha">Captcha</label>
                                            <div class='captcha-span'><?php echo $captcha['image']; ?></div>
                                            <input type="text" autocomplete="off" name="form-captcha" placeholder="Enter the captcha above..." class="form-captcha form-control" id="form-captcha" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>">
                                        </div>
                                        <button type="submit" class="btn">Sign in!</button>
                                    </form>
                                </div>
                            </div>
                                                   
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                            
                        <div class="col-sm-5">
                            
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Sign up now</h3>
                                        <p>Fill in the form below to get instant access:</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form role="form" action="register" method="post" class="registration-form">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-first-name">First name</label>
                                            <input type="text" name="form-first-name" placeholder="First name..." class="form-first-name form-control" id="form-first-name">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-last-name">Last name</label>
                                            <input type="text" name="form-last-name" placeholder="Last name..." class="form-last-name form-control" id="form-last-name">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-email">Email</label>
                                            <input type="text" name="form-email" placeholder="Email..." class="form-email form-control" id="form-email">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-mobile">Mobile</label>
                                            <input type="text" name="form-mobile" placeholder="Mobile..." class="form-mobile form-control" id="form-mobile">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-dob">Date of Birth</label>
                                            <input type="text" name="form-dob" placeholder="Date of Birth...(e.g. 01 January 2000)" class="form-dob form-control" id="form-dob">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-nationality">Nationality</label>
                                            <input type="text" name="form-nationality" placeholder="Nationality..." class="form-nationality form-control" id="form-nationality">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-gender">Gender</label>
                                            <input type="text" name="form-gender" placeholder="Gender...(Male/Female)" class="form-gender form-control" id="form-gender">
                                        </div>
                                        <button type="submit" class="btn">Sign me up!</button>
                                    </form>
                                </div>
                            </div>
                            
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