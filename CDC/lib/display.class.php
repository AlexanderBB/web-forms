<?php
session_start();

if ($_SESSION[include_engine] != 'on'){header('Location: http://www.you-dont-have-right-to-view-this-file.com/');}

/**
 * Main displayed content.
 */
class display {
	
	public function __construct(){
		}  
	/**
         * Display register form.
         * @return html code Returns the source code for the register form.
         */
	public function init(){
            $formBox= 
            '
    <div id="FromBox" data-backdrop="false" data-toggle="modal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
                <div class="modal-header">
                 <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                  <h4 class="modal-title">Register form for edicational courses.</h4>
                </div>
                <div id="registerFormHolder" class="modal-body">
                <form id="register" enctype="text/plain" action="?act=register" method="POST">
                        <div class="input-group customDivHolder">
                          <span class="fixWidth input-group-addon">Name</span>
                          <input type="text" class="fixHeight form-control" placeholder="Example: Joe" name="name" id="name" required="required" />
                        </div>
                        <div class="input-group customDivHolder">
                          <span class="fixWidth input-group-addon">Lastname</span>
                          <input type="text" class="fixHeight form-control" placeholder="Example: Smith" name="lastname" id="lastname" required="required" />
                        </div>
                        <div class="input-group customDivHolder">
                          <span class="fixWidth input-group-addon">Telephone</span>
                          <input type="text" class="fixHeight form-control" placeholder="Example: 01234567890" name="tel" id="tel" required="required" />
                        </div>
                        <div class="input-group customDivHolder">
                          <span class="fixWidth input-group-addon">E-mail</span>
                          <input type="text" class="fixHeight form-control" placeholder="Example: user@domain.com" name="email" id="email" required="required" />
                        </div>
                        <div class="input-group customDivHolder">
                          <span class="fixWidth input-group-addon">University</span>
                          <input type="text" class="fixHeight form-control" placeholder="Example: VUZF" name="university" id="university" required="required" />
                        </div>
                        <div class="input-group customDivHolder">
                          <span class="fixWidth input-group-addon">Speciality</span>
                          <input type="text" class="fixHeight form-control" placeholder="Example: Insuranse" name="specialty" id="specialty" required="required" />
                        </div>
                        <div class="input-group customDivHolder">
                          <span class="fixWidth input-group-addon">Current year in the university</span>
                          <input type="text" class="fixHeight form-control" placeholder="Example: First" name="current_year" id="current_year" required="required" />
                        </div>
                        <br />
                        <div class="input-group customDivHolder">
                          <span style="border-radius: 20px !important;" class="input-group-addon">Why I want to participate in this course?</span>                          
                          <!-- <input type="text" class="fixHeight form-control" placeholder="" name="question_field" id="question_field" required="required" /> -->
                        </div>
                        <textarea id="question_field" class="form-control" style="width:100% !important" rows="4" cols="80"></textarea>
                        <br />
                        <sup>
                                        <br>* All the fields above are required.</sup>
                </form>
                </div>
                <div class="modal-footer">
                        <div style="text-align:left;" id="container"></div>
                        <input type="submit" id="registerTrigger" value="Register!" class="btn btn-primary"></input>

                </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
                ';
            echo $formBox;
	}
	
}
?>
