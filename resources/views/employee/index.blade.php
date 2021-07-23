@extends('welcome')

@section('title', 'Employees - miniCRM')

@section('main_header')
    <h1>Employees</h1>
@stop

@section('main')
    <div class="px-1 overflow-hidden">
        <div class="flex flex-row-reverse justify-content-end">
            <a href="{{route('employees.create')}}" class="float-right btn-primary py-2 px-2 shadow mb-2 rounded-sm"
               >
                Add Employee
            </a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Company</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $index=>$employee)
                <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td>{{$employee->first_name}}</td>
                    <td>{{$employee->last_name}}</td>
                    <td>{{$employee->phone}}</td>
                    <td>{{$employee->email}}</td>
                    <td>{{ App\Models\Company::where('id', $employee->company)->first()['name']}}</td>

                    <td>
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <a href="{{route('employees.edit',$employee->id)}}"
                                   class="float-right btn-sm text-primary"
                                />
                                Edit
                            </div>
                            <div>
                                <a href="{{route('employees.destroy', $employee->id)}}"
                                   class="float-right btn-sm text-danger "/>
                                Delete
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$employees->links()}}
    </div>





@stop
