businessWalletApp.controller('aiController', function ($scope,$rootScope, dataHandler) {
    dataHandler.getAI()
        .then(function (data) {
            if(data.code === '00'){
                $rootScope.ai = data;

            } else {

                /*dataHandler.removeAI();
                swal({
                        title: '',
                        text: 'Could Not Verify Your Business Information, Please Reload the Page',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'RELOAD'
                    },
                    function () {
                        location.reload();
                    }
                );*/
            }

            console.log($scope.ai);
        }, function (error) {
            dataHandler.removeAI();
            swal({
                    title: '',
                    text: 'Could Not Verify Your Business Information, Please Reload the Page',
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'RELOAD'
                },
                function () {
                    //location.reload();
                }
            );

            console.log(error);
        });

});