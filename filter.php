<?php

global $wpdb;

/**
 * get all vetrina from wparch_post table and save in 'rows' variable
 * */
$rows = $wpdb->get_results(
    'SELECT ID,guid,post_content,post_title,post_name,post_type
         from wparch_posts
         where post_status="publish" AND post_type="vetrina"
         ORDER BY ID ASC;', OBJECT );

?>


<div class="container">
    <div class="row">
        <div class="col-8">

            <h3>Vetrina</h3>
            <div id="content-vetrina">

                <?php
                foreach ($rows as $value) {
                    echo "<div class=\"card\">";
                    echo "<div class=\"card-header\">$value->post_title <a href='$value->guid'>leggi di più</a></div>";
                    echo "</div>";

                }
                ?>
            </div>
        </div>

        <div class="col-4">
            <div id="container-search-filter" class="accordion">

                <h3>Search filter</h3>

                <form>
                    <!-- TAG -->
                    <div class="card">
                        <div class="card-header title-filter" id="header-tag" data-toggle="collapse" data-target="#content-tag" aria-expanded="false" aria-controls="content-tag">
                            Eticheta
                            <span class="plus-filter expanded">-</span>
                            <span class="plus-filter collapsed">+</span>
                        </div>

                        <div id="content-tag" class="list-filter collapse " aria-labelledby="header-tag" data-parent="#container-search-filter">
                            <div class="card-body ">

                                <ul class="section-list">

                                    <?php

                                    $level0 = array("Dormitorio","Cocinas","Baños","Terrazas");
                                    for ($j = 0; $j < count($level0); $j++) {

                                        echo "<li>";
                                        echo "<div id= 'id-$level0[$j]' aria-expanded=\"false\" data-toggle='collapse' href=\"#tag-$level0[$j]\">";
                                        echo "<label for='#id-$level0[$j]' >$level0[$j]</label>";
                                        echo "<span class=\"plus-filter expanded\">-</span>";
                                        echo "<span class=\"plus-filter collapsed\">+</span>";
                                        echo "</div>";
                                        echo "<ul id='tag-$level0[$j]' class='collapse'>";
                                        for ($i = 0 ; $i < 3; $i++){
                                            echo "<li class=\"list-item\">";
                                            echo "<div class=\"custom-control custom-checkbox\">";
                                            echo "<input type=\"checkbox\" class=\"custom-control-input\" id=\"$level0[$j]_$i\">";
                                            echo "<label class=\"custom-control-label\" for=\"$level0[$j]_$i\">subnivel</label>";
                                            echo "</div>";
                                            echo "</li>";
                                        }
                                        echo "</ul>";
                                        echo "</li>";
                                    }

                                    ?>
                                </ul>



                            </div>
                        </div>
                    </div>

                    <!-- CATEGORY -->
                    <div class="card">
                        <div class="card-header title-filter" id="header-category" data-toggle="collapse" data-target="#content-category" aria-expanded="false" aria-controls="content-category">
                            Categoria
                            <span class="plus-filter expanded">-</span>
                            <span class="plus-filter collapsed">+</span>
                        </div>

                        <div id="content-category" class="collapse" aria-labelledby="header-category" data-parent="#container-search-filter">
                            <div class="card-body">
                                <?php
                                $category = array("Legno","Vetro","Roccia","Ferro", "Design");

                                for ($i = 0; $i < count($category); $i++) {
                                    echo "<div class=\"custom-control custom-checkbox\">";
                                    echo "<input type=\"checkbox\" class=\"custom-control-input\" id=\"category$i\">";
                                    echo "<label class=\"custom-control-label\" for=\"category$i\">$category[$i]</label>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- COUNTRY -->
                    <div class="card">
                        <div class="card-header title-filter" id="header-pease" data-toggle="collapse" data-target="#content-pease" aria-expanded="false" aria-controls="content-pease">
                            Pease
                            <span class="plus-filter expanded">-</span>
                            <span class="plus-filter collapsed">+</span>

                        </div>

                        <div id="content-pease" class="collapse" aria-labelledby="header-pease" data-parent="#container-search-filter">
                            <div class="card-body">
                                <?php
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
                                echo "<ul>";

                                foreach ($listContinent as $continent => $listCountries){

                                    echo "<li  class='content-continent'>";
                                    echo "<div class='custom-control custom-checkbox'>";
                                    echo "<input type='checkbox' class='custom-control-input' id=\"id_$continent\">";
                                    echo "<div aria-expanded=\"false\" class='content-plus-minus' data-toggle='collapse' data-target=\"#collapse_$continent\">";
                                    echo "<label class='custom-control-label' for=\"id_$continent\">$continent</label>";
                                    echo "<span class=\"plus-filter expanded\">-</span>";
                                    echo "<span class=\"plus-filter collapsed\">+</span>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "<ul id=\"collapse_$continent\" class='collapse collapsing'>";
                                    foreach ($listCountries as $country) {
                                        echo "<li>";
                                        echo "<div class='custom-control custom-checkbox'>";
                                        echo "<input type='checkbox' class='custom-control-input' id=\"".$country["id"]."\">";
                                        echo "<label class='custom-control-label' for=\"".$country["id"]."\">".$country["country"]."</label>";
                                        echo "</div>";
                                        echo "</li>";
                                    }
                                    echo "</ul></li>";
                                }
                                echo "</ul>";
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="card">
                        <div class="card-header title-filter" id="header-brand" data-toggle="collapse" data-target="#content-brand" aria-expanded="false" aria-controls="content-brand">
                            Contrassegno
                            <span class="plus-filter expanded">-</span>
                            <span class="plus-filter collapsed">+</span>
                        </div>

                        <div id="content-brand" class="collapse" aria-labelledby="header-brand" data-parent="#container-search-filter">
                            <div class="card-body">
                                <?php
                                for ($i = 0; $i < 5; $i++) {
                                    echo "<div class=\"custom-control custom-checkbox\">";
                                    echo "<input type=\"checkbox\" class=\"custom-control-input\" id=\"brand$i\">";
                                    echo "<label class=\"custom-control-label\" for=\"brand$i\">Contrassegno $i</label>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- COMPANY -->
                    <div class="card">
                        <div class="card-header title-filter" id="header-company" data-toggle="collapse" data-target="#content-company" aria-expanded="false" aria-controls="content-company">
                            Società
                            <span class="plus-filter expanded">-</span>
                            <span class="plus-filter collapsed">+</span>
                        </div>

                        <div id="content-company" class="collapse" aria-labelledby="header-company" data-parent="#container-search-filter">
                            <div class="card-body">
                                <?php
                                $companies = $wpdb->get_results(
                                    'SELECT *
                                        from wparch_posts
                                        WHERE post_type="azienda" AND post_status="publish"
                                        ORDER BY ID ASC;', OBJECT );
                                ?>
                                <select id="select_company" class="custom-select" size="1" onchange="displayCompany()">
                                    <option selected disabled>Selezionare...</option>
                                    <?php
                                    # TODO - Aplicar cambios en contenedor
                                    foreach ($companies as $company){
                                        echo "<option value=\"$company->ID\" >$company->post_title</option>";
                                    }
                                    ?>
                                </select>
                                <div id="display-select-company"></div>

                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


</div>

