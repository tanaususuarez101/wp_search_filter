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
    global $wpdb;
    $db = new accessDataBase();


    if (isset($_POST['checkbox-company'])) {
        foreach ($_POST['checkbox-company'] as $key => $value) {
            buildShopWindow( $db->getShopWindowBySociety($key) );
        }
    }
    if (isset($_POST['checkbox-category'])){
        echo "category no found";
    }
    if (isset($_POST['checkbox-tag'])) {
        echo "Tag no found";
    }

    if ( ! isset($_POST['checkbox-company']) || ! isset($_POST['checkbox-category']) || ! isset($_POST['checkbox-tag']) ||
        ! isset($_POST['checkbox-pease']) || ! isset($_POST['checkbox-brand'])) buildShopWindow(getShopWindow(null ));
}

class accessDataBase {
    private $select;
    private $where;
    private $join;

    private $basedSociety="";

    function __construct() {
        $this->select = " p.ID, p.post_title, p.post_content, p.guid ";
        $this->where = ' post_status="publish" and post_type="vetrina" and meta_key="_wpcf_belongs_azienda_id" ';
        $this->join = " join wparch_postmeta pm on p.ID = pm.post_id ";
    }

    function AllShopWindow(){

    }

    function getShopWindowByCategory(){

    }
    function getShopWindowByTag(){

    }

    function getShopWindowBySociety($idSociety){


    }

    private function call($joinSQL){
        global $wpdb;
        $joinSQL = "select".$this->select."from wparch_posts p".$this->join."where".$this->where.'and meta_value="'.$idSociety.'" ';
        return $wpdb->get_results( $joinSQL, OBJECT );
    }
}

function getShopWindow(){
    global  $wpdb;
    return $wpdb->get_results(
        'SELECT ID,guid,post_content,post_title,post_name,post_type
             from wparch_posts
             where post_status="publish" AND post_type="vetrina"
             ORDER BY ID ASC;', OBJECT );

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






