<?php

$eafolders = get_terms(array(
    'taxonomy' => 'eafolders',
    'hide_empty' => false,
    'orderby' => 'order',
    'order' => 'ASC',
    'parent' => 0
));


$eaproducts = get_terms(array(
    'taxonomy' => 'eaproducts',
    'hide_empty' => false,
    'orderby' => 'order',
    'order' => 'ASC',
    'parent' => 0
));

$eaaddresses = get_terms(array(
    'taxonomy' => 'eaaddresses',
    'hide_empty' => false,
    'orderby' => 'order',
    'order' => 'ASC',
    'parent' => 0
));

?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php bloginfo( 'name' ); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/images/favicon.ico">
    <link rel="icon" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/images/favicon.ico" type="image/gif">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/css/normalize.css">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

    <!-- Media Boxes CSS -->
    <link rel="stylesheet"
    href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/Font%20Awesome/css/font-awesome.min.css">
    <link rel="stylesheet"
    href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/Magnific%20Popup/magnific-popup.css">
    <link rel="stylesheet"
    href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/components/Fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/css/mediaBoxes.css">
    <!-- Media Boxes CSS -->

    <link rel="stylesheet" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/css/easycubes-app-public.css">
    <link rel="stylesheet" href="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/css/easycubes-app-public-orderpage.css">

    <meta name="broken_img" content="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/images/missing.png"/>

