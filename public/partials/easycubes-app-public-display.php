<?php

$eafolders = get_terms( array(
                            'taxonomy' => 'eafolders',
                            'hide_empty' => false,
                            'order' => 'DESC',
                            'parent' => 0
                        ));

?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php the_title(); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/images/icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/css/normalize.css">

    <!-- Media Boxes CSS -->
    <link rel="stylesheet" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/Font%20Awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/Magnific%20Popup/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/Fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/css/mediaBoxes.css">
    <!-- Media Boxes CSS -->

    <link rel="stylesheet" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/css/easycubes-app-public.css">

</head>
<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->

<section class="page-header">
    <div class="container">
        <div class="pull-left">
            <form class="form-search">
                <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
                <input autocomplete="off" name="query" type="text" placeholder="Search">
            </form>
        </div>

        <div class="pull-right">
            <a class="logo" href=""><img src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/images/logo.png"></a>
        </div>
    </div>
</section>

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-4 navigation">
            <ul class="nav nav-tabs" id="interest_tabs">
                <?php
                if (!empty($eafolders))
                {
                    $bf = true;
                    foreach ($eafolders as $eafolder)
                    {
                        $t_id = $eafolder->term_id;
                        $eafolder_term_meta = get_option( "eafolder_taxonomy_$t_id" . "_fimg");
                    ?>
                    <li class="<?php if ($bf){echo "active"; $bf=false;} ?>">
                        <a href="#tab_<?php echo $t_id; ?>" data-toggle="tab" >
                            <img src="<?php echo $eafolder_term_meta;?>">
                            <p><?php echo $eafolder->name ;?></p>
                        </a>
                    </li>
                <?php
                    }
                }
                ?>
            </ul>

            <!--2ND Tab menu-->
            <div class="tab-content">
                <!--all tab menu-->

                <?php
                if (!empty($eafolders)){
                    $bf = true;
                    foreach ($eafolders as $eafolder)
                    {
                        $t_id = $eafolder->term_id;
                        $eafolders_l2 = get_terms( array(
                            'taxonomy' => 'eafolders',
                            'hide_empty' => false,
                            'parent' => $t_id
                        ));

                        ?>
                        <div id="tab_<?php echo $t_id; ?>" class="<?php if ($bf) {
                            echo "active";
                            $bf = false;
                        } ?> tab-pane">
                        <?php
                        if (!empty($eafolders_l2)) {
                            ?>

                                <ul class="nav nav-tabs">

                                    <?php
                                    $bf=true;
                            foreach ($eafolders_l2 as $eafolder_l2)
                            {
                                $t_id_l2 = $eafolder_l2->term_id;
                                $eafolder_l2_term_meta = get_option( "eafolder_taxonomy_$t_id_l2" . "_fimg");
?>
                                <li class="<?php if ($bf){echo "active"; $bf=false;} ?>">
                                    <a href="#tab_<?php echo $t_id_l2; ?>" data-toggle="tab" >
                                        <img src="<?php echo $eafolder_l2_term_meta;?>">
                                        <p><?php echo $eafolder_l2->name ;?></p>
                                    </a>
                                </li>

                                <?php
                            }
                                    ?>
                                </ul>



                            <?php
                        }
                        ?>
                        </div>
                <?php
                    }
                }
                ?>


            </div>

            <!-- 3RD Tab menu -->
            <div class="tab-content">
                <!--all tab menu-->
                <?php
                if (!empty($eafolders)) {
                    $bf = true;
                    foreach ($eafolders as $eafolder)
                    {
                        $t_id = $eafolder->term_id;
                        $eafolders_l2 = get_terms( array(
                            'taxonomy' => 'eafolders',
                            'hide_empty' => false,
                            'parent' => $t_id
                        ));
                        if (!empty($eafolders_l2)) {

                            foreach ($eafolders_l2 as $eafolder_l2)
                            {
                                $t_id_l2 = $eafolder_l2->term_id;
                                $eafolders_l3 = get_terms( array(
                                    'taxonomy' => 'eafolders',
                                    'hide_empty' => false,
                                    'parent' => $t_id_l2));

                                ?>
                                <div id="tab_<?php echo $t_id_l2; ?>" class="tab-pane <?php if ($bf){echo "active"; $bf=false;} ?>">
                    <?php
                                if (!empty($eafolders_l3)) {

                            ?>

                                    <ul class="nav nav-tabs">
                                        <?php
                                            foreach ($eafolders_l3 as $eafolder_l3)
                                            {
                                                $t_id_l3 = $eafolder_l3->term_id;

                                                ?>
                                                    <ul class="nav nav-pills">
                                                        <span><?php echo $eafolder_l3->name;?></span>
                                                        <?php

                                                        $the_query = new WP_Query( array(
                                                                'post_type' => 'eaarticles',
                                                                'post_status' => 'publish',
                                                                'posts_per_page' => -1,
                                                                'tax_query' => array(
                                                                        array(
                                                                            'taxonomy' => 'eafolders',
                                                                            'field' => 'id',
                                                                            'terms' => $eafolder_l3->term_id,
                                                                            'include_children' => false,
                                                                            )
                                                                ),
                                                            'order'    => 'ASC'
                                                        ));

                                                        if ($the_query->have_posts()) {

                                                            while ($the_query->have_posts()) {
                                                                $the_query->the_post();
                                                                ?>
                                                                <li><a class="eaarticles" href="#post_<?php echo $the_query->post->ID ;?>" data-toggle="tab"><img src="<?php echo get_the_post_thumbnail_url($the_query->post,'thumbnail') ?>"><p><?php echo $the_query->post->post_title; ?></p></a></li>
                                                                <?php

                                                            }
                                                        }
                                                    ?>
                                                    </ul>
                                                <?php
                                            }





                                        ?>
                                    </ul>

                <?php
                                }
                                    //Others
                                    $the_query = new WP_Query( array(
                                        'post_type' => 'eaarticles',
                                        'post_status' => 'publish',
                                        'posts_per_page' => -1,
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'eafolders',
                                                'field' => 'id',
                                                'terms' => $t_id_l2,
                                                'include_children' => false,
                                            )
                                        ),
                                        'order'    => 'ASC'
                                    ));

                                    if ($the_query->have_posts()) {
                                        ?>
                                        <ul class="nav nav-pills">
                                            <span>Others</span>
                                            <?php
                                            while ($the_query->have_posts()) {
                                                $the_query->the_post();
                                                ?>
                                                <li><a class="eaarticles" href="#post_<?php echo $the_query->post->ID ;?>" data-toggle="tab"><img src="<?php echo get_the_post_thumbnail_url($the_query->post,'thumbnail') ?>"><p><?php echo $the_query->post->post_title; ?></p></a></li>
                                                <?php

                                            }
                                            ?>
                                        </ul>
                                        <?php
                                    }


                                ?>
                                </div>
                <?php
                            }
                        }
                    }
                }
                ?>




            </div>




        </div>



        <div class="col-lg-8 content">


            <div class="title_action_bar">
                <div class="title col-lg-6">

                    <div class="col-lg-3">
                        <a href="#" class="title-logo">
                            <img src="img/menu/marketing.png" alt="">
                        </a>
                    </div>
                    <div class="col-lg-9">
                        <h2>

                        </h2>
                        <span class="text-date"></span>
                        <p></p>
                    </div>

                </div>

                <div id="action-ebook" class="action col-lg-6">
                    <a href="#" data-target="#preview"><span class="glyphicon glyphicon-file"></span>Download Preview</a>
                    <a href="#"  data-target="#source"><span class="glyphicon glyphicon-shopping-cart"></span>Download Source</a>
                    <a href="#" data-toggle="modal" data-target="#share"><span class="glyphicon glyphicon-share"></span>Share</a>
                    <a href="#" data-toggle="modal" data-target="#ask"><span class="glyphicon glyphicon-question-sign"></span>Ask Us</a>
                </div>

            </div>


            <div class="media_area">
                <ul class="nav nav-tabs"> </ul>

                <div class="tab-content">

                </div>

            </div>

        </div>
    </div>


    <div class="easearch">
        <div class="container" style="height: 100%;">
            <div class="pull-right" style="padding-top:5px ">
                <a class="btn-remove-search" href="#"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <h2 class="col-lg-12" style="color: white">
                Search results
            </h2>

            <div class="col-lg-12" style="background: white;height: 80%;overflow-x: hidden;overflow-y: scroll;">

                <div class="search-item">
                    <h3 class="search-item-title"><a href="#">Search Title</a> </h3>
                    <span class="search-item-nav"> vaa vaa > aaf</span>
                    <p class="search-item-desc">ASLDK FJHALSDKJFH ALKDSJFH ALKSDJHFALSK DJHFALKSDJFHASLKDF</p>
                    <span class="search-item-tags"> vuua, test, adf</span>
                </div>

                <div class="search-item">
                    <h3 class="search-item-title"><a href="#">Search Title</a> </h3>
                    <cite class="search-item-nav"> vaa vaa > aaf</cite>
                    <p class="search-item-desc">ASLDK FJHALSDKJFH ALKDSJFH ALKSDJHFALSK DJHFALKSDJFHASLKDF</p>
                    <span class="search-item-tags">Tags: <span>vuua, test, adf</span></span>
                </div>

            </div>

        </div>
    </div>


