<!DOCTYPE html>
<html>

<head>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?=asset_url()?>css/materialize.min.css" media="screen,projection" />

    <!--Import customized style-->
    <link type="text/css" rel="stylesheet" href="<?=asset_url()?>css/common.css" />
</head>

<body>


    <div id="profile-popup" class="dropdown-content grey-text text-darken-3">
        <h4>Profile</h4>
        <p>sdasdasdasdasd</p>
    </div>
    <!-- Navbar goes here -->
    <nav id="page-header">
        <div class="nav-wrapper red darken-3">
            <a class="brand-logo">Logo</a>
            <a data-activates="mobile-nav" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a>Log in</a></li>
                <li><a class="waves-effect waves-dark btn white grey-text text-darken-2">Join</a></li>
                <li><a>Upload</a></li>
                <li id="profile-btn">
                    <a class="dropdown-button" href="#!" data-activates="profile-popup"><img src="<?=asset_url()?>image/profpic.png" /></a>
                </li>
            </ul>
            <ul class="side-nav" id="mobile-nav">
                <li><a>Home</a></li>
                <li><a>Profile</a></li>
                <li><a>Featured</a></li>
                <li><a>Events</a></li>
                <li><a>Contact Us</a></li>
            </ul>
        </div>
    </nav>


    <!-- Page Layout here -->
    <div id="content-container" class="row">

        <div id="side-nav-large-container" class="col l2 hide-on-med-and-down">
            <ul id="side-nav-large">
                <li><a href="#" class="valign-wrapper"><i class="material-icons">home</i>Home</a></li>
                <li><a href="#" class="valign-wrapper"><i class="material-icons">featured_play_list</i>Featured</a></li>
                <li><a href="#" class="valign-wrapper"><i class="material-icons">event</i>Events</a></li>
                <li><a href="#" class="valign-wrapper"><i class="material-icons">phone</i>Contact Us</a></li>
            </ul>
            <hr>
            <ul id="side-nav-large">
                <li><span class="white-text">PLAYLIST</span></li>
                <li><a href="#" class="valign-wrapper"><i class="material-icons">queue_music</i>My Playlist</a></li>
                <li><a href="#" class="valign-wrapper"><i class="material-icons">favorite_border</i>Liked Videos</a></li>
                <li><a href="#" class="valign-wrapper"><i class="material-icons">star_border</i>Saved Artists</a></li>
            </ul>


            <a class="waves-effect waves-light btn red darken-4 modal-trigger" href="#modal1">Sign Up</a>
            <p class="center white-text">or</p>
            <a class="waves-effect waves-dark btn white grey-text text-darken-2 modal-trigger" href="#modal1">Social Login</a>
        </div>

        <div id="page-content-container" class="col m12 l10">

            <div id="main" class="row">

            </div>

            <footer class="page-footer">
                <div class="container">
                    <div class="row">
                        <div class="col l12 s12">
                            <h5>Logo</h5>
                            <ul class="links">
                                <li><a href="#">About</a></li>
                                <li><a href="#">Term of Use</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>

            <!-- Modal Structure -->
            <div id="modal1" class="modal">
                <div class="modal-content">
                    <h4>Modal Header</h4>
                    <p>A bunch of text</p>
                </div>
                <div class="modal-footer">
                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
                </div>
            </div>


        </div>

    </div>


    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="<?=asset_url()?>js/materialize.min.js"></script>

    <script type="text/javascript" src="<?=asset_url()?>js/global.js"></script>
</body>

</html>
