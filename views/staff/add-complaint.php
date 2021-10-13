<link rel="stylesheet" href="/css/all.css">
<link rel="stylesheet" href="/css/complaint.css">
<link rel="stylesheet" href="/css/Register.css">


<<?php $form = \app\core\form\Form::begin("","post",'',[""]); ?>
      <div class = "form-content">
        <ul class = "form-section page-section">
              <!-- <li class="form-line" id=""> -->
                <!-- <label class="form-label form-label-top" id="" > Complaint Date: </label>
                <div id="" class="form-input-wide">
                    <div data-wrapper-react="true"> -->
                        <!-- <input class="form-textbox"  type="date" id="input_1" name="complaint-date"> -->
                         <!-- <?php //echo $form->fieldonly($model,'ComplaintDate',["input","form-textbox"]); ?> -->
                    <!-- </div>
                  </div>
              </li>            --> 
              <li class="form-line" data-type="control_textbox" id="">
                <label class="form-label form-label-top " id=""> Order ID: </label>
                <div id="" class="form-input-wide">
                   <?php echo $form->fieldonly($model,'OrderID',["input","form-textbox"]); ?>
                </div>
              </li>
              <li class="form-line" data-type="control_datetime" id="">
                <label class="form-label form-label-top form-label-auto" id=""> Order Date: </label>
                <div id="" class="form-input-wide" >
                    <div data-wrapper-react="true">
                      <?php echo $form->fieldonly($model,'OrderDate',["input","form-textbox"]); ?>
                    </div>
                  </div>
              </li>
              <li class="form-line" id="">
                <label class="form-label form-label-top " id="" > The complaint is regarding: </label>
                <div id="" class="form-input-wide" >
                  <?php echo $form->selectfieldonly($model,'Regarding',['0'=>'Shop','1'=>'Delivery'],["select","form-dropDown"]); ?>
                </div>
              </li>
              <li class="form-line" id="">
                <label class="form-label form-label-top " id=""> Priority: </label>
                <div id="" class="form-input-wide" >
                  <?php echo $form->selectfieldonly($model,'Priority',['0'=>'High','1'=>'Low'],["select","form-dropDown"]); ?>
                </div>
              </li>
              <li class="form-line" id="">
                <label class="form-label form-label-top" id="">The nature of complaint: </label>
                <div id="" class="form-input-wide" >
                  <?php echo $form->TextAreaOnly($model,'Nature',["textarea","form-textarea"]); ?>
                </div>
              </li>
              <li class="form-line" id="">
                <label class="form-label form-label-top" id=""> The specific details of the complaint: </label>
                <div id=" " class="form-input-wide" >
                  <?php echo $form->TextAreaOnly($model,'SpecialDetails',["textarea","form-textarea"]); ?>
                </div>
              </li>
        </ul>
        <div class="form-buttons-wrapper">
            <button id="" type="submit" class="submit-button">
              Save
            </button>
        </div>
      </div>   
      <?php \app\core\form\Form::end(); ?>