</section>



<!-- Modals -->

<div id="share" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center">Share</h4>
            </div>
            <div class="modal-body">
                <form id="contact-form" method="post" action="contact.php" role="form">

                    <div class="messages"></div>

                    <div class="controls">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_name">Firstname *</label>
                                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_lastname">Lastname *</label>
                                    <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_email">From *</label>
                                    <input id="form_email" type="email" name="emailFrom" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_email">To *</label>
                                    <input id="form_email" type="email" name="emailTo" class="form-control" placeholder="Please enter recipient email *" required="required" data-error="Valid email is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_message">Message *</label>
                                    <textarea id="form_message" name="message" class="form-control" placeholder="Have a look at this awesome product from Easycubes... " rows="4" required="required" data-error="Please, leave us a message."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary btn-send" value="Send message">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted">
                                    Marked with <strong>*</strong>  fields are required, current page's link is already attached.
                                </p>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div id="ask" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center">Ask us</h4>
            </div>
            <div class="modal-body">
                <form id="contact-form" method="post" action="contact.php" role="form">

                    <div class="messages"></div>

                    <div class="controls">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_name">Firstname *</label>
                                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_lastname">Lastname *</label>
                                    <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_email">From *</label>
                                    <input id="form_email" type="email" name="emailFrom" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_message">Message </label>
                                    <textarea id="form_message" name="message" class="form-control" placeholder="I have a question about this product..." rows="4" required="required" data-error="Please, leave us a message."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary btn-send" value="Send message">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted">
                                    Marked with <strong>*</strong>  fields are required, current page's link is already attached.
                                </p>
                            </div>
                        </div>

                    </div>

                </form>
            </div>

        </div>
    </div>
