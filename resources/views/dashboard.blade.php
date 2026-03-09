@extends('plantillas.app')
@section('titulo', 'Dashboard - Sistema de Metrados')
@section('contenido')
<!-- Row start -->
<div class="row gx-3">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="mb-2">
                    <i class="bi bi-bar-chart fs-1 text-primary lh-1"></i>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="m-0 text-secondary fw-normal">Sales</h5>
                    <h3 class="m-0 text-primary">3500</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="mb-2">
                    <i class="bi bi-bag-check fs-1 text-primary lh-1"></i>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="m-0 text-secondary fw-normal">Orders</h5>
                    <h3 class="m-0 text-primary">2900</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="arrow-label">+18%</div>
                <div class="mb-2">
                    <i class="bi bi-box-seam fs-1 text-primary lh-1"></i>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="m-0 text-secondary fw-normal">Items</h5>
                    <h3 class="m-0 text-primary">6500</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="arrow-label">+24%</div>
                <div class="mb-2">
                    <i class="bi bi-bell fs-1 text-primary lh-1"></i>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="m-0 text-secondary fw-normal">Signups</h5>
                    <h3 class="m-0 text-primary">7200</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row end -->
@endsection
