<script>
    function commonFormHandler(formElement, createLink, updateLink, deleteLink){
        var formHandler = this;
        formHandler.formElement = formElement;
        formHandler.formMode = "";//create or update
        //Event binding
        formElement.ajaxForm({
            beforeSubmit : function(data,$form,options){
                clear_form_error(formElement);
                formElement.find(".formActionButton button").attr("disabled", true);
                formHandler.submitBeforeSubmit(data);
                
            },
            success : function(data){
                var response = JSON.parse(data);
                if(response["error"].length){
                    show_form_error(formElement, response["error"]);
                    console.log(response["error"])
                }else{
                    formElement.find(".formLabelIndicator.label-success").show()
                }
                if(formHandler.formMode === "create"){
                    formHandler.submitCreateSuccess(response);
                }else{
                    formHandler.submitUpdateSuccess(response);
                }
                formElement.find(".formActionButton button").attr("disabled", false);
            }
        });
        formElement.find(".formActionButton").on("click", "button", function(){
            switch($(this).attr("action")){
                case "delete":
                    formElement.find(".formActionButton button[action=delete_yes]").show();
                    formElement.find(".formActionButton button[action=delete_no]").show();
                    formElement.find(".formActionButton button[action=delete]").hide();
                    formElement.find(".formActionButton label[action=delete_confirmation]").show();
                    break;
                case "delete_yes":
                    deleteForm();
                    break;
                case "delete_no":
                    formElement.find(".formActionButton button[action=delete_yes]").hide();
                    formElement.find(".formActionButton button[action=delete_no]").hide();
                    formElement.find(".formActionButton button[action=delete]").show();
                    formElement.find(".formActionButton label[action=delete_confirmation]").hide();
                    formElement.find(".formActionButton button").attr("disabled", false);
                    break;
                    
            }
        });
        
        /*Function*/
        formHandler.reset = function(){
            formElement.trigger("reset");
            clear_form_error(formElement);
            formElement.find(".formActionButton button, .formActionButton label").hide();
            formElement.find(".formActionButton button[action=delete]").show();
            formElement.find(".formActionButton button[action=cancel]").show();
            formElement.find(".formActionButton button[type=submit]").show();
            formElement.find("input[type=file]").each(function(){
                var id = $(this).attr("id").replace("Input", "Label");
                formElement.find("#"+id).text("");
            });
        };
        formHandler.createForm = function(callbackFn){
            formHandler.reset();
            formElement.attr("action", api_url(createLink));
            changeFieldName("create", formElement);
            formElement.find(".formActionButton button[action=delete]").hide();
            console.log(formElement.find(".formActionButton button[action=delete]"))
            formHandler.formMode = "create";
            if(typeof callbackFn !== "undefined"){
                callbackFn();
            }
        };
        formHandler.updateForm = function(callbackFn){
            formHandler.reset();
            formElement.attr("action", api_url(updateLink));
            changeFieldName("update", formElement);
            formElement.find(".formActionButton button[action=delete]").show();
            formHandler.formMode = "update";
            if(typeof callbackFn !== "undefined"){
                callbackFn();
            }
        };
        
        
        formHandler.submitBeforeSubmit = function(data){
            
        };
        formHandler.submitCreateSuccess = function(response){
            
        };
        formHandler.submitUpdateSuccess = function(response){
            
        };
        formHandler.submitDeleteSuccess = function(response){
            
        }
        function deleteForm(){
            formElement.find(".formActionButton button").attr("disabled", true);
            api_request(deleteLink, {ID : formElement.find("input[name=ID]").val()}, function(response){
                formElement.find(".formActionButton button[action=delete_yes]").hide();
                formElement.find(".formActionButton button[action=delete_no]").hide();
                formElement.find(".formActionButton button[action=delete]").show();
                formElement.find(".formActionButton label[action=delete_confirmation]").hide();
                if(!response["error"].length){
                    formHandler.submitDeleteSuccess(response);
                }else{
                    formElement.find(".formActionButton .label-danger").show()
                }
                
                formElement.find(".formActionButton button").attr("disabled", false);
            });
        }
        return formHandler;
    }
</script>