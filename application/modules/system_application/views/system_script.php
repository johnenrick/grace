<script>
    if(window.location.href.indexOf("www") !== -1){
        window.location = window.location.href.replace("www.", "");
    }
    var system_data = {
        account_information : {
            user_ID : null,
            first_name : null,
            middle_name : null,
            last_name : null,
            username : null,
            user_type : null
        },
        
        default : {
            module_controller : "<?=$default["module"]?>"
        },
        access_control_list :{},
        refresh_call : {

        },
        request_data :{
            
        },
        token : null
    };
    var systemApplication = {
        module : {},
        url : {
            base_url : "<?=base_url()?>",
            api_url : "<?=api_url()?>",
            asset_url : "<?=asset_url()?>"
        },
        url_parameter : {}
    };
    function user_id(){
        return system_data.account_information.user_ID;
    }
    function user_type(){
        return system_data.account_information.user_type;
    }
    function user_first_name(){
        return system_data.account_information.first_name;
    }
    function user_middle_name(){
        return system_data.account_information.middle_name;
    }
    function user_last_name(){
        return system_data.account_information.last_name;
    }
    function refreshAccountInformation(){
        api_request("C_account/retrieveAccount", {user_ID : system_data.account_information.user_ID}, function(response){
            
            if(!response["error"].length){
                system_data.account_information.first_name = response["data"]["first_name"];
                system_data.account_information.middle_name = response["data"]["middle_name"];
                system_data.account_information.last_name = response["data"]["last_name"];
                system_data.account_information.email_address = response["data"]["email_address"];
                system_data.account_information.country = response["data"]["country"];
            }else{
                //TODO if account not found
                
            }
        });
    }
    function base_url(link){
       return systemApplication.url.base_url+((typeof link === "undefined") ? "" : link);
    }
    function api_url(link){
       return systemApplication.url.api_url+link;
    }
    function asset_url(link){
       return systemApplication.url.asset_url+link;
    }
    function user_video_url(uploaderAccountID, videoFilename){
        return systemApplication.url.asset_url+"user_upload/"+uploaderAccountID+"/"+videoFilename;
    }
    function user_photo_url(accountID, photoFilename){
        return systemApplication.url.asset_url+"user_upload/"+accountID+"/"+photoFilename;
    }
    function retrieve_access_control(){
        $.post(api_url("C_access_control_list/retrieveAccessControlList"), {}, function(data){
            var response = JSON.parse(data);
            if(!response["error"].length){
                if(response["data"]["access_control_list"]){
                    for(var x = 0; x < response["data"]["access_control_list"].length; x++){
                        system_data.access_control_list[response["data"]["access_control_list"][x]["module_ID"]] = (response["data"]["access_control_list"][x]);
                    }
                }
                if(response["data"]["group_access_control_list"]){
                    for(var x = 0; x < response["data"]["group_access_control_list"].length; x++){
                        system_data.access_control_list[response["data"]["group_access_control_list"][x]["module_ID"]] = (response["data"]["group_access_control_list"][x]);
                    }
                }
            }
        });
    }
    
    /***
     * Call the refresh function of the module
     * @param {String} moduleName Name of the module to be refreshed
     * @returns {undefined}
     */
    function refresh_call(moduleName){
        if(typeof system_data.refresh_call[moduleName] !== "undefined"){
            for(var x = 0; x < system_data.refresh_call[moduleName].length; x++){
                system_data.refresh_call[moduleName][x]();
            }
        }
    }
    /**
     * Add functions that needs to be called everytime the module is viewed
     * @param {string} moduleName name of the module in underscore format
     * @param {type} refreshFunction function to be called
     * @returns {undefined}
     */
    function add_refresh_call(moduleName, refreshFunction){
        if(typeof system_data.refresh_call[moduleName] === "undefined"){
            system_data.refresh_call[moduleName] = [];
        }
        if($(".wl-active-page").attr("module_name") === moduleName){
            refreshFunction();
        }
        system_data.refresh_call[moduleName].push(refreshFunction);
    }
    
    /**
     * Load a Page Component to the Document.
     * @param {string} component The name of the component to be loaded
     * @param {function} callBack The function called after the component is loaded. This is where the purpose of loading a component being place
     * @returns {none}
     */
    function load_component(component, callBack){
        if($("#pageComponentContainer ."+component).length === 0 ){
            $.post("<?=base_url()?>component/"+component, {component : component}, function(data){
                if($("#pageComponentContainer ."+component).length === 0 ){
                    var componentHolder = $("#pageComponentContainerPrototype .componentHolder").clone();
                    componentHolder.addClass(component);
                    componentHolder.append(data);
                    $("#pageComponentContainer").append(componentHolder);
                }
                callBack();
            });
        }else{
            callBack();
        }
    }
    function load_sub_module(moduleLink, callBack, data){
        data = (typeof data === "undefined") ? {}: data;
        $.post(base_url(moduleLink), data,function(data){
            callBack(data);
        });
    }
    /***
     * Send an API request. This is to be use instead for $.post for trapping different cases
     * @param {String} link the controller and function of the api
     * @param {Object} data parameter of the request
     * @param {Function} callbackFn Callback function if the request is successful
     * @param (boolean) tokenRequired prevent request if no token
     * @returns {undefined}
     */
    function api_request(link, data, callbackFn, tokenRequired){
        tokenRequired = typeof tokenRequired === "undefined" ? true : tokenRequired;
        var request = $.post(api_url(link), data, function(data){
            var response = JSON.parse(data);
            //Check token
            if(response["token"] || tokenRequired === false){
                callbackFn(response);
            }else if(response["token"] === -1){//expired token
                //Show log in, then call the callbackFn if log in is successful
            }
            
        });
        return request;
    }
    /*** Functions for requesting***/
    /***
     * Load an asset
     * @param {String} link The link of the asset to be loaded
     * @returns {Boolean}
     */
    function load_asset(link) {
        if (link.indexOf(".css") > -1) {
            if (!$("link[href='" + asset_url("css/" + link) + "']").length) {
                var systemModule = $("#systemModule").find("link").clone();
                systemModule.attr("href", asset_url("css/" + link));
                $("head").append(systemModule);
                return true;
            } else {
                return false;
            }
        } else {
            if (!$("script[src='" + asset_url("js/" + link) + "']").length) {
                var systemModule = $("#systemModule").find("script").clone();
                var s = document.createElement("script");
                s.type = "text/javascript";
                s.src = asset_url("js/" + link);
                $("head").append(s);
                return true;
            } else {
                return false;
            }
        }
    }
    
    /*Authentication*/
    function setCredential(token, ID, userName, firstName, middleName, lastName, accountTypeID){
        
        setToken(token);
        if(token){
            system_data.account_information.username = userName;
            system_data.account_information.first_name = firstName;
            system_data.account_information.middle_name = middleName;
            system_data.account_information.last_name = lastName;
            if(system_data.account_information.user_ID !== ID && system_data.account_information.user_type !== accountTypeID){//New Credentials
                //TODO Reset system frame for new log in
                system_data.account_information.user_ID = ID*1;
                system_data.account_information.user_type = accountTypeID*1;
                setSystemFrameCredential();
            }
            
            system_data.account_information.user_ID = ID*1;
            system_data.account_information.user_type = accountTypeID*1;
        }else{
            //TODO Reset system frame for Log out/Not login
            system_data.account_information.user_ID = null;
            system_data.account_information.user_type = null;
            system_data.account_information.username = null;
            system_data.account_information.first_name = null;
            system_data.account_information.middle_name = null;
            system_data.account_information.last_name = null;
            setSystemFrameCredential();
        }
    }
    function logout(){
        setCredential(null);
    }
    function setToken(token){
        document.cookie = "token"+ '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';//Destroy Cookie
        if(token !== null){
            document.cookie = "token="+token;
        }
        $.ajaxSetup({
            global: true,
            type: "POST",
            headers : {
                token: getCookie("token")
            }
        });
    }
    function getCookie(cookieKey){
        var cookieList = document.cookie.split(";");
        if(document.cookie.indexOf(cookieKey) !== -1){
            for(var x = 0; x < cookieList.length; x++){
                if(cookieList[x].indexOf(cookieKey) !== -1){
                    var token = cookieList[x].split(cookieKey+"="); 
                    return (token[1] === "null") ? null : token[1];
                }
            }
            return null;
        }else{
            return null;
        }
    }
    function clearListCookies(){   
        var cookies = document.cookie.split(";");
        for (var i = 0; i < cookies.length; i++)
        {
            var spcook = cookies[i].split("=");
            deleteCookie(spcook[0]);
        }
    
        function deleteCookie(cookiename){
            var d = new Date();
            d.setDate(d.getDate() - 1);
            var expires = ";expires=" + d;
            var name = cookiename;
            //alert(name);
            var value = "";
            document.cookie = name + "=" + value + expires + ";";
        }
        window.location = ""; // TO REFRESH THE PAGE
    }