</div>







<?php
do_shortcode('[easycubes_app_partner_generate]');
?>

<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/vendor/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script type="text/javascript" src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/vendor/bootstrap.js"></script>

<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/vendor/loadingoverlay.min.js"></script>

<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/plugins.js"></script>

<!-- Media Boxes SCRIPTS -->
<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/Isotope/jquery.isotope.min.js"></script>
<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/imagesLoaded/jquery.imagesLoaded.min.js"></script>
<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/Transit/jquery.transit.min.js"></script>
<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/jQuery Easing/jquery.easing.js"></script>
<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/Waypoints/waypoints.min.js"></script>
<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/Modernizr/modernizr.custom.min.js"></script>
<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/Magnific Popup/jquery.magnific-popup.min.js"></script>
<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/Fancybox/jquery.fancybox.min.js"></script>
<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/jquery.mediaBoxes.dropdown.js"></script>
<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/jquery.mediaBoxes.js"></script>
<!-- Media Boxes SCRIPTS -->



<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/easycubes-app-public.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>



<div class="loadingoverlayFake" style="box-sizing: border-box; position: fixed; display: flex; flex-flow: column nowrap; align-items: center; justify-content: space-around; background: rgba(255, 255, 255, 0.8); top: 0px; left: 0px; width: 100%; height: 100%; z-index: 2147483647; opacity: 1;">
    <div style="order: 1; box-sizing: border-box; overflow: visible; flex: 0 0 auto; display: flex; justify-content: center; align-items: center; animation-name: loadingoverlay_animation__rotate_right; animation-duration: 2000ms; animation-timing-function: linear; animation-iteration-count: infinite; width: 120px; height: 120px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" style="width: 100%; height: 100%; fill: rgb(32, 32, 32);"><circle r="80" cx="500" cy="90" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="500" cy="910" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="90" cy="500" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="910" cy="500" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="212" cy="212" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="788" cy="212" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="212" cy="788" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="788" cy="788" style="fill: rgb(32, 32, 32);"></circle></svg></div>
</div>
<div class="loadingoverlayFake" style="box-sizing: border-box; position: fixed; display: flex; flex-flow: column nowrap; align-items: center; justify-content: space-around; background: rgba(255, 255, 255, 0.8); top: 0px; left: 0px; width: 100%; height: 100%; z-index: 2147483647; opacity: 1;">
    <div style="order: 1; box-sizing: border-box; overflow: visible; flex: 0 0 auto; display: flex; justify-content: center; align-items: center; animation-name: loadingoverlay_animation__rotate_right; animation-duration: 2000ms; animation-timing-function: linear; animation-iteration-count: infinite; width: 120px; height: 120px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" style="width: 100%; height: 100%; fill: rgb(32, 32, 32);"><circle r="80" cx="500" cy="90" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="500" cy="910" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="90" cy="500" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="910" cy="500" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="212" cy="212" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="788" cy="212" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="212" cy="788" style="fill: rgb(32, 32, 32);"></circle><circle r="80" cx="788" cy="788" style="fill: rgb(32, 32, 32);"></circle></svg></div>
</div>



</body>

</html>