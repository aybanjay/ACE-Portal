<?php include 'db_connect.php' ?>
<style>
    span.float-right.summary_icon {
        font-size: 3rem;
        position: absolute;
        right: 1rem;
        color: #ffffff96;
    }

    .imgs {
        margin: .5em;
        max-width: calc(100%);
        max-height: calc(100%);
    }

    .imgs img {
        max-width: calc(100%);
        max-height: calc(100%);
        cursor: pointer;
    }

    #imagesCarousel,
    #imagesCarousel .carousel-inner,
    #imagesCarousel .carousel-item {
        height: 60vh !important;
        background: black;
    }

    #imagesCarousel .carousel-item.active {
        display: flex !important;
    }

    #imagesCarousel .carousel-item-next {
        display: flex !important;
    }

    #imagesCarousel .carousel-item img {
        margin: auto;
    }

    #imagesCarousel img {
        width: auto !important;
        height: auto !important;
        max-height: calc(100%) !important;
        max-width: calc(100%) !important;
    }

    .long_text {
        width: 100px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<div class="containe-fluid">
    <div class="row mt-3 ml-3 mr-3">
        <?php //print_r($_SESSION);  
        ?>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <strong><?php echo "Welcome back " . $_SESSION['login_name'] . "!"  ?></strong>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body bg-success">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-users"></i></span>
                                        <h4><b>
                                                <?php echo $conn->query("SELECT * FROM alumnus_bio where status = 1")->num_rows; ?>
                                            </b></h4>
                                        <p>Alumni</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body bg-primary">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-briefcase"></i></span>
                                        <h4><b>
                                                <?php echo $conn->query("SELECT * FROM careers")->num_rows; ?>
                                            </b></h4>
                                        <p>Posted jobs</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body bg-danger">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-users"></i></span>
                                        <h4><b>
                                                <?php echo $conn->query("SELECT * FROM applicants where status = 1")->num_rows; ?>
                                            </b></h4>
                                        <p>Short Listed</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body bg-warning">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-users"></i></span>
                                        <h4><b>
                                                <?php echo $conn->query("SELECT * FROM applicants where status = 2")->num_rows; ?>
                                            </b></h4>
                                        <p>Interviewed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body bg-info">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-users"></i></span>
                                        <h4><b>
                                                <?php echo $conn->query("SELECT * FROM applicants where status = 3")->num_rows; ?>
                                            </b></h4>
                                        <p>Hired</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <strong>Hired alumni per colleges</strong>
                    <hr>

                    <div class="row">
                        <?php
                        $sql = $conn->query("SELECT * FROM courses");

                        $row = $sql->fetch_all(MYSQLI_ASSOC);
                        $cnt = 0;
                        foreach ($row as $key) {
                            if ($cnt % 2 == 0) {
                                $class = "bg-info";
                            } else {
                                $class = "bg-warning";
                            }
                            $cid = $key['id'];

                            $qry = $conn->query("SELECT applicants.*,users.*,alumnus_bio.* FROM users INNER JOIN applicants ON applicants.user_id = users.id INNER JOIN alumnus_bio ON alumnus_bio.id = users.alumnus_id WHERE 
                                                applicants.status=3 AND alumnus_bio.status = 1 AND alumnus_bio.course_id = '$cid'");

                            $srow = $qry->num_rows;
                        ?>
                            <div class="col-md-3 mx-0">
                                <div class="card" data-toggle="tooltip" data-placement="top" title="<?php echo $key['course']; ?>">
                                    <div class="card-body <?php echo $class ?>">
                                        <div class="card-body text-white">
                                            <span class="float-right summary_icon"><i class="fa fa-graduation-cap"></i></span>
                                            <h4> <b><?php echo $srow ?></b></h4>
                                            <p class="long_text">
                                                <?php echo $key['course'] ?>
                                            </p>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php

                            $cnt++;
                        }
                        ?>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <strong>Hired alumni per company</strong>
                    <hr>
                    <div class="row">
                        <?php
                        $sql = $conn->query("SELECT * FROM company_profile");

                        $row = $sql->fetch_all(MYSQLI_ASSOC);
                        $cnt = 0;
                        foreach ($row as $key) {
                            if ($cnt % 2 == 0) {
                                $class = "bg-success";
                            } else {
                                $class = "bg-primary";
                            }
                            $cid = $key['id'];

                            $qry = $conn->query("SELECT applicants.*,users.*,company_profile.*,careers.* FROM careers INNER JOIN applicants ON applicants.career_id = careers.id INNER JOIN 
                             users ON careers.user_id = users.id INNER JOIN company_profile ON users.id = company_profile.user_id WHERE STATUS=3 AND company_profile.id = '$cid'");

                            $srow = $qry->num_rows;
                        ?>
                            <div class="col-md-3 mt-3">
                                <div class="card" data-toggle="tooltip" data-placement="top" title="<?php echo $key['name']; ?>">
                                    <div class="card-body <?php echo $class ?>">
                                        <div class="card-body text-white">
                                            <span class="float-right summary_icon"><i class="fa fa-building"></i></span>
                                            <h4> <b><?= $srow ?></b></h4>
                                            <p class="long_text">
                                                <?php echo $key['name']; ?>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php

                            $cnt++;
                        }
                        ?>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#manage-records').submit(function(e) {
        e.preventDefault()
        start_load()
        $.ajax({
            url: 'ajax.php?action=save_track',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                resp = JSON.parse(resp)
                if (resp.status == 1) {
                    alert_toast("Data successfully saved", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 800)

                }

            }
        })
    })
    $('#tracking_id').on('keypress', function(e) {
        if (e.which == 13) {
            get_person()
        }
    })
    $('#check').on('click', function(e) {
        get_person()
    })

    function get_person() {
        start_load()
        $.ajax({
            url: 'ajax.php?action=get_pdetails',
            method: "POST",
            data: {
                tracking_id: $('#tracking_id').val()
            },
            success: function(resp) {
                if (resp) {
                    resp = JSON.parse(resp)
                    if (resp.status == 1) {
                        $('#name').html(resp.name)
                        $('#address').html(resp.address)
                        $('[name="person_id"]').val(resp.id)
                        $('#details').show()
                        end_load()

                    } else if (resp.status == 2) {
                        alert_toast("Unknow tracking id.", 'danger');
                        end_load();
                    }
                }
            }
        })
    }
</script>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>