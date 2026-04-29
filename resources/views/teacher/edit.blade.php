@extends('app.layout')
@section('head')
    <title>Edit Students</title>
@endsection


@section('content')
{{-- //tis vaaldite when error display --}}

<x-errors-component className="alert alert-danger" ></x-errors-component>



    <section>
        <div class="card shadow-lg">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">Edit Teacher</h5>
            </div>
            <div class="card-body">
                <form action="{{ URL('teacher/update', $teacher->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{ $teacher->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="{{ $teacher->email }}">
                    </div>


                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="age" class="form-control" id="age" name="age" required value="{{ $teacher->age }}">
                    </div>

                       <div class="mb-3">
                        <label for="phone" class="form-label">phone</label>
                        <input type="number" class="form-control" id="phone" name="phone" value="{{ $teacher->phone}}">
                    </div>

                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required value="{{ $teacher->date_of_birth }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="m"
                                    {{ $teacher->gender == 'm' ? 'checked' : '' }}> <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="f"
                                    {{ $teacher->gender == 'f' ? 'checked' : '' }}>

                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                    </div>

                     <div class="mb-3">
                             <label class="form-label">Password</label>
                             <input type="password" class="form-control" name="password">
                            </div>

                        <div class="mb-3">
                             <label class="form-label">Confirm Password</label>
                             <input type="password" class="form-control" name="password_confirmation">
                        </div>

                           <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection
