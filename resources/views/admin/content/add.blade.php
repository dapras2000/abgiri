<!-- Add Category Modal Form HTML -->
<div class="modal fade" id="addContentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmAddContent" enctype="multipart/form-data">
            @csrf
                <div class="modal-header">
                    <h4 class="modal-title">
                        Add New {{ $titles }}
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-danger" id="add-error-bag">
                        <ul id="add-category-errors">
                        </ul>
                    </div>
                     <div class="form-group">
                          <label>Category</label>
                          <select class="form-control" name="category" id="category">
                                @foreach($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                                @endforeach
                          </select>
                    </div>
                    <div class="form-group">
                          <label>Title</label>
                          <input type="text" name="title" id="title" class="form-control" required="">                                          
                    </div>
                   
                    <div class="form-group">
                            <p><input type="file"  accept="image/*" name="select_file" id="select_file"  onchange="loadFile(event)" style="display: yes;"></p>
                              <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
                              <p><img id="output" src="" /></p>
                        </div>                    
                   
                    <div class="form-group">
                          <label>Description</label>
                          <textarea name="description" id="description" class="form-control" rows="10"></textarea>                                         
                    </div>

                    <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="status" id="status">
                                <option value="on">on</option>
                                <option value="off">off</option>
                          </select>
                    </div>

                </div>
                
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                        <button class="btn btn-info" id="btn-add" type="submit" value="add">
                            Save
                        </button>
                    </input>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    var loadFile = function (event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    
</script>

<style>
    #output {
        width :100px;
        height :100px;
    }
</style>