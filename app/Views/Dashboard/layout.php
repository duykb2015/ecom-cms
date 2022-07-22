<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\icon\feather\css\feather.css">
    <!-- Notification.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\pages\notification\notification.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\icon\themify-icons\themify-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\icon\font-awesome\css\font-awesome.min.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\icon\icofont\css\icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\css\jquery.mCustomScrollbar.css">
    
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\admin\css\app.css"></link>
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <?= $this->include("Dashboard/header") ?>

            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <?= $this->include("Dashboard/navbar") ?>

                    <?= $this->renderSection('content') ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\bower_components\bootstrap\js\bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>

    <!-- notification js -->
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\js\bootstrap-growl.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\pages\notification\notification.js"></script>

    <!-- modernizr js -->
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\bower_components\modernizr\js\modernizr.js"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\bower_components\chart.js\js\Chart.js"></script>
    <!-- amchart js -->
    <script src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\pages\widget\amchart\amcharts.js"></script>
    <script src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\pages\widget\amchart\serial.js"></script>
    <script src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\pages\widget\amchart\light.js"></script>
    <script src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\js\SmoothScroll.js"></script>
    <script src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\js\pcoded.min.js"></script>
    <!-- custom js -->
    <script src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\js\vartical-layout.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\pages\dashboard\custom-dashboard.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\js\script.js"></script>

    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\js\app.js"></script>

    <?= $this->renderSection('js') ?>
</body>

</html>