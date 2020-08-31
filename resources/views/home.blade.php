@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="row">

            <div class="col-12 col-sm-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i data-feather="activity" class="feather feather-activity feather-lg text-primary">
                                </i>
                            </div>
                            <div class="media-body">
                                <h3 class="mb-2">{{ $cCompany}}</h3>
                                <div class="mb-0">Company</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i data-feather="activity" class="feather feather-activity feather-lg text-info">
                                </i>
                            </div>
                            <div class="media-body">
                                <h3 class="mb-2">{{ $cMaterial}}</h3>
                                <div class="mb-0">Material Group</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i data-feather="activity" class="feather feather-activity feather-lg text-warning">
                                </i>
                            </div>
                            <div class="media-body">
                                <h3 class="mb-2">{{ $cComodity}}</h3>
                                <div class="mb-0">Komoditas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i data-feather="activity" class="feather feather-activity feather-lg text-danger">
                                </i>
                            </div>
                            <div class="media-body">
                                <h3 class="mb-2">{{ $cGroup}}</h3>
                                <div class="mb-0">Golongan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i data-feather="activity" class="feather-lg text-dark">
                                </i>
                            </div>
                            <div class="media-body">
                                <h3 class="mb-2">{{ $cCategory}}</h3>
                                <div class="mb-0">Kategori</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i data-feather="activity" class="feather feather-activity feather-lg text-primary">
                                </i>
                            </div>
                            <div class="media-body">
                                <h3 class="mb-2">{{ $cWarehouse}}</h3>
                                <div class="mb-0">Gudang</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i data-feather="activity" class="feather feather-activity feather-lg text-info">
                                </i>
                            </div>
                            <div class="media-body">
                                <h3 class="mb-2">{{ $cStock}}</h3>
                                <div class="mb-0">Barang / Obat</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
@endsection