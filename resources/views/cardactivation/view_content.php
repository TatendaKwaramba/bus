<div ng-controller="cardActivationController" >
    <div class="row">
        <div class="col s6 offset-s3">
            <div class="card ">
                <div class="card-content ">
                    <h4 class="blue-text center"> CARD ACTIVATION <br>
                        <button class="massive circular ui icon button blue white-text "
                                style="width: 100px; height: 100px; margin: 10px;">
                            <i class="fa fa-credit-card fa-2x"></i>
                        </button>
                    </h4>
                </div>
                <div class="card-content with-padding grey lighten-3">
                    <form name="cardActivationForm" id="cardActivationForm" ng-submit="activateCard()">
                        <div class="row">
                            <div class="col s6">
                                <input type="radio" name="group1" id="client" ng-model="type" value="client">
                                <label for="client">CLIENT</label>
                            </div>
                            <div class="col s6">
                                <input type="radio" name="group1" ID="business" ng-model="type" value="business">
                                <label for="business">BUSINESS</label>

                            </div>
                        </div>
                        <div class="input-field">
                            <i class="fa fa-credit-card prefix"></i>
                            <input type="text" name="card_number" id="card_number" autocomplete="off"
                                   ng-model="card_number" required>
                            <label for="card_number">CARD NUMBER</label>
                        </div>
                        <div class="input-field">
                            <i class="fa fa-mobile prefix"></i>
                            <input type="text" name="mobile" id="mobile" ng-model="mobile" autocomplete="off" required>
                            <label for="mobile">MOBILE NUMBER</label>
                        </div>
                        <div class="input-field">
                            <i class="fa fa-key prefix"></i>
                            <input type="password" name="pin" id="pin" ng-model="pin" required>
                            <label for="pin">PIN</label>
                        </div>
                        <div class="row">
                            <button class="col s12 btn blue waves-effect" ng-disabled="cardActivationForm.$invalid">
                                ACTIVATE CARD
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>