<link rel="stylesheet" href="/css/all.css">
<link rel="stylesheet" href="/css/complaint.css">
<link rel="stylesheet" href="/css/Register.css">


<<?php $form = \app\core\form\Form::begin("","post",'',[""]); ?>
      <div class = "form-content">
        <ul class = "form-section page-section">
              <li class="form-line" id="id_1">
                <label class="form-label form-label-top" id="label_1" > Complaint Date: </label>
                <div id="cid_3" class="form-input-wide">
                    <div data-wrapper-react="true">
                        <!-- <input class="form-textbox"  type="date" id="input_1" name="complaint-date"> -->
                        <?php echo $form->fieldonly($model,'ComplaintDate',["input","form-textbox"]); ?>
                    </div>
                  </div>
              </li>           
              <li class="form-line" data-type="control_textbox" id="id_2">
                <label class="form-label form-label-top " id="label_2"> Order ID: </label>
                <div id="cid_9" class="form-input-wide">
                  <!-- <input type="text" id="input_2" name="order-id"  class="form-textbox" data-defaultvalue="" > -->
                  <?php echo $form->fieldonly($model,'OrderID',["input","form-textbox"]); ?>
                </div>
              </li>
              <li class="form-line" data-type="control_datetime" id="id_3">
                <label class="form-label form-label-top form-label-auto" id="label_3"> Order Date: </label>
                <div id="cid_3" class="form-input-wide" >
                    <div data-wrapper-react="true">
                        <!-- <input class="form-textbox" type="date" id="order-date" name="order-date"> -->
                        <?php echo $form->fieldonly($model,'OrderDate',["input","form-textbox"]); ?>
                    </div>
                  </div>
              </li>
              <li class="form-line" id="id-4">
                <label class="form-label form-label-top " id="label_4" > The complaint is regarding: </label>
                <div id="cid_4" class="form-input-wide" >
                  <!-- <select class="form-dropDown" name="complaint-regarding" id="input_4">
                    <option value="">Shop</option>
                    <option value="">Delivery</option>
                  </select> -->
                  <?php echo $form->selectfieldonly($model,'Regarding',['0'=>'Shop','1'=>'Delivery'],["select","form-dropDown"]); ?>
                </div>
              </li>
              <li class="form-line" id="id-5">
                <label class="form-label form-label-top " id="label_5"> Priority: </label>
                <div id="cid_4" class="form-input-wide" >
                <!-- <select class="form-dropDown" name="priority" id="input_5">
                    <option value="">High</option>
                    <option value="">Low</option>
                  </select> -->
                  <?php echo $form->selectfieldonly($model,'Priority',['0'=>'High','1'=>'Low'],["select","form-dropDown"]); ?>
                </div>
              </li>
              <li class="form-line" id="id_6">
                <label class="form-label form-label-top" id="label_6">The nature of complaint: </label>
                <div id="cid_7" class="form-input-wide" >
                  <!-- <textarea id="input_6" class="form-textarea" name="complaint-nature" ></textarea> -->
                  <?php echo $form->textarea($model,'Nature')->setClass(["form-textarea"]); ?>
                </div>
              </li>
              <li class="form-line" id="id_7">
                <label class="form-label form-label-top" id="label_7"> The specific details of the complaint: </label>
                <div id="cid_7" class="form-input-wide" >
                  <!-- <textarea id="input_7" class="form-textarea" name="complaint-specific" ></textarea> -->
                  <?php echo $form->textarea($model,'SpecialDetails'); ?>
                </div>
              </li>
        </ul>
        <div class="form-buttons-wrapper">
            <button id="complaint-submit" type="submit" class="submit-button" data-component="button" data-content="">
              Save
            </button>
        </div>
      </div>   
      <?php \app\core\form\Form::end(); ?>