</script>

<!--Document Ready-->
<script>
    
    $(document).ajaxSuccess(function(event, xhr, settings){
        try{
            var response = JSON.parse(xhr.responseText);
            if(typeof response["token"] !== "undefined"){
                if(getCookie("token") !== null){
                    setToken(response["token"]);
                }
                //TODO Handle system errors here
            }
        }catch(e){
        }
    });
    $(document).ready(function(){
        //redirect www
        
        $.ajaxSetup({
            global: true,
            type: "POST",
            headers : {
                token: getCookie("token")
            }
        });
        /*Setting token*/
        
        var token = getCookie("token");
        if(token !== null ){
            $.post(base_url("portal/userInformation"), {}, function (data) {
                var response = JSON.parse(data);
                if (!response["error"].length) {
                    setCredential(response["token"], response["data"]["ID"], response["data"]["username"], response["data"]["first_name"], response["data"]["middle_name"], response["data"]["last_name"], response["data"]["account_type_ID"]);
                } else {
                    setCredential(null);
                }
                var moduleLink = window.location.href.replace(base_url(), "");
                load_module(system_data.default.module_controller, moduleLink);
            });
        } else {
            setCredential(null);
            var moduleLink = window.location.href.replace(base_url(), "");
            load_module(system_data.default.module_controller, moduleLink);
        }
        
        
        //load default page
        
//        retrieve_access_control();
        
    });
</script>
