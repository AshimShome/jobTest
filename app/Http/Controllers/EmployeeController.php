<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required',
            'email'=>"required",
            'phone' => 'required'
        ]);
        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        );
        if($request->hasFile('image') && $request->image->isValid()){
            $new_image = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'),$new_image);
            $data['image'] = $new_image;
        }

       Employee::create($data); 
       return response()->json(['success'=>"employee has been updated successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name'=>'required',
            'email'=>"required",
            'phone' => 'required'
        ]);
        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        );
        if($request->hasFile('image') && $request->image->isValid()){
            $new_image = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'),$new_image);
            $data['image'] = $new_image;
        }
       $employee->update($data); 
    //    return redirect()->route('employee.index');
    return response()->json(['success'=>"employee has been updated successfully"]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();
        return response()->json(['success'=>"employee has been updated successfully"]);
    }
}
