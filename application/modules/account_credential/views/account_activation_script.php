<script>
    /*global systemApplication, systemUtility*/
    
    /*Adding an asset*/
    load_asset("jquery-confirm.min.css");
    load_asset("jquery-confirm.min.js");
    
    /*Module Object*/
    var AccountActivation = function(){
        var accountActivation = this;//instance of the module
        var moduleBody = accountActivation.body = $("#accountActivation");
        var parameter  = getURLParameter("account_credential/accountActivation");
        if(parameter){
            moduleBody.find("form input[name=activation_code]").val(parameter[0]);
        }
        moduleBody.find("form").attr("action", base_url("portal/activateAccount"));
        moduleBody.find("form").ajaxForm({
            beforeSubmit : function(){
                if(moduleBody.find("form input[name=password]").val() !== moduleBody.find("form input[name=password_verification]").val()){
                    console.log(moduleBody.find("form input[name=password]").val()+"  "+moduleBody.find("form input[name=password_verification]").val());
                    return false;
                }
                moduleBody.find("form button[type=submit]").attr("disabled", true);
            },
            success : function(data){
                var response = JSON.parse(data);
                if(!response["error"].length){
                    addFormMessage(moduleBody.find("form"), "success", "Your account has been activated. You may now log in using your email and the password that you just entered.")
                }else{
                    show_form_error(moduleBody.find("form"), response["error"]);
                }
                moduleBody.find("form button[type=submit]").attr("disabled", false);
            }
        })
        accountActivation.ready = function(){
            if(user_id()){
                load_module("portal", "Portal");
            }
        }
    };
        
    $(document).ready(function(){
        systemApplication.module.accountActivation  = new AccountActivation();
    });
</script>