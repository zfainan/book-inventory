@extends('layoutkepala.tamplate')
@section('title')
 Dashboard 
@endsection
@section('titleform')
 Dashboard 
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
    
    <div class="row">
    <div class="col-lg-3 col-6">
    
    <div class="small-box bg-info">
    <div class="inner">
    <h3>{{ $totalBarang }}</h3>
    <p>Barang Inventaris</p>
    </div>
    <div class="icon">
    <i class="ion ion-cube"></i>
    </div>
    <a href="/barangkepala" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    
    @if (auth()->user()->id_role == 2)
    <div class="col-lg-3 col-6">
    
    <div class="small-box bg-warning">
    <div class="inner">
    <h3>{{$totalAcc}}</h3>
    <p>Pengajuan Barang ACC</p>
    </div>
    <div class="icon">
    <i class="ion ion-clipboard"></i>
    </div>
    <a href="/pengajuan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>

    <div class="col-lg-3 col-6">
    
    <div class="small-box bg-info">
    <div class="inner">
    <h3>{{ $totalPr  }}</h3>
    <p>Pengajuan Proses</p>
    </div>
    <div class="icon">
    <i class="ion ion-cube"></i>
    </div>
    <a href="/barang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
@endif
    
    
    
    </div>    
@endsection