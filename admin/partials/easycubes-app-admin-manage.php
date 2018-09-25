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
?>

<h2 class="text-danger"> Backup, Restore & Reset</h2>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="bootstrap-wrapper">
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