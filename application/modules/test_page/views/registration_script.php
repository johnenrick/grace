<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
load_asset("jquery.form.min.js");+
load_asset("registration.css");
load_asset("core/custom/materialize_modal.css");
// $("#registrationMessage").hide();
$("#registrationForm").attr('action',api_url("C_account/createAccount"));
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
  $("#modal1").attr("opacity",1);
  $("#modal").click(function(){
    $('#modal1').openModal();
    
  })

  //register
  $("#registrationForm").ajaxForm({
	beforeSubmit: function(){
		clear_form_error($("#registrationForm"));
	},
    success : function(data){
	    var response = JSON.parse(data);
	    console.log(response)
	    if(!response["error"].length){
	        $(".hide-module:not(#success-module)").hide();
               $("#success-module").fadeIn();
               $("#registrationNumberMessage").show();
	    }else{
	         show_form_error($("#registrationForm"), response["error"]);
	    console.log(response["error"]);
	   	}
	}
});
});

