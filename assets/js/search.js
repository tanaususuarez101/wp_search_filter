

function activationCheckCountry() {


    var inputElements = document.getElementsByClassName('checkbox');
    var continent = [], countries = [];


    for(var i=0; inputElements[i]; ++i){
        if(inputElements[i].checked) {

            if (inputElements[i].name === "asia" ||
                inputElements[i].name === "europa" ||
                inputElements[i].name === "america" ||
                inputElements[i].name === "africa"
            ){
                continent.push(inputElements[i].name);
            }else {
                countries.push({"name":inputElements[i].name,"id":inputElements[i].id});
            }
            var containerCheck = {
                "continent":continent,
                "countries":countries
            };

        }
    }

   // console.log(containerCheck);
}

$(document).ready(function () {


    $(".checkbox-son input[type=checkbox]").change(function () {

        console.clear();
        var closestUL =  $(this).closest(".checkbox-father ul");


        var checkboxChildSelected = closestUL.find('.checkbox-son input[type=checkbox]:checked').length;
        var checkboxChildNotSelected = closestUL.find('.checkbox-son input[type=checkbox]').length;


        if (checkboxChildSelected === checkboxChildNotSelected){
            closestUL.prev('div').find('input[type=checkbox]').prop('checked', true);
            closestUL.prev('div').find('input[type=checkbox]').prop('indeterminate', false);
        } else if (checkboxChildSelected === 0){
            closestUL.prev('div').find('input[type=checkbox]').prop('checked', false);
            closestUL.prev('div').find('input[type=checkbox]').prop('indeterminate', false);
        } else {
            closestUL.prev('div').find('input[type=checkbox]').prop('indeterminate', true);
        }
        activationCheckCountry();
    });

    $(".checkbox-father input[type=checkbox]").change(function () {

        var closestDIV =  $(this).closest('div');
        if (closestDIV.find('input[type=checkbox]:checked').length === 1) {
            /* Selected checkbox father */
            closestDIV.next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', true);
        } else {
            /* Deselected checkbox father */
            closestDIV.next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', false);
        }
        activationCheckCountry();
    });
});





