<script>
    /*global systemApplication, systemUtility*/
    
    /*Adding an asset*/
    
    /*Module Object*/
    var ModuleManagementTab  = function(trainingModule){
        var moduleManagementTab = this;//instance of the module
        var moduleBody = moduleManagementTab.body = $("#moduleManagementTab");
        load_component("table_component", function(){
            var columnConfiguration = [{
                description : "ID",
                table_column : "training_module__ID",
                default_sort : 1
            },{
                description : "Description",
                table_column : "training_module__description",
                default_sort : 1
            },{
                description : "Action"
            }];
            var filterConfiguration = {
                fieldFilter :[{
                        description : "Name",
                        table_column : "like__training_module__description",
                        type : "text"
                }]
            };
            var resultConfiguration = {
                result_link : api_url("c_training_module/retrieveTrainingModule"),
                success : listModule,
                limit : 5
            };
            moduleManagementTab.moduleTableList = new TableComponent(moduleBody.find('.moduleTableContainer'), resultConfiguration, columnConfiguration, filterConfiguration);
            moduleManagementTab.moduleTableList.table.on("click", ".viewModuleInformation", function(){
                moduleManagementTab.moduleTableList.table.find(".viewModuleInformation").attr("disabled", true);
                viewModuleInformation($(this).parent().parent().attr("training_module_id"));
            });
        });
        
        
        /*Module Information Modal*/
        
        moduleBody.find("#moduleInformation form").ajaxForm({
            beforeSubmit : function(data, $form, options){
                clear_form_error(moduleBody.find("#moduleInformation form"));
                data.push({
                    name : "modulename",
                    required : false,
                    type: "text",
                    value : moduleBody.find("#moduleInformation form input[field_name=first_name]").val()+moduleBody.find("#moduleInformation form input[field_name=middle_name]").val()+moduleBody.find("#moduleInformation form input[field_name=last_name]").val()
                });
            },
            success : function(data){
                var response = JSON.parse(data);
                if(!response["error"].length){
                    moduleBody.find("#moduleInformation form .modal-footer .label-success").show();
                    
                    viewModuleInformation(moduleBody.find("#moduleInformation form input[name=ID]").val()*1 ? moduleBody.find("#moduleInformation form input[name=ID]").val() : response["data"]);
                    setTimeout(function(){
                        moduleBody.find("#moduleInformation form .modal-footer .label-success").hide();
                    }, 1000);
                }else{
                    //formError
                    show_form_error(moduleBody.find("#moduleInformation form"), response["error"]);
                }
                moduleManagementTab.moduleTableList.retrieveEntry();
            }
        });
        moduleBody.find("#createModule").click(function(){
            moduleBody.find("#moduleInformation form").attr("action", api_url("c_training_module/createTrainingModule"));
            changeFieldName("create", moduleBody.find("#moduleInformation form"));
            moduleBody.find("#moduleInformation form").trigger("reset");
            moduleBody.find("#moduleInformation").modal("show");
            moduleBody.find("#moduleInformation form input[name=ID]").val(0);
            moduleBody.find("#moduleInformation form .deleteModule").hide();
        });
        moduleBody.find("#moduleInformation").on('shown.bs.modal', function() {
            clear_form_error(moduleBody.find("#moduleInformation form"));
            moduleBody.find("#moduleInformation form .deleteConfirmation").hide();
            moduleBody.find("#moduleInformation form .confirmDeletModule").hide();
            moduleBody.find("#moduleInformation form .cancelDeleteModule").hide();
        });
        moduleBody.find("#moduleInformation form .deleteModule").click(function(){
            moduleBody.find("#moduleInformation form .deleteModule").hide();
            moduleBody.find("#moduleInformation form .deleteConfirmation").show();
            moduleBody.find("#moduleInformation form .confirmDeletModule").show();
            moduleBody.find("#moduleInformation form .cancelDeleteModule").show();
        });
        moduleBody.find("#moduleInformation form .cancelDeleteModule").click(function(){
            moduleBody.find("#moduleInformation form .deleteModule").show();
            moduleBody.find("#moduleInformation form .deleteConfirmation").hide();
            moduleBody.find("#moduleInformation form .confirmDeletModule").hide();
            moduleBody.find("#moduleInformation form .cancelDeleteModule").hide();
        });
        moduleBody.find("#moduleInformation form .confirmDeletModule").click(function(){
            moduleBody.find("#moduleInformation form .deleteModule").hide();
            moduleBody.find("#moduleInformation form .deleteConfirmation").button("loading");
            moduleBody.find("#moduleInformation form .confirmDeletModule").hide();
            moduleBody.find("#moduleInformation form .cancelDeleteModule").hide();
            moduleBody.find("#moduleInformation form").attr("action", api_url("c_training_module/deleteTrainingModule"));
            api_request("c_training_module/deleteTrainingModule", {ID :moduleBody.find("#moduleInformation form input[name=ID]").val()}, function(response){
                moduleBody.find("#moduleInformation form .deleteConfirmation").button("reset");
                if(!response["error"].length){
                    moduleManagementTab.moduleTableList.table.find("tr[account_id="+moduleBody.find("#moduleInformation form input[name=ID]").val()+"]").remove();
                    moduleBody.find("#moduleInformation").modal("hide");
                }else{
                    moduleBody.find("#moduleInformation form .cancelDeleteModule").trigger("click");
                    show_form_error(moduleBody.find("#moduleInformation form"), response["error"]);
                }
                moduleManagementTab.moduleTableList.retrieveEntry();
            });
            
        });
        
        
        /*FUNCTIONS*/
        function listModule(data){
            for(var x = 0; x < data.length; x++){
                var newRow = moduleBody.find(".prototype").find(".moduleRow").clone();
                newRow.attr("training_module_id", data[x]["ID"]);
                newRow.find(".trainingModuleID").text(data[x]["ID"]);
                newRow.find(".trainingModuleDescription").text(data[x]["description"]);
                moduleManagementTab.moduleTableList.table.append(newRow);
            }
        }
        function viewModuleInformation(trainingModule){
            
            
            moduleBody.find("#moduleInformation form").attr("action", api_url("c_training_module/updateTrainingModule"));
            moduleBody.find("#moduleInformation form").trigger("reset");
          
            api_request("c_training_module/retrieveTrainingModule", {ID : trainingModule}, function(response){
                moduleManagementTab.moduleTableList.table.find(".viewModuleInformation").attr("disabled", false);
                if(!response["error"].length){
                    changeFieldName("update", moduleBody.find("#moduleInformation form"));
                    moduleBody.find("#moduleInformation form input[name=ID]").val(response["data"]["ID"]);
                    moduleBody.find("#moduleInformation form input[field_name=description]").val(response["data"]["description"]);
                    moduleBody.find("#moduleInformation").modal("show");
                    moduleBody.find("#moduleInformation form .deleteModule").show();
                }
            });
        }
    };
    

</script>