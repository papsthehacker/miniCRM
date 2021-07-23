@extends('welcome')

@section('title', ' Create employee - miniCRM')

@section('main_header')
    <h1>Add new employee</h1>
@stop

@section('main')
    <form action="{{route('employees.store')}}" enctype="multipart/form-data" method="post">
        @method('post')
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-7 col-lg-6">
                {{-- Email type --}}
                <x-adminlte-input name="first_name"  required label="First Name" type="text"/>

                <x-adminlte-input name="last_name" label="Last Name" type="text" placeholder="Doe"/>
                <x-adminlte-input name="email" label="Email" type="email" placeholder="mail@example.com"/>
                <x-adminlte-input name="phone" label="Phone" type="tel" placeholder="024455555"/>

                <x-adminlte-select  name="company" label="Company"
                >
                    @foreach($companies as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </x-adminlte-select>
                <x-adminlte-input-file name="picture" label="Upload Profile Picture" placeholder="Choose a file..."
                                       disable-feedback/>
                <div class="d-flex justify-content-end">
                    <div>
                        <x-adminlte-button label="Cancel" class="mr-4" action="{{route('employees.index')}}"/>
                    </div>

                    <div>
                        <x-adminlte-button class="" label="Save" type="submit" theme="primary"/>

                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
