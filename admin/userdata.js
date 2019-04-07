$(document).ready(function(){   
    $(".edit_link").click(function(){
        let userId = $(this).attr("data-id"); 
        $('#modalUserID').val(userId);
        let email = $('#email_'+userId).text();
        $('#modalEmail').val(email);
        let username = $('#username_'+userId).text();
        $('#modalUsername').val(username);
    });
});
