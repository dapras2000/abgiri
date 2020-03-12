$(document).ready(function () {
    $('#frmAddCategory').on('submit', function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/category',
            type: "post",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#frmAddCategory').trigger("reset");
                $("#frmAddCategory .close").click();
                window.location.reload();
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                $('#add-category-errors').html('');
                $.each(errors.messages, function (key, value) {
                    $('#add-category-errors').append('<li>' + value + '</li>');
                });
                $("#add-error-bag").show();
            }
        });
    });

    $('#frmEditCategory').on('submit', function (event) {
        event.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/category/' + $("#frmEditCategory input[name=idedit]").val(),
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#frmEditCategory').trigger("reset");
                $("#frmEditCategory .close").click();
                window.location.reload();
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                $('#edit-category-errors').html('');
                $.each(errors.messages, function (key, value) {
                    $('#edit-category-errors').append('<li>' + value + '</li>');
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
            url: '/category/' + $("#frmDeleteCategory input[name=category_id]").val(),
            dataType: 'json',
            success: function (data) {
                $("#frmDeleteCategory .close").click();
                window.location.reload();
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
function addCategoryForm() {
    //$(document).ready(function () {
    $("#add-error-bag").hide();
    $('#addCategoryModal').modal('show');
    //});
}


function deleteCategoryForm(id) {
    //$(document).ready(function () {
    //alert(id);
    $('#deleteCategoryModal').modal('show');
    //});
    $.ajax({
        type: 'GET',
        url: '/category/' + id,
        success: function (data) {
            $("#frmDeleteCategory #delete-title").html("Delete (" + data.data.title + ")?");
            $("#frmDeleteCategory input[name=category_id]").val(data.data.id);
            $('#deleteCategoryModal').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });
}
function editCategoryForm(id) {
    $.ajax({
        type: 'GET',
        url: '/category/' + id,
        success: function (data) {
            $("#edit-error-bag").hide();
            $("#frmEditCategory input[name=idedit]").val(data.data.id);
            $("#frmEditCategory input[name=titleedit]").val(data.data.title);
            $("#frmEditCategory input[name=orderedit]").val(data.data.seq);
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

            $('#editCategoryModal').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });



    function deleteCategoryForm(id) {
        //$(document).ready(function () {
        //alert(id);
        $('#deleteCategoryModal').modal('show');
        //});
        $.ajax({
            type: 'GET',
            url: '/category/' + id,
            success: function (data) {
                $("#frmDeleteCategory #delete-title").html("Delete Category (" + data.data.title + ")?");
                $("#frmDeleteCategory input[name=category_id]").val(data.data.id);
                $('#deleteCategoryModal').modal('show');
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}