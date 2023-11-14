<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="add_alumni" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Alumni</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" id="frm_add_alumni">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div id="msg"></div>


                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input type="text" name="lname" id="lname" required class="form-control" value="">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="username">First Name</label>
                                    <input type="text" name="fname" id="fname" required class="form-control" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Middle Name</label>
                                    <input type="text" name="mname" id="mname" class="form-control" value="">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-8">
                                <label for="password">Email</label>
                                <input type="email" name="email" id="email" required class="form-control" value="" autocomplete="off">
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="0" disabled selected>Choose..</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="name">Address <small><em>e.g (Malued, Dagupan City, Pangasinan)</em></small></label>
                                <input type="text" required name="address" id="address" class="form-control" placeholder="Barangay, City, Dagupan">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="password">Course</label>
                                    <select name="course" required id="" class="form-control">
                                        <option value="0" disabled selected>Choose course..</option>

                                        <?php
                                        include_once('../db_connect.php');

                                        $sql = $conn->query("SELECT * FROM courses");

                                        while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['course']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12"><strong>Batch</strong> <small> <em> (Year range)</em></small></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password">Start year</label>
                                    <input type="text" required name="batch_start" id="batch_start" class="form-control">
                                    <small>
                                        <div class="text-danger error_batch_start"></div>
                                    </small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password">End year</label>
                                    <input type="text" required name="batch_end" id="batch_end" class="form-control">
                                    <small>
                                        <div class="text-danger error_batch_end"></div>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <small>
                            <div class="text-danger error_range"></div>
                        </small>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password">Avatar</label>
                                <div class="input-group mb-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Upload profile</label>
                                        <input type="file" id="uploadImage" class="form-control-file" accept="image/*" name="image" id="exampleFormControlFile1">
                                    </div>
                                    <div class="custom-file">
                                        <!-- <input class="custom-file-input" id="uploadImage" type="file" accept="image/*" name="image" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="" alt="" id="iupload_img">
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnsave_">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>