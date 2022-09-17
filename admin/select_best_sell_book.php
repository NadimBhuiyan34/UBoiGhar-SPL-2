<?php
    require_once('functions/function.php');
    needLogged();
    if($_SESSION['role']=='1'){
    get_header();
    get_sidebar();

    $per_page=5;
    $start=0;
    $current_page=1;
    if(isset($_GET['start'])){
    	$start=$_GET['start'];
    	if($start<=0){
    		$start=0;
    		$current_page=1;
    	}else{
    		$current_page=$start;
    		$start--;
    		$start=$start*$per_page;
    	}
    }
    $record=mysqli_num_rows(mysqli_query($con,"SELECT * FROM adm_newbook"));
    $pagi=ceil($record/$per_page);
?>
    <div class="col-md-12">
    	<div class="panel panel-primary">
            <div class="panel-heading">
                <div class="col-md-9 heading_title">
                    Select the Best Sell books
                 </div>
                 <div class="col-md-3 text-right">

                  <a href="all-best_sell_book.php" class="btn btn-sm btn btn-primary"><i class="fa fa-plus-circle"></i> All Best Sell book</a>
                </div>
                <div class="clearfix"></div>
            </div>
          <div class="panel-body">
              <table class="table table-responsive table-striped table-hover table_cus">
              		<thead class="table_head">
                		<tr>
                      	<th>Book Title</th>
                        <th>Book Edition</th>
                        <th>Book Price</th>
                        <th>Book Stock</th>
                        <th>Book Status</th>
                        <th>Book Image</th>
                        <th>Manage</th>
                    </tr>
                	</thead>
                    <tbody>
                      <?php
                          $sel="SELECT * FROM adm_newbook limit $start,$per_page";
                          $Q=mysqli_query($con,$sel);
                          while($data=mysqli_fetch_assoc($Q)){
                            if ($data['status'] == "1") {
                      ?>
                    	<tr>
                        	<td><?= substr($data['book_title'],0,25);?>...</td>
                          <td><?= $data['book_edition']; ?></td>
                          <td><?= $data['book_price']; ?></td>
                          <td><?= $data['book_stock']; ?></td>
                          <td><?= $data['status']; ?></td>
                          <td>
                              <?php
                                if($data['book_img']!=''){
                              ?>
                                <img width="50" src="uploads/<?= $data['book_img']; ?>" alt="Image"/>
                              <?php
                                }else{
                              ?>
                                <img width="50" src="images/avatar.png" alt="Image"/>
                              <?php } ?>
                          </td>
                          <td>
                          	<a href="view-book.php?v=<?= $data['id']; ?>"><i class="fa fa-eye fa-lg"></i></a>
                              <a href="move_to_best_sellbook.php?ed=<?= $data['id']; ?>"><i class="fa fa-arrow-circle-o-right fa-lg"></i></a>

                          </td>
                        </tr>
                        <?php
                      }
                    } ?>
                    </tbody>
              </table>
          </div>
          <div class="panel-footer">
            <div class="col-md-4">
            	<a href="#" class="btn btn-sm btn-warning">EXCEL</a>
                <a href="#" class="btn btn-sm btn-primary">PDF</a>
                <a href="#" class="btn btn-sm btn-danger">SVG</a>
                <a href="#" class="btn btn-sm btn-success">PRINT</a>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-right">
            	<nav aria-label="Page navigation">
                <ul class="pagination mt-30">
                  <li>
                    <a href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                <?php
                for($i=1;$i<=$pagi;$i++){
                $class='';
                if($current_page==$i){
                  ?><li class="page-item active"><a class="page-link" href="javascript:void(0)"><?php echo $i?></a></li><?php
                }else{
                ?>
                  <li class="page-item"><a class="page-link" href="?start=<?php echo $i?>"><?php echo $i?></a></li>
                <?php
                }
                ?>

                <?php } ?>
                <li>
                  <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
                </ul>
                </nav>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
    </div><!--col-md-12 end-->
<?php
    get_footer();
  }else{
      echo "Access Denied! You have no permission access this page.";
  }
?>
