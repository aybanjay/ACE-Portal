<?php 
include 'admin/db_connect.php'; 
?>
<style>
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
.gallery-list{
cursor: pointer;
border: unset;
flex-direction: inherit;
}
.gallery-img,.gallery-list .card-body {
    width: calc(50%)
}
.gallery-img img{
    border-radius: 5px;
    min-height: 50vh;
    max-width: calc(100%);
}
span.hightlight{
    background: yellow;
}
.carousel,.carousel-inner,.carousel-item{
    
   min-height: calc(100%)
}
header.masthead,header.masthead:before {
        min-height: 50vh !important;
        height: 50vh !important

    }
.row-items{
    position: relative;
}
.masthead{
        min-height: 23vh !important;
        height: 23vh !important;
    }
     .masthead:before{
        min-height: 23vh !important;
        height: 23vh !important;
    }

    /* CSS FOR BUTTONS */
.detailsbutton {
  position: relative;
  display: inline-block;
  margin: 15px;
  padding: 15px 30px;
  text-align: center;
  font-size: 18px;
  letter-spacing: 1px;
  text-decoration: none;
  color: #3e9e4b;
  background: transparent;
  cursor: pointer;
  transition: ease-out 0.5s;
  border: 2px solid #3e9e4b;
  border-radius: 10px;
  box-shadow: inset 0 0 0 0 #3e9e4b;
}

.detailsbutton:hover {
  color: white;
  box-shadow: inset 0 -100px 0 0 #3e9e4b;
}

.detailsbutton:active {
  transform: scale(0.9);
}

</style>

<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-75 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h1 class="text-uppercase text-white font-weight-bold mt-5">Job List</h1>
                   
            </div>
            
        </div>
    </div>
</header>

<!--- SEARCH BOX --->
<div class="container mt-3 pt-2">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="filter-field"><i class="fa fa-search"></i></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Filter" id="filter" aria-label="Filter" aria-describedby="filter-field">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-success btn-block btn-sm" id="search">Search</button>
                </div>
            </div>
            
        </div>
    </div>

   <?php
    $event = $conn->query("SELECT c.*,u.name from careers c inner join users u on u.id = c.user_id where confirmed_at is not null order by id desc");

    if ($event->num_rows < 1) {
    ?>
    <div class="text-center mb-3 alert alert-warning">No available jobs at the moment. Check again later.</div>
    <?php
    } else {

    while($row = $event->fetch_assoc()):
        $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['description']),$trans);
        $desc=str_replace(array("<li>","</li>"), array("",","), $desc);
    ?>

    <div class="card job-list" data-id="<?php echo $row['id'] ?>">
        <div class="card-body shadow-lg rounded">
            <div class="row  align-items-center justify-content-center text-center h-100">
                <div class="">

                    <h3><b class="filter-txt"><?php echo ucwords($row['job_title']) ?></b></h3>
                    <div>
                    <span class="filter-txt"><small><i class="fa fa-building" style="color: blue; font-size: 18px;"></i> <?php echo ucwords($row['company']) ?></b></small></span>

                    <span class="filter-txt"><small><i class="fas fa-map-marker-alt" aria-hidden="true" style="color:red; font-size: 18px;" ></i> <?php echo ucwords($row['location']) ?></b></small></span>
                    </div>
                    <hr style="max-width: 600px;">
                    <larger class="truncate filter-txt"><?php echo strip_tags($desc) ?></larger>
                    <br>
                    <hr class="divider-light"  style="max-width: 300px;">
                    
                    <button class="read_more detailsbutton" data-id="<?php echo $row['id'] ?>">View Details</button>
                </div>
            </div>
            

        </div>
    </div>
    <br>
    <?php endwhile;
    } ?>
    
</div> 


<footer style="background-color: #bcc2be;">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-12 mt-4 mb-3">
          <img src="assets/img/upanglogo.png" style="width:100px">
        </div>

        <div class="col-lg-3 col-md-6 mt-4 mb-3">
          <ul class="list-unstyled mb-0">
            <li class="mb-1">
              <a href="index.php?page=careers" style="color: #4f4f4f;">Jobs</a>
            </li>
            <li class="mb-1">
              <a href="index.php?page=about" style="color: #4f4f4f;">About</a>
            </li>
            
            <li class="mb-1">
              <a href="#" style="color: #4f4f4f;">Terms & Conditions</a>
            </li>
          </ul>
        </div>
        
      </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); color: #4f4f4f;">
      © 2022 Copyright: Ace Portal</div>
    
  </footer>


<script>
    
    
    $('.read_more').click(function(){
        uni_modal("Career Opportunity","view_jobs.php?id="+$(this).attr('data-id'),'mid-large')
    })

   $('#filter').keypress(function(e){
    if(e.which == 13)
        $('#search').trigger('click')
   })
    $('#search').click(function(){
        var txt = $('#filter').val()
        start_load()
        if(txt == ''){
        $('.job-list').show()
        end_load()
        return false;
        }
        $('.job-list').each(function(){
            var content = "";
            $(this).find(".filter-txt").each(function(){
                content += ' '+$(this).text()
            })
            if((content.toLowerCase()).includes(txt.toLowerCase()) == true){
                $(this).toggle(true)
            }else{
                $(this).toggle(false)
            }
        })
        end_load()
    })

</script>