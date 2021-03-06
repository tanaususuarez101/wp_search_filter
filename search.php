<?php
/**
 * Created by PhpStorm.
 * User: Tana-HP
 * Date: 12/12/2018
 * Time: 11:45
 */

$portal = "/architure";
require_once( $_SERVER['DOCUMENT_ROOT'].$portal.'/wp-config.php' );
require_once( $_SERVER['DOCUMENT_ROOT'].$portal.'/wp-includes/wp-db.php' );


/**
 * Petition JQuery from search.js
*/

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    /**
     * Structure SQL for after auto generate
    */

    $select = "select p.ID, p.post_content, post_title, p.guid, pm.meta_value";
    $from = "from wparch_posts p";
    $join = 'join wparch_postmeta pm on p.ID = pm.post_id';
    $where = 'where post_status="publish" and post_type="vetrina" and meta_key="_wpcf_belongs_azienda_id"';

    $society = $tagAndCategory = $country = array();
    if (isset($_POST['checkbox-company'])) {

        foreach ($_POST['checkbox-company'] as $key => $value) {
            $society[] = $key;
        }
        $list = implode(",", $society);
        $where .= " and meta_value IN ($list)";
    }
    if (isset($_POST['checkbox-tag']) || isset($_POST['checkbox-category'])) {

        $join .= " join wparch_term_relationships tr on p.ID = tr.object_id";
        $join .= " join wparch_term_taxonomy tt on tr.term_taxonomy_id = tt.term_taxonomy_id";
        $join .= " join wparch_terms t on tt.term_id = t.term_id";
        $where .= ' and taxonomy IN ("post_tag","category")';

        if (isset($_POST['checkbox-tag'])) {
            foreach ($_POST['checkbox-tag'] as $key => $value) {
                $tagAndCategory[] = $key;
            }
        }
        if (isset($_POST['checkbox-category'])) {
            foreach ($_POST['checkbox-category'] as $key => $value) {
                $tagAndCategory[] = $key;
            }
        }

        $list = implode(",", $tagAndCategory);
        $where .= " and t.term_id IN ($list)";
    }
    if (isset($_POST['checkbox-pease'])) {
        echo "Pease no implements";
    }

    $joinSQL = $select." ".$from." ".$join." ".$where;
    global $wpdb;
    $row = $wpdb->get_results($joinSQL, OBJECT);

    if ( count ($row) == 0 ) echo "<p>Che vergogna! Non abbiamo una vetrina da mostrare</p>";
    else echo buildShopWindow( $row );




}

function get_file_url( $file = __FILE__ ) {
    $file_path = str_replace( "\\", "/", str_replace( str_replace( "/", "\\", WP_CONTENT_DIR ), "", $file ) );
    if ( $file_path )
        return content_url( $file_path );
    return false;
}



/**
 * TODO - Falta obtener/añadir enlace de la empresa.
*/
function buildShopWindow( $rows ){

    $card = $image = $logoCompany = "";
    $imageNoFound = dirname( get_file_url() )."/assets/lib/nofound-capture.jpg";
    $logoNoFound = dirname( get_file_url() )."/assets/lib/company-not-found.png";

    foreach ($rows as $row) {

        // show window image
        if ( has_post_thumbnail( $row->ID ) ):
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $row->ID )[0], 'single-post-thumbnail' );
        else:
            $image = $imageNoFound;
        endif;

        // show company logo
        if ( has_post_thumbnail( $row->meta_value ) ):
            $logoCompany = wp_get_attachment_image_src( get_post_thumbnail_id( $row->meta_value )[0], 'single-post-thumbnail' );
        else:
            $logoCompany = $logoNoFound;
        endif;

        //$image = "http://www.arkitectureonweb.com/wp-content/uploads/2018/08/10-Cappe-ad-aspirazione-e-filtrazion-Circle.Tech_.jpg";
        //$logoCompany = "http://www.arkitectureonweb.com/wp-content/uploads/2018/08/xLogo-Web-1-1024x341.jpg.pagespeed.ic.bZdmowGx-h.jpg";

        $card .= '<div class="showcase">
                        <a href="'.$row->guid.'">
                            <p class="showcase-title">'.$row->post_title.'</p>
                            <img src="'.$image.'" alt="'.$row->post_title.'" class="showcase-img">
                        </a>
                        <a href="">
                            <img src="'.$logoCompany.'" alt="" class="showcase-companycard" alt="'.$row->post_title.'">
                        </a>
                    </div>';
    }
    return $card;
}








/**
 * function get all filter element
*/
function getAllTag(){
    global $wpdb;
    $sql = 'SELECT wparch_terms.term_id,name from wparch_terms  join wparch_term_taxonomy on wparch_terms.term_id = wparch_term_taxonomy.term_id where taxonomy = "post_tag" and count>0 ORDER BY name;';
    return $wpdb->get_results( $sql , OBJECT);
}
function getAllCategory(){
    global $wpdb;
    return $wpdb->get_results('SELECT wparch_terms.term_id,name from wparch_terms  join wparch_term_taxonomy on wparch_terms.term_id = wparch_term_taxonomy.term_id where taxonomy = "category" and count>0 ORDER BY name;', OBJECT);
}
function getAllCountry(){
    global $wpdb;
    $countries = $wpdb->get_results('SELECT id,country,continent from wparch_countries ORDER BY country;', OBJECT );
    $listContinent = array();

    // join country by continent after show sort filter
    foreach ( $countries as $country) {

        switch ( $country->continent ){
            case "europe":
                $listContinent["europa"][] = array(
                    "id" => "$country->id",
                    "country" => "$country->country",
                );
                break;
            case "asiapacific":
                $listContinent["asia"][] = array(
                    "id" => "$country->id",
                    "country" => "$country->country",
                );
                break;
            case "africa":
                $listContinent["africa"][] = array(
                    "id" => "$country->id",
                    "country" => "$country->country",
                );
                break;
            default:
                $listContinent["america"][] = array(
                    "id" => "$country->id",
                    "country" => "$country->country",
                );
                break;
        }
    }
    return $listContinent;
}
function getAllCompanies(){
    global $wpdb;
    return $wpdb->get_results('SELECT * from wparch_posts WHERE post_type="azienda" AND post_status="publish" ORDER BY ID ASC;', OBJECT );
}






