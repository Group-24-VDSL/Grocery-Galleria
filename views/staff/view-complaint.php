<?php
/** @var $model \app\models\Complaint **/
/** @var $complaintlist \app\models\Complaint **/

use app\models\Complaint ;
?>


<div class="core core-complaint">
          <div class="complaint-heading">
            <h1 class="heading">User <span>Complaints</span></h1>
            <a href="/dashboard/staff/addcomplaint"><button class="btn-add" type="submit" id="add-button"><span class="" ><i class='bx bx-plus'></i></span></button> </a>
          </div>
          <div class="container-items">

            <!-- <div class = "complaint-content main"> -->
                <div class="complaint-content-header">
                    <div class = "complaint-header-element" >

<!--                                <li class="header-line" id="">-->
<!--                                    <label class="header-label header-label-top " id="" > Show  :  </label>-->
<!--                                    <div id="" class="form-input-wide" >-->
<!--                                      <select class="header-dropDown" name="complaint-regarding" id="input_11">-->
<!--                                        <option value=""> All</option>-->
<!--                                        <option value=""> New </option>-->
<!--                                        <option value=""> Attended</option>-->
<!--                                      </select>-->
<!--                                    </div>-->
<!--                                </li>-->
<!--                                <li class="header-line" id="">-->
<!--                                    <label class="header-label header-label-top " id="" >Priority Select By: &nbsp; &nbsp; &nbsp; &nbsp;</label>-->
<!--                                    <div id="" class="form-input-wide" >-->
<!--                                      <select class="header-dropDown" name="" id="">-->
<!--                                        <option value="" ></option>-->
<!--                                        <option value="1">High priority</option>-->
<!--                                        <option value="2">Low priority</option>-->
<!--                                      </select>-->
<!--                                    </div>-->
<!--                                </li>-->
<!--                            <li class="header-line" id="">-->
<!--                                <label class="header-label header-label-top " id="" >Select by Status: &nbsp; &nbsp; &nbsp; &nbsp;</label>-->
<!--                                <div id="" class="form-input-wide" >-->
<!--                                    <select class="header-dropDown" name="" id="">-->
<!--                                        <option value="1">New</option>-->
<!--                                        <option value="2">Resolve</option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                            </li>-->

<!--                        <div class="view">   -->
<!--                            <span class="header-label header-label-top view-button-left">Previous </span><a href=""> <i class='bx bxs-left-arrow'></i></a>-->
<!--                             <a href="./add-complaint.php"><i class='bx bxs-right-arrow'></i></a> <span class="header-label header-label-top view-button-right">Next</span>-->
<!--                        </div>-->
                    </div>
                    
                    <table class = "complaint-table" id="complaint-table">
                        <thead class="complaint-table-header">
                            <tr>
                                <td>Complaint ID</td>
                                <td>Complaint Date</td>
                                <td>Order ID</td>
                                <td>Order Date</td>
                                <td>Regarding</td>
                                <td>Priority</td>
                                <td>Status</td>
                                <td>View Description</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody id="compliantTable" class="complaint-table-body">
                        <?php $form = \app\core\form\Form::begin("http://localhost/dashboard/staff/viewcomplaints","post",'',[""]); ?>


                        <?php \app\core\form\Form::end()?>
                        </tbody>
                    </table>
                </div>
              </div>   
        </div>


<script src="/js/complaint.js" defer></script>
<link rel="stylesheet" href="/css/complaint.css" />