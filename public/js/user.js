const host = window.location.origin; //http://domainname

const URLGetUser = '/dashboard/staff/getsessionuser';

$.getJSON(URLGetUser,function (user){
    $('#userName').html(user.Name);
})