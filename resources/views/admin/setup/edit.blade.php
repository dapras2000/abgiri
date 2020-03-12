<!-- Edit Modal HTML -->
<div class="modal fade" id="editSetupModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="frmEditSetup">
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
                        <ul id="edit-Setup-errors">
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>
                            Logo
                        </label>
                        <input type="text" name="logo" id="logo" class="form-control" required>
                        </input>
                    </div>
                    <div class="form-group">
                        <label>
                            Meta Title
                        </label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control" required>
                        </input>
                    </div>
                    <div class="form-group">
                        <label>
                            Address
                        </label>
                        <input type="text" name="address" id="address" class="form-control" required>
                        </input>
                    </div>
                    <div class="form-group">
                        <label>
                            Contact
                        </label>
                        <input type="text" name="contact" id="contact" class="form-control" required>
                        </input>
                    </div>
                    <div class="form-group">
                        <label>
                            Email
                        </label>
                        <input type="text" name="email" id="email" class="form-control" required>
                        </input>
                    </div>
                    <div class="form-group">
                        <label>
                            Social
                        </label>
                        <input type="text" name="social" id="social" class="form-control" required>
                        </input>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <input id="idedit" name="idedit" type="hidden" value="0">
                        <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                            <button class="btn btn-info" id="btn-edit" type="button" value="add">
                                Update
                            </button>
                        </input>
                    </input>
                </div>
            </form>
        </div>
    </div>
</div>