<?php
include("header.php");
?>
<div class="modal" id="edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-dark">Update Price</h3>
          </div>
          <div class="modal-body">
          <p id="up-message" class="text-dark"></p>
           <form id="update_form">
                <input type="hidden" class="form-control mt-2" id="wash_id" name="id"/>
                <label>Amount</label>
                <input type="text" class="form-control mt-2" id="edit_price" name="edit_price" placeholder="Price" required/>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btn_update">Update Now</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close">Close</button>
          </div>
        </div>
      </div>
    </div>
<?php include("footer.php"); ?>