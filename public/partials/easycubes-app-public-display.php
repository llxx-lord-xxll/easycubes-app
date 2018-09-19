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
                <input type="text" placeholder="Search">
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

            <!--top level tab content-->
            <div class="tab-content">
                <!--all tab menu-->

                <?php
                if (!empty($eafolders))
                {
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
                            ?>
                            <div id="tab_<?php echo $t_id; ?>" class="<?php if ($bf) {
                                echo "active";
                                $bf = false;
                            } ?> tab-pane">
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
                            </div>


                            <?php
                        }
                    }
                }
                ?>


            </div>

            <!--top level tab content-->
            <div class="tab-content">
                <!--all tab menu-->
                <?php
                if (!empty($eafolders)) {
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

                                if (!empty($eafolders_l3)) {

                            ?>
                                <div id="tab_<?php echo $t_id_l2; ?>" class="tab-pane">
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
                                                                ?>
                                                                <li><a href="#post_<?php echo $the_query->post->ID ;?>" data-toggle="tab"><img src="<?php echo get_the_post_thumbnail_url($the_query->post,'thumbnail') ?>"><p><?php echo $the_query->post->post_title; ?></p></a></li>
                                                                <?php
                                                                $the_query->the_post();
                                                            }
                                                        }
                                                    ?>
                                                    </ul>
                                                <?php
                                            }

                                        $the_query = new WP_Query( array(
                                            'post_type' => 'eaarticles',
                                            'post_status' => 'publish',
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
                                                    ?>
                                                    <li><a href="#post_<?php echo $the_query->post->ID ;?>" data-toggle="tab"><img src="<?php echo get_the_post_thumbnail_url($the_query->post,'thumbnail') ?>"><p><?php echo $the_query->post->post_title; ?></p></a></li>
                                                    <?php
                                                    $the_query->the_post();
                                                }
                                            ?>
                                        </ul>
                                        <?php
                                    }

                                        ?>
                                    </ul>
                                </div>
                <?php
                                }
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
                            <img src="img/menu/marketing.png">
                        </a>
                    </div>
                    <div class="col-lg-9">
                        <h2>
                            Title
                        </h2>
                        <span class="text-date">September 1, 2018</span>
                        <p>Some text</p>
                    </div>

                </div>

                <div id="action-ebook" class="action col-lg-6" style="display: none">
                    <a href="#" data-toggle="modal" data-target="#page"><span class="glyphicon glyphicon-file"></span>Download Page</a>
                    <a href="#" data-toggle="modal" data-target="#buy"><span class="glyphicon glyphicon-shopping-cart"></span>Buy Items</a>
                    <a href="#" data-toggle="modal" data-target="#share"><span class="glyphicon glyphicon-share"></span>Share</a>
                    <a href="##" data-toggle="modal" data-target="#ask"><span class="glyphicon glyphicon-question-sign"></span>Ask Us</a>
                </div>

                <div id="action-gallery" class="action col-lg-6" >
                    <a href="#" data-toggle="modal" data-target="#preview"><span class="glyphicon glyphicon-file"></span>Download Preview</a>
                    <a href="#" data-toggle="modal" data-target="#source"><span class="glyphicon glyphicon-download"></span>Download Source</a>
                    <a href="#" data-toggle="modal" data-target="#share"><span class="glyphicon glyphicon-share"></span>Share</a>
                    <a href="#" data-toggle="modal" data-target="#ask"><span class="glyphicon glyphicon-question-sign"></span>Ask Us</a>
                </div>

            </div>


            <div class="media_area">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                    <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
                    <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <h3>HOME</h3>
                        <p>Some content.</p>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3>Menu 1</h3>
                        <p>Some content in menu 1.</p>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <h3>Menu 2</h3>
                        <p>Some content in menu 2.</p>
                    </div>
                </div>

            </div>

        </div>
    </div>






</section>



<!-- Modals -->

<div id="preview" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center">Register</h4>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>








<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>js/vendor/jquery-3.3.1.min.js"><\/script>')</script>

<script type="text/javascript" src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/vendor/bootstrap.js"></script>

<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/plugins.js"></script>
<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/easycubes-app-public.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>

</html>