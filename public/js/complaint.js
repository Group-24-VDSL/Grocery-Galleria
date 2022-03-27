
//Api links
const host = window.location.origin; //http://domainname

const URLComplaints = host + "/api/getcomplaints" ;

const ComplaintTable = document.getElementById('compliantTable');

$(document).ready(function complaint() {

  $.getJSON(URLComplaints, function (Complaints) {
    Complaints.forEach(Complaint=>{
        let status = '';
        let priority = '';
        let regarding = '' ;
        let attendButton = '' ;

      const complaintRow = document.createElement('tr');
      let com = parseInt(Complaint.ComplaintID) ;
      console.log(com)

        switch (Complaint.Priority){
            case 0 : priority = "High"; break ;
            case 1 : priority = "Low"; break ;
        }

        switch (Complaint.Regarding){
            case 0 : regarding = "Shop"; break ;
            case 1 : regarding = "Delivery"; break ;
            case 2 : regarding = "Shop/Delivery"; break ;
        }

        switch (Complaint.Status){
            case 0 : status = "New";
                complaintRow.innerHTML = `
                <td>${Complaint.ComplaintID}</td> 
                <td>${Complaint.ComplaintDate}</td> 
                <td>${Complaint.OrderID}</td> 
                <td>${Complaint.OrderDate}</td> 
                <td>${regarding}</td>  
                <td>${priority}</td> 
                <td>${status}</td>  
                <td>
                     <button onclick="showDescription(${Complaint.ComplaintID})" class="btn-description" type="submit" id="desc-button"><span class="" ><i class="bx bx-show-alt"></i></span></button> 
                     <div id="desc${Complaint.ComplaintID}" class="description">
                     <div class="description-content">
                     <div class="close-bar">
                     <span id="close${Complaint.ComplaintID} "  class="complaint-id" >Complaint ID: ${Complaint.ComplaintID}</span>
                      <button onclick="closeDescription(${Complaint.ComplaintID})" class="close"> &times; </button>
                      </div>
                                    <div class="description-header">
                                      <h5>Nature of the Complaint</h5>
                                    </div>
                                    <div class="description-body">
                                      <span class="desc-text">${Complaint.Nature}</span>
                                    </div>
                                      <div class="description-header">
                                        <h5>Specific details of the complaint</h5>
                                      </div>
                                      <div class="description-body">
                                        <span>${Complaint.SpecialDetails}</span>
                                      </div>
                                    </div>
                                </div>                
                      </td> 
                      <td  id="attend_${Complaint.ComplaintID}"> <button id="attendBtn_${Complaint.ComplaintID}" onclick="updatecomplaint(${Complaint.ComplaintID})" class="attend-button">Attend</button></td>         
                 `
                ComplaintTable.appendChild(complaintRow);

                break;
            case 1 : status = "Resolve";
                complaintRow.innerHTML = `

                <td>${Complaint.ComplaintID}</td> 
                <td>${Complaint.ComplaintDate}</td> 
                <td>${Complaint.OrderID}</td> 
                <td>${Complaint.OrderDate}</td> 
                <td>${regarding}</td>  
                <td>${priority}</td> 
                <td>${status}</td>  
                <td>
                     <button onclick="showDescription(${Complaint.ComplaintID})" class="btn-description" type="submit" id="desc-button"><span class="" ><i class="bx bx-show-alt"></i></span></button> 
                     <div id="desc${Complaint.ComplaintID}" class="description">
                     <div class="description-content">
                     <div class="close-bar">

                     <span id="close${Complaint.ComplaintID} "  class="complaint-id" >Complaint ID: ${Complaint.ComplaintID}</span>
                      <button onclick="closeDescription(${Complaint.ComplaintID})" class="close"> &times; </button>
                      </div>
                                    <div class="description-header">
                                      <h5>Nature of the Complaint</h5>
                                    </div>
                                    <div class="description-body">
                                      <span class="desc-text">${Complaint.Nature}</span>
                                    </div>
                                      <div class="description-header">
                                        <h5>Specific details of the complaint</h5>
                                      </div>
                                      <div class="description-body">
                                        <span>${Complaint.SpecialDetails}</span>
                                      </div>
                                    </div>
                                </div>                
                      </td> 
                      <td></td>         
                 `
                ComplaintTable.appendChild(complaintRow);break ;
            }

        })

  }).then(function (){
      $('#complaint-table').DataTable();
  });
});

function showDescription(ComplaintID){
    console.log(ComplaintID)
    $('#'.concat('desc').concat(ComplaintID)).show();
}

function closeDescription(ComplaintID){
    console.log(ComplaintID)
    $('#'.concat('desc').concat(ComplaintID)).hide();
}

const URLUpdateComplaint = host+ "/api/updatecomplaint" ;

function updatecomplaint(complaintID){

    let obj = {"ComplaintID":complaintID} ;

    $.ajax({
        url : URLUpdateComplaint,
        data : JSON.stringify(obj),
        type : 'POST',
        dataType:'json',
        processData: false,
        contentType : 'application/json'
    }).done(function (data){
        if (JSON.parse(data)['success'] == 'ok') {
            templateAlert('green', 'Update Success');
        } else if (JSON.parse(data)['success'] === 'fail') {
            templateAlert('yellow', 'Update Failed');
        }
    })
    $('#'.concat('attendBtn_').concat(complaintID)).hide();
}

// old complaint description popup

// $(document).ready(function () {
//     $(".btn-description").on("click",function(){
//         // $(this).closest("div.description").show();
//         $(this).siblings('.description').show();
//     });
//
//     $(".close").on("click",function(){
//         // $(this).closest("div.description").show();
//         $(this).closest('.description').hide();
//     });
// })



