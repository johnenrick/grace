<script>
    load_asset("jquery.form.min.js");
    $(document).ready(function(){
        $(".contactPageLink").click(function(){
            $("#contactPage").openModal();
        });
        $("#contactPageForm").attr("action", base_url("system_application/sendContactMessage"));
        $("#contactPageForm").ajaxForm({
            beforeSubmit : function(){
                $("#contactPageForm button").attr("disabled","disabled");
                $("#contactPageForm button").addClass("disabled");
                $("#contactPageForm .progress").show();
            },
            success : function(data){
                $("#contactPageForm .progress").hide();
                console.log(data);
            }
        });
    });
</script>