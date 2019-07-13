<!-- resources/views/admin/layouts/main.blade.php -->
<?php
$adminService = new \App\Services\AdminService;
?>

<!--
*
*  INSPINIA - Responsive Admin Theme
*  version 2.7
*
-->

@extends('admin.layouts.head')

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation"  style="min-height: 100%">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">

                    <div class="logo-element">
                        颜+
                    </div>
                </li>
                <?php echo $adminService->getMenuHtml(); ?>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">欢迎使用颜格视觉管理后台</span>
                    </li>

                    <li>
                        <a href="login.html">
                            <i class="fa fa-sign-out"></i> 退出登录
                        </a>
                    </li>

                </ul>

            </nav>
        </div>
        <div>
            @yield('content')
        </div>

    </div>

    <div id="right-sidebar" class="animated">




    </div>
</div>

<!-- Mainly scripts -->
<script src="/inspinia/js/jquery-3.1.1.min.js"></script>
<script src="/inspinia/js/bootstrap.min.js"></script>
<script src="/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Flot -->
<script src="/inspinia/js/plugins/flot/jquery.flot.js"></script>
<script src="/inspinia/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="/inspinia/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="/inspinia/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="/inspinia/js/plugins/flot/jquery.flot.pie.js"></script>

<!-- Peity -->
<script src="/inspinia/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/inspinia/js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="/inspinia/js/inspinia.js"></script>
<script src="/inspinia/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="/inspinia/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- GITTER -->
<script src="/inspinia/js/plugins/gritter/jquery.gritter.min.js"></script>

<!-- Sparkline -->
<script src="/inspinia/js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="/inspinia/js/demo/sparkline-demo.js"></script>

<!-- ChartJS-->
<script src="/inspinia/js/plugins/chartJs/Chart.min.js"></script>

<!-- Toastr -->
<script src="/inspinia/js/plugins/toastr/toastr.min.js"></script>


<script>
    $(document).ready(function() {
        //欢迎弹框
        /*setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.success('Responsive Admin Theme', 'Welcome to INSPINIA');

        }, 1300);*/

        //仪表框
        /*var data1 = [
            [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
        ];
        var data2 = [
            [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
            {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#d5d5d5'
                },
                colors: ["#1ab394", "#1C84C6"],
                xaxis:{
                },
                yaxis: {
                    ticks: 4
                },
                tooltip: false
            }
        );

        var doughnutData = {
            labels: ["App","Software","Laptop" ],
            datasets: [{
                data: [300,50,100],
                backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
            }]
        } ;


        var doughnutOptions = {
            responsive: false,
            legend: {
                display: false
            }
        };


        var ctx4 = document.getElementById("doughnutChart").getContext("2d");
        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        var doughnutData = {
            labels: ["App","Software","Laptop" ],
            datasets: [{
                data: [70,27,85],
                backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
            }]
        } ;


        var doughnutOptions = {
            responsive: false,
            legend: {
                display: false
            }
        };


        var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});*/

    });
</script>
</body>
</html>

