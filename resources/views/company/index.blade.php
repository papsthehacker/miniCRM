@extends('welcome')

@section('title', 'Companies - miniCRM')

@section('main_header')
    <h1>Companies</h1>
@stop

@section('main')
    <div class="px-1 overflow-hidden">
        <div class="flex flex-row-reverse justify-content-end">
            <a href="{{route('companies.create')}}" class="float-right btn-primary py-2 px-2 shadow mb-2 rounded-sm"
            >
                Add Company
            </a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Website</th>
                <th scope="col">No. Employees</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $index=>$company)
                <tr>
                    <th scope="row">
                        <img width="32" height="32" class="rounded-pill" src="{{$company->logo}}" alt="Company logo">
                    </th>
                    <td>{{$company->name}}</td>
                    <td>{{$company->email}}</td>
                    <td><a href="{{$company->website}}">{{$company->website}}</a></td>
                    <td>{{$company->employees()->count()}}</td>
                    {{--                    <td>{{$company->logo}}</td>--}}

                    <td>
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <a href="{{route('companies.edit',$company->id)}}"
                                   class="float-right btn-sm text-primary"
                                />
                                Edit
                            </div>
                            <div>
                                <a href="{{route('companies.destroy', $company->id)}}"
                                   class="float-right btn-sm text-danger "/>
                                Delete
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$companies->links()}}
    </div>





@stop