</head>
<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<section class="page-header">
    <div class="container-fluid">
        <div class="row no-gutters justify-content-between">
            <div class="col">
                <a class="logo" href=""><img src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/images/eb-logo-color@4x.png"></a>
            </div>

            <div class="col-auto">
                <div class="row">
                    <div class="col">
                        <form class="form-search">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                    <input autocomplete="off" name="query" type="text" placeholder="Search" class="form-control" aria-label="" aria-describedby="basic-addon1" style="width: 15vw;">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col text-right">
                        <a href="/" target="_blank" class="nav-link">EasyCubes&reg; Home Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 navigation">
            <ul class="nav nav-tabs" id="interest_tabs">
                <?php
                if (!empty($eafolders)) {
                    $bf = true;
                    foreach ($eafolders as $eafolder) {
                        $t_id = $eafolder->term_id;
                        $eafolder_term_meta = get_option("eafolder_taxonomy_$t_id" . "_fimg");
                        ?>
                        <li class="<?php if ($bf) {
                            echo "active";
                            $bf = false;
                        } ?>">
                        <a href="#tab_<?php echo $t_id; ?>" data-toggle="tab">
                            <img src="<?php echo $eafolder_term_meta; ?>">
                            <p><?php echo strtoupper($eafolder->name); ?></p>
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
            if (!empty($eafolders)) {
                $bf = true;
                foreach ($eafolders as $eafolder) {
                    $t_id = $eafolder->term_id;
                    $eafolders_l2 = get_terms(array(
                        'taxonomy' => 'eafolders',
                        'orderby' => 'order',
                        'order' => 'ASC',
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
                            $bf = true;
                            foreach ($eafolders_l2 as $eafolder_l2) {
                                $t_id_l2 = $eafolder_l2->term_id;
                                $eafolder_l2_term_meta = get_option("eafolder_taxonomy_$t_id_l2" . "_fimg");
                                ?>
                                <li class="<?php if ($bf) {
                                    echo "active";
                                    $bf = false;
                                } ?>">
                                <a href="#tab_<?php echo $t_id_l2; ?>" data-toggle="tab">
                                    <img src="<?php echo $eafolder_l2_term_meta; ?>">
                                    <p><?php echo strtoupper($eafolder_l2->name); ?></p>
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
        foreach ($eafolders as $eafolder) {
            $t_id = $eafolder->term_id;
            $eafolders_l2 = get_terms(array(
                'taxonomy' => 'eafolders',
                'orderby' => 'order',
                'order' => 'ASC',
                'hide_empty' => false,
                'parent' => $t_id
            ));
            if (!empty($eafolders_l2)) {

                foreach ($eafolders_l2 as $eafolder_l2) {
                    $t_id_l2 = $eafolder_l2->term_id;


                    ?>
                    <div id="tab_<?php echo $t_id_l2; ?>" class="tab-pane <?php if ($bf) {
                        echo "active";
                        $bf = false;
                    } ?>">


                    <ul class="nav nav-tabs">

                        <?php

                                        //Others
                        $the_query = new WP_Query(array(
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
                            'orderby' => 'menu_order',
                            'order' => 'ASC'
                        ));

                        if ($the_query->have_posts()) {
                            ?>
                            <ul class="nav nav-pills">
                                <span><?php echo strtoupper($eafolder_l2->name) ?></span>
                                <?php
                                while ($the_query->have_posts()) {
                                    $the_query->the_post();
                                    ?>
                                    <li><a class="eaarticles"
                                     href="#post_<?php echo $the_query->post->ID; ?>"
                                     data-toggle="tab"><img
                                     src="<?php echo get_the_post_thumbnail_url($the_query->post, 'thumbnail') ?>">
                                     <p><?php echo $the_query->post->post_title; ?></p></a></li>
                                     <?php

                                 }
                                 ?>
                             </ul>
                             <?php
                         }


                         $eafolders_l3 = get_terms(array(
                            'taxonomy' => 'eafolders',
                            'orderby' => 'order',
                            'order' => 'ASC',
                            'hide_empty' => false,
                            'parent' => $t_id_l2));


                         if (!empty($eafolders_l3)) {

                            ?>


                            <?php
                            foreach ($eafolders_l3 as $eafolder_l3) {
                                $t_id_l3 = $eafolder_l3->term_id;

                                ?>
                                <ul class="nav nav-pills">
                                    <span><?php echo strtoupper($eafolder_l3->name); ?></span>
                                    <?php

                                    $the_query = new WP_Query(array(
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
                                        'orderby' => 'menu_order',
                                        'order' => 'ASC'
                                    ));

                                    if ($the_query->have_posts()) {

                                        while ($the_query->have_posts()) {
                                            $the_query->the_post();
                                            ?>
                                            <li><a class="eaarticles"
                                             href="#post_<?php echo $the_query->post->ID; ?>"
                                             data-toggle="tab"><img
                                             src="<?php echo get_the_post_thumbnail_url($the_query->post, 'thumbnail') ?>">
                                             <p><?php echo $the_query->post->post_title; ?></p></a>
                                         </li>
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


<div class="col-lg-8 col-md-8 col-sm-8 content">


    <div class="title_action_bar">
        <div class="title col-lg-7 col-md-7 col-sm-7">

            <div class="col-lg-3 col-md-5 col-sm-4" style="height: 100%;">
                <a href="#" class="title-logo">
                    <img src="" alt="">
                </a>
            </div>
            <div class="col-lg-9 col-md-7 col-sm-8">
                <h2></h2>
                <span class="text-date hidden"></span>
                <p></p>
            </div>

        </div>

        <div id="action-ebook" class="action col-lg-5 col-md-5 col-sm-5">
            <div class="row physical" style="display: none;">
                <div class="d-flex justify-end">
                    <div class="col-auto preview">
                        <a href="#" data-target="#preview"><span class="glyphicon glyphicon-download-alt"></span>Download Preview</a>
                    </div>
                    <div class="col-auto source">
                        <a href="#" data-target="#source"><span class="glyphicon glyphicon-download-alt"></span>Download Source</a>
                    </div>
                    <div class="col-auto share">
                        <a href="#" data-toggle="modal" data-target="#share"><span class="glyphicon glyphicon-share"></span>Share</a>
                    </div>
                    <div class="col-auto ask">
                        <a href="#" data-toggle="modal" data-target="#ask"><span class="glyphicon glyphicon-question-sign"></span>Ask Us</a>
                    </div>
                </div>
            </div>

            <div class="row digital" style="display: block;">
                <div class="d-flex justify-end">
                    <div class="col-auto preview">
                        <a href="#" data-target="#preview"><span class="glyphicon glyphicon-download-alt"></span>Download Preview</a>
                    </div>
                    <div class="col-auto source">
                        <a href="#" data-target="#source"><span class="glyphicon glyphicon-download-alt"></span>Download Source</a>
                    </div>
                    <div class="col-auto share">
                        <a href="#" data-toggle="modal" data-target="#share"><span class="glyphicon glyphicon-share"></span>Share</a>
                    </div>
                    <div class="col-auto ask">
                        <a href="#" data-toggle="modal" data-target="#ask"><span class="glyphicon glyphicon-question-sign"></span>Ask Us</a>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="media_area">
        <ul class="nav nav-tabs"></ul>

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
        <h2 class="col-lg-12" style="color: black">
            Search results
        </h2>

        <div class="col-lg-12" style="background: white;height: 80%;overflow-x: hidden;overflow-y: scroll;">


        </div>

    </div>
</div>

 <!--
    <div class="order-page">
        <div class="container" style="height: 100%;">
            <div class="pull-right" style="padding-top:5px ">
                <a class="btn-remove-order" href="#"><span style="font-size: 40px;    color: black;" class="glyphicon glyphicon-remove-circle"></span></a>
            </div>



            <div class="row">
                <div class="col-lg-4 col-md-4">

                </div>
                <div class="col-lg-6 col-lg-6">
                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="pill" href="#cart-samples">Samples</a></li>
                        <li><a data-toggle="pill" href="#cart-products">Products</a></li>
                        <li><a data-toggle="pill" href="#cart-shipping">Shipping</a></li>
                    </ul>
                </div>
            </div>


            <div class="col-lg-12" style="background: white;height: 10%; display:none;">

                <div class="container">
                    <form class="order-form" id="order-form" action="#">

                        <div class="form-group">
                            <div class="col-lg-6">
                                <label class="label label-primary" for="order-cart-product">
                                    Product name :
                                </label>
                                <select class="form-control" id="order-cart-product">
                                    <?php
                                    if (!empty($eaproducts)) {
                                        foreach ($eaproducts as $eaproduct) {
                                            $t_id = $eaproduct->term_id;
                                            $product_price = get_option("eaproducts_taxonomy_$t_id" . "_price");
                                            $product_itempack = get_option("eaproducts_taxonomy_$t_id" . "_itempack");

                                            $product_price = doubleval($product_price);
                                            $product_itempack = intval($product_itempack);

                                            ?>
                                            <option name=""
                                                    value="<?php echo $eaproduct->slug; ?>"><?php echo strtoupper($eaproduct->name); ?>
                                                [$<?php echo $product_price; ?>, <?php echo $product_itempack; ?>
                                                item(s) in pack ]
                                            </option>

                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label class="label label-primary" for="order-cart-qty">
                                    Product Qty :
                                </label>
                                <input class="form-control" id="order-cart-qty" type="number" name="" min="1"
                                       max="10000" value="1">
                            </div>
                            <div class="col-lg-2">
                                <br>
                                <button class="col-xs-offset-2 btn btn-success" type="submit"><span
                                            class="glyphicon glyphicon-plus-sign"></span> Add to cart
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>


            <div class="col-lg-12 order-items well"
                 style="background: white;height: 85%;margin-bottom: 0;padding-bottom: 0;">


                <div class="tab-content">

                        <div id="cart-samples" class="tab-pane fade in active">

                            <div class="well">
                                <h3>SAMPLES</h3>
                                <p>
                                    Here you can find the production prices for custom printed covers and product samples.
                                    These products are delivered and invoiced seperately from Easycubes Poland.
                                    In the next tab you will be able to order products in larger quantities</p>
                                <p>
                                    Please be advised the prices visible are the advsed retail prices and are ex VAT, and ex
                                    WORKS. Your distributor reduction will be added in your final invoice
                                </p>
                                <p>
                                    Regarding shipping the samples and products are generally in stock and will be send
                                    within a few days. We will send you a confirmation as soon as we receive your request.
                                    Please mind that the shipping price and delivery time are estimates and depend on the
                                    availability.</p>


                            </div>
                            <div class="well">
                                <H3>PRINTED COVER</H3>
                                <p>Please indicate the total amount of covers you need, independently of the designs.
                                    If you need custom printed covers, you will be able to send us the graphics.</p>
                                <table class="table table-eacart">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product name</th>
                                        <th>Link</th>
                                        <th>Price(&euro;)</th>
                                        <th>Item in Pack</th>
                                        <th>Size</th>
                                        <th>Weight(g)</th>
                                        <th>Select Amount</th>
                                        <th>Total(&euro;)</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php do_shortcode("[easycubes_app_partner_products ids='74,75,76,77']"); ?>
                                    </tbody>

                                </table>
                            </div>
                            <div class="well">
                                <H3>PRINTED CUBE</H3>
                                <p>Please indicate the total amount of covers you need, independently of the designs.
                                    If you need custom printed covers, you will be able to send us the graphics.</p>
                                <table class="table table-eacart">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product name</th>
                                        <th>Link</th>
                                        <th>Price(&euro;)</th>
                                        <th>Item in Pack</th>
                                        <th>Size</th>
                                        <th>Weight</th>
                                        <th>Select Amount</th>
                                        <th>Total(&euro;)</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php do_shortcode("[easycubes_app_partner_products ids='78,79']"); ?>
                                    </tbody>

                                </table>
                            </div>
                            <div class="well">
                                <H3>ACRYLICS</H3>
                                <table class="table table-eacart">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product name</th>
                                        <th>Link</th>
                                        <th>Price(&euro;)</th>
                                        <th>Item in Pack</th>
                                        <th>Size</th>
                                        <th>Weight</th>
                                        <th>Select Amount</th>
                                        <th>Total(&euro;)</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php do_shortcode("[easycubes_app_partner_products ids='80,81,82,83']"); ?>

                                    </tbody>

                                </table>
                            </div>
                            <div class="well">
                                <H3>TOOLS</H3>
                                <table class="table table-eacart">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product name</th>
                                        <th>Link</th>
                                        <th>Price(&euro;)</th>
                                        <th>Item in Pack</th>
                                        <th>Size</th>
                                        <th>Weight</th>
                                        <th>Select Amount</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <?php do_shortcode("[easycubes_app_partner_products ids='84,85,86']"); ?>
                                    </tbody>

                                </table>
                            </div>
                            <div class="well">
                                <H3>FLOORING</H3>
                                <table class="table table-eacart">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product name</th>
                                        <th>Link</th>
                                        <th>Price(&euro;)</th>
                                        <th>Item in Pack</th>
                                        <th>Size</th>
                                        <th>Weight</th>
                                        <th>Select Amount</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php do_shortcode("[easycubes_app_partner_products ids='87,88,89,90,91']"); ?>
                                    </tbody>

                                </table>
                            </div>
                            <div class="well">
                                <H3>WALL PIXLIP</H3>
                                <table class="table table-eacart">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product name</th>
                                        <th>Link</th>
                                        <th>Price(&euro;)</th>
                                        <th>Item in Pack</th>
                                        <th>Size</th>
                                        <th>Weight</th>
                                        <th>Select Amount</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php do_shortcode("[easycubes_app_partner_products ids='92,93']"); ?>

                                    </tbody>

                                </table>
                            </div>
                            <div class="well">
                                <H3>WALL DIBOND</H3>
                                <table class="table table-eacart">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product name</th>
                                        <th>Link</th>
                                        <th>Price(&euro;)</th>
                                        <th>Item in Pack</th>
                                        <th>Size</th>
                                        <th>Weight</th>
                                        <th>Select Amount</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php do_shortcode("[easycubes_app_partner_products ids='94,95']"); ?>
                                    </tbody>

                                </table>
                            </div>

                            <footer class="navbar-fixed-bottom">

                                <div class="container">

                                    <div class="col-lg-8">
                                        <div class="pull-right">
                                            <h3>Total Samples(&euro;): <span class="cart-amount">0.00</span></h3>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="pull-right">
                                            <button class="btn btn-info" type="button" data-toggle="pill"
                                                    href="#cart-products"><span class="fa">NEXT <span
                                                            class="glyphicon glyphicon-arrow-right"></span>  </span>
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </footer>
                        </div>
                        <div id="cart-products" class="tab-pane fade">
                            <div class="well">
                                <h3>PRODUCTS</h3>
                                <p>
                                    Here you can find the production prices for our standard product offer. These products
                                    are delivered and invoiced seperately from Germany.</p>
                                <p>
                                    Standard products are generally in stock and will be send within a few days. We will
                                    send you a confirmation as soon as we receive your request. </p>
                                <p>
                                    Please mind that the shipping price and delivery time are estimates and depend on the
                                    availability.
                                </p>


                            </div>
                            <div class="well">
                                <H3>White RAL9003</H3>

                                <table class="table table-eacart">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product name</th>
                                        <th>Link</th>
                                        <th>Retail price(&euro;)</th>
                                        <th>Qty /pallet</th>
                                        <th>Min Qt</th>
                                        <th>Select Amount</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr class="well">
                                        <td></td>
                                        <td><a target="_blank" class="text-primary" href="#"><strong>Cube</strong></a></td>
                                        <td><a target="_blank" class="text-primary"
                                               href="http://easycubes.com/partnerapp/the-partner-page/#post_282"><span
                                                        class="glyphicon glyphicon-link"></span></a></td>
                                        <td>23.00</td>
                                        <td>60</td>
                                        <td>120</td>
                                        <td><input class="form-control" type="number" min="0" max="9999" value="0"
                                                   name="amount[]"/></td>
                                        <td>0.00</td>
                                    </tr>

                                    <tr class="well">
                                        <td></td>
                                        <td><a target="_blank" class="text-primary" href="#"><strong>Floor</strong></a></td>
                                        <td><a target="_blank" class="text-primary"
                                               href="http://easycubes.com/partnerapp/the-partner-page/#post_1505"><span
                                                        class="glyphicon glyphicon-link"></span></a></td>
                                        <td>10.00</td>
                                        <td>240</td>
                                        <td>240</td>
                                        <td><input class="form-control" type="number" min="0" max="9999" value="0"
                                                   name="amount[]"/></td>
                                        <td>0.00</td>
                                    </tr>

                                    <tr class="well">
                                        <td></td>
                                        <td><a target="_blank" class="text-primary" href="#"><strong>Cover</strong></a></td>
                                        <td><a target="_blank" class="text-primary"
                                               href="http://easycubes.com/partnerapp/the-partner-page/#post_1506"><span
                                                        class="glyphicon glyphicon-link"></span></a></td>
                                        <td>6.00</td>
                                        <td>120</td>
                                        <td>120</td>
                                        <td><input class="form-control" type="number" min="0" max="9999" value="0"
                                                   name="amount[]"/></td>
                                        <td>0.00</td>
                                    </tr>

                                    <tr class="well">
                                        <td></td>
                                        <td><a target="_blank" class="text-primary" href="#"><strong>Ramp + corner</strong></a>
                                        </td>
                                        <td><a target="_blank" class="text-primary"
                                               href="http://easycubes.com/partnerapp/the-partner-page/"><span
                                                        class="glyphicon glyphicon-link"></span></a></td>
                                        <td>9.00</td>
                                        <td>120</td>
                                        <td>120</td>
                                        <td><input class="form-control" type="number" min="0" max="9999" value="0"
                                                   name="amount[]"/></td>
                                        <td>0.00</td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                            <div class="well">
                                <H3>Black RAL9003</H3>
                                <p>Please indicate the total amount of covers you need, independently of the designs.
                                    If you need custom printed covers, you will be able to send us the graphics.</p>
                                <table class="table table-eacart">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product name</th>
                                        <th>Link</th>
                                        <th>Retail price(&euro;)</th>
                                        <th>Qty /pallet</th>
                                        <th>Min Qt</th>
                                        <th>Select Amount</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr class="well">
                                        <td></td>
                                        <td><a target="_blank" class="text-primary" href="#"><strong>Cube</strong></a></td>
                                        <td><a target="_blank" class="text-primary"
                                               href="http://easycubes.com/partnerapp/the-partner-page/#post_282"><span
                                                        class="glyphicon glyphicon-link"></span></a></td>
                                        <td>23.00</td>
                                        <td>60</td>
                                        <td>120</td>
                                        <td><input class="form-control" type="number" min="0" max="9999" value="0"
                                                   name="amount[]"/></td>
                                        <td>0.00</td>
                                    </tr>

                                    <tr class="well">
                                        <td></td>
                                        <td><a target="_blank" class="text-primary" href="#"><strong>Floor</strong></a></td>
                                        <td><a target="_blank" class="text-primary"
                                               href="http://easycubes.com/partnerapp/the-partner-page/#post_1505"><span
                                                        class="glyphicon glyphicon-link"></span></a></td>
                                        <td>10.00</td>
                                        <td>240</td>
                                        <td>240</td>
                                        <td><input class="form-control" type="number" min="0" max="9999" value="0"
                                                   name="amount[]"/></td>
                                        <td>0.00</td>
                                    </tr>

                                    <tr class="well">
                                        <td></td>
                                        <td><a target="_blank" class="text-primary" href="#"><strong>Cover</strong></a></td>
                                        <td><a target="_blank" class="text-primary"
                                               href="http://easycubes.com/partnerapp/the-partner-page/#post_1506"><span
                                                        class="glyphicon glyphicon-link"></span></a></td>
                                        <td>6.00</td>
                                        <td>120</td>
                                        <td>120</td>
                                        <td><input class="form-control" type="number" min="0" max="9999" value="0"
                                                   name="amount[]"/></td>
                                        <td>0.00</td>
                                    </tr>

                                    <tr class="well">
                                        <td></td>
                                        <td><a target="_blank" class="text-primary" href="#"><strong>Ramp + corner</strong></a>
                                        </td>
                                        <td><a target="_blank" class="text-primary"
                                               href="http://easycubes.com/partnerapp/the-partner-page/"><span
                                                        class="glyphicon glyphicon-link"></span></a></td>
                                        <td>9.00</td>
                                        <td>120</td>
                                        <td>120</td>
                                        <td><input class="form-control" type="number" min="0" max="9999" value="0"
                                                   name="amount[]"/></td>
                                        <td>0.00</td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                            <div class="well">
                                <H3>Custom Color</H3>
                                <table class="table table-eacart">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product name</th>
                                        <th>Link</th>
                                        <th>Retail price(&euro;)</th>
                                        <th>Qty /pallet</th>
                                        <th>Min Qt</th>
                                        <th>Select Amount</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr class="well">
                                        <td></td>
                                        <td><a target="_blank" class="text-primary" href="#"><strong>Cube</strong></a></td>
                                        <td><a target="_blank" class="text-primary"
                                               href="http://easycubes.com/partnerapp/the-partner-page/#post_282"><span
                                                        class="glyphicon glyphicon-link"></span></a></td>
                                        <td>23.00</td>
                                        <td>60</td>
                                        <td>480</td>
                                        <td><input class="form-control" type="number" min="0" max="9999" value="0"
                                                   name="amount[]"/></td>
                                        <td>0.00</td>
                                    </tr>

                                    <tr class="well">
                                        <td></td>
                                        <td><a target="_blank" class="text-primary" href="#"><strong>Floor</strong></a></td>
                                        <td><a target="_blank" class="text-primary"
                                               href="http://easycubes.com/partnerapp/the-partner-page/#post_1505"><span
                                                        class="glyphicon glyphicon-link"></span></a></td>

                                        <td>10.00</td>
                                        <td>240</td>
                                        <td>480</td>
                                        <td><input class="form-control" type="number" min="0" max="9999" value="0"
                                                   name="amount[]"/></td>
                                        <td>0.00</td>
                                    </tr>

                                    <tr class="well">
                                        <td></td>
                                        <td><a target="_blank" class="text-primary" href="#"><strong>Cover</strong></a></td>
                                        <td><a target="_blank" class="text-primary"
                                               href="http://easycubes.com/partnerapp/the-partner-page/#post_1506"><span
                                                        class="glyphicon glyphicon-link"></span></a></td>
                                        <td>6.00</td>
                                        <td>120</td>
                                        <td>480</td>
                                        <td><input class="form-control" type="number" min="0" max="9999" value="0"
                                                   name="amount[]"/></td>
                                        <td>0.00</td>
                                    </tr>

                                    <tr class="well">
                                        <td></td>
                                        <td><a target="_blank" class="text-primary" href="#"><strong>Ramp + corner</strong></a>
                                        </td>
                                        <td><a target="_blank" class="text-primary"
                                               href="http://easycubes.com/partnerapp/the-partner-page/"><span
                                                        class="glyphicon glyphicon-link"></span></a></td>
                                        <td>9.00</td>
                                        <td>120</td>
                                        <td>480</td>
                                        <td><input class="form-control" type="number" min="0" max="9999" value="0"
                                                   name="amount[]"/></td>
                                        <td>0.00</td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>


                            <footer class="navbar-fixed-bottom">

                                <div class="container">

                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h3 class="pull-left">Total Pallets: <span
                                                            class="cart-amount-pellets">0</span></h3>
                                            </div>
                                            <div class="col-lg-6">
                                                <h3 class="pull-right">Total Products(&euro;): <span class="cart-amount">0.00</span>
                                                </h3>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="pull-right">
                                            <button class="btn btn-primary" type="button" data-toggle="pill"
                                                    href="#cart-samples"><span class="fa"><span
                                                            class="glyphicon glyphicon-arrow-left"></span> PREVIOUS  </span>
                                            </button>
                                            <button class="btn btn-info" type="button" data-toggle="pill"
                                                    href="#cart-shipping"><span class="fa">NEXT <span
                                                            class="glyphicon glyphicon-arrow-right"></span>  </span>
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </footer>
                        </div>
                        <div id="cart-shipping" class="tab-pane fade">
                            <div class="col-lg-12 well">
                                <div class="col-lg-4 deliveryinfo">
                                    <h3>A. DELIVERY INFO</h3>

                                    <div class="form-group">
                                        <select id="shipping-address" name="shipping-address">
                                            <option></option>
                                            <?php
                                            if (!empty($eaaddresses)) {
                                                $bf = true;
                                                foreach ($eaaddresses as $eaaddress) {
                                                    $t_id = $eaaddress->term_id;
                                                    $term_meta_locs = get_option("eaaddress_taxonomy_$t_id" . "_locs");
                                                    $term_meta_locs = stripslashes(urldecode($term_meta_locs));
                                                    $term_meta_locs = json_decode($term_meta_locs);

                                                    ?>
                                                    <optgroup label="<?php echo ucfirst(strtolower($eaaddress->name)); ?>">

                                                        <?php
                                                        foreach ($term_meta_locs as $term_meta_loc) {
                                                            ?>
                                                            <option value="<?php echo $term_meta_loc[0]; ?>"
                                                                    data-price="<?php echo $term_meta_loc[1]; ?>"><?php echo ucfirst(strtolower($term_meta_loc[0])); ?></option>
                                                            <?php
                                                        }

                                                        ?>
                                                    </optgroup>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input id="shipping-cust-company" class="form-control" type="text" name="shipping-cust-company" placeholder="Company"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="First Name" name="shipping-fname" value=""/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Last Name" name="shipping-lname" value=""/>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="shipping-email" placeholder="Email Address *" value=""/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="shipping-phone" placeholder="Phone *" value=""/>
                                            </div>
                                        </div>
                                    </div>





                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea id="shipping-cust-addr" class="form-control" type="text" placeholder="Enter custom address" name="shipping-cust-addr"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="shipping-cust-city" class="form-control" type="text" name="shipping-cust-city" placeholder="City"/>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="shipping-cust-pc" class="form-control" type="text" name="shipping-cust-pc" placeholder="Postal Code"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="shipping-cust-country" class="form-control" type="text" name="shipping-cust-country" placeholder="Country"/>
                                        </div>
                                    </div>

                                </div>



                            </div>

                                <div class="col-lg-4 innershipping">
                                    <h3>B. SELECT SHIPPING </h3>
                                    <div class="row">
                                        <label>Samples shipped from Poland (<a style="font-size: 12px" href="#" data-toggle="tooltip" title="Drukpoznan.pl
    ul. Winogrady 28, 61-663 Poznań
    Poland">see full address</a>)</label>


                                        <div class="radio">
                                            <label><input type="radio" name="ship-poland" value="normal">Normal Package <a href="https://easycubes-s3.s3.eu-west-3.amazonaws.com/Others/Samples_shipped%20from%20Poland_Normal%20Package.pdf"> View rates</a></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="ship-poland" value="pallet">Pallet Package <a href="https://easycubes-s3.s3.eu-west-3.amazonaws.com/Others/Samples_shipped%20from%20Poland_Pallet%20Package.pdf"> View rates</a></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="ship-poland" value="pickup">Pickup <a href="#"> (own transport)</a></label>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <label>Products shipped from Augsburg(<a style="font-size: 12px" href="#" data-toggle="tooltip" title="WIBO Kunststofftechnik GmbH,
    Oskar-von-Miller-Str. 7
    D-86405 Meitingen,
    Germany">see full address</a>)</label>

                                        <div class="radio">
                                            <label><input type="radio" name="ship-augsbarg" value="pallet">Pallet Package <a href="https://easycubes-s3.s3.eu-west-3.amazonaws.com/Others/Products_shipped%20from%20Augsburg_Pallet%20Package.pdf"> View rates</a></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="ship-augsbarg" value="pickup">Pickup <a href="#"> (own transport)</a></label>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>



                                    </div>
                                </div>

                                <div class="col-lg-4 shippingtotal">
                                    <h3>C. TOTAL </h3>
                                    <div class="row">
                                        <strong>Total cost for samples</strong>
                                        <ul class="shippingotal-costsamples">
                                            <li><div style="width: 78%;display: inline-block;">Total cost samples</div> <div align="right" style="width: 20%;display: inline-block;"> <strong> € <span> 0</span></strong></div> </li>
                                            <li><div style="width: 78%;display: inline-block;">Shipping cost samples</div> <div align="right" style="width: 20%;display: inline-block;"> <strong> €<span> 0</span></strong></div> </li>
                                        </ul>

                                    </div>

                                    <div class="row">
                                        <strong>Total cost for products</strong>
                                        <ul class="shippingotal-products">
                                            <li><div style="width: 80%;display: inline-block;">Total cost products</div> <div align="right" style="width: 18%;display: inline-block;"> <strong> € <span> 0</span></strong></div> </li>
                                            <li><div style="width: 80%;display: inline-block;">Shipping cost products</div> <div align="right" style="width: 18%;display: inline-block;"> <strong> €<span> 0</span></strong></div> </li>
                                        </ul>

                                    </div>

                                    <div class="row">
                                        <strong>Order notes :</strong> <br>
                                        <textarea class="form-control form-input" name="total-ordernotes" rows="5"> </textarea>
                                    </div>


                                </div>

                        </div>

                            <footer class="navbar-fixed-bottom">
                                <div class="container">
                                    <div class="col-lg-9">
                                        <div class="pull-right">
                                            <div class="row bottom">
                                                <label><input type="checkbox"> If you click "Place your order", you agree to our general sales conditions</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="pull-right">
                                            <button class="btn btn-primary" type="button" data-toggle="pill" href="#cart-products">
                                                <span class="fa"><span class="glyphicon glyphicon-arrow-left"></span> PREVIOUS  </span>
                                            </button>
                                            <button class="btn btn-success" type="submit">
                                                <span class="fa"><span class="glyphicon glyphicon-ok"></span> PLACE YOUR ORDER  </span>
                                            </button>

                                        </div>
                                    </div>
                                </div>

                            </footer>
                    </div>

            </div>
        </div>

    </div>
    </div>

-->

<?php include ("easycubes-app-public-orderpage.php") ; ?>


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

                <div class="share-box form-group">
                    <input type="text" class="share-box-link" id="share-box-link" value="" readonly>
                    <button class="form-control share-box-copy">Copy</button>
                </div>

                <div id="share-buttons">
                    <!-- Email -->
                    <a class="social-email" href="#">
                        <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email"/>
                    </a>

                    <!-- Facebook -->
                    <a class="social-fb" href="#" target="_blank">
                        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook"/>
                    </a>

                    <!-- Google+ -->
                    <a class="social-g" href="#" target="_blank">
                        <img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google"/>
                    </a>

                    <!-- LinkedIn -->
                    <a class="social-li" href="#" target="_blank">
                        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn"/>
                    </a>


                    <!-- Reddit -->
                    <a class="social-reddit" href="#" target="_blank">
                        <img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit"/>
                    </a>


                    <!-- Twitter -->
                    <a class="social-twitter" href="#" target="_blank">
                        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter"/>
                    </a>

                    <!-- VK -->
                    <a class="social-vk" href="#" target="_blank">
                        <img src="https://simplesharebuttons.com/images/somacro/vk.png" alt="VK"/>
                    </a>


                </div>
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
                <form id="contact-form" method="post" action="" role="form">

                    <div class="messages"></div>

                    <div class="controls">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_email">From *</label>
                                    <input id="form_email" type="email" name="emailFrom" class="form-control"
                                    placeholder="Please enter your email *" required="required"
                                    data-error="Valid email is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_message">Message </label>
                                    <textarea id="form_message" name="message" class="form-control"
                                    placeholder="I have a question about this product..." rows="4"
                                    required="required" data-error="Please, leave us a message."></textarea>
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
                                    Marked with <strong>*</strong> fields are required, current page's link is already
                                    attached.
                                </p>
                            </div>
                        </div>

                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<div id="accessdialog" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center">Login</h4>
            </div>
            <div class="modal-body">
                <form id="access-form" method="post" action="" role="form">
                    <div class="messages"></div>
                    <div class="row">
                        <div class="form-group">
                            <input class="form-control" type="password" name="passphrase" autocomplete="off"
                            placeholder="Enter your access key"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <p class="text-warning">
                                By clicking proceed, you agree that you are authorized by <a
                                href="https://easycubes.com">Easycubes</a>
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group pull-right">
                                <button type="submit" class="btn btn-primary btn-send">Proceed <span
                                    class="fa fa-arrow-right"></span></button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <div id="webshopaccess" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align-last: center">Login to webshop</h4>
                </div>
                <div class="modal-body">
                    <form id="webshopaccess-form" method="post" action="" role="form">
                        <div class="messages"></div>
                        <div class="row">
                            <div class="form-group">
                                <input class="form-control" type="password" name="passphrase" autocomplete="off"
                                placeholder="Enter your webshop access key"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                                <p class="text-warning">
                                    By clicking proceed, you agree that you are authorized by <a
                                    href="https://easycubes.com">Easycubes</a>
                                </p>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary btn-send">Proceed <span
                                        class="fa fa-arrow-right"></span></button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>


<!--
<div id="modal-cart" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center">Cart</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-10 col-md-offset-1">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total</th>
                                <th> </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="col-sm-8 col-md-6">
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="#">Product name</a></h4>
                                            <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
                                            <span>Status: </span><span
                                                    class="text-success"><strong>In Stock</strong></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-sm-1 col-md-1" style="text-align: center">
                                    <input type="email" class="form-control" id="exampleInputEmail1" value="3">
                                </td>
                                <td class="col-sm-1 col-md-1 text-center"><strong>$4.87</strong></td>
                                <td class="col-sm-1 col-md-1 text-center"><strong>$14.61</strong></td>
                                <td class="col-sm-1 col-md-1">
                                    <button type="button" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-6">
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="#">Product name</a></h4>
                                            <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
                                            <span>Status: </span><span class="text-warning"><strong>Leaves warehouse in 2 - 3 weeks</strong></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-md-1" style="text-align: center">
                                    <input type="email" class="form-control" id="exampleInputEmail1" value="2">
                                </td>
                                <td class="col-md-1 text-center"><strong>$4.99</strong></td>
                                <td class="col-md-1 text-center"><strong>$9.98</strong></td>
                                <td class="col-md-1">
                                    <button type="button" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td><h5>Subtotal</h5></td>
                                <td class="text-right"><h5><strong>$24.59</strong></h5></td>
                            </tr>
                            <tr>
                                <td> Ship to </td>
                                <td>  </td>
                                <td>  </td>
                                <td><h5>Estimated shipping</h5></td>
                                <td class="text-right"><h5><strong>$6.94</strong></h5></td>
                            </tr>
                            <tr>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td><h3>Total</h3></td>
                                <td class="text-right"><h3><strong>$31.53</strong></h3></td>
                            </tr>
                            <tr>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success">
                                        Proceed <span class="glyphicon glyphicon-play"></span>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
-->

<?php
do_shortcode('[easycubes_app_partner_generate]');
?>

<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/vendor/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- Media Boxes SCRIPTS -->


    <script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/easycubes-app-public.js"></script>
    <script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/easycubes-app-public-orderpage.js"></script>

    <script>
        window.ga = window.ga || function () {
            (ga.q = ga.q || []).push(arguments)
        };
        ga.l = +new Date;
        ga('create', 'UA-42088978-9', 'auto');
    </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>


    <div class="loadingoverlayFake"
    style="box-sizing: border-box; position: fixed; display: flex; flex-flow: column nowrap; align-items: center; justify-content: space-around; background: rgba(255, 255, 255, 0.8); top: 0px; left: 0px; width: 100%; height: 100%; z-index: 2147483647; opacity: 1;">
    <div style="order: 1; box-sizing: border-box; overflow: visible; flex: 0 0 auto; display: flex; justify-content: center; align-items: center; animation-name: loadingoverlay_animation__rotate_right; animation-duration: 2000ms; animation-timing-function: linear; animation-iteration-count: infinite; width: 120px; height: 120px;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"
        style="width: 100%; height: 100%; fill: rgb(32, 32, 32);">
        <circle r="80" cx="500" cy="90" style="fill: rgb(32, 32, 32);"></circle>
        <circle r="80" cx="500" cy="910" style="fill: rgb(32, 32, 32);"></circle>
        <circle r="80" cx="90" cy="500" style="fill: rgb(32, 32, 32);"></circle>
        <circle r="80" cx="910" cy="500" style="fill: rgb(32, 32, 32);"></circle>
        <circle r="80" cx="212" cy="212" style="fill: rgb(32, 32, 32);"></circle>
        <circle r="80" cx="788" cy="212" style="fill: rgb(32, 32, 32);"></circle>
        <circle r="80" cx="212" cy="788" style="fill: rgb(32, 32, 32);"></circle>
        <circle r="80" cx="788" cy="788" style="fill: rgb(32, 32, 32);"></circle>
    </svg>
</div>
</div>
<div class="loadingoverlayFake"
style="box-sizing: border-box; position: fixed; display: flex; flex-flow: column nowrap; align-items: center; justify-content: space-around; background: rgba(255, 255, 255, 0.8); top: 0px; left: 0px; width: 100%; height: 100%; z-index: 2147483647; opacity: 1;">
<div style="order: 1; box-sizing: border-box; overflow: visible; flex: 0 0 auto; display: flex; justify-content: center; align-items: center; animation-name: loadingoverlay_animation__rotate_right; animation-duration: 2000ms; animation-timing-function: linear; animation-iteration-count: infinite; width: 120px; height: 120px;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"
    style="width: 100%; height: 100%; fill: rgb(32, 32, 32);">
    <circle r="80" cx="500" cy="90" style="fill: rgb(32, 32, 32);"></circle>
    <circle r="80" cx="500" cy="910" style="fill: rgb(32, 32, 32);"></circle>
    <circle r="80" cx="90" cy="500" style="fill: rgb(32, 32, 32);"></circle>
    <circle r="80" cx="910" cy="500" style="fill: rgb(32, 32, 32);"></circle>
    <circle r="80" cx="212" cy="212" style="fill: rgb(32, 32, 32);"></circle>
    <circle r="80" cx="788" cy="212" style="fill: rgb(32, 32, 32);"></circle>
    <circle r="80" cx="212" cy="788" style="fill: rgb(32, 32, 32);"></circle>
    <circle r="80" cx="788" cy="788" style="fill: rgb(32, 32, 32);"></circle>
</svg>
</div>
</div>


</body>

</html>
