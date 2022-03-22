const host = window.location.origin; //http://domainname
const URLUpdatePassword = host +'/api/updatepassword';

function updatePassword(){

       let oldPwd = $('#OldPwd').val();
       let newPwd = $('#NewPwd').val();
       let conPwd = $('#ConfirmPwd').val();
       let obj = {"OldPwd":oldPwd ,"NewPwd": newPwd, "ConfirmPwd":conPwd}

       $.ajax({
           url : URLUpdatePassword,
           data : JSON.stringify(obj),
           type : 'POST',
           dataType:'json',
           processData: false,
           contentType : 'application/json'
       }).done(function (data){
           if(JSON.parse(data)['success'] === 'ok'){

               templateAlert('green', 'Password is updated.');
           }else if(JSON.parse(data)['success'] === 'currentRequire'){
               document.getElementById("currentError").innerHTML = "This Field is Required";
           }
           else if(JSON.parse(data)['success'] === 'newRequire'){
               document.getElementById("newError").innerHTML = "This Field is Required";
           }
           else if(JSON.parse(data)['success'] === 'confirmRequire'){
               document.getElementById("confirmError").innerHTML = "This Field is Required";
           }
           else if(JSON.parse(data)['success'] === 'newConfirmFail'){
               document.getElementById("confirmError").innerHTML = "Does not match with the new password";
           }
           else if(JSON.parse(data)['success'] === 'currentFail'){
               document.getElementById("currentError").innerHTML = "Does not match with the current password";
           }
           else if(JSON.parse(data)['success'] === 'sizeFail'){
               document.getElementById("newError").innerHTML = "Minimum 8 Characters";
           }
       });

   }