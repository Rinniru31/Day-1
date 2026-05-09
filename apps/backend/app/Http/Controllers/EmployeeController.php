<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //parameters: pagination, sorting, filtering
        try{
            $employees = Employee::all();
            //select * from employees;
            return response()->json($employees, 200);
        }catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occured while fetching employees.',
                'error' => $e->getMessage()
            ], 500 );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            //validation
            $validatedData= $request->validate([
                'last_name' => 'required|string|max:100',
                'first_name' => 'required|string|max:100',
                'email' => 'required|email|unique:employees',
                'gender' => 'nullable|string|max:10',
                'birthday' => 'nullable|date',
                'date_hired' => 'required|date',
                'salary' => 'nullable|numeric'

            ]);

            $employees = Employee::create($validatedData);
            //insert into employees (last_name, first) values ('Doe', 'John')
            return response()->json($employees, 201);
        }catch (\Exception $e) {
            return response()->json([
                'message' => 'Saving Unsuccessful.',
                'error' => $e->getMessage()
            ], 500 );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $employee = Employee::FindOrFail($id);
            return response()->json($employees,200);
        }catch (\Exception $e) {
            return response()->json([
                'message' => 'No Records Available.',
                'error' => $e->getMessage()
            ], 500 );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $employee = Employee::FindOrFail($id);
            
            //validation
            $validatedData= $request->validate([
                'last_name' => 'required|string|max:100',
                'first_name' => 'required|string|max:100',
                'gender' => 'nullable|string|max:10',
                'birthday' => 'nullable|date',
                'date_hired' => 'required|date',
                'salary' => 'nullable|numeric'

            ]);

            $employee->update($validatedData);
            return response()->json($employee);
        }catch (\Exception $e) {
            return response()->json([
                'message' => 'Update Failed.',
                'error' => $e->getMessage()
            ], 500 );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $employee = Employee::FindOrFail($id);
            $employee->delete();
            return response()->json([
                'message'=> 'Employee deleted successsfully.',
                'employee_id'=> $id
            ], 200);
        }catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occured while deleting employee.',
                'error' => $e->getMessage()
            ], 500 );
        }
    }
}
