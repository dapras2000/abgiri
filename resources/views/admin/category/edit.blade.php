<!-- Edit Modal HTML -->
<div class="modal fade" id="editCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmEditCategory">
                    @csrf
                    {{ method_field('PUT') }}
                <div class="modal-header">
                    <h4 class="modal-title">
                        Edit {{ $titles }}
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="edit-error-bag">
                        <ul id="edit-category-errors">
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>
                            Title
                        </label>
                        <input type="text" name="titleedit" id="titleedit" class="form-control">
                        </input>
                    </div>
                    <div class="form-group">
                        <label>
                            Order
                        </label>
                        <input type="text" name="orderedit" id="orderedit" class="form-control">
                        </input>
                    </div>
                    <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="statusedit" id="statusedit">
                               
                          </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input id="idedit" name="idedit" type="hidden" value="0">
                        <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                            <button class="btn btn-info" id="btn-edit" type="submit" value="add">
                                Update
                            </button>
                        </input>
                    </input>
                </div>
            </form>
        </div>
    </div>
</div>