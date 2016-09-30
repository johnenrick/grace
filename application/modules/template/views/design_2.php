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
                <li><a>Upload</a></li>
                <li id="profile-btn">
                    <a class="dropdown-button" href="#!" data-activates="profile-popup"><img src="<?=asset_url()?>image/profpic.jpg" /></a>
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
        </div>

        <div id="page-content-container" class="col m12 l10">

            <div id="main" class="row">
                <div id="profile-header" class="col m12">
                    <div class="col m3 pro-info">
                        <img src="http://localhost/musico/assets/image/profpic.jpg">
                        <h5>Jane Doe</h5>
                        <p>
                            Lorem ipsum dolor sit amet, adhuc illud splendide mei ea. Ut has etiam lobortis consequuntur, ex harum veniam feugait has.
                        </p>
                    </div>

                </div>
                <div id="profile-menu" class="col m12">
                    <div class="col m9">
                        <ul class="links">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#">Videos</a></li>
                            <li><a href="#">Playlist</a></li>
                            <li><a href="#">Discussions</a></li>
                            <li><a href="#">About</a></li>
                        </ul>
                    </div>
                    <div class="col m3">
                        <a class="waves-effect waves-light btn red darken-4">Subscribe</a>
                        <span>14,321 subscribers</span>
                    </div>
                </div>
                <div id="profile-list" class="col m12">
                    <div class="col m9 col-left">
                        <div class="col s8 m8 l8 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small card-large">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s1.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s4 m4 l4 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s1.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s4 m4 l4 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s2.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                       <h6 class="red-text text-darken-1 album-title">BIKE WORLD MANIA</h6>
                       <hr>

                        <div class="col s4 m4 l4 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s2.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s4 m4 l4 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s3.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s4 m4 l4 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s14.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s4 m4 l4 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s4.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s4 m4 l4 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s5.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s4 m4 l4 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s6.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s4 m4 l4 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s7.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s4 m4 l4 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s8.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s4 m4 l4 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s9.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col m3 col-right">
                       <h6>Popular Uploads</h6>

                        <div class="col s12 m12 l12 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s10.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m12 l12 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s11.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m12 l12 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s12.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m12 l12 videoItem" user_video_id="1">
                            <div class="card hoverable transparent z-depth-0 small  card-fixed">
                                <div class="card-image">
                                    <a href="">
                                        <img src="http://localhost/musico/assets/sample_image/s13.jpg">
                                    </a>
                                </div>
                                <div class="">
                                    <h6 class=" blue-text darken-4" style="font-weight:bold"><a class="videoDescription" href="">Cycling to the Mountains</a></h6>
                                    <div class="grey-text lighten-2">
                                        <span class="uploadederName truncate">The Mountain Bikers</span>
                                        <div class="thin valign " style="font-size: 11px">
                                            <span class="videoAge">2 months ago</span>
                                            <span class="viewCount right-aligned right">10 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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
