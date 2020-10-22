$(document).ready(function(){
    //fun validate email
    $('.email_register').focus(function(){
        $('.user_name_div').hide();
        $('.password_div').hide();
        $('.password_confirm_div').hide();
        $('.email_div').show();
    });
    //temp arr that hold emil char 
    email_arr = [];
    var dot_posstion = '';
    var at_posstion = '';

    $('#email').keyup(function(event){
        var val = $('#email').val();
        //var email_validation = /\S+@\S+\.\S+/;
        var email_validation = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
         if(email_validation.test(val)){
            $('#valid_email').css("color","green");
            $('#email').css("border","1px solid green"); 
         }else{
            $('#valid_email').css("color","red");
            $('#email').css("border","1px solid red");
         }
    });

    /*
    
    
    $('#email').keyup(function(event){
        var val = $('#email').val();
        at_posstion = val.indexOf('@');
        dot_posstion = val.indexOf('.');
        //alert(event.keyCode);
        //dot_posstion and at_posstion return - 1 if they dose not exist in the input box
        if(at_posstion != -1 && dot_posstion != -1){
            if(at_posstion >= 1 && dot_posstion > at_posstion + 2 && dot_posstion + 3 <=  val.length){
               //if it is satisfay the condtions 
               $('#valid_email').css("color","green");
               $('#email').css("border","1px solid green");
            }else{
                $('#valid_email').css("color","red");
                $('#email').css("border","1px solid red");
            }
        }else{
            //invalid
            $('#valid_email').css("color","red");
            $('#email').css("border","1px solid red");
        } 
    });

    */
    //jqurie code for register page
    $('#user_name').focus(function(){
        $('.user_name_div').show();
        $('.password_div').hide();
        $('.password_confirm_div').hide();
        $('.email_div').hide();
    });
    //function validate username
    var user_name_array=[];
    var count_white_space = 0;
    $('#user_name').keyup(function(event){
      //  alert(event.keyCode);
        if(event.keyCode == 8){
            //if backspace is pressed do nothing bitch!
        }else{
            user_name_array.push(event.keyCode);
        }
        //console.log(user_name_array,"arr --")
        var username  = $('#user_name').val();
        if(username== null || username == ""){
            count_white_space = 0;
        }
        if(event.keyCode == 8){
           if(user_name_array.length >0){
               var last_ele = user_name_array.pop();
               if(last_ele == 32){
                count_white_space = count_white_space - 1;
               }
           }
        }
        count_white_space = 0; // since loop in each key pressed count_white_space must be 0
        for(var i = 0; i < user_name_array.length; i++){
            if(user_name_array[i] == 32){
              count_white_space = count_white_space + 1;
            }
            //check if the len is > 5
            if(user_name_array.length > 4){
                $('#error_five_character').css("color","green");
            }else{
                $('#error_five_character').css("color","red");
            }
        }
        if(count_white_space == 0){
            $('#error_white_space_character').css("color","green");
        }else{
            $('#error_white_space_character').css("color","red");
        }
        //if both condtions are true make the border of input box green
        if(count_white_space == 0 && user_name_array.length > 4){
            $('.user_name_register').css("border","1px solid green");
        }else{
            $('.user_name_register').css("border","1px solid red");
        }   
    });


    //function validate password
    var arr_num = [];
    var count_num = 0;

    var pass1, pass2;

    $('#password').keyup(function(event){
        pass1 = $('#password').val();
        if(event.keyCode == 8){
            if(arr_num.length > 0){
                arr_num.pop();
            }
        }else {
            arr_num.push(event.keyCode);
        }
    });

    $('#password_confirm').keyup(function(event){
        pass2 = $('#password_confirm').val();
        //console.log(pass2);
        compare_password();
    });

    function compare_password(){
        if(pass1 != pass2){
            $('#error_password_confirm').css("color","red");
        }else {
            $('#error_password_confirm').css("color","green");
            $('#password_confirm').css("border","1px solid green");
        }
    }
    /*
    $('#password').keyup(function(event){
        //if backspace btn clicked do nothing
        if((event.keyCode > 64 && event.keyCode < 91) || (event.keyCode > 47 && event.keyCode < 58) || 
            (event.keyCode == 32) || (event.keyCode == 188) || (event.keyCode == 190) ||
            (event.keyCode == 191) || (event.keyCode == 222) || (event.keyCode == 59) || (event.keyCode == 221) ||
            (event.keyCode == 219) || (event.keyCode == 61) || (event.keyCode == 173) || (event.keyCode == 220) ||
            (event.keyCode == 192) ){
            
            arr_num.push(event.keyCode);
            console.log(arr_num);
        }
       //if backspace btn clicked
        if(event.keyCode == 8){
            if(arr_num.length > 0){
                arr_num.pop();
                console.log(arr_num);
            }  
        }
        count_num = 0;//set couter to 0 after each key event performed
       for(var i = 0; i < arr_num.length; i++){
         if(arr_num[i] > 47 && arr_num[i] < 58){
            count_num = count_num + 1;
        }
       }
       if(count_num >0 ){
            $('#error_atleast_one_lowercase_letter').css("color","green");
       }else {
        $('#error_atleast_one_lowercase_letter').css("color","red");
       }  
       //validate len of password
        var password = $('#password').val();
        if(password.length < 5){
            $('#error_five_character_password').css("color","red");
        }else{
            $('#error_five_character_password').css("color","green");  
        }
        //if both condtions are true make input background green
        if(count_num > 0 && password.length > 4){
            $('.password_register').css("border","1px solid green");
        }else{
            $('.password_register').css("border","1px solid red");
        }
    });
    */
    $('#password').focus(function(){
        //clear the input box
       // $('#password').length = 0;
        $('.user_name_div').hide();
        $('.password_confirm_div').hide();
        $('.email_div').hide();
        $('.password_div').show();
    });


    //function confirm password
    $('#password_confirm').focus(function(){
        $('.user_name_div').hide();
        $('.password_div').hide();
        $('.email_div').hide();
        $('.password_confirm_div').show();
        //$('#password_confirm').val() = "";
    });
    
    //$('#password_confirm').keyup(myfun);
    conf_arr = [];
    /*
    function myfun(event){
        //check if the fucus is on input box
        //console.log('event code ' + event.keyCode);
        if((event.keyCode > 64 && event.keyCode < 91) || (event.keyCode > 47 && event.keyCode < 58) || 
            (event.keyCode == 32) || (event.keyCode == 188) || (event.keyCode == 190) ||
            (event.keyCode == 191) || (event.keyCode == 222) || (event.keyCode == 59) || (event.keyCode == 221) ||
            (event.keyCode == 219) || (event.keyCode == 61) || (event.keyCode == 173) || (event.keyCode == 220) ||
            (event.keyCode == 192) ){
            
            conf_arr.push(event.keyCode);
        }
        if(event.keyCode == 8){
            if(conf_arr.length > 0){
                conf_arr.pop();
            }
            //if arr.length == 1 make the array empty
            
        }
       console.log('confirmed password ' + conf_arr );
       compare();
    }
    */
    //function compaire two arrays
    function compare(){
       if(conf_arr.length != arr_num.length){
           $('#error_password_confirm').css("color","red");
       }
       if(conf_arr.length == arr_num.length){
           //_.isEqual function used to compare two arrays
          var x = _.isEqual(arr_num,conf_arr);
          if(x){
            $('#error_password_confirm').css("color","green");
            $('#password_confirm').css("border","1px solid green");
          }else{
              $('#error_password_confirm').css("color","red");
          }
        
       }
    }
    
       //for login page
       $('#btn_login').click(function(event){
        
        var username = $('.login_username').val();
        var password = $('.login_password').val();
        if(username == "" && password == ""){
            event.preventDefault();
            /*
            $('.login_message').append("<p style='color:red;'>UserName can not be null !</p>");
            $('.login_message').append("<p style='color:red;'>Password can not be null !</p>");
            */
            $('.login_username').addClass('error_username');
            $('.login_password').addClass('error_password');
        }
        else if(username == "" && password != ""){
            event.preventDefault();
            //$('.login_message').append("<p style='color:red;'>UserName can not be null !</p>");
            $('.login_username').addClass('error_username');
        }else if(username != "" && password == ""){
            event.preventDefault();
            //$('.login_message').append("<p style='color:red;'>Password can not be null !</p>");
            $('.login_password').addClass('error_password');
        }else{
           
        }
    });
   
    //fade out error message of login page
    $('.alert_login_message').fadeOut(5000);
});



