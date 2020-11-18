businessWalletApp.controller('addSubscriberCtrl', function ($scope, dataHandler) {

    dataHandler.getAI()
        .then(function (data) {
            $scope.ai = data
        }, function (error) {
            console.log(error)
        })

    $scope.loader = false;
    $scope.submit_subscriber = true;
    $scope.first_name = '';
    $scope.last_name = '';
    $scope.address = '';
    $scope.id = '';
    $scope.reg_date = new Date();
    $scope.mobile = '';
    $scope.sub_email = '';
    $scope.agent = '';
    $scope.class = '';




    $scope.addSubscriber = function () {
        $scope.loader = true;
        $scope.submit_subscriber = false;
        var post = {
            first_name: $scope.first_name,
            last_name: $scope.last_name,
            address: $scope.address,
            agent: $scope.ai.agent.id,
            email: $scope.sub_email,
            class: '14',
            mobile: $scope.mobile,
            id: $scope.id,
            imei: '980005'
        };
        console.log(post)

         dataHandler.addSubscriber(post)
         .then(function (data) {
         $scope.loader = false;
         $scope.submit_subscriber = true;
         $('#addSubscriberForm').trigger('reset');
             console.log(data)
         swal('', data[0].description, 'info')
         }, function (error) {
         swal('', 'Something Went Wrong Please Try Again','warning')
         })


    }

});

