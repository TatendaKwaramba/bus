<div style="margin: 10px;" class="card" class="addSingleSubscriber" ng-controller="addSubscriberCtrl"  ng-cloak>
    <div class="card-content purple with-padding white-text" style="font-size: large">
        <strong><i class="fa fa-user-plus "></i> ADD NEW SUBSCRIBER</strong>
    </div>

    <div class="card-content with-padding">
        <form name="addSubscriberForm" id="addSubscriberForm" ng-submit="addSubscriber()">
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" class="first_name" id="first_name" ng-model="first_name" required>
                    <label for="first_name">FIRST NAME</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" class="last_name" id="last_name" ng-model="last_name" required>
                    <label for="last_name">LAST NAME</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="fa fa-id-card prefix"></i>
                    <input type="text" name="id" id="id" ng-model="id" required>
                    <label for="id">I.D. NUMBER</label>
                </div>
                <!--<div class="input-field col s6">
                    <i class="fa fa-money prefix"></i>
                    <input type="text"  name="deposit" id="deposit" ng-model="deposit" required>
                    <label for="deposit">DEPOSIT</label>
                </div>-->

            </div>

            <div class="row">
                <div class="input-field col s12">
                    <i class="fa fa-home prefix"></i>

                    <input type="text" id="address" class="address" ng-model="address">
                    <label for="address">ADDRESS</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="fa fa-mobile prefix"></i>

                    <input type="text" id="mobile" name="mobile" ng-model="mobile" required>
                    <label for="mobile">MOBILE NUMBER</label>
                </div>
                <div class="input-field col s6">
                    <i class="fa fa-envelope prefix"></i>

                    <input type="email" id="sub_email" name="sub_email" ng-model="sub_email">
                    <label for="sub_email">EMAIL ADDRESS</label>
                </div>
            </div>
            <!--<div class="row">
                <div class="input-field col s6">
                    <select name="agent" id="agent" class="browser-default" ng-model="agent" >
                        <option value="" disabled selected>Choose an Agent</option>
                        <option ng-repeat="a in agents" value="{{a.id}}">{{a.firstname || a.name}} {{a.lastname}}</option>

                    </select>
                    <label for="agent" class="active">AGENT</label>
                </div>
                <div class="input-field col s6">
                    <label for="class" class="active">CLASS OF SERVICE</label>
                    <select  id="class" class="browser-default" ng-model="class">
                        <option value="" disabled selected>Choose Class Of Service</option>
                        <option ng-repeat="cc in classOfService" value="{{cc.id}}">{{cc.name}}</option>

                    </select>
                </div>
            </div>-->
            <div class="row">
                <button class="btn purple col s12 waves-effect" type="submit" ng-show="submit_subscriber">ADD SUBSCRIBER
                </button>
                <div class="progress" ng-show="loader">
                    <div class="indeterminate"></div>
                </div>
            </div>
        </form>
    </div>

</div
