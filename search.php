<?php
/**
 * Created by PhpStorm.
 * User: Tana-HP
 * Date: 12/12/2018
 * Time: 11:45
 */

$portal = "/wordpress";
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
    echo buildShopWindow( $wpdb->get_results($joinSQL, OBJECT) );


}


function buildShopWindow($rows){
    foreach ($rows as $row ){
        echo '<div class="card">
                  <div class="card-body">
                    <p>'.$row->post_title.'</p>
                    <a href="'.$row->guid.'">Leer mas</a>
                  </div>
              </div>';
    }
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






