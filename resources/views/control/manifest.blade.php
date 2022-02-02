@extends('layouts/app')
@section('title')
    Manifest | {{ ucwords($manifest->manifest_number) }}
@endsection
@section('pagecontent')



    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Manifest Number: {{ $manifest->manifest_number }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/control/">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="/control/{{ $manifest->org->slug }}">{{ ucwords($manifest->org->name) }}</a>
                                </li>


                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ ucwords($manifest->manifest_number) }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <button type="button" class="btn  btn-outline-white active" data-bs-toggle="modal"
                            data-bs-target="#editManifest">
                            <span class="fe fe-edit"></span> Edit Manifest Info
                        </button>
                    </div>
                </div>
            </div>
        </div>




        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Total Freights</span>
                            </div>
                            <div>
                                <span class="fe fe-shopping-bag fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">
                            {{ $manifest->freights->sum('pieces') }}
                        </h2>
                        <span class="fw-semi-bold"> {{ $manifest->freights->sum('weight')}} </span>
                        <span class="ms-1 fw-medium">LBS</span>
                        <span class="fw-semi-bold ms-2 "> {{ money($manifest->freights->sum('byd_split'))}} </span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Approved</span>
                            </div>
                            <div>
                                <span class=" fe fe-book-open fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">
                            {{ manifestApproved($manifest->id, 'pieces') }}
                        </h2>
                        <span
                            class="text-danger fw-semi-bold">{{ \App\Models\Freight::where(['status'=> 0, 'manifest_id' => $manifest->id])->sum('pieces') }}</span>
                        <span class="ms-1 fw-medium">Awaiting Approval</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Assigned</span>
                            </div>
                            <div>
                                <span class=" fe fe-book-open fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">
                            {{ manifestAssigned($manifest->id) }}
                        </h2>
                        <span class="text-success fw-semi-bold">{{ manifestDelivered($manifest->id) }}</span>
                        <span class="ms-1 fw-medium">Delivered</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Freight Expected</span>
                            </div>
                            <div>
                                <span class=" fe fe-users fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">
                            {{ $manifest->freights->sum('pieces'); }}
                        </h2>
                        <span class="text-success fw-semi-bold">{{ manifestApproved($manifest->id, 'pieces') }}</span>
                        <span class="ms-1 fw-medium">Freight Received</span>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12 col-12">

                @php
                    $freights = \App\Models\Freight::where('manifest_id', $manifest->id)
                        ->orderBy('id', 'desc')
                        ->paginate(50);
                @endphp
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="mb-0">Freights In Manifest</h4>
                        <button data-bs-toggle="modal" data-bs-target="#addFreight" class="btn btn-primary btn-xs">Add
                            Freight</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">Bill Number</th>
                                    <th scope="col" class="border-0">PIECES / LBS </th>
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
                                            <a href="/control/freight/approval/{{$fre->id}}" class="freightInfo align-middle" style="font-weight: bolder"
                                                title="click for more">{{$fre->bill_number }} {!! deliveryProStatus($fre->status) !!} </a>
                                        </td>
                                        <td class="align-middle"> @if ($fre->status > 2)
                                            {{$fre->driver->name}} (Driver)<br>
                                        @endif {{$fre->weight}} LBS | {{ money($fre->byd_split) }} </td>
                                        <td class="align-middle">{{ $fre->consignee }} {!!appointment($fre->need_appointment)!!}  <br> {{ $fre->consignee_email }} | {{ $fre->consignee_phone }} </td>
                                        <td  class="align-middle"> {{ \App\Models\FreightApproval::where('freight_id', $fre->id)->sum('pieces') }} </td>
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



    <div class="modal fade" id="editManifest" tabindex="-1" role="dialog" aria-labelledby="editManifest" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Edit Manifest Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('control.editManifest') }}" class="row">@csrf
                        <x-jet-validation-errors />
                        <div class="mb-2 col-md-6">
                            <label class="form-label">Manifest Number</label>
                            <input type="text" class="form-control" name="manifest_number" value="{{ $manifest->manifest_number }}"
                                placeholder="Manifest Number" required>
                                <input type="hidden" name="manifest_id" value="{{ $manifest->id }}">
                        </div>

                        <div class="mb-2 col-md-6">
                            <label class="form-label">Tractor Number</label>
                            <input type="text" class="form-control" name="tractor_no" value="{{ $manifest->tractor_no }}"
                                placeholder="Tractor Number" required>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label class="form-label">Driver</label>
                            <input type="text" class="form-control" name="driver" value="{{ $manifest->driver }}"
                                placeholder="Driver" required>
                        </div>


                        <div class="mb-2 col-md-6">
                            <label class="form-label">Owner</label>
                            <input type="text" class="form-control" name="owner" value="{{ $manifest->owner }}"
                                placeholder="Owner" required>
                        </div>

                        <div class="col-4">
                            <label class="form-label">Trailer No</label>
                            <input type="text" name="trailer_no" class="form-control" value="{{ $manifest->trailer_no }}"
                                placeholder="Trailer No" required>
                        </div>
                        <div class="mb-2 col-4">
                            <label class="form-label">Trailer Seal No</label>
                            <input type="text" name="trailer_seal_no" class="form-control" value="{{ $manifest->trailer_seal_no }}"
                                placeholder="Trailer Seal No" required>
                        </div>
                        <div class="mb-2 col-4">
                            <label class="form-label">Placards</label>
                            <input type="text" name="plac" class="form-control" value="{{ $manifest->plac }}"
                                placeholder="Placards" required>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Manifest</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="addFreight" tabindex="-1" role="dialog" aria-labelledby="addFreight" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFreight">Add Freight to Manifest</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('control.createFreight') }}" class="row">@csrf
                        <x-jet-validation-errors />
                        <div class="mb-2 col-md-6">
                            <label class="form-label">Bill Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="bill_number" value="{{ old('bill_number') }}"
                                placeholder="Bill Number" required>
                            <input type="hidden" name="manifest_id" value="{{ $manifest->id }}">
                        </div>

                        <div class="mb-2 col-md-6">
                            <label class="form-label">Consignee <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="consignee" value="{{ old('consignee') }}"
                                placeholder="Consignee" required>
                        </div>


                        <div class="mb-2 col-4">
                            <label class="form-label">Consignee Email</label>
                            <input type="text" name="consignee_email" class="form-control" value="{{ old('consignee_email') }}"
                                placeholder="Consignee Email" required>
                        </div>
                        <div class="mb-2 col-4">
                            <label class="form-label">Consignee Phone </label>
                            <input type="text" name="consignee_phone" class="form-control"
                                value="{{ old('consignee_phone') }}" placeholder="Consignee Phone">
                        </div>
                        <div class="mb-2 col-4">
                            <label class="form-label">Consignee Address</label>
                            <input type="text" name="consignee_address" class="form-control" placeholder="Consignee Address" value="{{ old('consignee_address') }}" required>
                        </div>




                        <div class="mb-2 col-md-6">
                            <label class="form-label">Shipper <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="shipper" value="{{ old('shipper') }}"
                                placeholder="Shipper" required>
                        </div>


                        <div class="mb-2 col-md-6">
                            <label class="form-label">Destination <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="destination"
                                value="{{ old('destination') }}" placeholder="Destination" required>
                        </div>

                        <div class="col-4">
                            <label class="form-label">No of Pieces <span class="text-danger">*</span> </label>
                            <input type="number" name="pieces" min="1" class="form-control"
                                value="{{ old('pieces') }}" placeholder="Pieces" required>
                        </div>
                        <div class="mb-2 col-4">
                            <label class="form-label">Weight(LBS) <span class="text-danger">*</span></label>
                            <input type="text" name="weight" class="form-control" value="{{ old('weight') }}"
                                placeholder="Weight" required>
                        </div>


                        <div class="mb-2 col-4">
                            <label class="form-label">BYD Split <span class="text-danger">*</span></label>
                            <input type="text" name="byd_split" class="form-control" value="{{ old('byd_split') }}"
                                placeholder="BYD Split" required>
                        </div>

                        <div class="mb-2 col-4">
                            <label class="form-label">Protect Service </label>
                            <input type="text" name="protective_service" class="form-control"
                                value="{{ old('protective_service') }}" placeholder="Protective Service">
                        </div>

                        <div class="mb-2 col-4">
                            <label class="form-label">PU Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" value="{{ old('plac') }}" required>
                        </div>

                        <div class="mb-2 col-4">
                            <label class="form-label">Due Date <span class="text-danger">*</span></label>
                            <input type="date" name="due_date" class="form-control" value="{{ old('due_date') }}"
                                required>
                        </div>


                        <div class="mb-1 d-flex justify-content-end col-12">
                            <input type="checkbox" id="need_appointment" name="need_appointment" value="1" class="form-check" >

                            <label for="need_appointment" class="form-label ms-2"> Check If Appointment is Needed</label>

                        </div>




                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Freight To List</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="approveFreightModal" tabindex="-1" role="dialog" aria-labelledby="approveFreight" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveFreight">Approve Freight</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('control.approveFreight') }}" class="row">@csrf
                        <x-jet-validation-errors />
                        <div class="mb-2 col-md-6">
                            <label class="form-label">Total Pallets Received <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pallet_in" value="{{ old('pallet_in') }}"
                                placeholder="Pallets Received" required>
                            <input type="hidden" name="freight_id">
                        </div>

                        <div class="mb-2 col-md-6">
                            <label class="form-label">Byd Split <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="byd_split" value="{{ old('byd_split') }}"
                                placeholder="Byd Split" required>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label class="form-label">Weight <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="weight" value="{{ old('weight') }}"
                                placeholder="Weight" required>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label class="form-label">Approved  By <span class="text-danger">*</span></label>
                            <input type="text" disabled class="form-control" value="{{ ucwords(auth()->user()->name) }}" required>
                        </div>

                        <div class="mb-2 col-12">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="2" placeholder="Enter message concerning this freight here" ></textarea>
                        </div>



                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Approve Freight</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/littleAlert.js') }}"></script>

    <script>
        $(function() {
            // $('#infoModal').modal('show');


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('body').on('click', '.approveFreightModal', function () {
                data = $(this).data('data');


                modal = document.querySelector('#approveFreightModal');
                modal.querySelector('input[name="pallet_in"]').value = data.pieces
                modal.querySelector('input[name="freight_id"]').value = data.id
                modal.querySelector('input[name="byd_split"]').value = data.byd_split
                modal.querySelector('input[name="weight"]').value = data.weight

                console.log(modal);
                $('#approveFreightModal').modal('show');

            });


            // $('.approveMany').on('click', function(e) {
            //     freights = $('input[name="freight_id[]"]');
            //     arr = '';
            //     freights.map((index) => {
            //         fre = freights[index];
            //         if (fre.checked) {
            //             arr += fre.value + ',';
            //         }
            //     })
            //     if (arr == '') {
            //         e.preventDefault();
            //         littleAlert('Please select freight to approve', 1);
            //     } else {
            //         $.ajax({
            //             method: 'POST',
            //             url: `/control/approvefreight`,
            //             data: {
            //                 freights: arr
            //             }
            //         }).done(function(res) {
            //         })
            //     }
            // });
        })
    </script>

@endsection
