<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/plain; charset=UTF-8"/>
        <title>GRACE | Golden Resource Academy for Career Enhancement</title>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- google fonts -->
        <!--<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700Open+Sans:400,300,400italic,700,700italic,300italic' rel='stylesheet' type='text/css'>-->    
        <!-- CSS components -->
        <!--<link rel="stylesheet" href="<?= asset_url() ?>css/core/custom/fontstyle.css">-->
        <link rel="stylesheet" href="<?= asset_url() ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= asset_url() ?>css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= asset_url() ?>css/jquery.bxslider.css">
        <link rel="stylesheet" href="<?= asset_url() ?>css/animate.min.css"> 
        <link rel="stylesheet" href="<?= asset_url() ?>css/core/custom/positioning.css"> 
        <link rel="stylesheet" href="<?= asset_url() ?>css/jquery.fancybox.css"> 
        <!-- CSS main styles -->
        <link rel="stylesheet" href="<?= asset_url() ?>css/style.css"> 
        <link rel="stylesheet" href="<?= asset_url() ?>css/core/custom/text.css"> 
        <link rel="stylesheet" href="<?= asset_url() ?>css/core/custom/form.css"> 
        <link rel="stylesheet" href="<?= asset_url() ?>css/core/font-awesome.min.css"> 

        <!-- load jquery -->  
        <script src="<?= asset_url() ?>js/jquery-1.11.1.min.js"></script>
        <!-- bootstrap -->
        <script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= asset_url() ?>js/jquery.form.min.js"></script>


    </head>
    <body class="theme-snow">
        <img class="hidden" src="<?= asset_url() ?>images/bx_loader.gif"/>

        <? ### [ MAIN NAVIGATION ] ############################################################### ?>
        <div id="topNav" >
            <div class="top-bar clearfix">
                <div class="container">
                    <ul class="list-inline pull-right">
                        <li class="text-primary" style="padding:6px 12px">Call Today 230-1510 local 7847</li>
                        <li><a href="https://www.facebook.com/ mygraceacademy" class="animateFast"><i class="fa fa-facebook-f"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/golden-resource-academy-for-career-enhancement" class="animateFast"><i class="fa fa-linkedin"></i></a></li>
                        <!--<li><a href="#" class="animateFast"><i class="fa fa-twitter"></i></a></li>-->
                    </ul>
                </div>
            </div>
            <div class="logoBrand">
                <div class="container clearfix">
                    <a href="#" class="navbar-brand-logo pull-left animateFast"><img class="img-responsive" src="<?= asset_url() ?>images/logo.png" /></a>
                    <div class="header-quote font-script text-primary pull-right">Golden Resource Academy for Career Enhancement</div>
                </div>
            </div>
        </div>
        <div id="mainNavWrap" >
            <nav class="main-nav navbar navbar-default affix-top">
                <div class="container">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="fa fa-bars"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar">
                        <ul class="nav navbar-nav animateFast">
                            <li class="active"><a href="#topNav" class="moduleLink" module_link="portal" module_name="Portal">Home</a></li>
                            <li class=""><a href="#sectionAbout" class="moduleLink" module_link="portal" module_name="Portal">About Us</a></li>
                            <li class="" style='display: none'><a href="#sectionPrograms" class="moduleLink" module_link="portal" module_name="Portal">Training Programs</a></li>
                            <li class="trainingProgramMenu dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Training Programs
                                <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#sectionPrograms" rhref="#basicHospitalityOperationTab" class="moduleLink"  module_link="portal" module_name="Portal">Basic Hospitality Operations</a></li> 
                                    <li><a href="#sectionPrograms" rhref="#languageTrainingTab" class="moduleLink"  module_link="portal" module_name="Portal">Cultural and Language Programs</a></li>
                                    <li><a href="#sectionPrograms" rhref="#professionalTab" class="moduleLink"  module_link="portal" module_name="Portal">Professional Development Programs</a></li>
                                    <li><a href="#sectionPrograms" rhref="#seminarsTab" class="moduleLink"  module_link="portal" module_name="Portal">Seminars</a></li>
                                </ul>
                            </li>
                            <li class=""><a href="#sectionExperts" module_link="portal" class="moduleLink"  module_name="Portal">Program Experts</a></li>
                            <li class=""><a href="#sectionExperts" module_link="portal" class="moduleLink"  module_name="Portal">Upcoming Events</a></li>
                            <li class=""><a href="#sectionGallery" module_link="portal" class="moduleLink"  module_name="Portal">Gallery</a></li>
                            <!--<li class=""><a href="#SectionTestimonials" class="moduleLink"  module_link="portal" module_name="Portal">Testimonials</a></li>-->
                            <li class=""><a href="#sectionContact" class="moduleLink"  module_link="portal" module_name="Portal">Contact Us</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right animateFast">
                            <li id="signInLink" class="text-gold"><a href="#" data-toggle="modal" data-target="#signInModal"><strong>Sign In</strong> <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> </a></li>
                            <li id="adminPageLink" class="text-gold"></li>
                            <li class="adminPageMenu dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><strong>Admin Page</strong>
                                <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="text-gold moduleLink"  module_link="user_management" module_name="userManagement" >User Management</a> </li>
                                    <li><a href="#" class="text-gold moduleLink"  module_link="training_module" module_name="trainingModule" >Training Module</a> </li>
                                </ul>
                            </li>
                            <li class="instructorPageMenu dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><strong>Instructor Page</strong>
                                <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="text-gold moduleLink"  module_link="class_management" module_name="classManagement" >Class Management</a> </li>
                                    <li><a href="#" class="text-gold moduleLink"  module_link="training_material" module_name="trainingMaterial" >Training Material</a> </li>
                                </ul>
                            </li>
                            <li class="userProfileMenu dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="text-gold moduleLink"   module_link="profile_management" module_name="profileManagement" ><i class="fa fa-user" aria-hidden="true"></i> View Profile</a> </li>
                                    <li><a href="#" class="text-gold logoutLink"   ><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a> </li>
                                </ul>
                            </li>
                            
                        </ul>

                    </div><!--/.nav-collapse -->
                </div>
            </nav>
        </div>
        
        <div id="signInModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registered User Sign In</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" class="form-horizontal">
                            <div class="formMessage center-align" style="text-align: center"></div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input name="email_address" type="email" class="form-control"  placeholder="Email" required="" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input name="password" type="password" class="form-control"  placeholder="Password" required="" value="123456">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-gold btn-pill pull-right"><strong>SIGN IN</strong></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="mainContent" class="page-content " >


        </div> <!-- END: .page-content -->
        <div id="footer"  style="background:#222 url(assets/images/pattern/bg-tuft-tile.png) repeat;">
            <div class="container clearfix text-white">
                <!-- 3-column footer -->
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <!--<h4 c><img class="img-responsive" src="<?= asset_url() ?>images/logo.png" /></h4>-->
                        <!--<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur. Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>-->
                        <!--<p>Tel: 230-1510 local 7847<br>-->
                            <!--Mail: <a href="#">info@grace.com</a></p>-->
                    </div>
