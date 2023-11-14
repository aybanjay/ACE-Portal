<div class="modal fade" id="edit_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Problem with your vitae?</h4>
                                <p class="card-description"> Fix it hereUpdate your curriculum vitae </p>
                                <form class="forms-sample" id="frmcv_update">
                                    <?php
                                    $id = $_SESSION['bio']['id'];
                                    $sql = $conn->query("SELECT * FROM alumnus_bio WHERE id = '$id'");
                                    $row = $sql->fetch_assoc();


                                    ?>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <h5 class="card-title">Personal details</h5>
                                            <hr>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <input type="hidden" id="hidden_id_update" name="hidden_id_update">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputUsername1">Full name</label>
                                                        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'];  ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email address</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Address</label>
                                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Contact number</label>
                                                        <input type="text" class="form-control" id="cnumber" name="cnumber" placeholder="e.g 0989-098-2910">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Gender</label>
                                                            <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $row['gender']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <h5 class="card-title">Job history</h5>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">Job title</label>
                                                            <input type="text" class="form-control" id="job_title" name="job_title" placeholder="e.g Web Developer">
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">Employer</label>
                                                            <input type="text" class="form-control" id="emp" name="emp" placeholder="e.g Accenture">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">Start date</label>
                                                            <input type="text" class="form-control" id="sdate" name="sdate">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">End date</label>
                                                            <input type="text" class="form-control" id="edate" name="edate">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"></div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <h5 class="card-title">Education</h5>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">Course</label>
                                                            <?php
                                                            $cid = $row['course_id'];
                                                            $qry = $conn->query("SELECT id, course FROM courses WHERE id='$cid'");
                                                            $srow = $qry->fetch_assoc();
                                                            ?>
                                                            <input type="text" class="form-control" id="course" name="course" value="<?php echo $srow['course']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">Batch</label>
                                                            <input type="text" class="form-control" id="batch" name="batch" value="<?php echo $row['batch']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">

                                                    <div class="col-md-12">
                                                        <h5 class="card-title">Character references </h5>
                                                        <p class="text-mute text-sm"> <small class=""> Please add three.</small></p>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">Full name</label>
                                                            <input type="text" class="form-control" id="cfname" name="cfname">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">position</label>
                                                            <input type="text" class="form-control" id="position" name="position">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">Contact number</label>
                                                            <input type="text" class="form-control" id="cn" name="cn">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">Full name</label>
                                                            <input type="text" class="form-control" id="cfname2" name="cfname2">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">position</label>
                                                            <input type="text" class="form-control" id="position2" name="position2">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">Contact number</label>
                                                            <input type="text" class="form-control" id="cn2" name="cn2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">Full name</label>
                                                            <input type="text" class="form-control" id="cfname3" name="cfname3">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">position</label>
                                                            <input type="text" class="form-control" id="position3" name="position3">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">Contact number</label>
                                                            <input type="text" class="form-control" id="cn3" name="cn3">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-2">

                                                    <div class="col-md-12">
                                                        <h5 class="card-title">Skills </h5>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputConfirmPassword1">
                                                                Use comma (,) to separate each skills.
                                                            </label>
                                                            <textarea class="form-control" name="skills" id="skills" cols="30" rows="10"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row py-2">

                                                    <div class="col-md-12">
                                                        <h5 class="card-title">Tell us more about you. </h5>

                                                        <textarea name="objectives" id="objectives" cols="10" rows="5" class="form-control"></textarea>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>



                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>

                </form>
            </div>
        </div>
    </div>