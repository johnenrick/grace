<script>
    /**
     * Shows error in the form submitted
     * @param {DOM} formElement the form that has been submitted
     * @param {type} errorList list of error from the api
     * @returns {undefined}
     */
    function show_form_error(formElement, errorList) {
        clear_form_error(formElement);
        formElement.find(".formMessage").empty();
        formElement.find(".formMessage").show();
        formElement.find(".formLabelIndicator.label-danger").show();
        var alertContainer = $(".prototype .alert").clone();
        alertContainer.addClass("alert-danger");
        var hasError = false;
        errorList.forEach(function (errorValue) {
            if (errorValue["status"] > 100 && errorValue["status"] < 1000) {/*Form Validation Error*/
                for (var index in errorValue["message"]) {
                    var inputField = formElement.find("input[name='"+index+"'], textarea[name='"+index+"'], select[name='"+index+"'] ").parent().parent();
                    console.log(inputField)
                    inputField.addClass("has-error has-feedback");
                    inputField.find("input,textarea, select").parent().append($(".prototype .form-control-feedback").clone());
                    inputField.find("input,textarea, select").parent().append($(".prototype .help-inline").clone().text(errorValue["message"][index]));
                }
            } else if (errorValue["status"] > 1000 && errorValue["status"] < 10000) {/*System Error*/
                for (var x = 0; x < errorValue["message"].length; x++) {
                    for (var index in errorValue["message"][x]) {
                        formElement.find(".formMessage").append("* " + errorValue["message"][x][index] + "<br>");
                    }
                }
            } else {
                hasError = true;
                alertContainer.append("<strong>*</strong> " + errorValue["message"] + "<br>");
                
            }
        });
        if(hasError){
            formElement.find(".formMessage").append(alertContainer);
        }
        formElement.scrollTo(".formMessage");
    }
    function addFormMessage(formElement, type, message){
        var alertContainer = $(".prototype .alert").clone();
        alertContainer.addClass("alert-"+type);
        alertContainer.append("<strong>*</strong> " + message + "<br>");
        formElement.find(".formMessage").append(alertContainer);
    }
    function clear_form_error(elementSelected) {
        
        elementSelected.find(".formMessage").empty();
        elementSelected.find(".has-error").removeClass("has-error");
        elementSelected.find(".has-feedback").removeClass("has-feedback");
        elementSelected.find(".help-inline").remove();
        elementSelected.find(".form-control-feedback").remove();
        elementSelected.find(".formLabelIndicator").hide();
    }
    /**
     * Show a system message at the bottom of the interface
     *
     * @param {int} status status of the message to avoid conflict
     * @param {int} messageType warning|danger|success|info
     * @param {object} messageDetail the message to be displayed
     * @param {object} link object containing the text and href of the link
     * @returns {undefined}
     */
    function show_system_message(status, messageType, messageDetail, link) {
        var messagePrototype = $("#systemComponent").find(".systemMessage").clone();
        messagePrototype.find(".alert-message").text(messageDetail);
        messagePrototype.attr("message_status", status);
        if (typeof link !== "undefined") {
            messagePrototype.find(".alert-link").text(link["text"]);
            if (typeof link["href"] !== "undefined") {
                messagePrototype.find(".alert-link").attr("href", link["href"]);
            } else if (typeof link["callback"] !== "undefined") {
                messagePrototype.find(".alert-link").click(link["callback"]);
            }

        }
        switch (messageType) {
            case 1: /*warning*/
                messagePrototype.addClass("alert-warning");
                messagePrototype.find(".alert-title").text("Warning!");
                break;
            case 2: /*danger*/
                messagePrototype.addClass("alert-danger");
                messagePrototype.find(".alert-title").text("Alert!");
                break;
            case 3: /*success*/
                messagePrototype.addClass("alert-success");
                messagePrototype.find(".alert-title").text("Success!");
                break;
            case 4: /*info*/
                messagePrototype.addClass("alert-info");
                messagePrototype.find(".alert-title").text("Information!");
                break;
        }

        $("#systemMessageContainer").prepend(messagePrototype);
        messagePrototype.fadeIn();
    }
    /***
     * Remove the message with matching status
     * @param {type} status 
     * @returns {undefined}
     */
    function remove_system_message(status) {
        $("#systemMessageContainer").find(".systemMessage[message_status='" + status + "']").remove();
    }
    function changeFieldName(mode, form){
        form.find("input[field_name!=''], select[field_name!='']").each(function(){
            if(typeof $(this).attr("field_name") !== "undefined"){
                if(mode === "update"){
                    $(this).attr("name", "updated_data["+$(this).attr("field_name")+"]");
                }else{//create
                    $(this).attr("name", $(this).attr("field_name"));
                }
            }else{
            }
        });
    }
    
    /***
     * Add leading zero to a number
     * @param {type} num The number to be padded
     * @param {type} size Number of leading zeros
     * @returns {String}
     */
    function pad(num, size) {
        var s = num+"";
        while (s.length < size) s = "0" + s;
        return s;
    }
    /***
     * 
     * @param {type} arr
     * @returns {unresolved}
     */
    function removeElementByValue(arr) {
        var what, a = arguments, L = a.length, ax;
        while (L > 1 && arr.length) {
            what = a[--L];
            while ((ax = arr.indexOf(what)) !== -1) {
                arr.splice(ax, 1);
            }
        }
        return arr;
    }
    /**
     * Convert phrase to camel case
     * @param {String} str the string to be convert to camel case
     * @returns {Boolean|getURLParameter.parameter}
     */
    function camelize(str) {
        str = str.replace("_", " ");
        return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function (letter, index) {
            return index == 0 ? letter.toLowerCase() : letter.toUpperCase();
        }).replace(/\s+/g, '');
    }
    function getURLParameter(moduleLink){
        var remainingLink = iReplace(window.location.href, base_url(moduleLink.toLowerCase()), "");
        var sectionSplit = remainingLink.split("#");
        var parameter = sectionSplit[0].split("/");
        parameter.splice(0,1);
        return (parameter.length) >= 1 ? parameter : false;
    }
    function iReplace( line, word, replacement)
    {
         var regex = new RegExp( '(' + word + ')', 'gi' );
         return line.replace( regex, replacement );
    }
    String.prototype.spliceInsert = function(index, startIndex, str) {
        return this.slice(0, index) + str + this.slice(index + Math.abs(startIndex));
    };
    function decToBin(dec){
        return (dec >>> 0).toString(2);
    }
    function reverseString(s) {
        var o = '';
        for (var i = s.length - 1; i >= 0; i--)
            o += s[i];
        return o;
    }
    function convertAMPM(rawTime){
        var time = pad(rawTime, 4);
        var splitTime = time.spliceInsert(2, 0, ":").split(":");
        var median = "am";

        if(splitTime[0]*1 > 12 && splitTime[0]*1 < 24){
            median = "pm";
            splitTime[0] = splitTime[0]*1 - 12;
        }else if(splitTime[0]*1 === 12){
            median = "nn";
        }
        if(splitTime[0]*1 === 0){
            splitTime[0] = 24;
        }
        if(splitTime[0]*1 === 24){
            median = "am";
            splitTime[0] = splitTime[0]*1 - 12;
        }
        return pad(splitTime[0], 2)+":"+splitTime[1]+" "+median;
    }
</script>
