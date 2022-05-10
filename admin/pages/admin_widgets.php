
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                      <div class='huge'><?php echo $numposts = recordCount('posts'); ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                      <div class='huge'><?php echo $numcomments = recordCount('comments'); ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                      <div class='huge'><?php echo $numusers = recordCount('users'); ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                      <div class='huge'><?php echo $numcategories = recordCount('categories'); ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php
// KK Aproved
$numpublished = checkStatus('posts', 'post_status', 'Published');

$numapproved= checkStatus('comments', 'comment_status', 'Approved');

$default_published = 0;

// KK Not aproved
$numdrafts= checkStatus('posts', 'post_status', 'Draft');

$numpending= checkStatus('comments', 'comment_status', 'Pending');

$default_draft = 0;

// Users
$numsubscriber= checkStatus('users', 'user_role', 'Subscriber');

$numadmin= checkStatus('users', 'user_role', 'Admin');

$default_users = 0;
?>
<!-- KK: chart -->
<div class="row">
  <script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Data', 'All', 'Published', 'Draft'],
        <?php
        $chart_text = ['Posts', 'Comments', 'Users' ,'Categories'];
        $chart_count = [$numposts, $numcomments, $numusers, $numcategories];
        $chart_published = [$numpublished, $numapproved, $numadmin, 0];
        $chart_unpublished = [$numdrafts, $numpending, $numsubscriber, 0];


        for ($i=0; $i <4; $i++) {
          echo "[
                  '{$chart_text[$i]}'
                  " .
                  ","
                  . "{$chart_count[$i]}
                  " .
                  ","
                  . "{$chart_published[$i]}
                  " .
                  ","
                  . "{$chart_unpublished[$i]}
                ], " ;
        }
        ?>
      ]);

      var options = {
        vAxis: {format: 'decimal'}
      };

      var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  <div id="columnchart_material" style="width: 'auto'; height: 500px; margin:50px;"></div>
</div>
