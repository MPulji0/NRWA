<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersApi extends Controller
{
    public function index()
    {
        $Customer = Customer::all();
        
        
        return response()->json($Customer);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'city' => 'required',
            
        ]);
        $customer=Customer::create($request->post());


        return "Customer stvoren";
    }

    public function show($id)
    {

        $Customer = Customer::find($id);
        return $Customer;
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'email' => 'required',
            
        ]);
        $customer->update($request->all());

        return $customer;
    }
    public function destroy($id)
    {
        $customer=Customer::find($id)->delete();
        return "Customer deleted";
    }
}
