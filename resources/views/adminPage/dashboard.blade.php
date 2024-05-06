@extends('adminComponent.default')

@section('title', 'GreenBite Dashboard')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        
        @if (\Illuminate\Support\Facades\Auth::user()->role_id == 1)
        <!-- Card Example -->
        <div class="col-xl-4 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pending Verifikasi Mitra
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mitraPending }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-hourglass-half fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Mitra
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mitraCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-store fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if (\Illuminate\Support\Facades\Auth::user()->role_id == 2)
        <!-- Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ongoing Pesanan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ongoingOrder }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>

    <!-- Next untuk admin ada chart dan untuk mitra ada shortcut untuk makanannya -->
@endsection

@section('page-script')
@endsection
