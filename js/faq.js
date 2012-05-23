// FAQ bei ausklappen icon weschseln
$(document).ready(function() {
    // xy collapse-item als Variable speichern
    var faqCollapse = $('.collapse');

    // wenn collapse-item x gezeigt wird
    faqCollapse.on('show', function() {
        // ergänze icon-minus-sign als Klasse, falls noch nicht vorhanden
        $(this).prev().find('i.icon').toggleClass('icon-minus');
    });
    // wenn collapse-item x wieder verschwindet
    faqCollapse.on('hide', function() {
        // entferne icon-minus-sign Klasse, falls vorhanden
        $(this).prev().find('i.icon').toggleClass('icon-minus');
    });
});