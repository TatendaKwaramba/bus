@extends('layouts.app')

@section('content')
    <div style="margin: 10px;" ng-controller="overviewCtrl">
        <div class="card col s12">
            <div class="card-content">
                <div class="center">
                    <img src="{{asset('img/gc/logo.jpeg')}}" alt="Logo" width="20px">
                </div>
                <h5 class="blue-text center"><i class="fa fa-pie-chart"></i> OVERVIEW </h5>
                <h5 class="blue-text center">CURRENT BALANCE -  @{{ai.agent.deposit | currency}} </h5>
                <h5 class="blue-text center">COMMISSIONS -  @{{ai.agent.commission | currency}} </h5>
            </div>
            <!--        <div class="card-content">
                        <canvas id="line" class="chart chart-line" chart-data="data"
                                chart-labels="labels" chart-series="series" chart-options="options"
                                chart-dataset-override="datasetOverride" chart-click="onClick">
                        </canvas>
                    </div>
            -->
        </div>
    </div>
{{--
    @include('home_content')
--}}
@endsection
