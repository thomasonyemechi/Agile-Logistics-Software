@extends('layouts/app')
@section('title')
    Organization | {{ ucwords($org->name) }}
@endsection
@section('pagecontent')

    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            {{ ucwords($org->name) }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="admin-dashboard.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ ucwords($org->name) }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <button type="button" class="btn  btn-outline-white active" data-bs-toggle="modal"
                            data-bs-target="#editOrganization">
                            <span class="fe fe-edit"></span> Edit Company Info
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('assets/img/org/' . $org->logo) }}" class="rounded-circle avatar-xl mb-3"
                                alt="" />
                            <h4 class="mb-0">{{ ucwords($org->name) }}</h4>
                            <p class="mb-0">{{ $org->email }}, {{ $org->phone }}</p>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Status</span>
                            @if ($org->status == 0)
                                <div class="badge bg-danger">Inactive</div>
                            @else
                                <div class="badge bg-success">Active</div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between pt-2">
                            <span>Address</span>
                            <span class="text-dark"> {{$org->address}} </span>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $org->manifests->count() }}</h4>
                                <p class="fs-6 mb-0">Total Manifest</p>
                            </div>
                            <div>
                                <span><i class="fe fe-file-text fs-3"></i></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $org->manifests->count() }}</h4>
                                <p class="fs-6 mb-0">Total Freight </p>
                            </div>
                            <div>
                                <span><i class="fe fe-book fs-3"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-8 col-md-8 col-12">

                @php
                    $manifests = \App\Models\Manifest::where('org_id', $org->id)->orderBy('id', 'desc')->paginate(50);
                @endphp
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="mb-0">Recent Manifests</h4>
                        <button data-bs-toggle="modal" data-bs-target="#addManifest" class="btn btn-primary btn-xs">Create Manifest</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="border-0">Manifest Number</th>
                                    <th scope="col" class="border-0">Tractor No</th>
                                    <th scope="col" class="border-0">Trailer No</th>
                                    <th scope="col" class="border-0">Trailer Seal No</th>
                                    <th scope="col" class="border-0">Driver/ Owner</th>
                                    <th scope="col" class="border-0">Date Added</th>
                                    <th scope="col" class="border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($manifests as $man)
                                    <tr>
                                        <td> <a href="/control/manifest/{{$man->id}}"> <div class="badge bg-primary"> {{$man->manifest_number}}  </div> </a> </td>
                                        <td>{{$man->tractor_no}} </td>
                                        <td>{{$man->trailer_no}} </td>
                                        <td>{{$man->trailer_seal_no}} </td>
                                        <td>{{$man->driver}} / {{$man->owner}} </td>
                                        <td>{{$man->created_at}} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex mt-3 justify-content-center">
                        {{$manifests->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="addManifest" tabindex="-1" role="dialog" aria-labelledby="addManifest"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addManifest">Create Manifest</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('control.createMainfest') }}" class="row">@csrf
                        <x-jet-validation-errors />
                        <div class="mb-2 col-md-6">
                            <label class="form-label">Manifest Number</label>
                            <input type="text" class="form-control" name="manifest_number" value="{{ old('manifest_number') }}"
                                placeholder="Manifest Number" required>
                                <input type="hidden" name="org_id" value="{{ $org->id }}">
                        </div>

                        <div class="mb-2 col-md-6">
                            <label class="form-label">Tractor Number</label>
                            <input type="text" class="form-control" name="tractor_no" value="{{ old('tractor_no') }}"
                                placeholder="Tractor Number" required>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label class="form-label">Driver</label>
                            <input type="text" class="form-control" name="driver" value="{{ old('driver') }}"
                                placeholder="Driver" required>
                        </div>


                        <div class="mb-2 col-md-6">
                            <label class="form-label">Owner</label>
                            <input type="text" class="form-control" name="owner" value="{{ old('owner') }}"
                                placeholder="Owner" required>
                        </div>

                        <div class="col-4">
                            <label class="form-label">Trailer No</label>
                            <input type="text" name="trailer_no" class="form-control" value="{{ old('trailer_no') }}"
                                placeholder="Trailer No" required>
                        </div>
                        <div class="mb-2 col-4">
                            <label class="form-label">Trailer Seal No</label>
                            <input type="text" name="trailer_seal_no" class="form-control" value="{{ old('trailer_seal_no') }}"
                                placeholder="Trailer Seal No" required>
                        </div>
                        <div class="mb-2 col-4">
                            <label class="form-label">Placards</label>
                            <input type="text" name="plac" class="form-control" value="{{ old('plac') }}"
                                placeholder="Placards" required>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Manifest</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <div class="modal fade" id="editOrganization" tabindex="-1" role="dialog" aria-labelledby="editOrganization"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrganization">Edit Organization Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fe fe-x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('control.editOrganizationInfo') }}" method="POST" enctype="multipart/form-data" class="row">@csrf
                    <x-jet-validation-errors />
                    <div class="mb-2 col-6">
                        <div class="mb-2">
                            <label  class="form-label">Organization Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name"  value="{{ $org->name }}" placeholder="Organization name" required>
                            <input type="hidden" name="org_id"  value="{{ $org->id }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label"> Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $org->email }}" placeholder="Email Address" >
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" value="{{ $org->phone }}"  placeholder="Enter phone" required>
                        </div>


                        <div class="mb-2">
                            <label class="form-label">Address </label>
                            <textarea name="address" class="form-control" rows="2" placeholder="Address" > {{ $org->address }}</textarea>
                        </div>


                    </div>

                    <div class="mb-2 col-6">
                        <div class="custom-file-container" data-upload-id="courseCoverImg" id="courseCoverImg">
                            <label class="form-label">Organization Logo
                                <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a></label>
                            <label class="custom-file-container__custom-file">
                                <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="logo" />
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                            </label>

                            <div class="custom-file-container__image-preview"></div>
                        </div>
                        </small>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


@endsection
