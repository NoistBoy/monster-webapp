$(document).ready(function () {
    $('.dropdown').hover(function () {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
    }, function () {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
    });


    $('.sidebar li').click(function () {

        var id = $(this).attr('id');
        var category_list = $(this).closest('#category-list');
        category_list.hide();
        var list_values_to_show = $('#' + id + '-list');
        list_values_to_show.fadeIn();

        list_values_to_show.on('click', '.back-to-category', function () {
            category_list.fadeIn();
            list_values_to_show.hide();

        });

    });
    $('.top-5-products').click(function (e) {
        e.preventDefault();
        console.log("test");
    });

    $('#apply-for-account').click(function (e) {
        e.preventDefault();

        let formData = new FormData($('#singUp-form')[0]);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/post-sing-up',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                Swal.fire({
                    title: response.status,
                    text: response.message,
                    icon: response.status,
                    customClass: {
                        confirmButton: 'custom-sweetAlert-btn-confirm',
                        cancelButton: 'btn btn-secondary'
                    }
                });
                if (response.status == "success") {
                    resetForm();
                }
            },
            error: function (xhr, status, error) {

                if (xhr.status == 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $('.error-message').text('');

                    $.each(errors, function (field, fieldErrors) {
                        $('#' + field + '_error').text(fieldErrors[0]);
                    });
                } else {

                    console.log("The status " + status);
                    console.log("The Message " + error);
                }
            }

        });

    });
    $('#singin-account').click(function (e) {
        e.preventDefault();

        let formData = new FormData($('#singIn-form')[0]);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/post-sing-in',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if(response.status == "error"){
                    Swal.fire({
                        title: response.status,
                        text: response.message,
                        icon: response.status,
                        customClass: {
                            confirmButton: 'custom-sweetAlert-btn-confirm',
                            cancelButton: 'btn btn-secondary'
                        }
                    });
                }
                if (response.status == "success") {
                    resetForm();
                    window.location.href = response.redirect;
                }
            },
            error: function (xhr, status, error) {

                if (xhr.status == 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $('.error-message').text('');

                    $.each(errors, function (field, fieldErrors) {
                        $('#' + field + '_error').text(fieldErrors[0]);
                    });
                } else {

                    console.log("The status " + status);
                    console.log("The Message " + error);
                }
            }

        });

    });
    // get states  by country id
    $('#country_id').change(function (e) {
        e.preventDefault();
        var stateInput = $("#state_id");
        stateInput.prop('disabled', true);
        var countryId = $(this).val();
        // console.log("The values  " + countryId);
        if (countryId !== null && countryId !== "") {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/get-states',
                data: {
                    countryId: countryId
                },
                success: function (response) {
                    stateInput.html(response);
                    stateInput.prop('disabled', false);
                },
                error: function (xhr, status, error) {
                    console.log("The status " + status);
                    console.log("The Message " + error);
                }
            });

        } else {
            stateInput.html("<option>---- Please  Select Country First ----</option>");
            stateInput.prop('disabled', true);
        }

    });

});


function toggleSidebar() {
    var sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('active');
}
function resetForm() {
    $('.error-message').text('');
    $('.reset').val(null);
}
