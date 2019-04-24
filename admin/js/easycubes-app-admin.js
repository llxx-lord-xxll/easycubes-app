var countries = ["Gallery","Video","Technical Info","Instructions","Drawings","Purchase Info","General Info","Commercial Info"];
(function( $ ) {
    'use strict';
    var html;

    var locTable;


    /**
     * All of the code for your admin-facing JavaScript source
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

    $(document).ready(function () {


        /* user clicks button on custom field, runs below code that opens new window */
        if($( "#eagallery_image_paths" ).length > 0)
        {
            $( "#eagallery_image_paths" ).sortable();
            $( "#eagallery_image_paths" ).disableSelection();
        }


        jQuery('#eafolder_upload_image').click(function() {

            var eafolder_image = wp.media(
                {
                    title : 'Upload Featured Image',
                    multiple: false
                }
            ).open().on('select',function () {
                var eafolder_image_obj = eafolder_image.state().get('selection').first().toJSON();
                $('#eafolder_show_upload_preview').html("<img height='100' src='" + eafolder_image_obj.url + "' />");
                $('#eafolder_image_path').val(eafolder_image_obj.url);
            }).on('close',function () {

            });
            return false;
        });

        jQuery('.ea_articles_tab_content_upload_getUrl').on('click',function () {
            var win_Title = $(this).parent().parent().find('label').html();
            var textElem = $(this).parent().find('input');
            var eafolder_image = wp.media(
                {
                    title : win_Title,
                    multiple: false
                }
            ).open().on('select',function () {
                var eafolder_image_obj = eafolder_image.state().get('selection').first().toJSON();
                textElem.val(eafolder_image_obj.url);
            }).on('close',function () {

            });

        });


        jQuery('#eagallery_upload_image').click(function() {

            var eagallery_media = wp.media(
                {
                    title : 'Add media',
                    multiple: true
                }
            ).open().on('select',function () {
                var eagallery_medias = eagallery_media.state().get('selection').toJSON();

                var mediahtml = "";
                $(eagallery_medias).each(function (key,item) {
                    mediahtml += '<div class="form-group"> <input type="text" class="form-control" name="eagallery_media[]" value="'+item.url+'"/> <span class="dashicons dashicons-trash eagallery-media-close"></span> </div>';
                });
                $("#eagallery_image_paths").append(mediahtml);
                //$('#eafolder_show_upload_preview').html("<img height='100' src='" + eafolder_image_obj.url + "' />");
                //$('#eafolder_image_path').val(eafolder_image_obj.url);
            }).on('close',function () {

            });
            return false;
        });

        if($.contextMenu){
            $.contextMenu({
                selector: '#eagallery_image_paths .form-group',
                callback: function(key, options) {
                    switch (key)
                    {
                        case 'copypreview':
                            prompt("URL of the preview image",options.$trigger.find('img').attr('src'));
                            break;
                        case 'copyentry':
                            prompt("URL of the entry",options.$trigger.find('input').val());
                            break;
                        case 'delete':
                            options.$trigger.remove();
                            break;
                    }
                },
                items: {
                    "copypreview": {name: "Copy preview url", icon: "copy"},
                    "copyentry": {name: "Copy entry url", icon: "copy"},
                    "delete": {name: "Delete", icon: "delete"},
                }
            });
        }

        jQuery('#eagallery_add_url').click(function() {
            var input_url = prompt("Input media url");
            if (input_url ==null || input_url === "")
            {

            }
            else
            {
                if (input_url.toLowerCase().indexOf("https://www.youtube.com/embed/") >= 0)
                {
                    var ytID = input_url.split("https://www.youtube.com/embed/")[1];
                    var ytthumb = "http://img.youtube.com/vi/"+ytID+"/0.jpg";

                    $("#eagallery_image_paths").append('<div class="form-group"> <input type="hidden" class="form-control" name="eagallery_media[]" value="'+input_url+'"/>' + '<div class="">\n' +
                        '                                                <span class="dashicons dashicons-trash eagallery-media-close"></span>\n' +
                        '                                                <div class="thumbnail-overlay-vid">\n' +
                        '                                                    <i class="dashicons dashicons-video-alt3"></i>\n' +
                        '                                                </div>' + '<img height="200px" width="200px" src="'+ytthumb+'" />' +
                        '</div></div>')
                }
                else {
                    $("#eagallery_image_paths").append('<div class="form-group"> <input type="hidden" class="form-control" name="eagallery_media[]" value="'+input_url+'"/> <div class="">\n' +
                        '                                                <span class="dashicons dashicons-trash eagallery-media-close"></span>' +
                        '<img height="200px" width="200px" src="'+input_url+'" />' +
                        '</div></div>')
                }

            }
        });

        jQuery(document).on('click','.eagallery-media-close',function() {
            $(this).parent().parent().remove();
        });

        jQuery('.ea_articles_tab_type').on('change',function () {
            var input = $(this).attr('id').replace('type','val');


            if ($(this).val()=== "pdf")
            {
                var input_preview = $(this).attr('id').replace('type','preview');
                var btnUpload = $(this).attr('id').replace('type','upload');
                html = '<button type="button" class="btn btn-primary ea_articles_tab_content_upload" id="' + btnUpload + '">Upload PDF</button>' +
                    '<button type="button" class="btn btn-primary ea_articles_tab_content_url" id="eaarticles_tab2_url">Insert URL</button>' +
                    '<div id="'+input_preview+'" style="padding: 20px;display: none;">' +
                    '<span style="font-size: 50px" class="dashicons dashicons-book"></span>' +
                    '<a target="_blank" href="#" style="padding-top:28px; display:block; "></a>' +
                    '</div>' +
                    '<input class="ea_articles_tab_content" id="'+input+'" name="'+input+'" type="hidden" value="">';
                $("#"+input).parent().html(html);
                console.log(html);
            }
            else if ($(this).val()=== "urlembed")
            {
                html = '<input class="ea_articles_tab_content form-control" id="'+input+'" name="'+input+'" type="text" value="">';
                $("#"+input).parent().html(html);
            }
            else if ($(this).val()=== "gallery")
            {
                var data = {
                    action: "get_eagallery"
                };
                var gallery_options = "";
                $("#"+input).parent().hide();

                jQuery.post(ajaxurl, data, function(response) {
                    response = response.substring(0, response.length - 1);
                    var jsonarray = JSON.parse(response);
                    $(jsonarray).each(function (key,item) {
                        gallery_options += '<option value="'+item['id']+'">'+item['name']+'</option>';
                    });
                    html = '<select class="form-control ea_articles_tab_content" id="'+input+'" name="'+input+'">'+ gallery_options + '</select>';
                    $("#"+input).parent().html(html);
                    $("#"+input).parent().show();
                });


            }

            //$(input).parent.html();
        });

        jQuery(document).on('click','.ea_articles_tab_content_upload',function() {
            var input = $(this).attr('id').replace('upload','val');
            var input_preview = $("#"+ $(this).attr('id').replace('upload','preview'));
            var eafolder_pdf = wp.media(
                {
                    title : 'Upload PDF',
                    library: {
                        type: [ 'application/pdf' ]
                    },
                    multiple: false
                }
            ).open().on('select',function () {
                var eafolder_pdf_obj = eafolder_pdf.state().get('selection').first().toJSON();

                if (eafolder_pdf_obj.subtype === "pdf")
                {
                    input_preview.css('display','block');
                    input_preview.find('a').html(eafolder_pdf_obj.name);
                    input_preview.find('a').attr('href',eafolder_pdf_obj.url);
                    $('#'+ input).val(eafolder_pdf_obj.url);
                }
                else
                {
                    alert("Wrong file type selected");
                }

            });

        });

        jQuery(document).on('click','.ea_articles_tab_content_url',function() {
            var input = $(this).attr('id').replace('url','val');
            var input_preview = $("#"+ $(this).attr('id').replace('url','preview'));

            var input_url = prompt("Input pdf url");
            if (input_url ==null || input_url === "")
            {

            }
            else
            {
                var fname = input_url.substring(input_url.lastIndexOf('/')+1);
                input_preview.css('display','block');
                input_preview.find('a').html(fname);
                input_preview.find('a').attr('href',input_url);
                $('#'+ input).val(input_url);
            }


        });

        $('#loc-add-btn').on('click',function () {
           var addr,cost;
           addr = window.prompt("Enter address :");

           if (!(addr ==null || addr === ""))
           {
               cost = window.prompt("Enter cost :");
               cost = parseInt(cost);
               if (isNaN(cost)) cost =0;
               if (locTable)
               {
                   locTable.row.add([addr,cost]).draw(false);
               }

           }

           $("#eaaddresses-json").val(JSON.stringify(locTable.rows( { search: 'applied' } ).data().toArray()));
        });

        $('#loc-rmv-btn').on('click',function () {
            locTable
                .rows( '.selected' )
                .remove()
                .draw();

            $("#eaaddresses-json").val(JSON.stringify(locTable.rows( { search: 'applied' } ).data().toArray()));

        });

        if($(".tab-title-inputwrap > input").length)  $(".tab-title-inputwrap > input").typeahead({ source:countries,minLength: 0,showHintOnFocus: true });

        if($('.loc-table').length){
            setTimeout(function () {
                var data ;

                try {
                    data = JSON.parse($("#eaaddresses-json").val());
                    locTable = $('.loc-table').DataTable({
                        select: true,
                        data : data
                    });
                }
                catch (e) {
                    locTable = $('.loc-table').DataTable({
                        select: true,
                });
                }


            },500);
        }





    });



})( jQuery );

function fnGetSelected( oTableLocal )
{
    return oTableLocal.$('tr.selected');
}
