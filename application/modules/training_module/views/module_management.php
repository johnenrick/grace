
<div class="" id="moduleManagementTab">
    <div class="row">
        <div class="col-sm-12 form-group">

            <button id="createModule" type="button" class="btn btn-gold pull-right" >
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create New Module
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 moduleTableContainer">

        </div>
    </div>
    <div class="prototype">
        <table>
            <tr class="moduleRow" training_module_id="0">
                <td class="trainingModuleID"></td>
                <td class="trainingModuleDescription"></td>
                <td class="moduleAction">
                    <button class="viewModuleInformation btn btn-xs btn-primary"><i class="fa fa-search" aria-hidden="true"></i> View</button>
                </td>
            </tr>
        </table>
    </div>
    <div class="modal fade" id="moduleInformation" role="dialog" >
        <div class="modal-dialog modal-lg"  role="document">
            <div class="modal-content">
                <form method="POST">
                    <input name="ID" type="hidden">
                    <div class="modal-header">
                        <h4 class="modal-title">Module Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 formMessage">

                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Description</label>
                                    <div class="col-sm-8">
                                        <input field_name="description" type="text" class="form-control"  placeholder="Description">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left deleteModule no-display"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Module</button>
                        <label class="label label-description pull-left deleteConfirmation no-display">Are you sure you want to delete this module?</label>
                        <button type="button" class="btn btn-danger pull-left confirmDeletModule no-display" data-loading-text="Deleting..."><i class="fa fa-trash-o" aria-hidden="true"></i> Yes</button>
                        <button type="button" class="btn btn-default pull-left cancelDeleteModule no-display"> No</button>

                        <label class="label formLabelIndicator label-success " >Success!</label>
                        <label class="label formLabelIndicator label-danger">Failed!</label>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
