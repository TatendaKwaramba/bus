

businessWalletApp.controller('overviewCtrl',function($scope, dataHandler){

    $scope.labels = ["January", "February", "March", "April", "May", "June", "July","August"];
    $scope.series = ['Series A'];
    $scope.data = [
        [0,0, 0, 0, 0, 0, 0,0]

    ];
    $scope.onClick = function (points, evt) {
        console.log(points, evt);
    };
    $scope.datasetOverride = [{ yAxisID: 'y-axis-1' }, { yAxisID: 'y-axis-2' }];
    $scope.options = {
        scales: {
            yAxes: [
                {
                    id: 'y-axis-1',
                    type: 'linear',
                    display: true,
                    position: 'left'
                },
                {
                    id: 'y-axis-2',
                    type: 'linear',
                    display: true,
                    position: 'right'
                }
            ]
        }
    };

    /*dataHandler.getAI()
        .then(function (data) {
            if(data.code === '00'){
                $scope.ai = data;

            } else {
                dataHandler.removeAI();
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
                );
            }

            console.log($scope.ai)
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
                    location.reload();
                }
            );

            console.log(error)
        })*/

});