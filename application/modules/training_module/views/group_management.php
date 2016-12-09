
<div class="" id="groupManagementTab">
    <div class="row">
        <div class="col-sm-12 form-group">

            <button id="createGroup" type="button" class="btn btn-gold pull-right" >
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create New Group
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 moduleTableContainer">

        </div>
    </div>
    
    <div class="modal fade" id="moduleGroupInformation" role="dialog" >
        <div class="modal-dialog modal-lg"  role="document">
            <div class="modal-content">
                <form method="POST">
                    <input name="ID" type="hidden">
                    <div class="modal-header">
                        <h4 class="modal-title">Module Group Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 formMessage">

                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Training Module</label>
                                    <div class="col-sm-8">
                                        <select field_name="training_module_ID" type="text" class="form-control"  placeholder="Training Module"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Instructor</label>
                                    <div class="col-sm-8">
                                        <select field_name="instructor_account_ID" type="text" class="form-control"  placeholder="Instructor"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Start Date</label>
                                    <div class="col-sm-8">
                                        <input field_name="start_datetime_dummy" type="date" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">End Date</label>
                                    <div class="col-sm-8">
                                        <input field_name="end_datetime_dummy" type="date" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-sm-12 ">
                                
                                <table class="groupScheduleTable table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>
                                                Days
                                            </th>
                                            <th>
                                                Start Time
                                            </th>
                                            <th>
                                                End Time
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                                <button type="button" class="anotherGroupSchedule btn btn-success pull-right"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Add Another Schedule</button>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-sm-12">
                                
                                
                                <button id="exportClassList" type="button" class="btn btn-primary pull-left" >
                                    <span class="glyphicon glyphicon-export"></span> Export Class List
                                </button>
                                <table class="groupClassList table table-responsive">
                                    <thead>
                                        <tr >
                                            <th class="align-center" colspan="2">Class List</th>
                                        </tr>
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Full Name
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left deleteGroup no-display"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Group</button>
                        <label class="label label-description pull-left deleteConfirmation no-display">Are you sure you want to delete this module?</label>
                        <button type="button" class="btn btn-danger pull-left confirmDeletGroup no-display" data-loading-text="Deleting..."><i class="fa fa-trash-o" aria-hidden="true"></i> Yes</button>
                        <button type="button" class="btn btn-default pull-left cancelDeleteGroup no-display"> No</button>

                        <label class="label formLabelIndicator label-success " >Success!</label>
                        <label class="label formLabelIndicator label-danger">Failed!</label>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="prototype">
        <table>
            <tr class="groupClassListRow">
                <td class="accountID"></td>
                <td class="accountFullName"></td>
            </tr>
            <tr class="moduleGroup" training_module_group_id="0">
                <td class="trainingModuleGroupID"></td>
                <td class="trainingModuleGroupDescription"></td>
                <td class="trainingModuleGroupInstructorName"></td>
                <td class="trainingModuleGroupSchedule"></td>
                <td class="moduleAction">
                    <button class="viewModuleGroupInformation btn btn-xs btn-primary"><i class="fa fa-search" aria-hidden="true"></i> View</button>
                </td>
            </tr>
            <tr class="moduleGroupScheduleRow" training_module_group_schedule_id="0">
                <td>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input  value="1" type="checkbox" autocomplete="off"> Monday
                        </label>
                        <label class="btn btn-default">
                            <input  value="2" type="checkbox" autocomplete="off"> Tuesday
                        </label>
                        <label class="btn btn-default">
                            <input  value="4" type="checkbox" autocomplete="off"> Wednesday
                        </label>
                        <label class="btn btn-default">
                            <input  value="8" type="checkbox" autocomplete="off"> Thursday
                        </label>
                        <label class="btn btn-default">
                            <input  value="16" type="checkbox" autocomplete="off"> Friday
                        </label>
                        <label class="btn btn-default">
                            <input value="32" type="checkbox" autocomplete="off"> Saturday
                        </label>
                    </div>
                </td>
                <td>
                    <input  class="scheduleStartTime form-control" type="time">
                </td>
                <td>
                    <input  class="scheduleEndTime form-control" type="time">
                </td>
                <td>
                    <button type="button" class="removeSchedule btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                </td>
            </tr>
        </table>
    </div>
</div>
