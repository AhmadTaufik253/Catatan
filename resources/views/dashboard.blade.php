@extends('layo.layouts')
@section('content')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Upcube</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Total Uang</p>
                                                <h4 class="mb-2">{{ 'Rp.' . number_format($totalUang, 2, ',', '.') }}</h4>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-currency-usd font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Total Pemasukan</p>
                                                <h4 class="mb-2">{{ 'Rp.' . number_format($totalPemasukan, 2, ',', '.') }}</h4>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="mdi mdi-currency-usd font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                            
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Total Pengeluaran</p>
                                                <h4 class="mb-2">{{ 'Rp.' . number_format($totalPengeluaran, 2, ',', '.') }}</h4>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="mdi mdi-currency-usd font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Unique Visitors</p>
                                                <h4 class="mb-2">29670</h4>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-currency-btc font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Pemasukan dan Pengeluaran</h4>

                                        <div class="text-center pt-3">
                                            <div class="row">
                                                <div class="col">
                                                    <div id="splineAreaChart" style="height: 400px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- End Page-content -->
               
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Upcube.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                
            </div>
            <!-- end main content-->

            <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
        <script>
            var dataPemasukan = @json($dataPemasukan);
            var dataPengeluaran = @json($dataPengeluaran);
        
            // Fungsi untuk mendapatkan nama bulan dari angka bulan (1-12)
            function getMonthName(monthNumber) {
                var months = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];
                return months[monthNumber - 1];
            }
        
            var categories = Array.from({ length: 12 }, (_, i) => getMonthName(i + 1)); // Menggunakan nama bulan
        
            var dataSeriesPemasukan = Array.from({ length: 12 }, (_, i) => {
                var bulanData = dataPemasukan.find(item => item.bulan == (i + 1));
                return bulanData ? bulanData.total : 0;
            });
        
            var dataSeriesPengeluaran = Array.from({ length: 12 }, (_, i) => {
                var bulanData = dataPengeluaran.find(item => item.bulan == (i + 1));
                return bulanData ? bulanData.total : 0;
            });
        
            var chartOptions = {
                chart: {
                    type: 'area',
                    height: 350,
                },
                series: [
                    { name: 'Pemasukan', data: dataSeriesPemasukan },
                    { name: 'Pengeluaran', data: dataSeriesPengeluaran }
                ],
                xaxis: {
                    categories: categories,
                },
            };
        
            var splineChart = new ApexCharts(document.querySelector("#splineAreaChart"), chartOptions);
            splineChart.render();
        </script>


        

@endsection