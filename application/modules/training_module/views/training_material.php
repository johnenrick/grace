
<div class="" id="trainingMaterialTab">
    <div class="row">
        <div class="col-sm-12" id="trainingMaterialInformation">
            <form method="POST" Accept-Charset="utf-8" enctype="multipart/form-data">
                    <input name="ID" type="hidden">
                    
                    <div class="row">
                        <div class="col-sm-12 formMessage">

                        </div>
                    </div>
                    <div class="row form-horizontal">
                        
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-4 btn btn-primary" for="trainingMaterialFileUploadInput">
                                <input id="trainingMaterialFileUploadInput"name="userfile" type="file" style="display:none;" onchange="$('#trainingMaterialFileUploadLabel').html($(this).val().split('fakepath\\')[1]);">
                                <i class="fa fa-folder-open" aria-hidden="true"></i> Select File to Upload
                            </label>
                            <label class="col-sm-4 align-center" for="" style="display:none">   
                                <a id="downloadMaterial" href="" download="proposed_file_name" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Download Uploaded File</a>
                            </label>
                            <div class="col-sm-8">
                                <span id="trainingMaterialFileUploadLabel" class="form-control" type="text" value="text"  ></span>
                            </div>
                        </div>
                    </div>
                    <div class="row form-horizontal">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Training Module</label>
                                <div class="col-sm-8">
                                    <select field_name="training_module_ID" type="text" class="form-control"  placeholder="Description">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Description</label>
                                <div class="col-sm-8">
                                    <input field_name="description" type="text" class="form-control"  placeholder="Description">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 align-right form-group formActionButton">
                            <button action="delete" type="button" class="btn btn-danger pull-left deleteGroup no-display"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Material</button>
                            <label action="delete_confirmation" class="label label-description pull-left deleteConfirmation no-display">Are you sure you want to delete this material?</label>
                            <button action="delete_yes" type="button" class="btn btn-danger pull-left confirmDeletGroup no-display" data-loading-text="Deleting..." style="margin-right: 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i> Yes</button>
                            <button action="delete_no" type="button" class="btn btn-default pull-left cancelDeleteGroup no-display"> No</button>

                            <label class="label formLabelIndicator label-success " >Success!</label>
                            <label class="label formLabelIndicator label-danger">Failed!</label>
                            <button type="submit" class="btn btn-success"><i class="fa fa-upload" aria-hidden="true"></i> Upload File</button>
                            <button action="cancel" type="button" class="btn btn-default">Close</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 trainingMaterialTableContainer">

        </div>
    </div>
    <div class="prototype">
        <table>
            <tr class="trainingMaterialRow" >
                <td class="trainingMaterialID"></td>
                <td class="trainingMaterialDescription"></td>
                <td class="trainingMaterialModuleDescription"></td>
                <td class="moduleAction">
                    <button class="viewTrainingMaterialInformation btn btn-xs btn-primary"><i class="fa fa-search" aria-hidden="true"></i> View</button>
                </td>
            </tr>
        </table>
    </div>
    
</div>
