@extends('layout.base')

@section('content')
    <div class="card rounded bg-white">
        <div class="col-12 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Edit Profile</h4>
                </div>
                <div class="row mt-2">
                    <form action="/profile/{{ Auth::user()->id }}" method="post" class="row mt-3">
                        @csrf
                        @method('patch')

                        <div class="col-md-12">
                            <label class="labels">Name</label>
                            <input type="text" class="form-control" placeholder="Name"
                                 name="name">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Phone</label>
                            <input type="number" class="form-control" placeholder="Phone"
                                 name="phone">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Address Line</label>
                            <input type="text" class="form-control" placeholder="Address"
                                name="address">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Gender</label>
                            <input type="text" class="form-control" placeholder="Gender"
                                 name="gender">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Email</label>
                            <input type="text" class="form-control" placeholder="Email"
                                 name="email">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Date of Birth</label>
                            <input type="date" class="form-control" placeholder="Date of Birth"
                                 name="dob">
                        </div>
                        <button type="submit" class="ml-2 mt-3 btn btn-primary profile-button">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
