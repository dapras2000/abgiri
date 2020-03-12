$(document).ready(function () {
    $('#frmAddContent').on('submit', function (event) {
        event.preventDefault();
        //var description = CKEDITOR.instances['description'].getData();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/content',
            type: "post",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#frmAddContent').trigger("reset");
                $("#frmAddContent .close").click();
                window.location.reload();
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                $('#add-Content-errors').html('');
                $.each(errors.messages, function (key, value) {
                    $('#add-Content-errors').append('<li>' + value + '</li>');
                });
                $("#add-error-bag").show();
            }
        });
    });

    $('#frmEditContent').on('submit', function (event) {
        event.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/Content/' + $("#frmEditContent input[name=idedit]").val(),
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#frmEditContent').trigger("reset");
                $("#frmEditContent .close").click();
                window.location.reload();
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                $('#edit-Content-errors').html('');
                $.each(errors.messages, function (key, value) {
                    $('#edit-Content-errors').append('<li>' + value + '</li>');
                });
                $("#edit-error-bag").show();
            }
        });
    });

    $("#btn-delete").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: '/Content/' + $("#frmDeleteContent input[name=Content_id]").val(),
            dataType: 'json',
            success: function (data) {
                $("#frmDeleteContent .close").click();
                window.location.reload();
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
function addContentForm() {
    //$(document).ready(function () {
    $("#add-error-bag").hide();
    $('#addContentModal').modal('show');
    //});
}


function deleteContentForm(id) {
    //$(document).ready(function () {
    //alert(id);
    $('#deleteContentModal').modal('show');
    //});
    $.ajax({
        type: 'GET',
        url: '/Content/' + id,
        success: function (data) {
            $("#frmDeleteContent #delete-title").html("Delete (" + data.data.title + ")?");
            $("#frmDeleteContent input[name=Content_id]").val(data.data.id);
            $('#deleteContentModal').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });
}
function editContentForm(id) {
    $.ajax({
        type: 'GET',
        url: '/Content/' + id,
        success: function (data) {
            $("#edit-error-bag").hide();
            $("#frmEditContent input[name=idedit]").val(data.data.id);
            $("#frmEditContent input[name=titleedit]").val(data.data.title);
            $("#frmEditContent input[name=orderedit]").val(data.data.seq);
            //$("#statusedit").append("<option value='"+data.data.status+"'>"+data.data.status+"</option>");
            $("#statusedit").empty();

            var x = document.getElementById("statusedit");
            var option = document.createElement("option");
            option.text = "on";
            option.value = "on";
            if (data.data.status == "on") {
                option.selected = "yes";
            }
            x.add(option);

            var y = document.getElementById("statusedit");
            var option = document.createElement("option");
            option.text = "off";
            option.value = "off";
            if (data.data.status == "off") {
                option.selected = "yes";
            }
            y.add(option);

            $('#editContentModal').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });



    function deleteContentForm(id) {
        //$(document).ready(function () {
        //alert(id);
        $('#deleteContentModal').modal('show');
        //});
        $.ajax({
            type: 'GET',
            url: '/Content/' + id,
            success: function (data) {
                $("#frmDeleteContent #delete-title").html("Delete Content (" + data.data.title + ")?");
                $("#frmDeleteContent input[name=Content_id]").val(data.data.id);
                $('#deleteContentModal').modal('show');
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}