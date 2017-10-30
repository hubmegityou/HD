

jQuery(document).ready(function () {

    clickme();
    save_position();

})


function clickme() {
    $(".clickme").click(function () {
        $("#show" + this.id).toggle();
    });
}




function save_position() {
    $(function () {
        $(".timeline-centeredleft").sortable();
        $(".clickme").sortable();
    });

    function saveOrder() {
        var selectedLanguage = new Array();
        $('ul#sortable-row li').each(function () {
            selectedLanguage.push($(this).attr("id"));
        });
        document.getElementById("row_order").value = selectedLanguage;
    }

}

function verify_order() {
    var article = $(".timeline-entry");
    for (i = 0; i < article.length; i++)
        console.log(article[i].id);
}