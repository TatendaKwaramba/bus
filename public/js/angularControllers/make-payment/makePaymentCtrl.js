angular.module('makePayment',[]);
processCtrl.$inject = ['$scope','$http'];

angular.module('makePayment')
.controller('processCtrl',processCtrl);

function processCtrl($scope,$http) {
    $scope.loader = false;
    $scope.pay = true;
    $scope.processing = false;

   $scope.submitData =  function () {
       $scope.loader = true;
        var params = {
            amount: $('#amount').val(),
            token: $('#token').val(),
            success_return_url: $scope.success_return_url,
            failure_return_url: $scope.failure_return_url,
            merchant_ref: $scope.merchant_ref,
            mobile: $scope.mobile,
            pin:$scope.pin
        };
        $http.post('/confirm-payment/process/preauth', params)
            .then(function (data) {
                console.log(data)
                $scope.loader = false;
                if(data.data.code =='00'){
                    $scope.pay = false;
                    $scope.processing = true;
                    var params2 = {
                        amount: $('#amount').val(),
                        token: $('#token').val(),
                        success_return_url: $scope.success_return_url,
                        failure_return_url: $scope.failure_return_url,
                        merchant_ref: $scope.merchant_ref,
                        mobile: $scope.mobile,
                        pin:$scope.pin
                    };
                    $http.post('/confirm-payment/process', params2)
                        .then(function (data) {
                            console.log(data)
                        }, function(error){
                            console.log(error)
                        })
                }else{
                    console.log('')
                }
            }, function (error) {
                console.log(error)

            });
    }


}

