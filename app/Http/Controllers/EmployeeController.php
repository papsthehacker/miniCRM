<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use JeroenNoten\LaravelAdminLte\Components\Tool\Datatable;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees = Employee::paginate(10);
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('employee.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $employee = new Employee();
        $data = $request->validate([
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'email' => 'email|unique:employees',
            'picture' => 'image'

        ]);
        if ($request->hasFile('picture')) {
            $imageName = time().'_'.Str::slug($request->name) . '_' . $request->picture->getClientOriginalName();
            $request->logo->storeAs('public/pictures', $imageName);
            $path = asset('/storage/pictures/'.$imageName);
            $employee->logo = $path;
        }
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->save();

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $employee = Employee::findOrFail($id);
        $company = Company::where('id', '=', $employee->company)->get();
        $companies = Company::all();
        return view('employee.edit', compact('employee', 'company', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'email|unique:employees',
            'picture' => 'image',

        );

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('admin/employees/' . $id . '/edit')
                ->withErrors($validator)->withInput($request->all());
        } else {
            $employee =  Employee::find($id);
            $employee->first_name = $request['first_name'];
            $employee->last_name = $request['last_name'];
            $employee->email = $request['email'];
            $employee->company_id = $request['company_id'];

            $employee->save();

            Session::flash('message', 'Employee updated successfully');
            return Redirect::to('/admin/employees');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        Session::flash('message', 'Employee deleted successfully');
        return Redirect::to('/admin/employees');
    }
}
