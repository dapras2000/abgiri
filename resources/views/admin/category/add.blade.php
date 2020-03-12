<!-- Add Category Modal Form HTML -->
<div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmAddCategory" enctype="multipart/form-data">
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
                          <label>Title</label>
                          <input type="text" name="title" id="title" class="form-control">                                          
                    </div>
                    <div class="form-group">
                          <label>Order</label>
                          <input type="text" name="order" id="order" class="form-control">                                          
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