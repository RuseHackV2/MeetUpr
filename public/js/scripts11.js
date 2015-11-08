$(function() {

    // Example link
    // <a data-id="1" href="#" data-toggle="modal">Test</a>

    $('[data-toggle="modal"]').click(function(e) {
        e.preventDefault();
        //data-id
        var id = $(this).attr('data-id');
        console.log(id);
        var modal_id = $(this).attr('data-target');
        url = "/events/short-details/" + id;
        $.get(url, function(data) {
            console.log($(data));
            $(data).modal();
        });
    });
});
