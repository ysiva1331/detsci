<!-- <div class="modal fade" tabindex="-1" id="myModal" role="dialog"> -->
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Expense Datails of </h4>
      </div>
      <div class="modal-body">
        <?php
        // echo "<pre>"; 
        // print_r($data);
        // echo $data[0]['ID'];
      
        ?>
        <table class="table table-striped">
        <tbody>
                <tr>
              <td>Id</td>
              <td><?php echo $data[0]->ID; ?></td>
            </tr>
            <tr>
              <td>Item</td>
              <td><?php echo $data[0]->ExpenseItem; ?></td>
            </tr>
            <tr>
              <td>Cost of Item</td>
              <td><?php echo $data[0]->ExpenseCost; ?></td>
            </tr>
            <tr>
              <td>Date of Expense</td>
              <td><?php 
              $originalDate = $data[0]->ExpenseDate;
$newDate = date("d-M-Y", strtotime($originalDate));
              echo $newDate; 
            ?></td>
            </tr>
             <tr>
              <td>Created Date</td>
              <td><?php 
               $originalDate = $data[0]->NoteDate;
$newDate = date("d-M-Y h:i A", strtotime($originalDate));
              echo $newDate; 
             // echo $data[0]->NoteDate; 
            ?></td>
            </tr>
        </tbody>
    </table>
      </div>
    </div>
  </div>
</div>