

function activedCheckCountry(  ) {


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

    console.clear();
    //console.log(containerCheck);
}

$(document).ready(function () {


    $(".checkbox-son input[type=checkbox]").change(function () {

        var closestUL =  $(this).closest(".checkbox-father ul");


        if (closestUL.find('.checkbox-son input[type=checkbox]:checked').length === closestUL.find('.checkbox-son input[type=checkbox]').length){
            closestUL.prev('div').find('input[type=checkbox]').prop('checked', true);
        } else if (closestUL.find('.checkbox-son input[type=checkbox]:checked').length === 0){
            closestUL.prev('div').find('input[type=checkbox]').prop('checked', false);
        } else {
            closestUL.prev('div').find('input[type=checkbox]').prop('indeterminate', true);
        }



        //var nodeChild = closestUL.prev('div').find('input[type=checkbox]').prop('checked',checkedParent);



    });
    $(".checkbox-father input[type=checkbox]").change(function () {

        if ($(this).closest('div').find('input[type=checkbox]:checked').length === 1) {
            /* Selected checkbox father */
            $(this).closest("div").next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', true);
        } else {
            /* Selected checkbox father */
            $(this).closest("div").next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', false);
        }

    });
});





