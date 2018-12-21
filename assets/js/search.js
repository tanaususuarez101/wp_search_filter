


/**
 * @var indeterminateFatherBox determine if checkbox father are selected
 * @var containerFilterActived used to send element selected to server
 **/

/**
 containerFilterActive structure:

 {
    "checkbox-tag":{
         "id"=>"name_selected",
         "id"=>"name_selected",
     }
     "checkbox-category":{
         "id"=>"name_selected",
         "id"=>"name_selected",
     }
     ...
 }


 * */


var containerFilterActived = {};


$(document).ready(function () {
    loadDataBase();
    loadButtonAccion();
});


function loadButtonAccion() {


    $("#content-pease .checkbox-son input[type=checkbox]").change(function () {
        checkSon( $(this).closest(".checkbox-father ul") , 'checkbox-pease' );
    });
    $("#content-category .checkbox-son input[type=checkbox]").change(function () {
        checkSon( $(this).closest(".checkbox-father ul") , 'checkbox-category' );
    });
    $( "#content-company .checkbox-son input[type=checkbox]" ).change(function () {
        checkSon( $(this).closest(".checkbox-father ul"), 'checkbox-company' );
        activationCheck( 'checkbox-company' );
    });
    $("#content-tag .checkbox-son input[type=checkbox]").change(function () {
        checkSon( $(this).closest(".checkbox-father ul") , 'checkbox-tag' );
        activationCheck( 'checkbox-tag' );

    });
    $("#content-brand .checkbox-son input[type=checkbox]").change(function () {
        checkSon( $(this).closest(".checkbox-father ul") , 'checkbox-brand' );
        activationCheck( 'checkbox-brand' );
    });
    $("#content-brand .checkbox-father input[type=checkbox]").change(function () {

        $(this).closest('div').next('ul').find('li.checkbox-son input[type=checkbox]').prop('checked', this.checked);
        //if ( this.value === "click" ) indeterminateFatherBox[ 'checkbox-brand' ] =  false;
        activationCheck( 'checkbox-brand' );

    });
    $("#content-tag .checkbox-father input[type=checkbox]").change(function () {
        $(this).closest( 'div' ).next( 'ul' ).find('li.checkbox-son input[type=checkbox]').prop('checked', this.checked);
        //if ( this.value === "click" ) indeterminateFatherBox[ 'checkbox-tag' ] =  false;
        activationCheck( 'checkbox-tag' );
    });
    $("#content-category .checkbox-father input[type=checkbox]").change(function () {
        $(this).closest('div').next('ul').find('li.checkbox-son input[type=checkbox]').prop('checked', this.checked);
        //if ( this.value === "click" ) indeterminateFatherBox[ 'checkbox-category' ] =  false;
        activationCheck( 'checkbox-category' );
    });
    $("#content-company .checkbox-father input[type=checkbox]").change(function () {
        $(this).closest('div').next('ul').find('li.checkbox-son input[type=checkbox]').prop('checked', this.checked);
        //if ( this.value === "click" ) indeterminateFatherBox[ 'checkbox-company' ] =  false;
        activationCheck( 'checkbox-company' );
    });
    $("#content-pease .checkbox-father input[type=checkbox]").change(function () {
        $(this).closest('div').next('ul').find('li.checkbox-son input[type=checkbox]').prop('checked', this.checked);
        //if ( this.value === "click" ) indeterminateFatherBox[ 'checkbox-pease' ] =  false;
        activationCheck( 'checkbox-pease' );
    });
    function checkSon(closestUL,clss_checkbox) {

        var checkboxChildSelected = closestUL.find('.checkbox-son input[type=checkbox]:checked').length;
        var checkboxChildNotSelected = closestUL.find('.checkbox-son input[type=checkbox]').length;

        if (checkboxChildSelected === checkboxChildNotSelected){
            closestUL.prev('div').find('input[type=checkbox]').prop('checked', true);
            closestUL.prev('div').find('input[type=checkbox]').prop('indeterminate', false);
            //indeterminateFatherBox[clss_checkbox] = false;
        } else if (checkboxChildSelected === 0){
            closestUL.prev('div').find('input[type=checkbox]').prop('checked', false);
            closestUL.prev('div').find('input[type=checkbox]').prop('indeterminate', false);
            //indeterminateFatherBox[clss_checkbox] = false;
        } else {
            closestUL.prev('div').find('input[type=checkbox]').prop('indeterminate', true);
            //indeterminateFatherBox[clss_checkbox] = true;
        }


    }
}
function activationCheck(typeSelected) {


    var inputElements = document.getElementsByClassName(typeSelected);

    var itemSelected = {};
    for(var i=0; inputElements[i]; ++i){
        if(inputElements[i].checked) {
            itemSelected[inputElements[i].id] = inputElements[i].name;
        }
    }
    containerFilterActived[typeSelected] = itemSelected;
    loadDataBase();

    //console.log(containerFilterActived);
    //console.log(indeterminateFatherBox);
}
function translateITA(name){
    switch (name) {
        case "checkbox-company": return "Società";
        case "checkbox-tag": return "Eticheta";
        case "checkbox-category": return "Categoria";
        case "checkbox-pease": return "Pease";
        case "checkbox-brand": return "Contrassegno";
    }
}
function loadDataBase() {



    var resultFilter = "";
    for (var clave in containerFilterActived){
        if (Object.keys(containerFilterActived[clave]).length > 0) {
            resultFilter += '<div class="search-card"><div class="search-card-title">'+translateITA(clave)+'</div></div>';
        }
    }
    $("#filter-aplication").html('<div class="search-card"><div class="search-card-title"><i class="fa fa-search" aria-hidden="true"></i> | Cerca per » </div> </div>' + resultFilter);


    $.ajax({
        type: "post",
        url: window.location+"wp-content/plugins/search/search.php",
        data: containerFilterActived,
        beforeSend:function(){
            $("#container-showcase").html("Caricamento, per favore aspetta...");
        },
        success: function (data) {
            $("#container-showcase").html(data);
        }
    });
}






