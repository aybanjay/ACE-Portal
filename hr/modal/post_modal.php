<div class="modal fade" id="post" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="_jobhead">Post a job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="forms-sample" id="frmpost">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-group">

                                <label for="company">Company</label>
                                <input type="text" class="form-control" required name="company" id="company" placeholder="e.g Axa Corporation">
                              
                            </div>
                            </div>
                            <div class="form-group">
                                <label for="job_title">Job title</label>
                                <input type="text" class="form-control" required name="job_title" id="job_title" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" required name="location" id="location" placeholder="">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="description" name="description" class="text-jqte dN"></textarea>
                                <div class="text-danger err_d"></div>
                            </div>
                        </div>

                    </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="create">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="post_update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="_jobhead">Post a job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="forms-sample" id="frmpost_update">
          
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 ">
                        <input type="hidden" id="hidden_id" name="hidden_id">
                            <div class="form-group">
                                <label for="company">Company</label>
                                <input type="text" class="form-control" name="edit_company" id="edit_company" placeholder="e.g Axa Corporation">
                              
                            </div>
                            <div class="form-group">
                                <label for="job_title">Job title</label>
                                <input type="text" class="form-control" name="edit_job_title" id="edit_job_title" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" name="edit_location" id="edit_location" placeholder="">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="edit_description" id="edit_description" class="text-jqte dN"></textarea>
                                <div class="text-danger err_d"></div>
                                <!-- <p class="" id="edit_description"></p> -->
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update_data">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>