<?php
/*
    Plugin Name: search filter
    Plugin URI: localhost
    Description: Product search plugin using filter
    Version: 1.0
    Author: Tana-HP
*/

/**
 * TODO - Modificar la ruta del CSS
 * TODO - Add AJAX result search
*/


add_shortcode( "custom_filter", "custom_filter");


function init_config() {

    include ("search.php");

    wp_register_style( 'style_search.css', dirname(get_file_url()).'/assets/css/search.css' );
    wp_register_script( 'search.js', dirname(get_file_url()).'/assets/js/search.js' );
    wp_enqueue_style('style_search.css');
    wp_enqueue_script('search.js');


    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">';
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>';
    echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>';
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';

}


function custom_filter() {
    init_config();
    ?>

    <div >
        <div class="row col-lg-12">
            <div id="filter-aplication" class="show-search-tag"></div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div id="container-search-filter" class="accordion">
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

                                        <?php $contentTag = getAllTag(); ?>
                                        <ul>
                                            <li class="checkbox-father">
                                                <div class='custom-control custom-checkbox'>
                                                    <input type='checkbox' class='custom-control-input'  id="id_tag">
                                                    <label class='custom-control-label text-selected' for="id_tag">Tutto Etichette</label>
                                                </div>
                                                <ul>
                                                    <?php foreach ($contentTag as $tag) { ?>
                                                        <li class="checkbox-son">
                                                            <div class='custom-control custom-checkbox'>
                                                                <input type='checkbox' class='checkbox-tag checkbox-company custom-control-input' name="<?php echo $tag->name ?>" id="<?php echo $tag->term_id; ?>">
                                                                <label class='custom-control-label text-selected' for="<?php echo $tag->term_id; ?>"><?php echo $tag->name; ?></label>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
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
                                        <?php $category = getAllCategory(); ?>

                                        <ul>
                                            <li class="checkbox-father">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"  id="id_category">
                                                    <label class="custom-control-label text-selected" for="id_category">Tutto Categoria</label>
                                                </div>
                                                <ul>
                                                    <?php foreach ($category as $subcategory) { ?>
                                                    <li class="checkbox-son">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="checkbox-category custom-control-input" name="<?php echo $subcategory->name; ?>" id="<?php echo $subcategory->term_id; ?>">
                                                            <label class="custom-control-label text-selected" for="<?php echo $subcategory->term_id; ?>"><?php echo $subcategory->name; ?></label>
                                                        </div>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>

                            <!-- COUNTRY -->
                            <div  style="display: none" class="card">
                                <div class="card-header title-filter" id="header-pease" data-toggle="collapse" data-target="#content-pease" aria-expanded="false" aria-controls="content-pease">
                                    Pease
                                    <span class="plus-filter expanded">-</span>
                                    <span class="plus-filter collapsed">+</span>
                                </div>

                                <div id="content-pease" class="collapse" aria-labelledby="header-pease" data-parent="#container-search-filter">
                                    <div class="card-body">

                                        <?php $listContinent = getAllCountry(); ?>

                                        <ul>
                                        <?php foreach ($listContinent as $continent => $listCountries){ ?>

                                            <li class="checkbox-father">
                                                <div class='custom-control custom-checkbox'>
                                                    <input type='checkbox'  class='indeterminate custom-control-input' name="<?php echo $continent ?>" id="<?php echo "id_".$continent ?>" >
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
                                                            <input type='checkbox' class='checkbox-pease custom-control-input' value="checkbox-pease" name="<?php echo $country["country"] ?>" id="<?php echo $country["id"] ?>" >
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

                            <!-- Contrassegno -->
                            <div class="card" style="display:none">
                                <div class="card-header title-filter" id="header-brand" data-toggle="collapse" data-target="#content-brand" aria-expanded="false" aria-controls="content-brand">
                                    Contrassegno
                                    <span class="plus-filter expanded">-</span>
                                    <span class="plus-filter collapsed">+</span>
                                </div>

                                <div id="content-brand" class="collapse" aria-labelledby="header-brand" data-parent="#container-search-filter">
                                    <div class="card-body">


                                        <ul>
                                            <li class="checkbox-father">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="id_brand">
                                                    <label class="text-selected custom-control-label" for="id_brand">Tutto Contrassegno</label>
                                                </div>
                                                <ul>
                                                    <?php for ($i = 0; $i < 5; $i++) { ?>
                                                        <li class="checkbox-son">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="<?php echo "brand".$i ?>">
                                                                <label class="text-selected custom-control-label" for="<?php echo "brand".$i ?>">Contrassegno<?php echo $i ?></label>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        </ul>

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


                                        <?php $companies = getAllCompanies(); ?>
                                        <ul>
                                            <li class="checkbox-father">
                                                <div class='custom-control custom-checkbox'>
                                                    <input type='checkbox' class='custom-control-input' id="id_company">
                                                    <label class='custom-control-label text-selected' for="id_company">Tutto Società</label>
                                                </div>
                                                <ul>
                                                <?php foreach ($companies as $company) { ?>
                                                    <li class="checkbox-son">
                                                        <div class='custom-control custom-checkbox'>
                                                            <input type='checkbox' class='checkbox-company custom-control-input' name="<?php echo $company->post_title ?>" id="<?php echo $company->ID; ?>">
                                                            <label class='custom-control-label text-selected' for="<?php echo $company->ID; ?>"><?php echo $company->post_title; ?></label>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                                </ul>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div id="container-showcase"></div>
            </div>
        </div>
    </div>



<?php } ?>








