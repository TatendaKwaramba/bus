businessWalletApp.controller('pinController', function ($scope, dataHandler) {
    $scope.password_confirmation = '';
    $scope.password = '';
    $scope.current_password = '';

    $scope.submitPin = function () {
        var params = {
            current_password: $scope.current_password,
            password_confirmation: $scope.password_confirmation,
            password: $scope.password
        };
        dataHandler.submitPin(params)
            .then(function (data) {
                swal('', data, 'info')
                $('#formChangePassword').trigger('reset');
            }, function (error) {
                swal('', 'Something Went Wrong. Please try again!', 'info');
                $('#formChangePassword').trigger('reset');
            })
    }
});