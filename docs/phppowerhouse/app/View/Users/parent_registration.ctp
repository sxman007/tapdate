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

    <!-- Message for parent start -->
    <div class="parent-info">
        <p>Dear Parent,</p>
        <p>&nbsp;</p>
        <p>Your child would like to enroll and game on our Eep World™ website.  We want your child’s experience to be safe and fun as we do for all children who game on our site.  Therefore want to make sure that your child does not post any information on our site that may identify him or her, where he/she lives or engage in any another activity on our site that would not be appropriate for other children as well.  We do not tolerate cyber bullying, offensive language or the posting subject matter that we deem offensive, nor do we allow contacting anyone in person or otherwise through this site without parental supervision.  If your child is subject to any of this behavior please let us know immediately at www.eepworld/privacy.com .   If we deem that your child has engaged is any banned behavior, your child’s account may be suspended for 24 hours, 72hours and/or permanently at our complete and absolute discretion.  Further, you will be notified of such behavior and the reason(s) for the ban as well as the term of the ban,</p>
        <p>&nbsp;</p>
        <p>Though not all areas of the internet are completely safe we have taken precautions protect your child by restricting his/her ability to access certain portions and capabilities of our forums.  This is an area where the general public is free to post comments.  If you are concerned that some comments may not be appropriate for your child, then you should check the box below to restrict your child from view of this section of our site altogether.  You may unlock this section at a later date in which you believe your child is ready to view these sections of the forums.  Once your child reaches the age of majority he/she may choose to access both the children’s restricted sections as well as the adult’s sections.</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </div>
    <!-- Message for parent end -->

<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'parent_registration'), 'id' => 'registration')); ?>
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">All Forums Turned Off </div>
        <div class="registration_from_field registration_from_field_checkbox">
            <input name="forum_closed" type="checkbox"  value="1" id="forum_closed"/>	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->


    <!-- Message for parent start -->
    <div class="parent-info">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>Further we will not use any information that your child provides as a method to provide companies or firms the ability to directly solicit your child for products and services.  In fact, this site was designed so that you and your child can choose whom you would like to contact for products and services should a need arise and not the reverse.</p>
        <p>&nbsp;</p>
        <p>Therefore you will not receive any junk mail or spam mail from using our site nor will we sell your specific information except as provided under our Terms of Use.</p>
        <p>&nbsp;</p>
        <p>Therefore, we require your registration so that your child(ren) may use this site.  We will need the following:</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </div>
    <!-- Message for parent end -->



    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Email Address </div>
        <div class="registration_from_field registration_email_field_bg">
            <input id="email" type="text" name="email" >	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row  no_margin guidelines">
        <div class="registration_from_label">&nbsp; </div>
        <div class="registration_from_field">
            ( If you have multiple children under the age of 13, then this email address may be used for all of the accounts should you desire. )
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Username </div>
        <div class="registration_from_field user_id_field_bg">
           <input id="username" type="text" name="username" >	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row  no_margin guidelines">
        <div class="registration_from_label">&nbsp; </div>
        <div class="registration_from_field">
            ( Do not use actual names or any name that may identify your child directly, or his/her place of residency. )
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row no_margin">
        <div class="registration_from_label">Password </div>
        <div class="registration_from_field password_field_bg">
            <input id="password" type="password" name="password">	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row  no_margin guidelines">
        <div class="registration_from_label">&nbsp; </div>
        <div class="registration_from_field">
            ( Password must contain at least 1 capital letter and 1 number. )
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Confirm Password</div>
        <div class="registration_from_field password_field_bg">
             <input id="confirm_password" type="password" name="confirm_password" >	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row no_margin">
        <div class="registration_from_label">Mobile Phone <span>(optional)</span></div>
        <div class="registration_from_field mobile_field_bg">
            <input id="mobile" type="text" name="mobile">	
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
        <div class="registration_from_label">Users  Zipcode</div>
        <div class="registration_from_field answer_field_bg">
            <input id="zipcode" class="required" type="text" name="zipcode" >
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <h2>Security Questions</h2>
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Question One</div>
        <div class="registration_from_field question_field_bg">
            <input id="question1"  type="text" name="question1">	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Answer</div>
        <div class="registration_from_field answer_field_bg">
            <input id="answer1"  type="text" name="answer1" >	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Question Two</div>
        <div class="registration_from_field question_field_bg">
            <input id="question2" type="text" name="question2" >	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Answer</div>
        <div class="registration_from_field answer_field_bg">
            <input id="answer2" type="text" name="answer2">	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Question Three</div>
        <div class="registration_from_field question_field_bg">
           <input id="question3" type="text" name="question3" >	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Answer</div>
        <div class="registration_from_field answer_field_bg">
           <input id="answer3" type="text" name="answer3" >	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <div class="button_row">
        <?php echo $this->Form->submit('Sign Up', array('type' => 'image', 'src' => $this->webroot . '/images/submit_bt.png')); ?>
    </div>



</div>