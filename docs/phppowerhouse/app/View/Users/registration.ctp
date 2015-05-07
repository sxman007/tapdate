<script>
    $(function() {
    jQuery.validator.addMethod(
            'ContainsAtLeastOneDigit',
            function (value) {
            return (/[0-9]/).test(value);
            },
            'Your password must contain at least one digit.'
            );
    jQuery.validator.addMethod(
            'ContainsAtLeastOneCapitalLetter',
            function (value) {
            return (/[A-Z]/).test(value);
            },
            'Your password must contain at least one capital letter.'
            );
    
    $.validator.addMethod("uniqueEmail", function(value, element) {
        var  mail_notexist;
       // alert(value);
        $.ajax({
        data: 'email=' + value,
        type: 'post',
        async: false,
        url: 'uniqueEmail',
       // dataType:"html",
            success: function(msg) {
                if(msg == 1){
                     mail_notexist = true;
                   //alert("TRUE!!!");
                }
                else{
                     mail_notexist = false;
                }
            }
        });
        if(mail_notexist==true)
            return true;
        else 
            return false;
          
    },"Sorry, this email already exist");

   $("#registration").validate({

            rules: {
                    birthday: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                        uniqueEmail: true
                    },
                    username: "required",
                    password:
                    {
                        required: true,
                        ContainsAtLeastOneDigit: true,
                        ContainsAtLeastOneCapitalLetter: true,
                        minlength: 8
                    },
                    confirm_password:
                    {
                        required: true,
                        equalTo: password,
                    },
                    mobile: {
                        required: false,
                        number: true
                    },
                    zipcode: {
                        required: true,
                            //number: true,
                            //rangelength : [3, 5]
                    },
                    question1: "required",
                    answer1: "required",
                    question2: "required",
                    answer2: "required",
                    question3: "required",
                    answer3: "required"
            },
            messages: {
            birthday: {
            required: "Please select your birthday",
            },
                    email: {
                        required: "Please enter a Email-Id",
                        email: "Enter a valid Email-Id ",
                     
                    },
                    username: "Please enter a username",
                    password:{
                        required:"Please enter a password.",
                        minlength: $.validator.format("Please, at least {0} characters are necessary")
                    },
                    confirm_password:{
                        required:"Please enter a Confirm password.",
                        equalTo:"Passwords and Confirm password must match.",
                    },
                    mobile: {
                        number : "Phone number must contain digits only"
                    },
                    zipcode: {
                        required: "Please enter your zip code",
                            // number: "Zip code must contain digits only",
                            //rangelength : "Zip code must have between 3 to 5 digits"
                    },
                    question1: "Please enter this question",
                    answer1: "Please enter your answer",
                    question2: "Please enter this question",
                    answer2: "Please enter your answer",
                    question3: "Please enter this question",
                    answer3: "Please enter your answer",
            }

    });
    });
</script> 
<div class="heading">Registration:</div>
<div class="registration_area">
<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'registration'), 'id' => 'registration')); ?>
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Birthday </div>
        <div class="registration_from_field user_id_field_bg">
<?php //echo $this->Form->input('birthday', array('label' => FALSE, 'div' => FALSE, 'type' => 'text','class' => 'birthday_picker', 'id' => 'birthday', 'readonly' => TRUE, 'autocomplete' => 'off'));  ?>
            <input id="birthday" class="birthday_picker" type="text" autocomplete="off" readonly="readonly" name="birthday">
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Email Address </div>
        <div class="registration_from_field registration_email_field_bg">
<!--            <input id="email" class="required email" type="text" required="required" placeholder="Email ID" tabindex="1" name="data[User][email]" aria-required="true">-->
<?php //echo $this->Form->input('email', array('type' => 'text', 'div' => FALSE, 'label' => FALSE, 'id' => 'email'));  ?>
            <input id="email" type="text" name="email" >
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Username</div>
        <div class="registration_from_field user_id_field_bg">
<?php //echo $this->Form->input('username', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'required', 'id' => 'username'));  ?><input id="username" type="text" name="username" >	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row no_margin">
        <div class="registration_from_label">Password</div>
        <div class="registration_from_field password_field_bg">
<?php //echo $this->Form->input('password', array('label' => FALSE, 'div' => FALSE, 'type' => 'password', 'class' => 'required', 'id' => 'password'));  ?>	<input id="password" type="password" name="password">
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row  no_margin guidelines">
        <div class="registration_from_label">&nbsp; </div>
        <div class="registration_from_field">
            ( Password contain at least 1 capital letter and 1 number and min length is 8 ).
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Confirm Password</div>
        <div class="registration_from_field password_field_bg">
<?php //echo $this->Form->input('confirm_password', array('label' => FALSE, 'div' => FALSE, 'type' => 'password', 'class' => 'required', 'id' => 'confirm_password'));  ?>	
            <input id="confirm_password" type="password" name="confirm_password" >
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row no_margin">
        <div class="registration_from_label">Mobile Phone <span>(optional)</span></div>
        <div class="registration_from_field mobile_field_bg">
<?php //echo $this->Form->input('mobile', array('label' => FALSE, 'div' => FALSE, 'required'=>'false' ,'type' => 'text','id' => 'mobile'));  ?>          <input id="mobile" type="text" name="mobile">
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row no_margin guidelines">
        <div class="registration_from_label">&nbsp; </div>
        <div class="registration_from_field">
            ( if you would like receive password resets ).
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Zipcode</div>
        <div class="registration_from_field answer_field_bg">
<?php //echo $this->Form->input('zipcode', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'required', 'id' => 'zipcode'));  ?>     <input id="zipcode" class="required" type="text" name="zipcode" >
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <h2>Security Questions</h2>
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Question One</div>
        <div class="registration_from_field question_field_bg">
<?php //echo $this->Form->input('question1', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'required', 'id' => 'question1'));  ?><input id="question1"  type="text" name="question1">	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Answer</div>
        <div class="registration_from_field answer_field_bg">
<?php //echo $this->Form->input('answer1', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'required', 'id' => 'answer1'));  ?>         <input id="answer1"  type="text" name="answer1" >
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Question Two</div>
        <div class="registration_from_field question_field_bg">
<?php //echo $this->Form->input('question2', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'required', 'id' => 'question2'));  ?><input id="question2" type="text" name="question2" >	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Answer</div>
        <div class="registration_from_field answer_field_bg">
<?php //echo $this->Form->input('answer2', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'required', 'id' => 'answer2'));  ?>	       <input id="answer2" type="text" name="answer2">
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Question Three</div>
        <div class="registration_from_field question_field_bg">
<?php //echo $this->Form->input('question3', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'required', 'id' => 'question3'));  ?>	<input id="question3" type="text" name="question3" >
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Answer</div>
        <div class="registration_from_field answer_field_bg">
<?php //echo $this->Form->input('answer3', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'required', 'id' => 'answer3'));  ?>     <input id="answer3" type="text" name="answer3" >
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <div class="button_row">
<?php echo $this->Form->submit('Sign Up', array('type' => 'image', 'src' => $this->webroot . '/images/submit_bt.png')); ?>
    </div>
        <?php echo $this->Form->end(); ?>


</div>