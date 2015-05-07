 
<div class="heading">Registration:</div>
<div class="registration_area">
    <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'registration'), 'id' => 'registration')); ?>
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Birthday </div>
        <div class="registration_from_field user_id_field_bg">
            <?php //echo $this->Form->input('birthday', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'birthday_picker', 'id' => 'birthday', 'autocomplete' => 'off')); ?>
            <input type="text" name="birthday" id="birthday" class="birthday_picker" />
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Email Address </div>
        <div class="registration_from_field registration_email_field_bg">
            <?php //echo $this->Form->input('email', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'required  email', 'id' => 'email')); ?>
<!--            <input id="email" class="required email" type="text" required="required" placeholder="Email ID" tabindex="1" name="data[User][email]" aria-required="true">-->
            <?php //echo $this->Form->input('email', array('type' => 'text', 'div' => FALSE, 'label' => FALSE, 'id' => 'email')); ?>
            <input type="text" name="email" id="email" />
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Username</div>
        <div class="registration_from_field user_id_field_bg">
            <?php echo $this->Form->input('username', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => '', 'id' => 'username')); ?>	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row no_margin">
        <div class="registration_from_label">Password</div>
        <div class="registration_from_field password_field_bg">
            <?php echo $this->Form->input('password', array('label' => FALSE, 'div' => FALSE, 'type' => 'password', 'class' => '', 'id' => 'password')); ?>	
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
            <?php echo $this->Form->input('confirm_password', array('label' => FALSE, 'div' => FALSE, 'type' => 'password', 'class' => '', 'id' => 'confirm_password')); ?>	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row no_margin">
        <div class="registration_from_label">Mobile Phone <span>(optional)</span></div>
        <div class="registration_from_field mobile_field_bg">
            <?php echo $this->Form->input('mobile', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'id' => 'mobile')); ?>
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
            <?php echo $this->Form->input('zipcode', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => '', 'id' => 'zipcode')); ?>	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <h2>Security Questions</h2>
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Question One</div>
        <div class="registration_from_field question_field_bg">
            <?php echo $this->Form->input('question1', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => '', 'id' => 'question1')); ?>	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Answer</div>
        <div class="registration_from_field answer_field_bg">
            <?php echo $this->Form->input('answer1', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => '', 'id' => 'answer1')); ?>	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Question Two</div>
        <div class="registration_from_field question_field_bg">
            <?php echo $this->Form->input('question2', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => '', 'id' => 'question2')); ?>	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Answer</div>
        <div class="registration_from_field answer_field_bg">
            <?php echo $this->Form->input('answer2', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => '', 'id' => 'answer2')); ?>	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Question Three</div>
        <div class="registration_from_field question_field_bg">
            <?php echo $this->Form->input('question3', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => '', 'id' => 'question3')); ?>	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Answer</div>
        <div class="registration_from_field answer_field_bg">
            <?php echo $this->Form->input('answer3', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => '', 'id' => 'answer3')); ?>	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <div class="button_row">
        <?php echo $this->Form->submit('Sign Up', array('type' => 'image', 'src' => $this->webroot . '/images/submit_bt.png')); ?>
    </div>
    <?php echo $this->Form->end(); ?>


</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#registration").validate({
        rules: {
            birthday: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                email: true
            },
            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 8
            },
            confirm_password: {
                required: true,
                equalTo: password,
            },
            mobile: {
                required: true,
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
                required: "You must enter your birthday",
                minlength: "First name must be at least 5 characters long"
            },
            email: {
                required: "We need your email address to contact you",
                email: "Your email address must be in the format of name@domain.com"
            },
            username: {
                required: "Please specify your username"
            },
            password: {
                required: "Please enter a password.",
                minlength: "Please enter a password of minimum 8 length.",
            },
            confirm_password: {
                required: "Please enter a Confirm password.",
                equalTo: "Passwords and Confirm password must match.",
            },
            mobile: {
                required: "You must enter your phone number",
                number: "Phone number must contain digits only"
            },
            zipcode: {
                required: "You must enter your zip code",
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