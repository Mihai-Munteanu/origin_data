<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all companies, paginated by ten per page
        $companies = Company::orderBy('name')->paginate(10);

        return response()->json([
            "data" => $companies,
            "status" => "Success"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // validate the input
         $validation = Validator::make($request->all(),[
            'name' => 'required|unique:companies|max:100',
            'address' => 'nullable|max:100',
            'email' => 'nullable|email|unique:companies|max:100',
            'phone' => 'nullable|digits_between:1,10',
            'description' => 'nullable|max:255',
        ]);

        //  if validation fails
        if ($validation->fails()) {
            return response()->json([
                "errors" => $validation->errors(),
                "message" => "Validation errors",
                "status" => "error"
            ]);
        }

        // create company
        $company = Company::create($request->input());

        return response()->json([
            "message" => "Company was created!",
            "status" => "Success",
            "company" => $company
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        // show only one company
        return response()->json([
            "data" => $company,
            "status" => "Success"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        if(empty($request->all())){
            return response()->json([
                "message" => "Nothing to update!",
                "status" => "Success",
                "company" => $company
            ]);
        };

         // validate the input
         $validation = Validator::make($request->all(),[
            'name' => !empty($request->name) ? 'required|max:100|unique:companies,name,'.$company->id : 'nullable',
            'address' => !empty($request->address) ? 'nullable|max:100' : 'nullable',
            'email' => !empty($request->email) ? 'nullable|email|max:100|unique:companies,email,'.$company->id : 'nullable',
            'phone' => !empty($request->phone) ? 'nullable|digits_between:1,10' : 'nullable',
            'description' => !empty($request->description) ? 'nullable|max:255' : 'nullable',
        ]);

        //  if validation fails
        if ($validation->fails()) {
            return response()->json([
                "errors" => $validation->errors(),
                "message" => "Validation errors",
                "status" => "error"
            ]);
        }

        // update company
        $company->update($request->input());

        return response()->json([
            "message" => "Company was updated!",
            "status" => "Success",
            "company" => $company
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //delete company
        $company->delete();

        return response()->json([
            "message" => "Company was deleted!",
            "status" => "Success",
        ]);
    }
}
