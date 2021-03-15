<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Assignment</title>

    <!-- Bootstrap -->
    <link href="assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- iCheck -->
    <link href="assets/iCheck/skins/flat/green.css" rel="stylesheet">

    <link href="assets/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="assets/css/custom.css" rel="stylesheet">
  </head>
<?php
 
 
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><span>Assignment</span></a>
            </div>

            <div class="clearfix"></div>

            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="#"><i class="fa fa-table"></i> Issues </a></li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">John Doe
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
  
              <div class="clearfix"></div>
  
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Issues</small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="close-add" href="form.html"><i class="fa fa-plus"></i> Add</a>
                        <li><a class="close-add issue-del"><i class="fa fa-remove"></i> Delete</a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
  
                    <div class="x_content">
  
                      <div class="table-responsive">
                        <table class="table table-striped jambo_table">
                          <thead>
                            <tr class="headings">
                              <th>
                                <input type="checkbox" id="check-all" class="flat allcheck">
                              </th>
                              <th class="column-title">Issue Id </th>
                              <th class="column-title">Subject </th>
                              <th class="column-title">Status </th>
                              <th class="column-title">Priority </th>
                              <th class="column-title">Due Date </th>
                              <th class="column-title">Assignee </th>
                              <th class="column-title">Reviewer</th>
                              <th class="column-title">Target Version</th>
                            </tr>
                          </thead>
  
                          <tbody>
                           
                              <?php 
                                 require_once('config/DbConn.php');
                                 $obj = DbConn::getConnect();
                                 $result = DbConn::getAllData('SELECT issue_id, subject, description, status, priority, region, due_date, assignee, reviewer, version, image_path, reviewer_comment FROM issue WHERE is_deleted !=1 ');
                                 
                              foreach($result as $key => $valData){  ?> 
                               <tr class="even pointer">                             
                              <td class="a-center ">
                                <input type="checkbox" class="flat" name="table_records[]"  value="<?php echo $valData['issue_id'] ?>">
                              </td>
                              <td class=" "><?php echo $valData['issue_id'] ?></td>
                              <td class=" "><?php echo $valData['subject'] ?></td>
                              <td class=" "><?php echo $valData['status'] ?></td>
                              <td class=" "><?php echo $valData['priority'] ?></td>
                              <td class=" "><?php echo date("d-M-Y", strtotime($valData['due_date'])) ?></td>
                              <td class=" "><?php echo $valData['assignee'] ?></td>
                              <td class=" "><?php echo $valData['reviewer'] ?></td>
                              <td class=" last"> <?php echo $valData['version'] ?>
                              </td>
                              </tr>
                             <?php } ?>
                           
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="assets/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="assets/fastclick/lib/fastclick.js"></script>
    <!-- iCheck -->
    <script src="assets/iCheck/icheck.min.js"></script>
    <!-- DateJS -->
    <script src="assets/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="assets/moment/min/moment.min.js"></script>

    <script src="assets/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Autosize -->
    <script src="assets/autosize/dist/autosize.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="assets/js/custom.js"></script>
    <script>
       $('#check-all').on('ifChecked', function (event) {  
        $('input[name^="table_records[]"]').prop('checked',true);
        $('input[name^="table_records[]"]').parent('div').addClass('checked'); 
          
      });
      $('#check-all').on('ifUnchecked', function (event) { 
        $('input[name^="table_records[]"]').parent('div').removeClass('checked');
        $('input[name^="table_records[]"]').prop('checked',false);
      });
      
      $('.issue-del').click(function(){
        var ids=[];
        var values = $("input[name='table_records[]']")
              .map(function(){               
                if ($(this).prop('checked')==true){ 
                  ids.push($(this).val()) ;
                }
              
              }).get();
            
        let  data ={
          'issueids':"'" + ids.join("','") + "'"
        };
        
         $.ajax({
            type: 'POST',
            url: "issue.php/deleteIssue",
            data: data,
            dataType: "text",
            success: function(result) { 
              if(result)  {
               alert('Record deleted successfully');
               // location.reload();              
              }else{
                alert('Something went worng.');
              }
            }
        });
      })
      
      
    </script>                                
  </body>
</html>
