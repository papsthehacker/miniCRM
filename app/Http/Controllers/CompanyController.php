<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderByDesc('name')->withCount('employees')->paginate(10);
        return view('company.index', compact('companies',));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $company = new Company();
        $data = $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'name' => 'required|string',
            'email'=> 'email|nullable'

        ]);
        if ($request->hasFile('logo')) {
            $imageName = time().'_'.Str::slug($request->name) . '_' . $request->logo->getClientOriginalName();
             $request->logo->storeAs('public/logos', $imageName);
            $path = asset('/storage/logos/'.$imageName);
           $company->logo = $path;
        }


        $company->name=$request->name;
        $company->website=$request->website;
        $company->email = $request->email;
        $company->save();
        if($request->email != null){
            $this->newAccountNotification($data['email']);
        }

          return Redirect::to('/admin/companies')->with('message', 'Company updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('company.edit', compact('company'));
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
        $company =  Company::find($id);
        $data = $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string',
            'email'=> 'email|nullable'

        ]);
        if ($request->hasFile('logo')) {
            $imageName = time().'_'.Str::slug($request->name) . '_' . $request->logo->getClientOriginalName();
            $request->logo->storeAs('public/logos', $imageName);
            $path = asset('/storage/logos/'.$imageName);
            $company->logo = $path;
        }


        $company->name=$request->name;
        $company->website=$request->website;
        $company->email = $request->email;
        $company->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Company::find($id)->delete();
        return Redirect::to('/admin/companies')->with('message', 'Company deleted successfully');
    }
    public function newAccountNotification($email){
        \Mail::to($email)->send(new WelcomeMail());
    }

    public function updateAttachment($id){
        Company::find($id)->update(['logo'=>Company::saveAttachment()]);
    }
}
