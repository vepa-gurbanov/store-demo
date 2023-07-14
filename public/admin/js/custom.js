$(document).ready(function (e) {

    // Enable bootstrap tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    // $(document).ready(function(){
    //     $('[data-bs-toggle="tooltip"]').tooltip();
    // });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });

    function checkAdminIsExists() {

        var form = $('form#checkAdminIsExists_form');
        var email = $('input#checkAdminIsExists').val();


        $.ajax({
            url: form.attr('action'),
            dataType: "json",
            type: "POST",
            data: {'email': email},
            success: function (result, status, xhr) {
                console.log(result);
                if (result.response === 1) {
                    form.find('button').remove();
                    var button = '<button type="" class="btn btn-primary btn-user btn-block"></button>';
                    form.append();

                    $.ajax({
                        url: form.attr('action').replace('login', 'check'),
                        dataType: "json",
                        type: "POST",
                        data: {'email': email},
                        success: function (result, status, xhr) {
                            console.log(result);



                        },
                        error: function (result, status, xhr) {
                            console.log(result);
                        },
                    });
                } else if (result.response === 0) {
                    $.ajax({
                        url: form.attr('action').replace('register', 'check'),
                        dataType: "json",
                        type: "POST",
                        data: {'email': email},
                        success: function (result, status, xhr) {
                            console.log(result);



                        },
                        error: function (result, status, xhr) {
                            console.log(result);
                        },
                    });
                }


            },
            error: function (result, status, xhr) {
                console.log(result);
            },
        });

    }

    $('button#checkAdminIsExists_button').on('click', function () {
        checkAdminIsExists();
    });
});
