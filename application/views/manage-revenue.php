
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Revenue Tracker || Manage Revenue</title>
<?php echo link_tag('assets/css/bootstrap.min.css')?>
	<?php echo link_tag('assets/css/datepicker3.css')?>
	<?php echo link_tag('assets/css/styles.css')?>
	<?php echo link_tag('assets/css/font-awesome.min.css')?>
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<?php include APPPATH.'views/includes/header.php';?>	
<?php include APPPATH.'views/includes/sidebar.php';?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Revenue</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Revenue</div>
					<div class="panel-body">
	<!--success message -->
<?php if($this->session->flashdata('success')){?>
<p style="color:red"><?php  echo $this->session->flashdata('success');?></p>
<?php } ?>
<div>
<a href="/detsci/index.php/Revenue/add" class="btn btn-primary">Add New</a><br>	
</div>
<div style="clear: both;">&nbsp;</div>
						<div class="col-md-12">
							
							<div class="table-responsive">
            <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Revenue Item</th>
                  <th>Revenue Cost</th>
                  <th>Revenue Date</th>
                  <th>Posting Date</th>
                  <th>Remarks</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php
if(count($revenuedetails)):
	$cnt=1;
foreach($revenuedetails as $row):
?>
              <tbody>
                <tr>
                  <td><?php echo $cnt;?></td>
              
                  <td><?php  echo $row->RevenueItem;?></td>
                  <td><?php  echo $row->RevenueCost;?></td>
                  <td><?php  echo $row->RevenueDate;?></td>                 
                    <td><?php  echo $row->NoteDate?></td>
                     <td><?php  echo $row->remarks;?></td>
                  <td>
                  	<a href="delete/<?php echo $row->ID; ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a> | <?php echo anchor("Revenue/editdata/{$row->ID}",'Edit'); ?> | 
                <a data-toggle="modal" data-target="#myModal" 
                  onclick="javascript:load_Revenue(<?php echo $row->ID; ?>)">View</a> 

                  </td>
                </tr>
                <?php 
$cnt=$cnt+1;
endforeach;
else:
?>
<tr>
	<td colspan="5" style="color:red; text-align:center">No Record found</td>
</tr>
<?php endif;?>
               
              </tbody>
            </table>
          </div>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include APPPATH.'views/includes/footer.php';?>
		</div><!-- /.row -->
	</div><!--/.main-->
	
<script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/chart.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/chart-data.js');?>"></script>
	<script src="<?php echo base_url('assets/js/easypiechart.js');?>"></script>
	<script src="<?php echo base_url('assets/js/easypiechart-data.js');?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-datepicker.js');?>"></script>
	<script src="<?php echo base_url('assets/js/custom.js');?>"></script>
	
</body>
</html>
<div class="modal fade displaycontent" id="myModal">
<?php include APPPATH.'views/revenue-modal.php';?>

<script type="text/javascript">
//$(".modal-dialog").hide();
function load_Revenue(id)
{
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('Revenue/getrevenue');?>",
                data: "id="+id,
                success: function (response) {
                  // alert(response);
                $(".displaycontent").html(response);
                  
                }
            });
}
</script>
