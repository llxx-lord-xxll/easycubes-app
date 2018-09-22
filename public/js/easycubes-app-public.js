(function( $ ) {
	'use strict';

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
            $('.tab-content:not(.' + link.attr('href').replace('#','') + ') .tab-pane').removeClass('active');

            // click first submenu tab for active section
            $('a[href="' + link.attr('href') + '_all"][data-toggle="tab"]').click();

            // activate tab-pane for active section
            $('.tab-content.' + link.attr('href').replace('#','') + ' .tab-pane:first').addClass('active');
        }

    });


    $(".eaarticles").on('click',function (e) {
        e.preventDefault();
        $.LoadingOverlay("show");
        var data = {
            action: "get_eaarticle",
			url: $(this).attr('href')
        };
        jQuery.post(ajaxurl, data, function(response) {
            response = response.substring(0, response.length - 1);
            var json = JSON.parse(response);

            $('.title_action_bar .title-logo img').attr('src',json['thumbnail']);
            $('.title_action_bar .title div:nth-child(2) h2').html(json['post_title']);
            $('.title_action_bar .title div:nth-child(2) p').html(json['subtitle']);
            $('.title_action_bar .title div:nth-child(2) .text-date').html(json['post_date']);

            var tabs = json['tabs'];
            var tab_menu_items = "";
            var tab_menu_contents = "";
			$.each(tabs,function (key,item) {
                tab_menu_items += '<li data-dpage="'+item['dpage']+'" data-durl="'+item['durl']+'" data-type="'+item['type']+'"><a data-toggle="tab" href="#tab_'+item['id']+'">'+item['title']+'</a></li>';
            });
            $.each(tabs,function (key,item) {

                if (item['type'] === "pdf")
				{
                    tab_menu_contents += '<div id="tab_'+item['id']+'" class="tab-pane fade">';
                    tab_menu_contents += '<iframe height="100" frameborder="0" src="https://docs.google.com/viewer?url='+item['content']+'&embedded=true"></iframe>';
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
                        tab_menu_contents += '<div id="tab_'+item['id']+'" class="tab-pane fade">';
                        tab_menu_contents += '<div id="grid_'+item['id']+'">';
                        $.each(response2,function (key,obj) {
                            var fname = obj.substring(obj.lastIndexOf('/')+1);
                            var domain = obj.replace('http://','').replace('https://','').split(/[/?#]/)[0];
                            tab_menu_contents += '<div class="media-box category1"> <div class="media-box-image">';
                            switch (domain)
                            {
                                case 'www.youtube.com':
                                   var ytID = obj.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/).pop();
                                    tab_menu_contents += '<div data-thumbnail="http://img.youtube.com/vi/'+ytID+'/0.jpg"></div>';
                                    break;
                                default:
                                    tab_menu_contents += '<div data-thumbnail="'+obj+'"></div>';
                                    break;
                            }
                            //console.log(domain);



                            tab_menu_contents += '<div class="thumbnail-overlay"> <i class="fa fa-plus mb-open-popup" data-src="'+obj+'"></i> </div>';
                            tab_menu_contents += '</div></div>';
                        });
                        tab_menu_contents += '</div>';
                        tab_menu_contents += '</div>';



                        $('.media_area .tab-content').html(tab_menu_contents);

                        setTimeout(
                            function()
                            {
                                var randX = $('#grid_' + item['id']).mediaBoxes({lazyLoad:false});
                                randX.refresh();
                                setTimeout(
                                    function()
                                    {
                                        $('#grid_' + item['id']).mediaBoxes().refresh();
                                    }, 1000);
                                //do something special
                            }, 2000);


                    });

				}


            });
			$('.media_area .nav-tabs').html(tab_menu_items);
			$('.media_area .tab-content').html(tab_menu_contents);
            $.LoadingOverlay("hide");

            $('.media_area .nav-tabs li:first a').click();


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
            case 'source':
                e.preventDefault();
                var target =  $('.media_area .nav-tabs li.active');
                if (target.length)
                {
                    window.open(target.attr('data-durl'),'_blank');
                }
                break;
        }
    });


    $(window).on('load',function () {

        setTimeout(function () {
            $(".loadingoverlayFake").remove();
        },2000);
        var query = window.location.href.substring(window.location.href.indexOf("#")+1);

        if (query!==window.location.href)
        {
           $('.navigation .tab-content:last .tab-pane ul li a').each(function (key,item) {
                var postid = $(item).attr('href').substring(1);
                if (query === postid)
                {
                    var tab3 = $(item).parent().parent().parent();
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

})( jQuery );
