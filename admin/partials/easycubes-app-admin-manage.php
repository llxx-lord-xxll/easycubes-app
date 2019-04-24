<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.facebook.com/llxx.lord.xxll
 * @since      1.0.0
 *
 * @package    Easycubes_App
 * @subpackage Easycubes_App/admin/partials
 */


$partnerapp_backup_nonce = wp_create_nonce( 'eapartnerapp_backup_nonce' );
$partnerapp_reset_nonce = wp_create_nonce( 'eapartnerapp_reset_nonce' );
$partnerapp_restore_nonce = wp_create_nonce( 'eapartnerapp_restore_nonce' );
$partnerapp_accesskeys_nonce = wp_create_nonce( 'eapartnerapp_accesskeys_nonce' );
?>

<h2 class="text-danger">Access key, Backup, Restore & Reset</h2>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="bootstrap-wrapper">

    <div class="panel panel-default">
        <div class="panel-heading">Access keys</div>
        <div class="panel-body">
            <form id="access_key_form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                <input type="hidden" name="action" value="eapartner_app_accesskey">

                <table class="table accesskey-table">
                    <tbody>
                    <?php
                    $keys = get_option('easycubes_app_accesskeys');
                    $keysType = get_option('easycubes_app_accesskeysType');
                    if (!empty($keys))
                    {
                        $keys = json_decode($keys);
                        if (!empty($keysType)) {
                            $keysType = json_decode($keysType);
                        }


                        if (!empty($keys)) {
                            foreach ($keys as $index => $key) {
                                ?>

                                <tr>
                                    <td><?php echo $key; ?></td>
                                    <td>
                                        <select name="akeysType[]">
                                            <?php
                                            if ($keysType[$index] == "access")
                                            {
                                                ?>
                                                <option value="access" selected>Access</option>
                                                <option value="webshop">Webshop</option>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <option value="webshop" selected>Webshop</option>
                                                <option value="access">Access</option>
                                                <?php
                                            }
                                            ?>


                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger eaapp-accesskey-del" type="button"><i
                                                    class="glyphicon glyphicon-folder-close"> </i></button>
                                    </td>
                                    <td><input type="hidden" name="akeys[]" value="<?php echo $key; ?>"/></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                    ?>
                    </tbody>
                </table>



                <input type="hidden" name="eapartnerapp_accesskey_nonce" value="<?php echo $partnerapp_accesskeys_nonce ?>" />
                <button class="btn btn-primary" type="button" id="partner_app_add_access_key">Add keys</button>
                <button class="btn btn-primary" type="submit" name="partner_app_accesskey_save">Save keys</button>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Backup</div>
        <div class="panel-body">
            <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                <input type="hidden" name="action" value="eapartner_app_backup">
                <input type="hidden" name="eapartnerapp_backup_nonce" value="<?php echo $partnerapp_backup_nonce ?>" />
                <button class="btn btn-primary" type="submit" name="partner_app_backup_submit">Create backup and download</button>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Restore</div>
        <div class="panel-body">
            <form id="easycubes_app_restore_form" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                <input type="hidden" name="action" value="eapartner_app_restore">
                <input type="hidden" name="eapartnerapp_restore_nonce" value="<?php echo $partnerapp_restore_nonce ?>" />
                <input class="form-control" name="eapartnerapp_restore_file" type="file" accept="application/zip" />
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Reset</div>
        <div class="panel-body">
            <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                <input type="hidden" name="action" value="eapartner_app_reset">
                <input type="hidden" name="eapartnerapp_reset_nonce" value="<?php echo $partnerapp_reset_nonce ?>" />
                <button class="btn btn-danger" type="submit">Reset Partner App Data</button>
            </form>
        </div>
    </div>
</div>


<script src="<?php echo EASYCUBES_APP_PLUGIN_URL; ?>/public/js/vendor/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).on('change','#easycubes_app_restore_form input[name=eapartnerapp_restore_file]',function () {

        if ($(this).val())
        {
            $(this).parent().submit();
        }
    });

    $(document).ready(function () {
        $(document).on('click','.eaapp-accesskey-del',function (e) {
            $(this).parent().parent().remove();
        }) ;

        $("#partner_app_add_access_key").on('click',function (e) {
            var acKey = prompt("New ccesskey (4 - 30 characters) ");
            if (acKey ===null || acKey === "")
            {
                alert("Canceled");
            }
            else
            {
                if (acKey.length>3 && acKey.length < 30)
                {
                    $(".accesskey-table tbody").append('<tr><td>'+acKey+'</td>                                         <td>\n' +
                        '                                            <select name="akeysType[]">\n' +
                        '                                                <option value="access">Access</option>\n' +
                        '                                                <option value="webshop">Webshop</option>\n' +
                        '                                            </select>\n' +
                        '                                        </td> <td><button class="btn btn-danger eaapp-accesskey-del" type="button"> <i class="glyphicon glyphicon-folder-close"> </i> </button> </td><td><input type="hidden" name="akeys[]" value="'+acKey+'"/></td></tr>');
                }
                else
                {
                    alert("Invalid key");
                }

            }
        });
    });

</script>