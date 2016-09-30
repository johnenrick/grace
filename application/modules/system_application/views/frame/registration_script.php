<!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
<script>

    /*Global\ Variable for this module. This is also the moduleName*/
    var registrationModule = function(){
        registrationModule = this;
        function testing(){
            $.confirm({
                title: 'Confirm!',
                content: 'Simple confirm!'
            });
        }
            $("#registrationForm").ajaxForm({
            beforeSubmit: function(data,$form,options){
                var firstname = data[1].value;
                var lastname = data[3].value;
                var username = firstname+""+lastname;
                username = username.replace(/\s+/g, '').toLowerCase();
                data[0].value = username;
            },
            success : function(data){
                var response = JSON.parse(data);
                console.log(response)
                if(!response["error"].length){
                    $(".hide-module:not(#success-module)").hide();
                    $("#success-module").show();
                    $("#first_name").val('');
                    $("#username").val('');
                    $("#middle_name").val('');
                    $("#last_name").val('');
                    $("#email_address").val('');
                    $("#password").val('');
                    $("#country").val('');
                }else{
                    $("#success-module").hide();
                    console.log(response['error']);
                    // show_error($("#registrationForm"), response["error"]);
                }
            }
        });


        $("#loginForm").ajaxForm({
            beforeSubmit: function(data,$form,options){
            },
            success : function(data){
                var response = JSON.parse(data);
                if(!response["error"].length){
                    $(".hide-module:not(#success-module)").hide();
                    $("#username").val('');
                    $("#password").val('');
                    setCredential(response.data.token, response.data.ID, response.data.username, response.data.first_name, response.data.middle_name, response.data.last_name, response.data.account_type_ID);
                    $('#registrationModal').closeModal();
                }else{
                    $("#success-module").hide();
                    console.log(response['error']);
                    // show_error($("#registrationForm"), response["error"]);
                }
            }
        });

    };
    
    /*Adding an asset*/
    load_asset("jquery.form.min.js");
    load_asset("jquery.form.min.js");
    load_asset("registration.css");
    load_asset("core/custom/materialize_modal.css");
    load_asset("jquery.validate.min.js");

    $(document).ready(function(){
        var test = new registrationModule();
        $("#success-module").hide();
        $("#registrationForm").attr('action',api_url("C_account/createAccount"));
        $("#loginForm").attr('action',base_url("portal/login"));
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $("#registrationModal").attr("opacity",1);
        $(".headerAuthentication").click(function(){
            $('#registrationModal').openModal();
            $('#loginField').hide();
            $('#registerField').show();
        });
        $(".headerLogin").click(function(){
            $('#registrationModal').openModal();
            $('#registerField').hide();
            $('#loginField').show();
        });
        var countryList = [
          "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"
        ];
        $( "#country" ).autocomplete({
          source: countryList
        });


        $("#registrationForm").validate({
        rules: {
            first_name: "required",
            last_name: "required",
            email_address: {
                required: true,
                email:true
            },
            password: {
                required: true,
                minlength: 6
            },
            country: "required",
        },
        //For custom messages
        messages: {
            first_name: "First name required",
            last_name: "Last name required",
            password:{
                required: "Password required",
                minlength: "Enter at least 6 characters"
            },
            email_address: "Email is invalid",
            country : "Country required",
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertBefore(element);
          }
        }
     });

        $("#loginForm").validate({
        rules: {

            username: "required",
            password: "required",
        },
        //For custom messages
        messages: {
            username: "Username required",
            password:{
                required: "Password required"
            },
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertBefore(element);
          }
        }
     });
     
    });
</script>

