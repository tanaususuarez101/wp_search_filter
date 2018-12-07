
var containerFilterActived = {};

/***
 *
 * @param typeSelected
 * @description general function pick up selected checkbox
 *
 */

function activationCheck(typeSelected) {


    var inputElements = document.getElementsByClassName(typeSelected);

    var itemSelected = [];
    for(var i=0; inputElements[i]; ++i){
        if(inputElements[i].checked) {
            itemSelected.push({"name":inputElements[i].name,"id":inputElements[i].id});
        }
    }

    containerFilterActived[typeSelected] = itemSelected;

    console.clear();
    console.log(containerFilterActived);
}

$(document).ready(function () {


    $("#content-pease .checkbox-son input[type=checkbox]").change(function () {


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
        activationCheck( 'checkbox-pease' );
    });
    $("#content-pease .checkbox-father input[type=checkbox]").change(function () {

        var closestDIV =  $(this).closest('div');
        if (closestDIV.find('input[type=checkbox]:checked').length === 1) {
            /* Selected checkbox father */
            closestDIV.next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', true);
        } else {
            /* Deselected checkbox father */
            closestDIV.next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', false);
        }
        activationCheck( 'checkbox-pease' );
    });

    $("#content-company .checkbox-son input[type=checkbox]").change(function () {


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
        activationCheck( 'checkbox-company' );
    });
    $("#content-company .checkbox-father input[type=checkbox]").change(function () {

        var closestDIV =  $(this).closest('div');
        if (closestDIV.find('input[type=checkbox]:checked').length === 1) {
            /* Selected checkbox father */
            closestDIV.next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', true);
        } else {
            /* Deselected checkbox father */
            closestDIV.next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', false);
        }
        activationCheck( 'checkbox-company' );
    });

    $("#content-category .checkbox-son input[type=checkbox]").change(function () {


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
        activationCheck( 'checkbox-category' );
    });
    $("#content-category .checkbox-father input[type=checkbox]").change(function () {

        var closestDIV =  $(this).closest('div');
        if (closestDIV.find('input[type=checkbox]:checked').length === 1) {
            /* Selected checkbox father */
            closestDIV.next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', true);
        } else {
            /* Deselected checkbox father */
            closestDIV.next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', false);
        }
        activationCheck( 'checkbox-category' );
    });

    $("#content-brand .checkbox-son input[type=checkbox]").change(function () {


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
        activationCheck( 'checkbox-brand' );
    });
    $("#content-brand .checkbox-father input[type=checkbox]").change(function () {

        var closestDIV =  $(this).closest('div');
        if (closestDIV.find('input[type=checkbox]:checked').length === 1) {
            /* Selected checkbox father */
            closestDIV.next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', true);
        } else {
            /* Deselected checkbox father */
            closestDIV.next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', false);
        }
        activationCheck( 'checkbox-brand' );
    });

    $("#content-tag .checkbox-son input[type=checkbox]").change(function () {


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
        activationCheck( 'checkbox-tag' );
    });
    $("#content-tag .checkbox-father input[type=checkbox]").change(function () {

        var closestDIV =  $(this).closest('div');
        if (closestDIV.find('input[type=checkbox]:checked').length === 1) {
            /* Selected checkbox father */
            closestDIV.next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', true);
        } else {
            /* Deselected checkbox father */
            closestDIV.next('ul').find('.checkbox-son input[type=checkbox]').prop('checked', false);
        }
        activationCheck( 'checkbox-tag' );
    });
});





