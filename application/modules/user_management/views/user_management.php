<section id="userManagement" class="page-section clearfix container" >
    <div class=" section-content">
        <div class="row">
            <div class="col-sm-12 form-group">
                
                <button id="createUser" type="button" class="btn btn-gold pull-right" >
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create New User
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 userTableContainer">

            </div>
        </div>

    </div>
    <div class="modal fade" id="userInformation" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-lg"  role="document">
            <div class="modal-content">
                <form method="POST">
                    <input name="ID" type="hidden">
                    <div class="modal-header">
                        <h4 class="modal-title">User Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 formMessage">
                                
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Role</label>
                                    <div class="col-sm-8">
                                        <select field_name="account_type_ID" class="form-control">
                                            <option value="3">Student</option>
                                            <option value="5">Instructor</option>
                                            <option value="4">Administrator</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">First Name</label>
                                    <div class="col-sm-8">
                                        <input field_name="first_name" type="text" class="form-control"  placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Middle Name</label>
                                    <div class="col-sm-8">
                                        <input field_name="middle_name" type="text" class="form-control"  placeholder="Middle Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Last Name</label>
                                    <div class="col-sm-8">
                                        <input field_name="last_name" type="text" class="form-control"  placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Profession</label>
                                    <div class="col-sm-8">
                                        <input field_name="profession" type="text" class="form-control"  placeholder="Profession">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Email Address</label>
                                    <div class="col-sm-8">
                                        <input field_name="email_address" type="email" class="form-control"  placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Address</label>
                                    <div class="col-sm-8">
                                        <input field_name="address" type="text" class="form-control"  placeholder="Address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Nationality</label>
                                    <div class="col-sm-8">
                                        <input field_name="nationality" type="text" class="form-control"  placeholder="Nationality">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Birthday</label>
                                    <div class="col-sm-8">
                                        <input field_name="birth_datetime_dummy" type="date" class="form-control"  placeholder="Birthday">
                                        <input field_name="birth_datetime" type="hidden" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Age</label>
                                    <div class="col-sm-8">
                                        <input name="age" type="number" class="form-control"  placeholder="Age">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="educationalBackgroundTable table table-responsive  table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="4">Educational Background</th>
                                        </tr>
                                        <tr>
                                            <th>Degree</th>
                                            <th>School</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4">
                                                <button type="button" class="addDegree btn btn-success pull-right"><i class="fa fa-book" aria-hidden="true"></i> Add Degree</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="personalInterestTable table  table-responsive  table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="3">Interest</th>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4">
                                                <button type="button" class="addPersonalInterest btn btn-success pull-right"><i class="fa fa-star-o" aria-hidden="true"></i> Add Interest</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left deleteUser no-display"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete User</button>
                        <label class="label label-description pull-left deleteConfirmation no-display">Are you sure you want to delete this user?</label>
                        <button type="button" class="btn btn-danger pull-left confirmDeletUser no-display" data-loading-text="Deleting..."><i class="fa fa-trash-o" aria-hidden="true"></i> Yes</button>
                        <button type="button" class="btn btn-default pull-left cancelDeleteUser no-display"> No</button>
                        
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
            <tr class="userRow">
                <td class="accountID"></td>
                <td class="accountFullName"></td>
                <td class="accountRole"></td>
                <td class="accountAction">
                    <button class="viewUserInformation btn btn-xs btn-primary"><i class="fa fa-search" aria-hidden="true"></i> View</button>
                </td>
            </tr>
            <tr class="educationalBackgroundRow" education_background_id="0">
                <td>
                    <input name="degree" type="text" class="form-control">
                </td>
                <td>
                    <input name="school" type="text" class="form-control">
                </td>
                <td>
                    <input name="academic_year" type="date" class="form-control" >
                </td>
                <td>
                    <button type="button" class="btn btn-danger removeDegree"><i class="fa fa-remove" aria-hidden="true"></i></button>
                </td>
            </tr>
            <tr class="personalInterestRow" personal_interest_id="0">
                <td>
                    <input name="description" type="text" class="form-control">
                </td>
                <td>
                    <button type="button" class="removePersonalInterest btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i></button>
                </td>
            </tr>
        </table>
    </div>
</section>
<!--        <div id="sideMenu">
            <ul class="menu">
                <li><i class="fa fa-align-justify" aria-hidden="true"></i> MENU</li>
                <li><a class="btn btn-xs btn-pill btn-gold">hide</a></li>
            </ul>
            <ul class="nav">
                <li><a href="#topNav" ><i class="fa fa-user" aria-hidden="true"></i> User Management</a></li>
                <li><a href="#topNav" ><i class="fa fa-user" aria-hidden="true"></i> User Management</a></li>
                <li class="active"><a href="#topNav" ><i class="fa fa-user" aria-hidden="true"></i> User Management</a></li>
            </ul>


        </div>-->