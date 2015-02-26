$('ready').ready(function() {
	$('#FromBox').modal('show');
        $('#FromBox').on('hidden.bs.modal', function () {
            $('#FromBox').modal('show');
	});
        
        $('#registerTrigger').click(function(){
            //Get the action option from the register form.
            var dest = $('#register').attr('action');
            //Prepare the data and sending.
            $.ajax({
                type: "POST",
		dataType: "json",
                url: dest,
                data:({
                    name:               $("#name").val(),
                    lastname:           $("#lastname").val(),
                    tel:                $("#tel").val(),
                    email:              $("#email").val(),
                    university:         $("#university").val(),
                    specialty:          $("#specialty").val(),
                    current_year:       $("#current_year").val(),
                    question_field:     $("#question_field").val()
                }),
                beforeSend:
                    function(xhr){
                    //This custom header is additional security layer
                        xhr.setRequestHeader('x-custom-sendfrom-header', 'ajaxRqst');
                    }
            }).done(function(data){
                //After sending the AJAX call
                    var names = new Array(
                            'name','lastname','tel','email'
                            ,'university','specialty','current_year','question_field');
                    if (data[0] != 0){
                    //HANDLING ERRORS SECTION
                        //Coloring the message box - red for error
                        $('#container').addClass('alert alert-danger');
                        // CODE:1 - empty field 
                        if ( data[0] == 1 ){
                                //Check for empty input field and color it RED
                                var len = new Array();

                                len[0] = $("#name").val().length;
                                len[1] = $("#lastname").val().length;
                                len[2] = $("#tel").val().length;
                                len[3] = $("#email").val().length;
                                len[4] = $("#university").val().length;
                                len[5] = $("#specialty").val().length;
                                len[6] = $("#current_year").val().length;
                                len[7] = $("#question_field").val().length;
                                for(var i=0;i<len.length;i++){
                                    if(len[i]==0){
                                        $( '#' + names[i]).removeClass('alert-success')
                                                .addClass('alert-danger').focus();
                                    }else{
                                        $( '#' + names[i]).removeClass('alert-danger');
                                    }
                                }
                        //CODE:2 - validation error 
                        }else if(data[0] == 2){
                                //Find the field with error and color RED && SELECT
                                for(var i=0;i<names.length;i++){
                                        $( '#' + names[i]).removeClass('alert-success alert-danger');
                                }
                                $( '#' + data[2]).removeClass('alert-success')
                                                        .addClass('alert-danger');
                                $( '#' + data[2]).focus().select();
                            }
                        $( "#container" ).empty().append(data[1]);
                    }else{
                        //SUCCESS SECTION - validation, recording data and sending notify mail
                            $( "#container" ).empty().removeClass('alert alert-danger');
                            $( "#registerFormHolder" ).empty().append(data[1]);
                            $('#registerTrigger').hide(10);
                    }
            });
            // Cancel the default action to the button we pressed.
            return false;
        });
});