<!--                    <div class="col-xs-12 col-sm-4">
                        <h4 class="text-primary">Column2</h4>
                        <ul class="m-list list-unstyled no-border">
                            <li><span class="fa fa-user fa-boxed"></span> Sed rhoncus vestibulum mauris</li>
                            <li><span class="fa fa-child fa-boxed"></span> Tempor eleifend erat volutpat risus</li>
                            <li><span class="fa fa-cloud fa-boxed"></span> Sed lacus risus, sagittis a feugiat </li>
                            <li><span class="fa fa-bitbucket fa-boxed"></span> Quis, sagittis eget arcu </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <h4 class="text-primary">Tempor Eleifend</h4>
                        <div class="social-footer">
                            Lorem Ipsum is simply dummy text of the vestibulum. Sed lacus risus, sagittis a feugiat
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
        <div id="footerBar" \>
            <div class="container">
                <div class="social-footer pull-right hidden-xs">
                    <!--<? /* hidden when width is < 768px */ ?>-->
                    <ul class="list-inline">
                        <li style="font-size: 14px">Call Today 230-1510 local 7847</li>
                        <li><a href="https://www.linkedin.com/company/golden-resource-academy-for-career-enhancement"><i class="fa fa-linkedin"></i></a>
                        <!--<li><a href="#"><i class="fa fa-google-plus"></i></a>-->
                        <li><a href="https://www.facebook.com/ mygraceacademy"><i class="fa fa-facebook"></i></a>
    <!--                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                        <li><a href="#"><i class="fa fa-youtube"></i></a>-->
                    </ul>
                </div>
                <div id="copyright" class="">
                    © Copyright <?php echo date('Y'); ?> GRACE.
                </div>
            </div>
        </div>


        


        <!-- easing -->
        <script type="text/javascript" src="<?= asset_url() ?>js/jquery.easing.1.3.js"></script>
        <!-- bxslider -->   
        <script type="text/javascript" src="<?= asset_url() ?>js/jquery.bxslider.js"></script>
        <!-- jquery.fancybox.pack -->
        
        <script type="text/javascript" src="<?= asset_url() ?>js/jquery.fancybox.pack.js"></script>

        <!-- other plugins) -->
        <script type="text/javascript" src="<?= asset_url() ?>js/jquery.fitvids.js"></script>
        <script type="text/javascript" src="<?= asset_url() ?>js/jquery.viewportchecker.js"></script>
        <script type="text/javascript" src="<?= asset_url() ?>js/jquery.parallax-1.1.3.js"></script>
        <script type="text/javascript" src="<?= asset_url() ?>js/jquery.scrollTo.min.js"></script>
        <script type="text/javascript" src="<?= asset_url() ?>js/jquery.localScroll.min.js"></script>
        <script type="text/javascript" src="<?= asset_url() ?>js/jQuery.scrollSpeed.js"></script>



    </body>

</html>
