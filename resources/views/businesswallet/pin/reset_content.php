<div class="row" ng-controller="pinController">
    <div class="col s6 offset-s3">
        <div class="card">
            <div class="card-content purple-text" >
                <center><h4><i class="fa fa-lock"></i> CHANGE PIN</h4></center>
            </div>
        </div>
    </div>
    <div class="col s6 offset-s3">
        <div class="card with-padding">

            <div class="card-content">
                <form id="formChangePassword" name="formChangePassword" ng-submit="submitPin()">
                    <div class="input-field">
                        <label for="current-password">Current PIN</label>
                        <input type="password" pattern="\d{4}" id="current_password" name="current_password"
                               ng-model="current_password" required length="4">
                        <div ng-messages="formChangePassword.current_password.$error"
                             ng-if="formChangePassword.current_password.$touched || formChangePassword.current_password.$dirty"
                             style="color:red; font-size: x-small" role="alert">
                            <div ng-message="required">
                                <strong>The Current PIN is Required!</strong>
                            </div>
                            <div ng-message="pattern">
                                <strong>Please Enter a 4-digit PIN!</strong>
                            </div>
                        </div>

                    </div>
                    <div class="input-field">
                        <label for="password">New PIN</label>
                        <input type="password" id="password" pattern="\d{4}" name="password" ng-model="password"
                               required length="4">
                        <div ng-messages="formChangePassword.password.$error"
                             ng-if="formChangePassword.password.$touched || formChangePassword.password.$dirty"
                             style="color:red; font-size: x-small" role="alert">
                            <div ng-message="required">
                                <strong>The New PIN is Required!</strong>
                            </div>
                            <div ng-message="pattern">
                                <strong>Please Enter a 4-digit PIN!</strong>
                            </div>
                        </div>
                    </div>
                    <div class="input-field">
                        <label for="password_confirmation">Re-enter
                            PIN</label>

                        <input type="password" id="password_confirmation" ng-pattern="password"
                               name="password_confirmation" ng-model="password_confirmation" required length="4">
                        <div ng-messages="formChangePassword.password_confirmation.$error"
                             ng-if="formChangePassword.password_confirmation.$touched || formChangePassword.password_confirmation.$dirty"
                             style="color:red; font-size: x-small" role="alert">
                            <div ng-message="required">
                                <strong>The Confirmation PIN is Required!</strong>
                            </div>
                            <div ng-message="pattern">
                                <strong>Your Confirmation PIN Does Not match!</strong>
                            </div>
                        </div>


                    </div>
                    <dic class="row">
                        <div class="col s12 input-field">
                            <div>
                                <button type="submit" class="col s12 purple btn"
                                        ng-disabled="formChangePassword.$invalid">Submit
                                </button>
                            </div>
                        </div>
                    </dic>
                </form>
            </div>

        </div>

    </div>
</div>
