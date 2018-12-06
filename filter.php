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
        <div class="col-lg-4">
            <div id="container-search-filter" class="accordion">


                <div class="content-main-title">
                    <h3>Filtro</h3>
                </div>

                <div>
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
                                        ?>
                                        <li>
                                            <div id='<?php echo "id-".$level0[$j]?>' aria-expanded="false" data-toggle='collapse' href="<?php echo "#tag-".$level0[$j] ?>">
                                                <label class='text-selected' for='<?php echo "id-".$level0[$j]?>' ><?php echo $level0[$j]?></label>
                                                <span class="plus-filter expanded">-</span>
                                                <span class="plus-filter collapsed">+</span>
                                            </div>
                                            <ul id='<?php echo "tag-".$level0[$j]?>' class='collapse'>
                                                <?php for ($i = 0 ; $i < 3; $i++){ ?>
                                                <li class="list-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="<?php echo $level0[$j]."_".$i ?>">
                                                        <label class="custom-control-label text-selected" for="<?php echo $level0[$j]."_".$i ?>">subnivel</label>
                                                    </div>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <?php } ?>
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
                                     <?php $category = array("Legno","Vetro","Roccia","Ferro", "Design"); ?>

                                     <?php for ($i = 0; $i < count($category); $i++) { ?>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="<?php echo "category".$i; ?>">
                                            <label class="custom-control-label text-selected" for="<?php echo "category".$i; ?>"><?php echo $category[$i]; ?> </label>
                                        </div>
                                    <?php } ?>

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

                            <div id="content-pease" class="collapse show" aria-labelledby="header-pease" data-parent="#container-search-filter">
                                <div class="card-body">

                                    <!-- TODO - Clasificación de países colocado aquí provicionalmente, debe estar en una función -->
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
                                    ?>
                                    <ul>
                                    <?php foreach ($listContinent as $continent => $listCountries){ ?>

                                        <li class="checkbox-father">
                                            <div class='custom-control custom-checkbox'>
                                                <input type='checkbox'  class='checkbox indeterminate custom-control-input' name="<?php echo $continent ?>" id="<?php echo "id_".$continent ?>" >
                                                <label class='custom-control-label text-selected' for="<?php echo "id_".$continent ?>"><?php echo ucwords($continent) ?></label>
                                                <span aria-expanded="false" data-toggle='collapse' data-target="<?php echo "#collapse_".$continent ?>" class="plus-filter ">
                                                    <b class='expanded'>-</b>
                                                    <b class='collapsed'>+</b>
                                                </span>
                                            </div>
                                            <ul id="<?php echo "collapse_".$continent ?>" class='collapse collapsing'>
                                            <?php foreach ($listCountries as $country) { ?>
                                                <li class="checkbox-son">
                                                    <div class='custom-control custom-checkbox'>
                                                        <input type='checkbox' class='checkbox custom-control-input' name="<?php echo $country["country"] ?>" id="<?php echo $country["id"] ?>" >
                                                        <label class='custom-control-label text-selected' for="<?php echo $country["id"] ?>"><?php echo $country["country"] ?></label>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    </ul>

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

                                    <?php for ($i = 0; $i < 5; $i++) { ?>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="<?php echo "brand".$i ?>">
                                            <label class="text-selected custom-control-label" for="<?php echo "brand".$i ?>">Contrassegno<?php echo $i ?></label>
                                        </div>
                                    <?php } ?>

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

                                    <!-- TODO - Colocar buscador de company -->

                                    <?php $companies = $wpdb->get_results('SELECT * from wparch_posts WHERE post_type="azienda" AND post_status="publish" ORDER BY ID ASC;', OBJECT ); ?>
                                    <ul>
                                    <?php foreach ($companies as $company) { ?>
                                        <li>
                                            <div class='custom-control custom-checkbox'>
                                                <input type='checkbox' class='custom-control-input' id="<?php echo $company->ID; ?>">
                                                <label class='custom-control-label text-selected' for="<?php echo $company->ID; ?>"><?php echo $company->post_title; ?></label>
                                            </div>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div id="content-vetrina">
                <div class="content-main-title">
                    <h3>Vetrine | </h3>
                    <span class="fa fa-search"></span>
                    <span class="badge badge-pill badge-light">
                        Etiqueta » Etiqueta 1, Etiqueta 2 |  Pease » Pease 1, Pease 2
                    </span>
                </div>
                <div class="row card-group">
                    <?php foreach ($rows as $value){?>
                        <div class="col-sm-4 ">
                            <div class="card" >
                                <img class="card-img-top" src="http://www.ultident.com//skin/frontend/default/sm_ultident/images/no_image.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text"><a href="<?php echo $value->guid; ?>"> <?php echo $value->post_title; ?> </a></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>

