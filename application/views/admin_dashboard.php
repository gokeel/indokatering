      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $count_customer; ?></h3>
                  <p>Total Customer</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url();?>users/user_view?v=all" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $count_order; ?></h3>
                  <p>Total Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo base_url();?>cms/view_order" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                  <!-- <li><a href="#sales-chart" data-toggle="tab">Donut</a></li> -->
                  <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
                </ul>
                <div class="tab-content no-padding">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                  <!-- <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div> -->
                </div>
              </div><!-- /.nav-tabs-custom -->

            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->



<?php include('footer.php');?>
<script>
  // Sales chart
  var data_sales_chart = [
        <?php foreach($total_sales_per_date as $row){
          echo "{day: '".date_format(new DateTime($row->sales_date), 'Y-m-d')."', total: ".$row->total."}, ";
        } ?>
      ];
  var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    data: data_sales_chart,
    // data: [
    //   {y: '2011 Q1', item1: 2666, item2: 2666},
    //   {y: '2011 Q2', item1: 2778, item2: 2294},
    //   {y: '2011 Q3', item1: 4912, item2: 1969},
    //   {y: '2011 Q4', item1: 3767, item2: 3597},
    //   {y: '2012 Q1', item1: 6810, item2: 1914},
    //   {y: '2012 Q2', item1: 5670, item2: 4293},
    //   {y: '2012 Q3', item1: 4820, item2: 3795},
    //   {y: '2012 Q4', item1: 15073, item2: 5967},
    //   {y: '2013 Q1', item1: 10687, item2: 4460},
    //   {y: '2013 Q2', item1: 8432, item2: 5713}
    // ],
    xkey: 'day',
    ykeys: ['total'],
    labels: ['Total'],
    lineColors: ['#a0d0e0'],
    hideHover: 'auto'
  });
</script>
</body>
</html>
