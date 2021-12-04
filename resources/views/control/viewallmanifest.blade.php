@extends('layouts/app')
@section('title')
    Manifest | View All
@endsection
@section('pagecontent')




<link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">




    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            All Manifest
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control/">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">
                                    All Manifest
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @php
            $manifests = \App\Models\Manifest::orderBy('id', 'desc')->paginate(100);
        @endphp




        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="mytb" class="table table-sm mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">Company</th>
                                    <th scope="col" class="border-0">Manifest</th>
                                    <th scope="col" class="border-0">Pallets </th>
                                    <th scope="col" class="border-0">Tractor </th>
                                    <th scope="col" class="border-0">owner</th>
                                    <th scope="col" class="border-0">driver</th>
                                    <th scope="col" class="border-0">Trailer / Seal no </th>
                                    <th scope="col" class="border-0">Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($manifests as $man)
                                    <tr>
                                        <td><a href="/control/organization/{{$man->org->slug}}"> {{$man->org->name}} </a> </td>
                                        <td><a href="/control/manifest/{{ $man->id }}">{{$man->manifest_number}} </a> </td>
                                        <td> {{$man->plac}} </td>
                                        <td> {{$man->tractor_no}} </td>
                                        <td> {{$man->owner}} </td>
                                        <td> {{$man->driver}} </td>
                                        <td> {{$man->trailer_no}} / {{$man->trailer_seal_no}} </td>
                                        <td>{{ date('j, D M y H:i a',strtotime($man->created_at)) }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex mt-3 justify-content-center">
                        {{ $manifests->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>


    </div>


    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <script>
        $('#mytb').DataTable( {
            paging: false,
        } );
    </script>


@endsection
