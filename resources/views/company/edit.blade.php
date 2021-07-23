@extends('welcome')

@section('title', 'Edit '.$company->name.' - miniCRM')

@section('main_header')
    <h1>Edit {{$company->name}}</h1>
@stop

@section('main')
    <form action="{{route('companies.update', $company->id)}}" enctype="multipart/form-data" method="post">
        @method('post')
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-7 col-lg-6">
                {{-- Email type --}}
                <x-adminlte-input value="{{$company->name}}" name="name" required label="Company Name" type="text" placeholder="Test Corp"/>

                <x-adminlte-input value="{{$company->email}}" name="email" label="Company Email" type="email" placeholder="mail@example.com"/>

                <x-adminlte-input value="{{$company->website}}" name="website" label="Company Website" type="text" placeholder="https://example.com"/>

                <x-adminlte-input-file value="{{$company->logo}}" name="logo" label="Upload file" placeholder="Choose a file..."
                                       disable-feedback/>
                <div class="d-flex justify-content-end">
                    <div>
                        <x-adminlte-button label="Cancel" class="mr-4"/>
                    </div>

                    <div>
                        <x-adminlte-button class="" label="Save Changes" type="submit" theme="primary"/>

                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
