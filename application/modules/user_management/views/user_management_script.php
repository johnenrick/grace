<script>
    /*global systemApplication, systemUtility*/
    
    /*Adding an asset*/
//    load_asset("jquery-confirm.min.css");
//    load_asset("jquery-confirm.min.js");
    
    /*Module Object*/
    var UserManagement = function(){
        var userManagement = this;//instance of the module
        var moduleBody = userManagement.body = $("#userManagement");
        /*Component*/
        load_component("table_component", function(){
            var columnConfiguration = [{
                description : "ID",
                table_column : "account_information__account_ID",
                default_sort : 1
            },{
                description : "Full Name",
                table_column : "account_information__first_name__CONCAT__account_information__middle_name__CONCAT__account_information__last_name",
                default_sort : 1
            },{
                description : "Role",
                table_column : "account__account_type_ID",
                default_sort : 1
            },{
                description : "Action"
            }];
            var filterConfiguration ={
                fieldFilter : [{
                        description : "Name",
                        table_column : "like__account_information__first_name__CONCAT__account_information__middle_name__CONCAT__account_information__last_name",
                        type : "text"
                }]
            } ;
            var resultConfiguration = {
                result_link : api_url("c_account/retrieveAccount"),
                success : listUser,
                limit : 5
            };
            userManagement.userTableList = new TableComponent(moduleBody.find('.userTableContainer'), resultConfiguration, columnConfiguration, filterConfiguration);
            userManagement.userTableList.table.on("click", ".viewUserInformation", function(){
                userManagement.userTableList.table.find(".viewUserInformation").attr("disabled", true);
                viewUserInformation($(this).parent().parent().attr("account_ID"));
                
            });
        });
        
        
        /*User Information Modal*/
        moduleBody.find("#userInformation form input[field_name=birth_datetime_dummy]").change(function(){
            moduleBody.find("#userInformation form input[field_name=birth_datetime]").val((new Date($(this).val())).getTime()/1000);
            var birthDatetime = new Date($(this).val());
            var currentDate = new Date();
            var age = currentDate.getFullYear() - birthDatetime.getFullYear()-1;
            if(currentDate.getMonth() >= birthDatetime.getMonth() && currentDate.getDate() >= birthDatetime.getDate()){
                age++;
            }
            moduleBody.find("#userInformation form input[name=age]").val(age);
        });
        moduleBody.find("#userInformation form input[name=age]").change(function(){
            var birthdate = new Date(moduleBody.find("#userInformation form input[field_name=birth_datetime_dummy]").val());
            var currentDate = new Date();
            var birthYear = currentDate.getFullYear()-$(this).val()-1;
            if(currentDate.getMonth() >= birthdate.getMonth() && currentDate.getDate() >= birthdate.getDate()){
                birthYear++;
            }
            moduleBody.find("#userInformation form input[field_name=birth_datetime_dummy]").val((birthYear)+"-"+pad(birthdate.getMonth()+1, 2)+"-"+pad(birthdate.getDate(),2));
            moduleBody.find("#userInformation form input[field_name=birth_datetime_dummy]").trigger("change");
        });
        moduleBody.find("#userInformation form").ajaxForm({
            beforeSubmit : function(data, $form, options){
                clear_form_error(moduleBody.find("#userInformation form"));
                moduleBody.find("#userInformation .modal-footer button").attr("disabled", true);
                data.push({
                    name : "username",
                    required : false,
                    type: "text",
                    value : moduleBody.find("#userInformation form input[field_name=first_name]").val()+moduleBody.find("#userInformation form input[field_name=middle_name]").val()+moduleBody.find("#userInformation form input[field_name=last_name]").val()
                });
                /*Educational Background*/
                var newDegreeCtr = 0;
                moduleBody.find("#userInformation .educationalBackgroundTable tbody tr").each(function(){
                    var keyName = ($(this).attr("educational_background_id")*1) ? "updated" : "new";
                    data.push({
                        name : (keyName+"_educational_background["+newDegreeCtr+"][ID]"),
                        required : false,
                        type : "text",
                        value : $(this).attr("educational_background_id")
                    });
                    data.push({
                        name : (keyName+"_educational_background["+newDegreeCtr+"][degree]"),
                        required : false,
                        type : "text",
                        value : $(this).find("input[name=degree]").val()
                    });
                    data.push({
                        name : (keyName+"_educational_background["+newDegreeCtr+"][school]"),
                        required : false,
                        type : "text",
                        value : $(this).find("input[name=school]").val()
                    });
                    data.push({
                        name : (keyName+"_educational_background["+newDegreeCtr+"][academic_year]"),
                        required : false,
                        type : "text",
                        value : ((new Date($(this).find("input[name=academic_year]").val())).getTime()/1000)
                    });
                    newDegreeCtr++;
                });
                for(var x = 0; x < userManagement.removedDegree.length; x++){
                    data.push({
                        name : "deleted_educational_background["+x+"]",
                        required : false,
                        type : "text",
                        value : userManagement.removedDegree[x]
                    });
                }
                /*Personal Interest*/
                var newDegreeCtr = 0;
                moduleBody.find("#userInformation .personalInterestTable tbody tr").each(function(){
                    var keyName = ($(this).attr("personal_interest_id")*1) ? "updated" : "new";
                    data.push({
                        name : (keyName+"_personal_interest["+newDegreeCtr+"][ID]"),
                        required : false,
                        type : "text",
                        value : $(this).attr("personal_interest_id")
                    });
                    data.push({
                        name : (keyName+"_personal_interest["+newDegreeCtr+"][description]"),
                        required : false,
                        type : "text",
                        value : $(this).find("input[name=description]").val()
                    });
                    newDegreeCtr++;
                });
                for(var x = 0; x < userManagement.removedPersonalInterest.length; x++){
                    data.push({
                        name : "deleted_personal_interest["+x+"]",
                        required : false,
                        type : "text",
                        value : userManagement.removedPersonalInterest[x]
                    });
                }
            },
            success : function(data){
                var response = JSON.parse(data);
                if(!response["error"].length){
                    moduleBody.find("#userInformation form .modal-footer .label-success").show();
                    
                    viewUserInformation(moduleBody.find("#userInformation form input[name=ID]").val()*1 ? moduleBody.find("#userInformation form input[name=ID]").val() : response["data"]);
                    setTimeout(function(){
                        moduleBody.find("#userInformation form .modal-footer .label-success").hide();
                    }, 1000);
                }else{
                    //formError
                    show_form_error(moduleBody.find("#userInformation form"), response["error"]);
                }
                userManagement.userTableList.retrieveEntry();
                moduleBody.find("#userInformation .modal-footer button").attr("disabled", false);
            }
        });
        moduleBody.find("#userInformation form").on("reset", function(){
           moduleBody.find("#userInformation .educationalBackgroundTable tbody").empty();
           moduleBody.find("#userInformation .personalInterestTable tbody").empty();
        });
        moduleBody.find("#createUser").click(function(){
            moduleBody.find("#userInformation form").attr("action", api_url("c_account/createAccount"));
            changeFieldName("create", moduleBody.find("#userInformation form"));
            moduleBody.find("#userInformation form").trigger("reset");
            moduleBody.find("#userInformation").modal("show");
            moduleBody.find("#userInformation form input[name=ID]").val(0);
            moduleBody.find("#userInformation form .deleteUser").hide();
        });
        moduleBody.find("#userInformation").on('shown.bs.modal', function() {
            clear_form_error(moduleBody.find("#userInformation form"));
            moduleBody.find("#userInformation form .deleteConfirmation").hide();
            moduleBody.find("#userInformation form .confirmDeletUser").hide();
            moduleBody.find("#userInformation form .cancelDeleteUser").hide();
        });
        moduleBody.find("#userInformation form .deleteUser").click(function(){
            moduleBody.find("#userInformation form .deleteUser").hide();
            moduleBody.find("#userInformation form .deleteConfirmation").show();
            moduleBody.find("#userInformation form .confirmDeletUser").show();
            moduleBody.find("#userInformation form .cancelDeleteUser").show();
        });
        moduleBody.find("#userInformation form .cancelDeleteUser").click(function(){
            moduleBody.find("#userInformation form .deleteUser").show();
            moduleBody.find("#userInformation form .deleteConfirmation").hide();
            moduleBody.find("#userInformation form .confirmDeletUser").hide();
            moduleBody.find("#userInformation form .cancelDeleteUser").hide();
        });
        moduleBody.find("#userInformation form .confirmDeletUser").click(function(){
            moduleBody.find("#userInformation form .deleteUser").hide();
            moduleBody.find("#userInformation form .deleteConfirmation").button("loading");
            moduleBody.find("#userInformation form .confirmDeletUser").hide();
            moduleBody.find("#userInformation form .cancelDeleteUser").hide();
            moduleBody.find("#userInformation form").attr("action", api_url("c_account/deleteAccount"));
            api_request("c_account/deleteAccount", {ID :moduleBody.find("#userInformation form input[name=ID]").val()}, function(response){
                moduleBody.find("#userInformation form .deleteConfirmation").button("reset");
                if(!response["error"].length){
                    userManagement.userTableList.table.find("tr[account_id="+moduleBody.find("#userInformation form input[name=ID]").val()+"]").remove()
                    moduleBody.find("#userInformation").modal("hide");
                }else{
                    moduleBody.find("#userInformation form .cancelDeleteUser").trigger("click");
                    show_form_error(moduleBody.find("#userInformation form"), response["error"]);
                }
                userManagement.userTableList.retrieveEntry();
            });
            
        });
        moduleBody.find("#userInformation .addDegree").click(function(){
            var degree = moduleBody.find(".prototype .educationalBackgroundRow").clone();
            moduleBody.find("#userInformation .educationalBackgroundTable tbody").append(degree);
        });
        userManagement.removedDegree = [];
        moduleBody.find("#userInformation .educationalBackgroundTable").on("click", ".removeDegree", function(){
            var currentRow = $(this).parent().parent();
            if(currentRow.attr("educational_background_id")*1){
                userManagement.removedDegree.push(currentRow.attr("educational_background_id")*1);
            }
            console.log(userManagement.removedDegree)
            currentRow.remove();
        }); 
        userManagement.removedPersonalInterest = [];
        moduleBody.find("#userInformation .addPersonalInterest").click(function(){
            var degree = moduleBody.find(".prototype .personalInterestRow").clone();
            moduleBody.find("#userInformation .personalInterestTable tbody").append(degree);
        });
        userManagement.removedPersonalInterest = [];
        moduleBody.find("#userInformation .personalInterestTable").on("click", ".removePersonalInterest", function(){
            var currentRow = $(this).parent().parent();
            if(currentRow.attr("personal_interest_id")*1){
                userManagement.removedPersonalInterest.push(currentRow.attr("personal_interest_id")*1);
            }
            console.log(userManagement.removedPersonalInterest)
            currentRow.remove();
        }); 

        /*FUNCTIONS*/
        function listUser(data){
            console.log(data);
            for(var x = 0; x < data.length; x++){
                var newRow = moduleBody.find(".prototype").find(".userRow").clone();
                newRow.attr("account_ID", data[x]["account_ID"]);
                newRow.find(".accountID").text(data[x]["account_ID"]);
                newRow.find(".accountFullName").text(data[x]["last_name"]+", "+data[x]["first_name"]+" "+data[x]["middle_name"]);
                newRow.find(".accountRole").text(data[x]["account_type_description"]);
                userManagement.userTableList.table.append(newRow)
            }
        }
        function viewUserInformation(accountID){
            moduleBody.find("#userInformation form").attr("action", api_url("c_account/updateAccount"));
            moduleBody.find("#userInformation form").trigger("reset");
            moduleBody.find("#userInformation .educationalBackgroundTable tbody").empty();
            moduleBody.find("#userInformation .personalInterestTable tbody").empty();
            api_request("c_account/retrieveAccount", {ID : accountID, with_educational_background: true, with_personal_interest : true}, function(response){
                userManagement.userTableList.table.find(".viewUserInformation").attr("disabled", false);
                if(!response["error"].length){
                    changeFieldName("update", moduleBody.find("#userInformation form"));
                    moduleBody.find("#userInformation form input[name=ID]").val(response["data"]["ID"]);
                    moduleBody.find("#userInformation form select[field_name=account_type_ID]").val(response["data"]["account_type_ID"]);
                    moduleBody.find("#userInformation form input[field_name=first_name]").val(response["data"]["first_name"]);
                    moduleBody.find("#userInformation form input[field_name=middle_name]").val(response["data"]["middle_name"]);
                    moduleBody.find("#userInformation form input[field_name=last_name]").val(response["data"]["last_name"]);
                    moduleBody.find("#userInformation form input[field_name=email_address]").val(response["data"]["email_address"]);
                    moduleBody.find("#userInformation form input[field_name=address]").val(response["data"]["address"]);
                    moduleBody.find("#userInformation form input[field_name=nationality]").val(response["data"]["nationality"]);
                    moduleBody.find("#userInformation form input[field_name=profession]").val(response["data"]["profession"]);
                    var birthdate = new Date(response["data"]["birth_datetime"]*1000);
                    moduleBody.find("#userInformation form input[field_name=birth_datetime_dummy]").val(birthdate.getFullYear()+"-"+pad(birthdate.getMonth()+1, 2)+"-"+pad(birthdate.getDate(),2));
                    moduleBody.find("#userInformation form input[field_name=birth_datetime]").val(response["data"]["birth_datetime"]);
                    moduleBody.find("#userInformation form input[field_name=birth_datetime_dummy]").trigger("change");
                    var educationalBackgroundList = response["data"]["educational_background"];
                    if(educationalBackgroundList){
                        for(var x = 0; x < educationalBackgroundList.length;x++){
                            var educationalBackground = moduleBody.find(".prototype .educationalBackgroundRow").clone();
                            educationalBackground.attr("educational_background_id", educationalBackgroundList[x]["ID"]);
                            educationalBackground.find("input[name=degree]").val(educationalBackgroundList[x]["degree"]);
                            educationalBackground.find("input[name=school]").val(educationalBackgroundList[x]["school"]);
                            var academicYear = new Date(educationalBackgroundList[x]["academic_year"]*1000);
                            educationalBackground.find("input[name=academic_year]").val(academicYear.getFullYear()+"-"+pad(academicYear.getMonth()+1, 2)+"-"+pad(academicYear.getDate(),2));
                            moduleBody.find("#userInformation .educationalBackgroundTable tbody").append(educationalBackground);
                        }
                    }
                    var personalInterestList = response["data"]["personal_interest"];
                    if(personalInterestList){
                        for(var x = 0; x < personalInterestList.length;x++){
                            var personalInterest = moduleBody.find(".prototype .personalInterestRow").clone();
                            personalInterest.attr("personal_interest_id", personalInterestList[x]["ID"]);
                            personalInterest.find("input[name=description]").val(personalInterestList[x]["description"]);
                            moduleBody.find("#userInformation .personalInterestTable tbody").append(personalInterest);
                        }
                    }
            
                    moduleBody.find("#userInformation").modal("show");
                    moduleBody.find("#userInformation form .deleteUser").show();
                }
            });
        }
        
    };
        
    $(document).ready(function(){
        systemApplication.module.userManagement = new UserManagement();
    });
</script>