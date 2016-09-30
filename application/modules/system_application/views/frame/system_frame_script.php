<script>
    /*global system_data, systemApplication*/   
    function setSystemFrameCredential(){
        if(user_id()){//Log In
            $("#navbar").find("a[href='#sectionGallery']").hide();
            $("#navbar").find("a[href='#SectionTestimonials']").hide();
            $("#signInLink").hide();
            $(".userProfileMenu").show();
            $(".userProfileMenu .dropdown-toggle").text("Hello! "+user_first_name());
            $(".adminPageMenu").hide();
            $(".instructorPageMenu").hide();
            if(user_type() === 1 || user_type() === 5){
                $(".instructorPageMenu").show();
            }
            if(user_type() === 1 || user_type() === 4){
                $(".adminPageMenu").show();
            }
            
        }else{//Log Out
            $("#navbar").find("a[href='#sectionGallery']").show();
            $("#navbar").find("a[href='#SectionTestimonials']").show();
            $("#signInLink").show();
            $(".userProfileMenu").hide();
            $(".adminPageMenu").hide();
            $(".instructorPageMenu").hide();
        }
    }
    function addFormMessage(form, status, message){
        switch(status){
            case "success":
                var message = form.find(".formMessage").append('<div class="alert alert-success "> '+message+'</div>');
                setTimeout(function(){
                    message.find(".alert").remove();
                },3000);
                break;
            case "info":
                var message = form.find(".formMessage").append('<div class="alert alert-info">'+message+'</div>');
                setTimeout(function(){
                    message.find(".alert").remove();
                },3000);
                break;
            case "warning":
                var message = form.find(".formMessage").append('<div class="alert alert-warning ">'+message+'</div>');
                setTimeout(function(){
                    message.find(".alert").remove();
                },3000);
                break;
            case "danger":
                var message = form.find(".formMessage").append('<div class="alert alert-danger">'+message+'</div>');
                setTimeout(function(){
                    message.find(".alert").remove();
                },3000);
                break;
        }
    }
    /***
     * Load module to the page
     * @param {String} moduleLink Controller/Function of the module
     * @param {String} moduleName Name of the module
     * @extraData {String} moduleName Name of the module
     * @returns {undefined}
     */
    var isloadingModule = false;
    function load_module(moduleLink, moduleName, extraData){
        if(isloadingModule){
            return false;
        }else{
            isloadingModule = true;
        }
        moduleName = moduleName.replace("#","");
        var section = window.location.href.split("#");
        window.history.pushState('Object', 'Title', base_url(moduleLink)+(section.length >1  ? "#"+section[1] : ""));
        if($(".page-content").find(".moduleHolder[module_link='"+moduleLink+"']").length === 0){
            var data = {};
            if(typeof extraData !== "undefined"){
                extraData["load_module"] = true;
                data = extraData;
            }else{
                data = {load_module : true};
            }
            $.post(base_url(moduleLink), data, function(data){
                /*CHECK IF JSON OR HTML FOR AUTHORIZATION*/
                var moduleHolder = $("#systemModule").find(".moduleHolder").clone();
                moduleHolder.attr("module_link", moduleLink);
                moduleHolder.attr("id",moduleName.replace(/_([a-z])/g, function (g) { return g[1].toUpperCase(); }));
                moduleHolder.append(data);
                $(".page-content").append(moduleHolder);
                /*show page*/
                $(".page-content").find(".moduleHolder[module_link!='"+moduleLink+"']").hide();
                if(typeof systemApplication.module[camelize(moduleName)] !== "undefined" && typeof systemApplication.module[camelize(moduleName)].ready !== "undefined"){
                    systemApplication.module[camelize(moduleName)].ready();
                }
                isloadingModule = false;
            });
        }else{
            /*show page*/
            $("#mainContent").find(".moduleHolder[module_link!='"+moduleLink+"']").hide();
            if($('#mainContent .moduleHolder[module_link="'+moduleLink+'"]').is(":visible") === false){
                $('.moduleHolder[module_link="'+moduleLink+'"]').fadeIn(500);
                if(typeof systemApplication.module[camelize(moduleName)] !== "undefined" && typeof systemApplication.module[camelize(moduleName)].ready !== "undefined"){
                    systemApplication.module[camelize(moduleName)].ready();
                }
            }
            isloadingModule = false;
        }
    }
    $(document).ready(function(){
        //Module Redirection
        $(".moduleLink").click(function(){
            $(".moduleLink").parent().removeClass("active");
            $(this).parent().addClass("active");
            var data = {};
            if($(this).attr("module_link").toLowerCase() === "portal"){
                data = {
                    section : $(this).attr("href")
                };
            }
            load_module($(this).attr("module_link"), $(this).attr("module_name"), data);
        });
        $("#signInModal form").attr("action", base_url("portal/login"));
        $("#signInModal form").ajaxForm({
            beforeSubmit : function(data){
                $("#signInModal form button").button("loading");
            },
            success : function(data){
                var response = JSON.parse(data);
                if(!response["error"].length){
                    setCredential(response["data"]["token"], response["data"]["ID"], response["data"]["username"], response["data"]["first_name"], response["data"]["middle_name"], response["data"]["last_name"], response["data"]["account_type_ID"]);
                    $("#signInModal").modal("hide");
                    setTimeout(function(){
                        for(var x in systemApplication.module){
                            if(typeof systemApplication.module[x].ready !== "undefined"){
                                systemApplication.module[x].ready();
                            }
                        }
                    },3000);
                    
                }else{
                    for(var x = 0; x< response["error"].length; x++){
                        addFormMessage($("#signInModal form"), "warning", response["error"][x]["message"]);
                    }
                }
                $("#signInModal form button").button("reset");
            },
            done : function(){
                alert();
            }
        });
        $(".logoutLink").click(function(){
           logout(); 
           for(var x in systemApplication.module){
                if(typeof systemApplication.module[x].ready !== "undefined"){
                    systemApplication.module[x].ready();
                }
            }
            load_module("portal","Portal")
        });
        $(".trainingProgramMenu ul a").click(function(){
            $("#sectionPrograms .nav a[href="+$(this).attr("rhref")+"]").trigger("click");           
        });
    });

</script>