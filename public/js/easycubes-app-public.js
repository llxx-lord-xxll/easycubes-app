(function( $ ) {
    'use strict';
    var prodList;
    var shipList;

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
	 *
	 * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
	 *
	 * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */


    $('#interest_tabs').on('click', 'a[data-toggle="tab"]', function(e) {
        e.preventDefault();

        var link = $(this);

        if (!link.parent().hasClass('active')) {

            //remove active class from other tab-panes
            //$('.navigation .tab-content .tab-pane').removeClass('active');
            $('.navigation .tab-content .tab-pane .nav-tabs li').removeClass('active');
            $('.navigation .tab-content .tab-pane .nav-pills li').removeClass('active');
            var tabpane = $('.navigation .tab-content ' + link.attr("href"));
            tabpane.find('.nav-tabs li:first a').click();

            $('.media_area .nav-tabs').html("");
            $('.media_area .tab-content').html("");

            $('.title_action_bar .title-logo img').attr('src',null);
            $('.title_action_bar .title div:nth-child(2) h2').html("");
            $('.title_action_bar .title div:nth-child(2) p').html("");
            $('.title_action_bar .title div:nth-child(2) .text-date').html("");


            // click first submenu tab for active section
            //$('a[href="' + link.attr('href') + '"][data-toggle="tab"]').click();

            // activate tab-pane for active section
            //$('.tab-content.' + link.attr('href').replace('#','') + ' .tab-pane:first').addClass('active');

        }

    });

    $($(".navigation .tab-content")[0]).on('click',".nav-tabs li a",function (e) {

        $(".navigation .tab-content "  + $(this).attr('href') + " .nav-tabs .nav-pills li:first a").click();

    });

    $(".eaarticles").on('click',function (e) {
        $(".eaarticles").parent().removeClass("active");
        $(".media_area").removeClass("coming-soon");

        e.preventDefault();
        window.location.href = $(this).attr('href');
        $.LoadingOverlay("show");
        var data = {
            action: "get_eaarticle",
            url: $(this).attr('href')
        };
        jQuery.post(ajaxurl, data, function(response) {
            response = response.substring(0, response.length - 1);

            var json = JSON.parse(response);
            if (json['success'] === "0")
            {
                $(".loadingoverlay").remove();
                $('#accessdialog').modal('show');
                $('#access-form .messages').html("");
                return false;
            }
            //ga('set', 'page', '/' + json['post_name']);
            ga('send', 'pageview',{
                'page': '/' + json['post_name'],
                'title': json['post_title']
            });

            $('.title_action_bar .title-logo img').attr('src',json['thumbnail']);
            $('.title_action_bar .title div:nth-child(2) h2').html(json['post_title']);
            $('.title_action_bar .title div:nth-child(2) p').html(json['subtitle']);
            $('.title_action_bar .title div:nth-child(2) .text-date').html(json['post_modified']);


            if (json['product_type'] == "digital")
            {
                $('#action-ebook .digital').css('display','block');
                $('#action-ebook .physical').css('display','none');

            }
            else
            {

                $('#action-ebook .digital').css('display','block');
                $('#action-ebook .physical').css('display','none');
                /*
                $('#action-ebook .digital').css('display','none');
                $('#action-ebook .physical').css('display','block');
                */
            }


            //$('.title_action_bar .title div:nth-child(2) .text-date').html(json['post_modified']);

            var tabs = json['tabs'];
            var tab_menu_items = "";
            var tab_menu_contents = "";
            $.each(tabs,function (key,item) {
                var firstkey = "";
                if (key===0) firstkey=" active";
                tab_menu_items += '<li class="nav-item '+firstkey+'" data-dpage="'+item['dpage']+'" data-durl="'+item['durl']+'" data-type="'+item['type']+'"><a class="nav-link" data-toggle="tab" href="#atab_'+item['id']+'">'+item['title']+'</a></li>';
            });
            $.each(tabs,function (key,item) {
                var firstkey = "";
                if (key===0) firstkey=" active in";

                if (item['type'] === "pdf")
                {
                    tab_menu_contents += '<div id="atab_'+item['id']+'" class="tab-pane fade loader-bg '+firstkey+'">';
                    if(validate_url(item['content']))
                    {
                        var randomDig = Math.floor((Math.random() * 1000) + 1);
                        var pdfdoc = item['content'] + '&time=' + randomDig;
                        pdfdoc = encodeURI(pdfdoc);
                        tab_menu_contents += '<iframe height="100" frameborder="0" src="//easycubes.com/viewerapp/?url='+pdfdoc+'"></iframe>';
                    }
                    else
                    {
                        tab_menu_contents += '<p>Invalid PDF document</p>';
                    }

                    tab_menu_contents += '</div>';

                }
                else if (item['type'] === "urlembed")
                {
                    tab_menu_contents += '<div id="atab_'+item['id']+'" class="tab-pane fade loader-bg '+firstkey+'">';

                    if(validate_url(item['content']))
                    {
                        tab_menu_contents += '<iframe height="100" rel="0" frameborder="0" src="'+item['content']+'"></iframe>';
                    }
                    else
                    {
                        tab_menu_contents += '<p class="text-center text-danger">Invalid URL</p>';
                    }

                    tab_menu_contents += '</div>';
                }
                else
                {
                    var fdata = {
                        action: "get_eagallery_contents",
                        url: item['content']
                    };


                    jQuery.post(ajaxurl, fdata, function(response2) {
                        response2 = response2.substring(0, response2.length - 1);
                        response2 = JSON.parse(response2);
                        tab_menu_contents += '<div id="atab_'+item['id']+'" class="tab-pane fade loader-bg'+firstkey+'">';
                        tab_menu_contents += '<div id="grid_'+item['id']+'">';
                        $.each(response2,function (key,obj) {
                            var fname = obj.substring(obj.lastIndexOf('/')+1);
                            var domain = obj.replace('http://','').replace('https://','').split(/[/?#]/)[0];
                            tab_menu_contents += '<div class="media-box category1"> <div class="media-box-image">';
                            switch (domain)
                            {
                                case 'www.youtube.com':
                                    var ytID = obj.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/).pop();
                                    tab_menu_contents += '<div data-width="240px" data-height="140px" data-thumbnail="http://img.youtube.com/vi/'+ytID+'/0.jpg"></div>';
                                    tab_menu_contents += '<div class="thumbnail-overlay mb-open-popup" data-src="'+obj+'?rel=0"> <span class="fa fa-play media-box-play-button"></span> </div>';

                                    break;
                                default:
                                    tab_menu_contents += '<div data-width="240px" data-height="140px" data-thumbnail="'+obj+'"></div>';
                                    tab_menu_contents += '<div class="thumbnail-overlay mb-open-popup" data-src="'+obj+'"> <i class="fa fa-plus"></i> </div>';
                                    break;
                            }
                            //console.log(domain);




                            tab_menu_contents += '</div></div>';
                        });
                        tab_menu_contents += '</div>';
                        tab_menu_contents += '</div>';



                        $('.media_area .tab-content').html(tab_menu_contents);



                        setTimeout(function () {
                            $('#grid_' + item['id']).ready(function () {
                                /* $('#grid_' + item['id']).mediaBoxes({
                                     overlayEffect: 'direction-aware',
                                     boxesToLoadStart: 8,
                                     boxesToLoad: 8,
                                     horizontalSpaceBetweenBoxes: 10,
                                     verticalSpaceBetweenBoxes: 10,
                                     lazyLoad:true,
                                 });
                                 */
                                var medibox =  $('#grid_' + item['id']).mediaBoxes({
                                    columns: 4,
                                    lazyLoad: true,
                                    loadMoreWord: 'LOAD MORE',
                                    noMoreEntriesWord: 'NO MORE ENTRIES',
                                    LoadingWord: 'LOADING...',
                                    boxesToLoadStart: 999999,
                                    boxesToLoad: 99999,
                                    horizontalSpaceBetweenBoxes:30,
                                    verticalSpaceBetweenBoxes: 30,
                                    thumbnailOverlay: true,
                                    overlayEffect: 'fade',
                                    overlaySpeed: 200,
                                    waitForAllThumbsNoMatterWhat: false,
                                    considerFilteringInPopup: true,
                                });

                                $('#grid_' + item['id']).mediaBoxes( 'resize' );
                                $('#grid_' + item['id']).mediaBoxes( 'refresh' );
                                $(window).trigger("resize");

                                $(medibox).ready(function (e) {
                                    $('#atab_'+item['id']).removeClass("loader-bg");
                                })
                            });





                        },2000);




                    });

                }


            });



            $('.media_area .nav-tabs').html(tab_menu_items);
            $('.media_area .tab-content').html(tab_menu_contents);
            $.LoadingOverlay("hide");

            $('.media_area .nav-tabs li:first a').click();

            if (tab_menu_items === "")
            {
                $(".media_area").addClass("coming-soon");
            }




            //console.log(json['post_title']);
        });
    });

    $("#action-ebook a").on('click',function (e) {


        switch ($(this).attr('data-target').replace("#",""))
        {
            case 'preview':
                e.preventDefault();
                var target =  $('.media_area .nav-tabs li.active');
                if (target.length)
                {
                    window.open(target.attr('data-dpage'),'_blank');
                }
                break;
            case 'buy':

                break;
            case 'source':
                e.preventDefault();
                var target =  $('.media_area .nav-tabs li.active');
                if (target.length)
                {
                    window.open(target.attr('data-durl'),'_blank');
                }
                break;
            case 'share':
                $("#share-buttons a").attr('href',"#");
                var target = $('.navigation .tab-content:last .tab-pane ul li.active a:first');
                target = location.protocol+'//'+ location.host + location.pathname +target.attr('href');
                $('.share-box-link').val(target);
                break;
        }
    });


    $(window).on('load',function () {


        jQuery.post(ajaxurl, {action: "get_eaproducts"}, function(response) {
            response = response.substring(0, response.length - 1);1
            var json = JSON.parse(response);
            if (json['success'] === "0")
            {
                $(".loadingoverlay").remove();
                $('#accessdialog').modal('show');
                $('#access-form .messages').html("");
                return false;
            }

            prodList = json;

        });

        jQuery.post(ajaxurl, {action: "get_eaaddresses"}, function(response) {
            response = response.substring(0, response.length - 1);


            var json = JSON.parse(response);
            if (json['success'] === "0")
            {
                $(".loadingoverlay").remove();
                $('#accessdialog').modal('show');
                $('#access-form .messages').html("");
                return false;
            }

            shipList = json;

        });

        setTimeout(function () {
            $(".loadingoverlayFake").remove();
        },2000);
        var query = window.location.href.substring(window.location.href.indexOf("#post")+1);

        if (query!==window.location.href)
        {
            $('.navigation .tab-content:last .tab-pane ul li a').each(function (key,item) {
                var postid = $(item).attr('href').substring(1);
                if (query === postid)
                {
                    var tab3 = $(item).closest('.tab-pane');
                    var tab2Selector = $('.navigation .tab-content:first .tab-pane ul li a[href$="#'+tab3.attr('id')+'"]').first();
                    var tab2 = $(tab2Selector).parent().parent().parent();
                    var tab1Selector = $('#interest_tabs li a[href$="#'+tab2.attr('id')+'"]').first();
                    tab1Selector.click();
                    tab2Selector.click();
                    $(item).click();

                }
            });

        }
        else
        {
            $('.navigation .tab-content:last .tab-pane.active ul li a:first').click();

        }
    });
    $('#order-form').on('submit',function (e) {
        e.preventDefault();

        var prod = $("#order-cart-product").val();
        var qty = $("#order-cart-qty").val();
        prod = get_product_by_slug(prod);


    });

    $(".order-items footer .btn").on('click',function (e) {
        $(".order-page .nav-pills li").removeClass("active");
        switch ($(this).attr('href')){
            case "#cart-products":
                $('.order-page .nav-pills li a[href="#cart-products"]').parent().addClass('active');
                break;

            case "#cart-shipping":
                $('.order-page .nav-pills li a[href="#cart-shipping"]').parent().addClass('active');
                break;

            case "#cart-confirmation":
                $('.order-page .nav-pills li a[href="#cart-confirmation"]').parent().addClass('active');
                break;
            case "#cart-samples":
                $('.order-page .nav-pills li a[href="#cart-samples"]').parent().addClass('active');
                break;

            default:

                break;
        }
    });

    $('#access-form').on('submit',function (e) {
        e.preventDefault();
        $('#access-form .messages').html("<p class='text-primary'>Logging in...</p>");
        var accesskey = $('#access-form input[name=passphrase]').val();
        var fdata = {
            action: "partner_app_accesskey_auth",
            passphrase: accesskey,
        };
        jQuery.post(ajaxurl, fdata, function(response) {
            response = response.substring(0, response.length - 1);
            var json = JSON.parse(response);
            if (json['success'] === "0")
            {
                $('#access-form .messages').html("<p class='text-danger'>Error: Invalid access key</p>");
            }
            else {
                $('#accessdialog button.close').click();
                $('.navigation .tab-content:nth-child(3) ul ul li.active a').click();

            }
        });

    });

    $('#webshopaccess-form').on('submit',function (e) {
        e.preventDefault();
        $('#webshopaccess-form .messages').html("<p class='text-primary'>Verifying...</p>");
        var accesskey = $('#webshopaccess-form input[name=passphrase]').val();
        var fdata = {
            action: "partner_app_webaccesskey_auth",
            passphrase: accesskey,
        };
        jQuery.post(ajaxurl, fdata, function(response) {
            response = response.substring(0, response.length - 1);
            var json = JSON.parse(response);
            if (json['success'] === "0")
            {
                $('#webshopaccess-form .messages').html("<p class='text-danger'>Error: Invalid access key</p>");
                $('#webshopaccess-form').trigger('reset');
            }
            else {
                $('#webshopaccess-form').trigger('reset');
                $('#webshopaccess button.close').click();
                $('.order-page-new').show();

            }
        });

    });

    $('#contact-form').on('submit',function (e) {
        e.preventDefault();

        $('#contact-form .messages').html("");
        var from = $("#form_email").val();
        var msg = $("#form_message").val();

        var target = $('.navigation .tab-content:last .tab-pane ul li.active a:first');
        target = location.protocol+'//'+ location.host + location.pathname +target.attr('href');

        var fdata = {
            action: "partner_app_contact",
            from_email: from,
            from_message: msg,
            url: target
        };

        jQuery.post(ajaxurl, fdata, function(response) {
            response = response.substring(0, response.length - 1);
            $('#contact-form .messages').html(response);
        });

    });

    $('.form-search').on('submit',function (e) {
        e.preventDefault();
        if ($(this).find('input').first().val() !== "")
        {
            $.LoadingOverlay("show");
            var data = {
                action: "earticle_search",
                qry: $(this).find('input').first().val()
            };

            jQuery.post(ajaxurl, data, function(response) {
                $.LoadingOverlay("hide");
                response = response.substring(0, response.length - 1);
                var searchContainer = $('.easearch > .container > .col-lg-12:last');
                searchContainer.html(response);
                $('.easearch').show();
            });

        }
        else
        {
            alert("Search query is empty ! ");
        }
    });

    $(".cart").on('click',function (e) {
        e.preventDefault();
        $('#webshopaccess-form').trigger('reset');
        $('#webshopaccess-form .messages').html("");
        $('#webshopaccess').modal('show');
    });


    $('.btn-remove-search').on('click',function (e) {
        e.preventDefault();
        $('.easearch').hide();
        $('.easearch > .container > .col-lg-12:last').html("");
    });

    $('.btn-remove-order').on('click',function (e) {
        e.preventDefault();
        $('.order-page').hide();
        //$('.order-items').html("");
        $('.order-form').trigger('reset');

    });


    $('.share-box-copy').on('click',function (e) {
        var textInput = $("#share-box-link");
        var textInputJ = document.getElementById("share-box-link");

        textInput.focus();
        textInputJ.setSelectionRange(0,textInput.val().length);
        document.execCommand("copy");


        $(this).html("Copied!");
        setTimeout(function () {
            $('.share-box-copy').html("Copy");
        },3000);

    });

    $("#share-buttons a").on('click',function (e) {

        var target = $('.navigation .tab-content:last .tab-pane ul li.active a:first');
        var title = target.find('p').html();

        target = location.protocol+'//'+ location.host + location.pathname +target.attr('href');



        switch ($(this).attr('class'))
        {
            case 'social-email':
                $(this).attr('href','mailto:?Subject='+title+'&Body=' + escape('Have a look at this url '+ target));
                break;
            case 'social-fb':
                $(this).attr('href','http://www.facebook.com/sharer.php?u=' + escape(target));
                break;
            case 'social-g':
                $(this).attr('href','https://plus.google.com/share?url=' + escape(target));
                break;
            case 'social-li':
                $(this).attr('href','http://www.linkedin.com/shareArticle?mini=true&amp;url=' + escape(target));
                break;
            case 'social-reddit':
                $(this).attr('href','http://reddit.com/submit?url=' + escape(target) + '&amp;title=' + escape(title));
                break;
            case 'social-twitter':
                $(this).attr('href','https://twitter.com/share?url=' + escape(target) + '&amp;text=' + escape(title) + '&amp;hashtags=simplesharebuttons');
                break;
            case 'social-vk':
                $(this).attr('href','http://vkontakte.ru/share.php?url=' + escape(target));
                break;

        }
    });

    $("#action-ebook a").mousedown(function () {
        $(this).css('cssText','color: #2099d3 !important;');
    });
    $("#action-ebook a").mouseup(function () {
        $(this).css('cssText','color: inherit;');
    });

    $(document).on('click','.media_area .nav-tabs li a',function (e) {

        if ($(this).parent().attr('data-durl') !== '#' && validate_url($(this).parent().attr('data-durl')) )
        {
            $("#action-ebook a[data-target$='#source']").parent().css('display','block');
            //$("#" + $(this).attr('href').replace('#atab','grid')).mediaBoxes( 'refresh' );
            //$("#" + $(this).attr('href').replace('#atab','grid')).mediaBoxes( 'resize' );
        }
        else
        {
            $("#action-ebook a[data-target$='#source']").parent().css('display','none');
        }

        if ($(this).parent().attr('data-dpage') !== '#' && validate_url($(this).parent().attr('data-dpage')) )
        {
            $("#action-ebook a[data-target$='#preview']").parent().css('display','block');
        }
        else
        {
            $("#action-ebook a[data-target$='#preview']").parent().css('display','none');
        }

        var mediaGrid = $("#" + $(this).attr('href').replace('#atab','grid'));
        if (mediaGrid.length)
        {
            setTimeout(function(){ window.dispatchEvent(new Event('resize')); }, 200);


        }

    });

    $(".navigation img").each(function (key,item) {
        if(!$(item).attr('src'))
        {
            $(item).attr('src',$('meta[name=broken_img]').attr("content"));
        }
    });

    $("#cart-samples table tbody tr td input[type=number]").on('keyup',function (e) {
        var tVal =   parseFloat($(this).val()).toFixed(2);
        var total = 0.00;
        tVal = isNaN(tVal)?parseFloat("0").toFixed(2):tVal;
        $(this).parent().siblings("td:nth-child(9)").text(parseFloat((parseFloat($(this).parent().siblings("td:nth-child(4)").text()) * tVal)).toFixed(2));

        $("#cart-samples table tbody tr td:nth-child(9)").each(function (key,item) {
            total = parseFloat(parseFloat(total) + parseFloat($(item).text())).toFixed(2);
        });
        $("#cart-samples footer .cart-amount").text(total);
    });

    $("#cart-products table tbody tr td input[type=number]").on('keyup',function (e) {
        var tVal =   parseFloat($(this).val()).toFixed(2);
        var total = 0.00;
        tVal = isNaN(tVal)?parseFloat("0").toFixed(2):tVal;
        $(this).parent().siblings("td:nth-child(8)").text(parseFloat((parseFloat($(this).parent().siblings("td:nth-child(4)").text()) * tVal)).toFixed(2));

        $("#cart-products table tbody tr td:nth-child(8)").each(function (key,item) {
            total = parseFloat(parseFloat(total) + parseFloat($(item).text())).toFixed(2);
        });
        $("#cart-products footer .cart-amount").text(total);
        total = 0.00;

        $("#cart-products table tbody tr td input[type=number]").each(function (key,item) {
            total = parseFloat(parseFloat(total) + parseFloat($(item).val())).toFixed(2);
        });

        $("#cart-products footer .cart-amount-pellets").text(total);
    });

    function get_product_by_slug(slug) {
        $.each(prodList,function (key,item) {
            if (slug===item['slug'])
            {
                return item;
            }
        });
    }
    $("#shipping-address").select2({
        placeholder: "Select a delivery address",
        dropdownParent: $('.order-page #cart-shipping'),
        width: '100%'
    });
    $('[data-toggle="tooltip"]').tooltip();

    $("#cart-products button[href='#cart-shipping'], .order-page ul.nav-pills li a[href='#cart-shipping']").on('click',function (e) {
        $(".shippingotal-costsamples li div:nth-child(2) strong span").text($("#cart-samples .cart-amount").text());
        $(".shippingotal-products li div:nth-child(2) strong span").text( $("#cart-products .cart-amount").text());
    });

    $("#cart-shipping button[type='submit']").on('click',function (e) {

    });

    $('#shipping-address').on('select2:select', function (e) {
        var data = e.params.data;
        var contactList = {
            'Eeklo' : {
                'company': 'Easyscreen Bvba',
                'firstName': 'Avi',
                'lastName': 'Duanis',
                'email': 'belgium@easycubes.com',
                'phone': '0032 3 808 62 66',
                'caddr': 'Korte Moeie 12',
                'city': 'Eeklo',
                'postcode': '9900',
                'country': 'Belgium',
            },
            'Schelle' : {
                'company': 'Van der wal',
                'firstName': 'Avi',
                'lastName': 'Duanis',
                'email': 'belgium@easycubes.com',
                'phone': '0032 3 808 62 66',
                'caddr': 'Brandekensweg 92',
                'city': 'Schelle',
                'postcode': '2627',
                'country': 'Belgium',
            },
            'Copenhagen' : {
                'company': 'Sodeman Udstillingssystemer',
                'firstName': 'Kristian',
                'lastName': 'Egense',
                'email': 'denmark@easycubes.com',
                'phone': '0045 7020 5060',
                'caddr': 'Meterbuen 18',
                'city': 'Copenhagen',
                'postcode': 'DK-2740',
                'country': 'Denmark',
            },
            'Risskov' : {
                'company': 'Sodeman Udstillingssystemer',
                'firstName': 'Kristian',
                'lastName': 'Egense',
                'email': 'denmark@easycubes.com',
                'phone': '0045 7020 5060',
                'caddr': 'Sindalsvej 49',
                'city': 'Risskov',
                'postcode': 'DK-8240',
                'country': 'Denmark',
            },
            'Aachen' : {
                'company': 'Printunddisplay',
                'firstName': 'Nikolaus',
                'lastName': 'Küch',
                'email': 'germany@easycubes.com',
                'phone': '0049 170 78254 69',
                'caddr': 'Grüner Weg 37',
                'city': 'Aachen',
                'postcode': '52070',
                'country': 'Germany',
            },
            'Aachen pnd' : {
                'company': 'Printunddisplay',
                'firstName': 'Nikolaus',
                'lastName': 'Küch',
                'email': 'germany@easycubes.com',
                'phone': '0049 241 559 23 11',
                'caddr': 'Im Erdbeerfeld 20b',
                'city': 'Aachen',
                'postcode': '52078',
                'country': 'Germany',
            },
            'Amsterdam' : {
                'company': 'YPOS',
                'firstName': 'Camiel',
                'lastName': 'Dekker',
                'email': 'netherlands@easycubes.com',
                'phone': '0031 20 410 61 44',
                'caddr': 'Maroastraat 8',
                'city': 'Amsterdam',
                'postcode': '1060',
                'country': 'Norway',
            },
            'Bergen' : {
                'company': 'Expoline',
                'firstName': 'Gian Carlo',
                'lastName': 'Buoso',
                'email': 'norway@easycubes.com',
                'phone': '0047 920 31 443',
                'caddr': 'Kanalveien 105 B',
                'city': 'Bergen',
                'postcode': '5068',
                'country': 'Norway',
            },
            'Oslo' : {
                'company': 'Expoline',
                'firstName': 'Gian Carlo',
                'lastName': 'Buoso',
                'email': 'norway@easycubes.com',
                'phone': '0047 920 31 443',
                'caddr': 'Wismargata 4',
                'city': 'Oslo',
                'postcode': '0191',
                'country': 'Norway',
            },
            'Trondheim' : {
                'company': 'Expoline',
                'firstName': 'Gian Carlo',
                'lastName': 'Buoso',
                'email': 'norway@easycubes.com',
                'phone': '0047 920 31 443',
                'caddr': 'Ferjemannsveien 10',
                'city': 'Trondheim',
                'postcode': '7014',
                'country': 'Norway',
            },
            'Poznan' :{
                'company': 'Drukpoznan',
                'firstName': 'Łukasz',
                'lastName': 'Chęciński',
                'email': 'poland@easycubes.com',
                'phone': '0048 513 180 099',
                'caddr': 'Winogrady 28',
                'city': 'Poznan',
                'postcode': '61-663',
                'country': 'Poland',
            },
            'Madrid' : {
                'company': 'Innovacionplv',
                'firstName': 'Eduardo',
                'lastName': 'Ezama',
                'email': 'spain@easycubes.com',
                'phone': '0034 916 300 503',
                'caddr': 'C/Perú 4',
                'city': 'Madrid',
                'postcode': '28290',
                'country': 'Spain',
            },
        };

        var contact = contactList[data.text];
        $("#cart-shipping .deliveryinfo #shipping-cust-company").val(contact.company);
        $("#cart-shipping .deliveryinfo input[name='shipping-fname']").val(contact.firstName);
        $("#cart-shipping .deliveryinfo input[name='shipping-lname']").val(contact.lastName);
        $("#cart-shipping .deliveryinfo input[name='shipping-email']").val(contact.email);
        $("#cart-shipping .deliveryinfo input[name='shipping-phone']").val(contact.phone);
        $("#cart-shipping .deliveryinfo textarea[name='shipping-cust-addr']").val(contact.caddr);
        $("#cart-shipping .deliveryinfo input[name='shipping-cust-city']").val(contact.city);
        $("#cart-shipping .deliveryinfo input[name='shipping-cust-pc']").val(contact.postcode);
        $("#cart-shipping .deliveryinfo input[name='shipping-cust-country']").val(contact.country);

    });

})( jQuery );


function validate_url(url) {
    var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

    if (url)
    {
        if (pattern.test(url)) {
            return true;
        }
    }
    return false;
}

