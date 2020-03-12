$(document).ready(function () {
    
    $("#btn-edit").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'put',
            url: '/setup/' + $("#frmEditSetup input[name=idedit]").val(),
            data: {
                logo: $("#frmEditSetup input[name=logo]").val(),
                meta_title: $("#frmEditSetup input[name=meta_title]").val(),
                address: $("#frmEditSetup input[name=address]").val(),
                contact: $("#frmEditSetup input[name=contact]").val(),
                email: $("#frmEditSetup input[name=email]").val(),
                social: $("#frmEditSetup input[name=social]").val(),
            },
            dataType: 'json',
            success: function (data) {
                $('#frmEditSetup').trigger("reset");
                $("#frmEditSetup .close").click();
                window.location.reload();
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                $('#edit-Setup-errors').html('');
                $.each(errors.messages, function (key, value) {
                    $('#edit-Setup-errors').append('<li>' + value + '</li>');
                });
                $("#edit-error-bag").show();
            }
        });
    });

    
});

function editSetupForm(id) {
    $.ajax({
        type: 'GET',
        url: '/setup/' + id,
        success: function (data) {
            $("#edit-error-bag").hide();
            
            $("#frmEditSetup input[name=idedit]").val(data.data.id);
            $("#frmEditSetup input[name=logo]").val(data.data.logo);
            $("#frmEditSetup input[name=meta_title]").val(data.data.meta_title);
            $("#frmEditSetup input[name=address]").val(data.data.address);
            $("#frmEditSetup input[name=contact]").val(data.data.contact);
            $("#frmEditSetup input[name=email]").val(data.data.email);
            $("#frmEditSetup input[name=social]").val(data.data.social);
            $('#editSetupModal').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });
}