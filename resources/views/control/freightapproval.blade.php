@extends('layouts/app')
@section('title')
    Freight Approval | {{ ucwords($freight->bill_number) }}
@endsection
@section('pagecontent')

<style>
    .f-img {
        width: 100%;
        height: 120px;
    }

    .f-cover {
        object-fit: cover;
    }
</style>



    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Approval Management: {{ $freight->bill_number }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control/organization/{{$freight->manifest->org->slug}}">{{ ucwords($freight->manifest->org->name) }}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="/control/manifest/{{ $freight->manifest->id }}">{{ ucwords($freight->manifest->manifest_number) }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $freight->bill_number }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <a href="/control/freight/delivery/{{$freight->id}}" class="btn  btn-outline-white active" >
                            <span class="fe fe-eye"></span> Delivery
                        </a>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Consignee Name</h5>
                                        <p class="fs-6 mb-0"> {{$freight->consignee}} </p>
                                    </div>

                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Consignee Email</h5>
                                        <p class="fs-6 mb-0"> {{$freight->consignee_email}} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Consignee Phone</h5>
                                        <p class="fs-6 mb-0"> {{$freight->consignee_phone}} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Consignee Address</h5>
                                        <p class="fs-6 mb-0"> {{$freight->consignee_address}} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Shipper</h5>
                                        <p class="fs-6 mb-0"> {{$freight->shipper}} </p>
                                    </div>

                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Destination</h5>
                                        <p class="fs-6 mb-0"> {{$freight->destination}} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Weight</h5>
                                        <p class="fs-6 mb-0"> {{$freight->weight}} LBS </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Byd Split</h5>
                                        <p class="fs-6 mb-0"> {{$freight->byd_split}} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Protective Service</h5>
                                        <p class="fs-6 mb-0"> {{$freight->consignee_address}} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Due Date</h5>
                                        <p class="fs-6 mb-0"> {{$freight->due_date}} </p>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <h5 class="mb-0 fw-bold">Pieces</h5>
                                        <p class="fs-6 mb-0"> {{$freight->pieces}} </p>
                                    </div>
                                    <div class="col-md-12 col-12 d-flex justify-content-end ">
                                        <button class="btn btn-primary btn-xs "><i class="fe fe-edit" ></i> Edit Freight Info </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>


        <div class="row">
            <div class="col-lg-4 col-md-12 mb-3 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"> Make an Approval </h4>
                    </div>
                    <div class="card-body" >
                        <form method="POST" action="{{ route('control.approveFreight') }}" enctype="multipart/form-data" class="row">@csrf
                            <x-jet-validation-errors />
                            <div class="mb-2 col-md-12">
                                <label class="form-label">Pallets Received <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="pallet_in" value="{{ old('pallet_in') }}"
                                    placeholder="Pallets Received" required>
                                <input type="hidden" name="freight_id" value="{{ $freight->id }}">
                            </div>

                            <div class="mb-2 col-md-12">
                                <label class="form-label">Photos</label>
                                <input type="file" class="form-control" name="photos[]" multiple  accept="image/png, image/gif, image/jpeg" >
                            </div>

                            <div class="mb-2 col-12">
                                <label class="form-label">Message</label>
                                <textarea name="message" class="form-control" rows="2" placeholder="Enter message concerning this freight here" ></textarea>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary  ">Approve Freight</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-lg-8 col-md-12 col-12">




                @php
                    $photos = [];
                    $approvals = \App\Models\FreightApproval::where('freight_id', $freight->id)->orderBy('id', 'desc')->paginate(50);
                @endphp
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="mb-0">Approvals</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">Received</th>
                                    <th scope="col" class="border-0">Message</th>
                                    <th scope="col" class="border-0">by</th>
                                    <th scope="col" class="border-0">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total_pieces = 0; @endphp
                                @foreach ($approvals as $apro)
                                    @php
                                        $photos[] = json_decode($apro->photos);
                                        $total_pieces += $apro->pieces;
                                    @endphp
                                    <tr>
                                        <td>{{ $apro->pieces }}</td>
                                        <td>{{ $apro->message }}</td>
                                        <td>{{ ucwords($apro->user->name) }}</td>
                                        <td>{{ date('j, D M y H:i a',strtotime($apro->created_at)) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th> {{$total_pieces}} </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex mt-3 justify-content-center">
                        {{ $approvals->links('pagination::bootstrap-4') }}
                    </div>
                </div>






                <div class="card mt-2">
                    <div class="card-body row">


                        @foreach ($photos as $photos )
                            @foreach ($photos as $photo)

                                <div class="col-xl-3 col-md-4 col-6 mb-2">
                                    <img class="f-img f-cover img-fluid" src="{{ asset('assets/img/freight/'.$photo) }}" alt="">
                                </div>
                            @endforeach

                        @endforeach
                    </div>
                </div>
            </div>



        </div>
    </div>





    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/littleAlert.js') }}"></script>
@endsection
