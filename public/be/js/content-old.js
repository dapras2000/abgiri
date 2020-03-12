$(document).ready(function () {    
    $("#btn-add").click(function () {
    //var x = document.getElementById("status").selectedIndex;
    var sts = document.getElementById("status").value;
    var kat = document.getElementById("category").value;
    var title = $("#frmAddContent input[name=title]").val();
    var img = document.getElementById("file").files[0].name;
    var img2 = $("#frmAddContent input[id=imgs]").val();
    var description = CKEDITOR.instances['description'].getData();
        //alert(sts+kat+title+img+img2+description);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        url: '/content',
        data: {
            title: title,
            description: description,
            status: sts,
            category: kat,
            image:img,
            image2:img2,
        },
        dataType: 'json',
        success: function (data) {
            $('#frmAddContent').trigger("reset");
            $("#frmAddContent .close").click();
            window.location.reload();
        },
        error: function (data) {
            var errors = $.parseJSON(data.responseText);
            $('#add-content-errors').html('');
            $.each(errors.messages, function (key, value) {
                $('#add-content-errors').append('<li>' + value + '</li>');
            });
            $("#add-error-bag").show();
        }
    });
});
    
    $("#btn-edit").click(function () {
        //var x = document.getElementById("statusedit").selectedIndex;
        //var stsedit = document.getElementsByTagName("option")[x].value;
        var stsedit = document.getElementById("status").value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'put',
            url: '/content/' + $("#frmEditContent input[name=idedit]").val(),
            data: {
                titleedit: $("#frmEditContent input[name=titleedit]").val(),
                seqedit: $("#frmEditContent input[name=seqedit]").val(),
                statusedit: stsedit,
            },
            dataType: 'json',
            success: function (data) {
                $('#frmEditContent').trigger("reset");
                $("#frmEditContent .close").click();
                window.location.reload();
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                $('#edit-content-errors').html('');
                $.each(errors.messages, function (key, value) {
                    $('#edit-content-errors').append('<li>' + value + '</li>');
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
            url: '/content/' + $("#frmDeleteContent input[name=Content_id]").val(),
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
    $("#add-error-bag").hide();     
    $('#addContentModal').modal('show');
}


        function deleteContentForm(id) {
            //$(document).ready(function () {
                //alert(id);
                $('#deleteContentModal').modal('show');
            //});
            $.ajax({
                type: 'GET',
                url: '/content/' + id,
                success: function (data) {
                    $("#frmDeleteContent #delete-title").html("Delete (" + data.data.title + ")?");
                    $("#frmDeleteContent input[name=content_id]").val(data.data.id);
                    $('#deleteModal').modal('show');
                },
                error: function (data) {
                    console.log(data);
                }
             });
        }
function editForm(id) {
    $.ajax({
        type: 'GET',
        url: '//' + id,
        success: function (data) {
            $("#edit-error-bag").hide();
            $("#frmEdit input[name=idedit]").val(data.data.id);
            $("#frmEdit input[name=titleedit]").val(data.data.title);
            $("#frmEdit input[name=seqedit]").val(data.data.seq);
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

            $('#editModal').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });



    function deleteForm(id) {
        //$(document).ready(function () {
        //alert(id);
        $('#deleteModal').modal('show');
        //});
        $.ajax({
            type: 'GET',
            url: '/content/' + id,
            success: function (data) {
                $("#frmDeleteContent #delete-title").html("Delete Content (" + data.data.title + ")?");
                $("#frmDeleteContent input[name=content_id]").val(data.data.id);
                $('#deleteContentModal').modal('show');
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}
