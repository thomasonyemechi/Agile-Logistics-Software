@extends('layouts/app')
@section('title')
    Newly assigned freight
@endsection
@section('pagecontent')

    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">



    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Assigned Freights
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control/">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">
                                    Assigned Freights
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @php
            $freights = \App\Models\Freight::where(['assigned_to' => auth()->user()->id, 'status' => 3 ])->orderBy('id', 'desc')->paginate(100);
        @endphp
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="dataTableBasic2" class="table table-sm mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">Bill Number</th>
                                    <th scope="col" class="border-0">Others </th>
                                    <th scope="col" class="border-0">CONSIGNEE</th>
                                    <th scope="col" class="border-0">Reveiced</th>
                                    <th scope="col" class="border-0">DESTINATION</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($freights as $fre)
                                    <tr>
                                        <td class="align-middle">
                                            <a href="javascript::" class="manageOrder align-middle" data-data='{{ json_encode($fre) }}'  style="font-weight: bolder"
                                                title="click for more">{{$fre->bill_number }} {!! deliveryProStatus($fre->status) !!} </a>
                                        </td>
                                        <td class="align-middle"> @if ($fre->status > 2)
                                            {{$fre->driver->name}} (Driver)<br>
                                        @endif {{$fre->weight}} LBS | {{ money($fre->byd_split) }} </td>
                                        <td class="align-middle">{{ $fre->consignee }} {!!appointment($fre->need_appointment)!!}
                                            <br> {{ $fre->consignee_email }} | {{ $fre->consignee_phone }} </td>
                                        <td>  {{ \App\Models\FreightApproval::where('freight_id', $fre->id)->sum('pieces') }}</td>
                                        <td class="align-middle">{{ $fre->destination }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex mt-3 justify-content-center">
                        {{ $freights->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('driver.modal')




    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/delivery.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <script>
        $('#dataTableBasic2').DataTable( {
            paging: false,
        } );
    </script>


@endsection
