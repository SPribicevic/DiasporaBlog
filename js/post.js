$(document).ready(function(){
    /* Code is executed when dom is opened. */

    /* Flag used for preventing multiple submits */
    var working = false;

    /* Listening to submit event on the  form */
    $('#addCommentForm').submit(function(e){

        e.preventDefault();
        if(working) return false;
        working = true;



        $('#sumbit').val = "Working...";
        $('span.error').remove();


        /* Sending the form fields to post.php. */
        $.post('submit.php',$(this).serialize(),function(msg){

            working = false;
            $('submit').val("Submit");
            console.log('success!');

            if(msg.status){
                /* If the insert was successful, add new comment with a slideDown effect */
                $('#test').html("success");
                $(msg.html).hide().insertBefore('#addCommentContainer').slideDown();
                $('#body').val('');


            }else{
                /* Otherwise, loop through message errors and display them */

                $.each(msg.errors,function(k,v){
                    $('label[for='+k+']').append('<span class="error">'+v+'</span>');
                });
            }

        },'json');

    });

});