<div class="heading">Registration:</div>
<?php echo $this->Form->create('User'); ?>
<div class="registration_area">
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Birthday </div>
        <div class="registration_from_field">
            <div class="col_01">
                <select>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
            <div class="col_01">
                <select>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>

            </div>
            <div class="col_01">
                <select>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Enter Email Address </div>
        <div class="registration_from_field registration_email_field_bg">
            <input name="" type="text" />	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">User Id </div>
        <div class="registration_from_field user_id_field_bg">
            <input name="" type="text" />	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row no_margin">
        <div class="registration_from_label">Enter Password </div>
        <div class="registration_from_field password_field_bg">
            <input name="" type="text" />	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row  no_margin guidelines">
        <div class="registration_from_label">&nbsp; </div>
        <div class="registration_from_field">
            ( Password must contain at least 1 capital letter and 1 number ).
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Confirm Password</div>
        <div class="registration_from_field password_field_bg">
            <input name="" type="text" />	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row no_margin">
        <div class="registration_from_label">Mobile Phone <span>(optional)</span></div>
        <div class="registration_from_field mobile_field_bg">
            <input name="" type="text" />	
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
    <div class="registration_from_row no_margin">
        <div class="registration_from_label">Additional Email Address <span>(optional)</span></div>
        <div class="registration_from_field registration_email_field_bg">
            <input name="" type="text" />	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row no_margin guidelines">
        <div class="registration_from_label">&nbsp; </div>
        <div class="registration_from_field">
            ( for password resets ).
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Users  Zipcode</div>
        <div class="registration_from_field zipcode_bg">
            <select>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <h2>Security Questions</h2>
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Question One</div>
        <div class="registration_from_field question_field_bg">
            <input name="" type="text" />	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Answer</div>
        <div class="registration_from_field answer_field_bg">
            <input name="" type="text" />	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Question Two</div>
        <div class="registration_from_field question_field_bg">
            <input name="" type="text" />	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Answer</div>
        <div class="registration_from_field answer_field_bg">
            <input name="" type="text" />	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Question Three</div>
        <div class="registration_from_field question_field_bg">
            <input name="" type="text" />	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <!--registration form row-->
    <div class="registration_from_row">
        <div class="registration_from_label">Answer</div>
        <div class="registration_from_field answer_field_bg">
            <input name="" type="text" />	
        </div>
        <div class="clear"></div>
    </div>
    <!--registration form row ends-->
    <div class="button_row">
        <?php echo $this->Form->submit('Sign Up', array('type'=>'image','src' => $this->webroot . '/images/submit_bt.png'));  ?>
    </div>



</div>
<?php echo $this->Form->end(); ?>