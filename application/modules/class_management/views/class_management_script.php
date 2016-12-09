<script>
    /*global systemApplication, systemUtility*/
    
    /*Adding an asset*/
//    load_asset("jquery-confirm.min.css");
//    load_asset("jquery-confirm.min.js");
    
    /*Module Object*/
    var ClassManagement = function(){
        var classManagement = this;//instance of the module
        var moduleBody = classManagement.body = $("#classManagement");
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
                description : "Action"
            }];
            var filterConfiguration = {  
                customGenerator : function(data){
                    data.push({
                        name : "condition[training_module_group_ID]",
                        required : false,
                        type : "text",
                        value : moduleBody.find("#trainingModuleSelection").val()*1
                    });
                },
                fieldFilter : [{
                        description : "Name",
                        table_column : "like__account_information__first_name__CONCAT__account_information__middle_name__CONCAT__account_information__last_name",
                        type : "text"
                }]
            };
            var resultConfiguration = {
                result_link : api_url("c_training_module_group_member/retrieveTrainingModuleGroupMember"),
                success : listClassStudent,
                limit : 0
            };
            classManagement.classTableList = new TableComponent(moduleBody.find('.classTableContainer'), resultConfiguration, columnConfiguration, filterConfiguration);
            
            classManagement.classTableList.table.on("click", ".viewClassInformation", function(){
                viewUserInformation($(this).parent().parent().attr("account_id")*1);
                
            });
            //Student Management Table
            var columnConfiguration = [{
                description : "ID",
                table_column : "account_information__account_ID",
                default_sort : 1
            },{
                description : "Full Name",
                table_column : "account_information__first_name__CONCAT__account_information__middle_name__CONCAT__account_information__last_name",
                default_sort : 1
            },{
                description : "Action"
            }];
            var filterConfiguration = {  
                customGenerator : function(data){
                },
                fieldFilter : [{
                        description : "Name",
                        table_column : "like__account_information__first_name__CONCAT__account_information__middle_name__CONCAT__account_information__last_name",
                        type : "text"
                },{
                        description : "Account Type",
                        table_column : "account__account_type_ID",
                        type : "hidden",
                        value : 3
                }]
            };
            var resultConfiguration = {
                result_link : api_url("c_account/retrieveAccount"),
                success : listStudent,
                limit : 10
            };
            classManagement.classListManagementTable = new TableComponent(moduleBody.find('#classListManagementModal .studentManagementTableContainer'), resultConfiguration, columnConfiguration, filterConfiguration);
            classManagement.classListManagementTable.table.on("click", ".addStudent", function(){
                $(this).hide();
                addStudent($(this).parent().parent().attr("account_id"));
            });
            classManagement.classListManagementTable.table.on("click", ".removeStudent", function(){
                $(this).hide();
                removeStudent($(this).parent().parent().attr("account_id"));
            });
        });
        
        /*EVENT BINDING*/
        moduleBody.find("#addTrainingModuleMember").click(function(){
            moduleBody.find("#classListManagementModal").modal("show");
        });
        moduleBody.find("#exportClassList").click(function(){
            console.log(classManagement.classTableList)
            var uri = 'data:application/vnd.ms-excel;base64,'
              , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
              , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
              , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
            
            
            var table = classManagement.classTableList.table.clone();
            var name = "test";
            table.find("td:nth-child(3)").remove();
            table.find("th:nth-child(3)").remove();
            table.find("tfoot").remove();
            table.find("thead").prepend("<tr><th colspan='2'>"+moduleBody.find("#trainningModuleTableDescription").text()+"</th></tr>")
            var ctx = {worksheet: name || 'Worksheet', table: table.html()}
            var link = document.createElement("a");
            link.download = moduleBody.find("#trainningModuleTableDescription").text().replace(/ /g,'')+".xls";
            link.href = uri + base64(format(template, ctx));
            link.click();
            return true;
        });
        moduleBody.find("#viewTrainingModuleMember").click(function(){
            
            classManagement.classTableList.retrieveEntry();
            if(moduleBody.find("#trainingModuleSelection").val()*1 > 0){
                var trainingModule = moduleBody.find("#trainingModuleSelection option:selected").text().split("Schedule");
                moduleBody.find("#trainningModuleTableDescription").text(trainingModule[0].replace(/ /g,'').replace(/\u00A0/g,''));
                moduleBody.find("#addTrainingModuleMember").show();
                moduleBody.find("#exportClassList").show();
            }else{
                moduleBody.find("#trainningModuleTableDescription").text("No Class Selected");
                moduleBody.find("#addTrainingModuleMember").hide();
                moduleBody.find("#exportClassList").hide();
            }
            moduleBody.find("#classListManagementModal").attr("training_module_group_id", moduleBody.find("#trainingModuleSelection").val());
        });
        /*Class Information Modal*/
        moduleBody.find("#classInformation form").ajaxForm({
            beforeSubmit : function(data, $form, options){
                clear_form_error(moduleBody.find("#classInformation form"));
                data.push({
                    name : "classname",
                    required : false,
                    type: "text",
                    value : moduleBody.find("#classInformation form input[field_name=first_name]").val()+moduleBody.find("#classInformation form input[field_name=middle_name]").val()+moduleBody.find("#classInformation form input[field_name=last_name]").val()
                });
            },
            success : function(data){
                var response = JSON.parse(data);
                if(!response["error"].length){
                    moduleBody.find("#classInformation form .modal-footer .label-success").show();
                    
                    viewClassInformation(moduleBody.find("#classInformation form input[name=ID]").val()*1 ? moduleBody.find("#classInformation form input[name=ID]").val() : response["data"]);
                    setTimeout(function(){
                        moduleBody.find("#classInformation form .modal-footer .label-success").hide();
                    }, 1000);
                }else{
                    //formError
                    show_form_error(moduleBody.find("#classInformation form"), response["error"]);
                }
            }
        });
        
        
        /*FUNCTIONS*/
        var dayCodeSymbol = {
            1 : "Mon",
            2 : "Tue",
            4 : "Wed",
            8 : "Thu",
            16 : "Fri",
            32 : "Sat",
            64 : "Sun"
        };
        function listUserTrainingModuleGroup(){
            moduleBody.find("#trainingModuleSelection").empty();
            var condition  = {
                instructor_account_ID : user_id()
            };
            var request = api_request("c_training_module_group/retrieveTrainingModuleGroup", {condition : condition, with_training_module_group_schedule : true}, function(response){
                if(!response["error"].length){
                    moduleBody.find("#trainingModuleSelection").append("<option value='"+0+"'>Select Training Module Group</option>");
                    for(var x =0; x <response["data"].length;x++){
                        var scheduleList = response["data"][x]["training_module_group_schedule"];
                        var scheduleListString = "";
                        if(scheduleList){
                            for(var sx = 0; sx < scheduleList.length;sx++){
                                var days = "";
                                var dayCode = reverseString(decToBin(scheduleList[sx]["day"]));
                                for(var y = 0; y < dayCode.length; y++){
                                    if(dayCode[y]*1){
                                        days += dayCodeSymbol[Math.pow(2,y)]+" ";
                                    }
                                }
                                scheduleListString += convertAMPM(scheduleList[sx]["start_time"])+" - "+convertAMPM(scheduleList[sx]["end_time"])+" "+days +((sx !== scheduleList.length-1)  ? ", ":"" );
                            }
                        }
                        moduleBody.find("#trainingModuleSelection").append("<option  value='"+response["data"][x]["ID"]+"'>"+(response["data"][x]["training_module_description"]).toUpperCase()+" Group "+response["data"][x]["ID"]+" &nbsp;&nbsp;&nbsp;Schedule: "+(scheduleListString === "" ? "None" : scheduleListString)+"</option>");
                    }
                }
            });
            return request;
        }
        function addStudent(accountID){
            var newStudent = {
                training_module_group_ID : moduleBody.find("#classListManagementModal").attr("training_module_group_id"),
                member_account_ID : accountID
            };
            api_request("c_training_module_group_member/createTrainingModuleGroupMember", newStudent, function(response){
                if(!response["error"].length){
                    moduleBody.find(".studentManagementTableContainer tr[account_id="+accountID+"] .removeStudent").show();
                    classManagement.classTableList.retrieveEntry();
                }else{
                    moduleBody.find(".studentManagementTableContainer tr[account_id="+accountID+"] .addStudent").show();
                    classManagement.classTableList.retrieveEntry();
                }
            });
        }
        function removeStudent(accountID){
            var student = {
                training_module_group_ID : moduleBody.find("#classListManagementModal").attr("training_module_group_id"),
                member_account_ID : accountID
            };
            api_request("c_training_module_group_member/deleteTrainingModuleGroupMember", {condition : student}, function(response){
                if(!response["error"].length){
                    moduleBody.find(".studentManagementTableContainer tr[account_id="+accountID+"] .removeStudent").hide();
                    moduleBody.find(".studentManagementTableContainer tr[account_id="+accountID+"] .addStudent").show();
                    classManagement.classTableList.retrieveEntry();
                }else{
                    classManagement.classTableList.retrieveEntry();
                }
            });
        }
        
        function listClassStudent(data){
            console.log(data);
            for(var x = 0; x < data.length; x++){
                var newRow = moduleBody.find(".prototype").find(".classRow").clone();
                newRow.attr("account_ID", data[x]["account_ID"]);
                newRow.find(".accountID").text(data[x]["account_ID"]);
                newRow.find(".accountFullName").text(data[x]["last_name"]+", "+data[x]["first_name"]+" "+data[x]["middle_name"]);
                newRow.find(".accountRole").text(data[x]["account_type_description"]);
                classManagement.classTableList.table.append(newRow)
            }
        }
        function listStudent(data){
            for(var x = 0; x < data.length; x++){
                var newRow = moduleBody.find(".prototype").find(".studentRow").clone();
                newRow.attr("account_ID", data[x]["account_ID"]);
                newRow.find(".accountID").text(data[x]["account_ID"]);
                newRow.find(".accountFullName").text(data[x]["last_name"]+", "+data[x]["first_name"]+" "+data[x]["middle_name"]);
                if(classManagement.classTableList.table.find("tr[account_id="+data[x]["account_ID"]+"]").length){
                    newRow.find(".addStudent").hide();
                }else{
                    newRow.find(".removeStudent").hide();
                }
                classManagement.classListManagementTable.table.append(newRow)
            }
        }
        function viewUserInformation(accountID){
            moduleBody.find("#userInformation form").attr("action", api_url("c_account/updateAccount"));
            moduleBody.find("#userInformation form").trigger("reset");
            moduleBody.find("#userInformation .educationalBackgroundTable tbody").empty();
            moduleBody.find("#userInformation .personalInterestTable tbody").empty();
            api_request("c_account/retrieveAccount", {ID : accountID, with_educational_background: true, with_personal_interest : true}, function(response){
                classManagement.classTableList.table.find(".viewUserInformation").attr("disabled", false);
                if(!response["error"].length){
                    changeFieldName("update", moduleBody.find("#userInformation form"));
                    moduleBody.find("#userInformation form input[name=ID]").val(response["data"]["ID"]);
                    moduleBody.find("#userInformation form span[field_name=account_type_ID]").val(response["data"]["account_type_ID"]);
                    moduleBody.find("#userInformation form span[field_name=first_name]").text(response["data"]["first_name"]);
                    moduleBody.find("#userInformation form span[field_name=middle_name]").text(response["data"]["middle_name"]);
                    moduleBody.find("#userInformation form span[field_name=last_name]").text(response["data"]["last_name"]);
                    moduleBody.find("#userInformation form span[field_name=email_address]").text(response["data"]["email_address"]);
                    moduleBody.find("#userInformation form span[field_name=address]").text(response["data"]["address"]);
                    moduleBody.find("#userInformation form span[field_name=nationality]").text(response["data"]["nationality"]);
                    moduleBody.find("#userInformation form span[field_name=profession]").text(response["data"]["profession"]);
                    var birthdate = new Date(response["data"]["birth_datetime"]*1000);
                    moduleBody.find("#userInformation form span[field_name=birth_datetime_dummy]").text(birthdate.getFullYear()+"-"+pad(birthdate.getMonth()+1, 2)+"-"+pad(birthdate.getDate(),2));
                    var currentDate = new Date();
                    var age = currentDate.getFullYear() - birthdate.getFullYear()-1;
                    if(currentDate.getMonth() >= birthdate.getMonth() && currentDate.getDate() >= birthdate.getDate()){
                        age++;
                    }
                    moduleBody.find("#userInformation form span[name=age]").text(age);
            
                    var educationalBackgroundList = response["data"]["educational_background"];
                    if(educationalBackgroundList){
                        for(var x = 0; x < educationalBackgroundList.length;x++){
                            var educationalBackground = moduleBody.find(".prototype .educationalBackgroundRow").clone();
                            educationalBackground.attr("educational_background_id", educationalBackgroundList[x]["ID"]);
                            educationalBackground.find("span[name=degree]").text(educationalBackgroundList[x]["degree"]);
                            educationalBackground.find("span[name=school]").text(educationalBackgroundList[x]["school"]);
                            var academicYear = new Date(educationalBackgroundList[x]["academic_year"]*1000);
                            educationalBackground.find("span[name=academic_year]").text(academicYear.getFullYear()+"-"+pad(academicYear.getMonth()+1, 2)+"-"+pad(academicYear.getDate(),2));
                            moduleBody.find("#userInformation .educationalBackgroundTable tbody").append(educationalBackground);
                        }
                    }
                    var personalInterestList = response["data"]["personal_interest"];
                    if(personalInterestList){
                        for(var x = 0; x < personalInterestList.length;x++){
                            var personalInterest = moduleBody.find(".prototype .personalInterestRow").clone();
                            personalInterest.attr("personal_interest_id", personalInterestList[x]["ID"]);
                            personalInterest.find("span[name=description]").text(personalInterestList[x]["description"]);
                            moduleBody.find("#userInformation .personalInterestTable tbody").append(personalInterest);
                        }
                    }
            
                    moduleBody.find("#userInformation").modal("show");
                    moduleBody.find("#userInformation form .deleteUser").show();
                }
            });
        }
        classManagement.ready = function(){
            listUserTrainingModuleGroup();
        };
    };
        
    $(document).ready(function(){
        systemApplication.module.classManagement = new ClassManagement();
    });
</script>