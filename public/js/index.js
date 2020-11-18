$(function () {
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 150,
        format:'yyyy-mm-dd'
    });
    $(".dropdown-button").dropdown();

    $('.select2-select').select2({
        allowClear: true,
        placeholder: 'Select An Option'
    });
});