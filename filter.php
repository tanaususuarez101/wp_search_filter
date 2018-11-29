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
                <div class="cointainer-search-filter">
                    <h3>Filtro di ricerca</h3>
                    <form>

                        <div id="content-tag">
                            <h3 class="title-filter">Etichetta</h3>
                            <?php
                            for ($i = 0; $i < 2; $i++) {
                                echo "<div class=\"custom-control custom-checkbox\">";
                                echo "<input type=\"checkbox\" class=\"custom-control-input\" id=\"tag$i\">";
                                echo "<label class=\"custom-control-label\" for=\"tag$i\">Etichetta $i</label>";
                                echo "</div>";
                            }
                            ?>
                        </div>

                        <div id="content-category">
                            <h3 class="title-filter">Categoria</h3>
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

                        <div id="content-country">
                            <?php
                            $countries = $wpdb->get_results(
                                'SELECT id,country,continent
                                     from wparch_countries;', OBJECT );
                            ?>
                            <h3 class="title-filter">Paese</h3>
                            <div class="form-group" >
                                <select id="select_country" class="custom-select" size="1" onchange="displayCountries()">
                                    <option selected disabled>Selezionare...</option>
                                    <option value="title" disabled>EUROPA</option>
                                    <?php
                                        # TODO - Aplicar cambios en contenedor
                                        foreach ($countries as $site){
                                            if ($site->continent === "europe"){
                                                echo "<option value=\"$site->id\" >$site->country</option>";
                                            }
                                        }
                                    ?>

                                    <option value="title" disabled>ASIA</option>
                                    <?php
                                    foreach ($countries as $site){
                                        if ($site->continent === "asiapacific"){
                                            echo "<option value=\"$site->id\">$site->country</option>";
                                        }
                                    }
                                    ?>
                                    <option value="title" disabled>AFRICA</option>
                                    <?php
                                    foreach ($countries as $site){
                                        if ($site->continent === "africa"){
                                            echo "<option value=\"$site->id\">$site->country</option>";
                                        }
                                    }
                                    ?>
                                    <option value="title" disabled>AMERICA</option>
                                    <?php
                                    foreach ($countries as $site){
                                        if ($site->continent === "southamerica" OR $site->continent === "northamerica"){
                                            echo "<option value=\"$site->id\">$site->country</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <div id="display-select-country"></div>
                            </div>
                        </div>

                        <div id="content-make">
                            <h3 class="title-filter">Contrassegno</h3>
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                                echo "<div class=\"custom-control custom-checkbox\">";
                                echo "<input type=\"checkbox\" class=\"custom-control-input\" id=\"brand$i\">";
                                echo "<label class=\"custom-control-label\" for=\"brand$i\">Contrassegno $i</label>";
                                echo "</div>";
                            }
                            ?>
                        </div>

                        <div id="content-comapany">
                            <?php
                            $companies = $wpdb->get_results(
                                'SELECT *
                                from wparch_posts
                                WHERE post_type="azienda" AND post_status="publish"
                                ORDER BY ID ASC;', OBJECT );
                            ?>
                            <h3 class="title-filter">Società</h3>
                            <div class="form-group" >
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

                    </form>
                </div>
            </div>
        </div>


    </div>

