$(document).ready(function () {
    $('#frmAddMenu').on('submit', function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/menu',
            type: "post",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#frmAddMenu').trigger("reset");
                $("#frmAddMenu .close").click();
                window.location.reload();
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                $('#add-menu-errors').html('');
                $.each(errors.messages, function (key, value) {
                    $('#add-menu-errors').append('<li>' + value + '</li>');
                });
                $("#add-error-bag").show();
            }
        });
    });

    $('#frmEditMenu').on('submit', function (event) {
        event.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/menu/' + $("#frmEditMenu input[name=idedit]").val(),
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#frmEditMenu').trigger("reset");
                $("#frmEditMenu .close").click();
                window.location.reload();
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                $('#edit-menu-errors').html('');
                $.each(errors.messages, function (key, value) {
                    $('#edit-menu-errors').append('<li>' + value + '</li>');
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
            url: '/menu/' + $("#frmDeleteMenu input[name=menu_id]").val(),
            dataType: 'json',
            success: function (data) {
                $("#frmDeleteMenu .close").click();
                window.location.reload();
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
function addMenuForm() {
    //$(document).ready(function () {
    $("#add-error-bag").hide();
    $('#addMenuModal').modal('show');
    //});
}


function deleteMenuForm(id) {
    //$(document).ready(function () {
    //alert(id);
    $('#deleteMenuModal').modal('show');
    //});
    $.ajax({
        type: 'GET',
        url: '/menu/' + id,
        success: function (data) {
            $("#frmDeleteMenu #delete-title").html("Delete (" + data.data.title + ")?");
            $("#frmDeleteMenu input[name=menu_id]").val(data.data.id);
            $('#deleteMenuModal').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });
}
function editMenuForm(id) {
    $.ajax({
        type: 'GET',
        url: '/menu/' + id,
        success: function (data) {
            $("#edit-error-bag").hide();
            $("#frmEditMenu input[name=idedit]").val(data.data.id);
            $("#frmEditMenu input[name=titleedit]").val(data.data.title);
            $("#frmEditMenu input[name=orderedit]").val(data.data.seq);
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

            $('#editMenuModal').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });



    function deleteMenuForm(id) {
        //$(document).ready(function () {
        //alert(id);
        $('#deleteMenuModal').modal('show');
        //});
        $.ajax({
            type: 'GET',
            url: '/menu/' + id,
            success: function (data) {
                $("#frmDeleteMenu #delete-title").html("Delete Menu (" + data.data.title + ")?");
                $("#frmDeleteMenu input[name=menu_id]").val(data.data.id);
                $('#deleteMenuModal').modal('show');
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}