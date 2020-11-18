businessWalletApp.controller('cardActivationController', function ($scope, dataHandler) {

    $scope.mobile = '';
    $scope.pin = '';
    $scope.card_number = '';
    $scope.type = 'client';

    $scope.activateCard = function () {
        var params = {
            pin: $scope.pin,
            cardNumber: $scope.card_number,
            mobile: $scope.mobile,
            type:$scope.type
        };

        dataHandler.cardActivation(params)
         .then(function (data) {
            swal('',data.description,'info');
             $('#cardActivationForm').trigger('reset');
         }, function (error) {
             swal('','Something Went Wrong. Please Try Again','warning')
         })

    }

});