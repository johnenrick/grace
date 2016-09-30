<section id="profileManagement" class="page-section clearfix container">
    <div class=" section-content">
        <div class="row">
            <form id="profileInformationForm" method="POST">
                    <input name="ID" type="hidden">
                    <h4 class="modal-title">Profile Information</h4>
                    <div class="row">
                        <div class="col-sm-12 formMessage">

                        </div>
                    </div>
                    <div class="row form-horizontal">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Role</label>
                                <div class="col-sm-8">
                                    <span field_name="account_type_description" class="form-control"> </span>
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
                    <div class="row formActionButton">
                        <div class="col-sm-12 align-right ">

                            <label class="label formLabelIndicator label-success " >Success!</label>
                            <label class="label formLabelIndicator label-danger">Failed!</label>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    <div class="prototype">
        <table>
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