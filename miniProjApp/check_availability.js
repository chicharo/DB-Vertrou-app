$(document).ready(function(){
    $('#username').keyup(function(){ // Keyup function for check the user action in input
        var Username = $(this).val();
        var dataString = 'username='+Username; // Get the username textbox using $(this) or you can use directly $('#username')
        var UsernameAvailResult = $('#username_avail_result'); // Get the ID of the result where we gonna display the results
        if(Username.length > 2) { // check if greater than 2 (minimum 3)
            UsernameAvailResult.html('Loading..'); // Preloader, use can use loading animation here  
        //use ajax to run the check  
            // AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: 'checker.php',
                data: {"username":Username},
                cache: false,
                success: function(result){
                    if(result=="Available"){
                        $('#username_avail_result').html('Available');
                    }
                    else if(result=="Username not available"){
                        $('#username_avail_result').html('Username not available');
                    }
                }
            });
        }else{
            $('#username_avail_result').html('Enter atleast 3 characters');
        }

    });
});
