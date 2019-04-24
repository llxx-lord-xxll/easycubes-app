<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.facebook.com/llxx.lord.xxll
 * @since      1.0.0
 *
 * @package    Easycubes_App
 * @subpackage Easycubes_App/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Easycubes_App
 * @subpackage Easycubes_App/public
 * @author     Arifuzzaman Pranto <zamanpranto@gmail.com>
 */
class Easycubes_App_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }


    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Easycubes_App_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Easycubes_App_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/easycubes-app-public.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Easycubes_App_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Easycubes_App_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/easycubes-app-public.js', array( 'jquery' ), $this->version, false );

    }

    public function define_page_template($page_template)
    {
        $post = get_post();
        $app_page_id = get_option("easycubes_app_page");
        if (!empty($app_page_id))
        {
            if ($app_page_id == $post->ID)
            {
                $new_page_template = EASYCUBES_APP_PLUGIN_DIR . "/public/partials/easycubes-app-public-display.php";
                if(!empty($new_page_template))
                    return $new_page_template;
            }
        }

        return $page_template;
    }

    public function easycubes_app_partner_generate()
    {
        ?>

        <script type="text/javascript">
            var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
        </script>

        <?php
    }

    public function get_notice_buy(){

        return array('id'=>'02',
            'title' => 'Buy Notice',
            'type' => 'pdf',
            'dpage' => 'https://easycubes-s3.s3.eu-west-3.amazonaws.com/Product/Notice%20BUY.pdf',
            'durl'=> '#',
            'content'=> 'https://easycubes-s3.s3.eu-west-3.amazonaws.com/Product/Notice%20BUY.pdf');
    }

    public function get_notice_nobuy(){

        return array('id'=>'02',
            'title' => 'No Buy Notice',
            'type' => 'pdf',
            'dpage' => 'https://easycubes-s3.s3.eu-west-3.amazonaws.com/Product/Notice%20NOBUY.pdf',
            'durl'=> '#',
            'content'=> 'https://easycubes-s3.s3.eu-west-3.amazonaws.com/Product/Notice%20NOBUY.pdf');
    }


    public function get_eaproducts()
    {
        if (!$this->partner_app_verify_accesskey())
        {
            $response = array('success'=>'0');
            echo json_encode($response);
            return;
        }
        $eaproducts = get_terms(array(
            'taxonomy' => 'eaproducts',
            'hide_empty' => false,
            'orderby' => 'order',
            'order' => 'ASC',
            'parent' => 0
        ));

        if (!empty($eaproducts))
        {
            $eaproduct = (array)$eaproducts;
            foreach ($eaproducts as $k => $eaproduct) {
                $t_id = $eaproduct->term_id;
                $product_price = get_option( "eaproducts_taxonomy_$t_id" . "_price");
                $product_itempack = get_option( "eaproducts_taxonomy_$t_id" . "_itempack");
                $product_size = get_option( "eaproducts_taxonomy_$t_id" . "_size");
                $product_weight = get_option( "eaproducts_taxonomy_$t_id" . "_weight");
                $product_url = get_option( "eaproducts_taxonomy_$t_id" . "_url");

                $tmpeaproduct = (array)$eaproduct;
                $tmpeaproduct['price'] = $product_price;
                $tmpeaproduct['itempack'] = $product_itempack;
                $tmpeaproduct['size'] = $product_size;
                $tmpeaproduct['weight'] = $product_weight;
                $tmpeaproduct['url'] = $product_url;
                $eaproducts[$k] = $tmpeaproduct;


            }
            echo json_encode($eaproducts);
        }
        else
        {
            echo json_encode(array());
        }
    }

    public function get_eaaddresses()
    {
        if (!$this->partner_app_verify_accesskey())
        {
            $response = array('success'=>'0');
            echo json_encode($response);
            return;
        }

        $eaaddresses = get_terms(array(
            'taxonomy' => 'eaaddresses',
            'hide_empty' => false,
            'orderby' => 'order',
            'order' => 'ASC',
            'parent' => 0
        ));

        if (!empty($eaaddresses))
        {
            $eaaddresses = (array)$eaaddresses;

            foreach ($eaaddresses as $k => $eaaddress) {
                $t_id = $eaaddress->term_id;
                $term_meta_locs = get_option( "eaaddress_taxonomy_$t_id" . "_locs");
                $term_meta_locs = urldecode($term_meta_locs);

                $tmpaddr = (array)$eaaddress;
                $tmpaddr['locs'] = $term_meta_locs;

                $eaaddresses[$k] = $tmpaddr;
            }
            echo json_encode($eaaddresses);
        }
        else
        {
            echo json_encode(array());
        }


    }
    public function get_eaarticle()
    {
        if (!$this->partner_app_verify_accesskey())
        {
            $response = array('success'=>'0');
            echo json_encode($response);
            return;
        }

        if (isset($_POST['url']))
        {
            $post_id = str_replace('#post_',"",$_POST['url']);
            $post = get_post( $post_id );

            if (!empty($post))
            {

                $thumbnail = get_the_post_thumbnail_url($post,'thumbnail');
                $post = (array)$post;
                $subtitle =  get_post_meta( $post_id, 'eaarticles_subtitle', true ) ;
                $tabcount = intval( get_post_meta( $post_id, 'eaarticles_tabcount', true ) );
                $post['subtitle'] = $subtitle;
                $post['tabcount'] = $tabcount;
                $post['thumbnail'] = $thumbnail;
                $post['product_type'] =  get_post_meta( $post_id, 'eaarticles_product_type', true );
                $post['post_modified'] = date("d-M-Y", strtotime($post['post_modified']));
                $product_type =  get_post_meta( $post_id, 'eaarticles_product_type', true ) ;
                $product_type_buyable =  get_post_meta( $post_id, 'eaarticles_product_type_buyable', true ) ;

                $notice = 0;
                if ($product_type=="physical")
                {
                    if ( $product_type_buyable != 'no')
                    {
                        $notice = 1;
                    }
                    else{
                        $notice = 2;
                    }

                }

                $tabs = array();

                for ($i=1;$i<=$tabcount; $i++) {
                    $tab_title = get_post_meta( $post_id, 'eaarticles_tab'. $i . "_title", true );
                    $tab_state = get_post_meta( $post_id, 'eaarticles_tab'. $i . "_state", true );
                    $tab_type = get_post_meta( $post_id, 'eaarticles_tab'. $i . "_type", true );
                    $tab_down_page = get_post_meta( $post_id, 'eaarticles_tab'. $i . "_dpage", true );
                    $tab_down_url = get_post_meta( $post_id, 'eaarticles_tab'. $i . "_durl", true );
                    $tab_val = get_post_meta( $post_id, 'eaarticles_tab'. $i . "_val", true );
                    $tab_title = ucfirst(strtolower($tab_title));

                    if($tab_type== "pdf")
                    {
                        if(empty($tab_down_page) || $tab_down_page == "#")
                        {
                            if(!empty($tab_val))
                            {
                                $tab_down_page = $tab_val;
                            }
                        }
                    }


                    if ($tab_state=="on")
                    {
                        array_push($tabs,array(
                            'id'  => $i,
                            'title' => $tab_title,
                            'type' => $tab_type,
                            'dpage' => $tab_down_page,
                            'durl' => $tab_down_url,
                            'content' => $tab_val
                        ));
                    }

                    if ($i==1 && $notice == 1)
                    {
                        array_push($tabs,$this->get_notice_buy());
                    }
                    elseif ($i==1 && $notice == 2)
                    {
                        array_push($tabs,$this->get_notice_nobuy());
                    }
                }


                if ($product_type=="physical" && $notice == 2){
                    $post['product_type'] = "digital";
                }



                $post['tabs'] = $tabs;

                $post['success'] = '1';

                echo json_encode($post);
            }


        }

    }

    public function get_eagallery_contents()
    {
        if (isset($_POST['url']))
        {
            $term_slug = $_POST['url'];
            $term = get_term_by('slug', $term_slug, 'eagallery');
            $term_id = $term->term_id;
            $term_meta = get_option( "eagallery_taxonomy_$term_id" . "_media");
            $term_meta = json_decode($term_meta);
            echo json_encode($term_meta);
        }

    }
    private function limit_text($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    public function earticle_search()
    {
        if (isset($_POST['qry']))
        {

            $the_query = new WP_Query( array(
                'post_type' => 'eaarticles',
                'post_status' => 'publish',
                'posts_per_page' => -1
            ));


            if( $the_query->have_posts() ) {
                while( $the_query->have_posts() ){
                    $the_query->the_post();
                    $the_post = $the_query->post;
                    $subtitle =  get_post_meta( $the_post->ID, 'eaarticles_subtitle', true ) ;
                    $tags =  get_post_meta( $the_post->ID, 'eaarticles_tags', true ) ;
                    $tabcount =  intval(get_post_meta( $the_post->ID, 'eaarticles_tabcount', true ));
                    $searcher = false;
                    for ($i=1;$i<=$tabcount; $i++) {
                        $tab_title = get_post_meta( $the_post->ID, 'eaarticles_tab'. $i . "_title", true );
                        if (strpos($tab_title, $_POST['qry']) !== false)
                        {
                            $searcher = true;
                        }
                    }

                    if ((strpos(strtolower($the_post->post_title), strtolower($_POST['qry'])) !== false)  || (strpos(strtolower($subtitle), strtolower($_POST['qry'])) !== false) || ($this->tagchecker(strtolower($tags), strtolower($_POST['qry'])) !== false) || ($searcher != false)) {
                        $subtitle = $this->limit_text($subtitle,20);
                        $ea_folder = get_the_terms( $the_post->ID, 'eafolders' );
                        $navs = get_term_parents_list($ea_folder[0]->term_id,'eafolders',array('link'=>false));
                        $navs = str_replace("/", " -> ", $navs);
                        $navs = rtrim($navs," -> ");
                        ?>
                        <div class="search-item">
                            <h3 class="search-item-title"><a target="_blank" href="#post_<?php echo $the_post->ID ;?>"><?php echo $the_post->post_title; ?></a> </h3>
                            <span class="search-item-nav"> <?php echo $navs; ?></span>
                            <p class="search-item-desc"><?php echo $subtitle; ?></p>
                            <span class="search-item-tags">Tags: <span><?php echo $tags; ?></span></span>
                        </div>

                        <?php
                    }

                }
            }
        }
    }

    public function tagchecker($tags,$qry)
    {
        $temp = false;
        if (strpos($tags,",") !== false)
        {
            $tags = explode(",",$tags);
            foreach ($tags as $tag)
            {
                if (strpos($qry,$tag) !== false)
                {
                    $temp = true;
                }
            }
        }
        return $temp;

    }
    public function partner_app_verify_accesskey()
    {
        $response = false;
        $cookie_name = "eapartnerappaccess";
        $computerId = $_SERVER['HTTP_USER_AGENT'].$_SERVER['LOCAL_ADDR'].$_SERVER['LOCAL_PORT']. $this->get_client_ip();
        $seskey = md5($computerId);

        if(isset($_COOKIE[$cookie_name])) {
            if ($_COOKIE[$cookie_name] == $seskey)
            {
                $response = true;
            }
        }

        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if (user_can( $current_user, 'administrator' )) {
                $response = true;
            }
        }

        return $response;
    }

    public function partner_app_webaccesskey_auth()
    {

        $response = array('success'=> '0');
        $cookie_name = "eawebshopaccess";
        $accesskey = $_POST['passphrase'];
        $computerId = $_SERVER['HTTP_USER_AGENT'].$_SERVER['LOCAL_ADDR'].$_SERVER['LOCAL_PORT']. $this->get_client_ip();
        $seskey = md5($computerId);
        if ($accesskey)
        {
            $allowed_keys = get_option('easycubes_app_accesskeys');
            $allowed_keys_type = get_option('easycubes_app_accesskeysType');


            if ($allowed_keys)
            {
                $allowed_keys = json_decode($allowed_keys);
            }
            if ($allowed_keys_type)
            {
                $allowed_keys_type = json_decode($allowed_keys_type);
                foreach ($allowed_keys as $alkey => $alkeyal)
                {
                    if($allowed_keys_type[$alkey] != 'webshop')
                    {
                        unset($allowed_keys[$alkey]);
                        unset($allowed_keys_type[$alkey]);
                    }
                }
            }



            if (in_array($accesskey,$allowed_keys))
            {
                setcookie($cookie_name, $seskey, time() + (86400 * 30), "/"); // 86400 = 1 day
                $response['success'] = '1';
            }
        }

        echo json_encode($response);
    }


    public function partner_app_accesskey_auth()
    {
        $response = array('success'=> '0');
        $cookie_name = "eapartnerappaccess";
        $accesskey = $_POST['passphrase'];
        $computerId = $_SERVER['HTTP_USER_AGENT'].$_SERVER['LOCAL_ADDR'].$_SERVER['LOCAL_PORT']. $this->get_client_ip();
        $seskey = md5($computerId);
        if ($accesskey)
        {
            $allowed_keys = get_option('easycubes_app_accesskeys');
            $allowed_keys_type = get_option('easycubes_app_accesskeysType');

            if ($allowed_keys)
            {
                $allowed_keys = json_decode($allowed_keys);
            }
            if ($allowed_keys_type)
            {
                $allowed_keys_type = json_decode($allowed_keys_type);
                foreach ($allowed_keys as $alkey => $alkeyal)
                {
                    if($allowed_keys_type[$alkey] != 'access')
                    {
                        unset($allowed_keys[$alkey]);
                        unset($allowed_keys_type[$alkey]);
                    }
                }
            }


            if (in_array($accesskey,$allowed_keys))
            {
                setcookie($cookie_name, $seskey, time() + (86400 * 30), "/"); // 86400 = 1 day
                $response['success'] = '1';
            }
        }

        echo json_encode($response);
    }

    public function partner_app_contact()
    {
        if (isset($_POST['from_email']) && isset($_POST['from_message']) && isset($_POST['url']))
        {
            $user_ip = $this->get_client_ip();

            $headers[] = 'Content-Type: text/html; charset=UTF-8' ;
            $headers[] = 'From: '.$_POST['from_email'] . "\r\n";
            $headers[] = 'Reply-To: ' .$_POST['from_email'] . "\r\n";


            $message = '<p>Page URL : <a href="' . $_POST['url'] .'"> '.$_POST['url'].' </a>' . "</p>";
            $message .= '<p>IP Address: ' . $user_ip . "</p>";
            $message .= '<p>E-Mail : <a href="mailto:' . $_POST['from_email'] .'"> '.$_POST['from_email'].' </a>' . "</p>";
            $message .= '<p>Message: <blockquote>' . nl2br($_POST['from_message']) . "</blockquote> </p>";
            $message .= '<p></p>';
            $message .= '<p></p>';
            $message .= '<p>Sent from Partner App System</p>' . "\r\n";

            $email = wp_mail( "support@easy-build.eu", "Partner app contact", $message, $headers);
            // $email = wp_mail( "zamanpranto@gmail.com", "Partner app contact", $message , $headers);
            if ($email)
            {
                echo '<p class="text-success">Success: The question has been submitted</p>';
            }
            else
            {
                echo '<p class="text-danger">Error: There is a problem in submitting the data</p>';
            }


            /*
             *  Need to attach mailer
             *
             *
             */

        }
        else
        {
            echo '<p class="text-danger">Error: The submitted data has some problem, please try again</p>';
        }
    }

    public function ea_partner_product($atts)
    {
        if(!is_array($atts))
            return false;
        if (!array_key_exists('ids',$atts))
            return false;

        $ids = explode(',',$atts['ids']);

        foreach ($ids as $id)
        {
            $term = get_term_by('id', $id, 'eaproducts');

            if ($term)
            {
                $t_id = $term->term_id;
                $product_price = get_option( "eaproducts_taxonomy_$t_id" . "_price");
                $product_itempack = get_option( "eaproducts_taxonomy_$t_id" . "_itempack");
                $product_size = get_option( "eaproducts_taxonomy_$t_id" . "_size");
                $product_weight = get_option( "eaproducts_taxonomy_$t_id" . "_weight");
                $product_url = get_option( "eaproducts_taxonomy_$t_id" . "_url");


                ?>
                <tr class="well">
                    <td></td>
                    <td><strong><?php echo strtoupper($term->name); ?></strong> </td>
                    <td> <a target="_blank" class="text-primary" href="<?php echo $product_url; ?>"><strong><span class="glyphicon glyphicon-link"></span></strong></a> </td>
                    <td><?php echo $product_price; ?></td>
                    <td><?php echo $product_itempack; ?></td>
                    <td><?php echo $product_size; ?></td>
                    <td><?php echo $product_weight; ?></td>
                    <td><input class="form-control" type="number" min="0" max="9999" value="0" name="amount[<?php echo $term->slug;?>]"/></td>
                    <td>0.00</td>
                </tr>
                <?php
            }
        }

    }


    private function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }


}
