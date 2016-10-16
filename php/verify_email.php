<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Webcademy</title>

    <!-- Bootstrap Core CSS -->
    <link href="../course-assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../course-assets/css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../course-assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="../course-assets/ico/favicon.png">
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="../index.php">Webcademy</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a href="../login.php">Sign In/Sign Up</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">

            <?php
                $ans = '';
                if(isset($_GET['email']) && isset($_GET['hash']) && !empty($_GET['email']) && !empty($_GET['hash']))
                {
                    require_once('database.php');
                    $conn = new mysqli($servername, $usn, $psw,$database);
                    if($conn->connect_errno)
                        $ans = 'We are sorry, but a problem occured while processing your request. Please, try again!';
                    else
                    {
                        $email = $_GET['email']; // Set email variable
                        $hash = $_GET['hash']; // Set hash variable
                        $query="SELECT * from users where email='$email' AND hash='$hash'";
                        $result=$conn->query($query);
                        if(!$result->num_rows) 
                            $ans = 'It seems that the provided link is not correct. Your details do not exist in our databases.';
                        else
                        {
                            while($row=$result->fetch_assoc())
                            {
                                $id=$row["id"];
                                $verified=$row["verified"];
                            }

                            if($verified==1)
                                $ans = 'Your account is already registered!';
                            else
                            {
                                $verified=1;
                                $query="UPDATE users SET verified='$verified' WHERE id='$id'";
                                $conn->query($query);
                                $ans = 'Thank you for choosing Webcademy. Your account is now activated. You can now login to our website and start learning. Enjoy!';
                            }
                        }
                    }
                    $conn->close();
                }
                else
                    $ans = 'The link is invalid. Please, try again!';

                echo '<div class="intro-lead-in">'.$ans.'</div>';
            ?>

            </div>
        </div>
    </header>

    


    <!-- jQuery -->
    <script src="../course-assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../course-assets/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="../course-assets/js/classie.js"></script>
    <script src="../course-assets/js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="../course-assets/js/jqBootstrapValidation.js"></script>
    <script src="../course-assets/js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../course-assets/js/agency.js"></script>

</body>

</html>