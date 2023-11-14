<?php include('db_connect.php');?>
<div class="container-fluid">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row">
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Reports</b>
                        <!-- <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="index.php?page=manage_alumni" id="new_alumni">
                    <i class="fa fa-plus"></i> New Entry
                </a></span> -->
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover">
                            <!-- <colgroup>
                                <col width="5%">
                                <col width="10%">
                                <col width="15%">
                                <col width="15%">
                                <col width="30%">
                                <col width="15%">
                            </colgroup> -->
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Avatar</th>
                                    <th class="">Name</th>
                                    <th class="">Course Graduated</th>
                                    <th class="">Job Applied for</th>
                                    <th class="">Application Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $alumni = $conn->query('SELECT users.id as user_id, alumnus_bio.*,alumnus_bio.id AS aid, courses.course, CONCAT(alumnus_bio.lastname,", ",alumnus_bio.firstname," ",alumnus_bio.middlename) as `name`, applicants.status as application_status, applicants.date_updated, careers.job_title, careers.id as job_id FROM applicants JOIN careers ON careers.id = applicants.career_id JOIN users ON users.id = applicants.user_id JOIN alumnus_bio ON alumnus_bio.id = users.alumnus_id JOIN courses ON courses.id =  alumnus_bio.course_id ORDER BY CONCAT(alumnus_bio.lastname,", ",alumnus_bio.firstname," ",alumnus_bio.middlename) ASC');
                                if ($alumni->num_rows > 0 ) {
                                $i = 1;

                                while($row=$alumni->fetch_assoc()):




                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="text-center">
                                        <div class="avatar">
                                         <img src="assets/uploads/<?php echo $row['avatar'] ?>" class="" alt="">
                                        </div>
                                    </td>
                                    <td class="">
                                         <p> <b><?php echo ucwords($row['name']) ?></b></p>
                                    </td>
                                    <td class="">
                                         <p> <b><?php echo $row['course'] ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <p> <b><?php echo $row['job_title'] ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                            switch($row['application_status']) {
                                                case 1:
                                                    $application_class = 'text-info';
                                                    $application_status = 'Shortlisted';
                                                    break;
                                                case 2:
                                                    $application_class = 'text-warning';
                                                    $application_status = 'Interviewed';
                                                    break;
                                                case 3:
                                                    $application_class = 'text-success';
                                                    $application_status = 'Hired';
                                                    break;
                                                default:
                                                    $application_class = 'text-secondary';
                                                    $application_status = 'Pending';
                                                    break;
                                            }

                                        ?>
                                        <p> <b><span class="<?php echo $application_class; ?>"><?php echo $application_status; ?> </span> as of <?php echo date('M d, Y h:i A', strtotime($row['date_updated'])); ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary view_alumni" type="button" data-id="<?php echo $row['aid'] ?>" data-status="<?php echo $row['application_status'] ?>">View</button>
                                    </td>
                                </tr>
                                <?php endwhile; }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>

</div>
<style>

    td{
        vertical-align: middle !important;
    }
    td p{
        margin: unset
    }
    img{
        max-width:100px;
        max-height: 150px;
    }
    .avatar {
        display: flex;
        border-radius: 100%;
        width: 100px;
        height: 100px;
        align-items: center;
        justify-content: center;
        border: 3px solid;
        padding: 5px;
    }
    .avatar img {
        max-width: calc(100%);
        max-height: calc(100%);
        border-radius: 100%;
    }
</style>
<script>
    $(document).ready(function(){
        $('table').dataTable()
    })

    $('.view_alumni').click(function(){
        uni_modal("Bio","view_alumni.php?id="+$(this).attr('data-id')+"&astatus="+$(this).attr('data-status'),'mid-large')

    })
</script>