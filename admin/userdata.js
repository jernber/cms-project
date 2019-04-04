$(document).ready(function(){   
    $(".edit_link").click(function(){
        let userId = $(this).attr("data-id"); 
        $('#modalUserID').val(userId);
        let email = $('#email_'+userId).text();
        $('#modalEmail').val(email);
        let username = $('#username_'+userId).text();
        $('#modalUsername').val(username);
    });

    $('button#modalSubmit').click(function(){
        var form = $('#edit_form');

        console.log("submit clicked");
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response){
                console.log(form);
            }
        }); 
        
    });
});
