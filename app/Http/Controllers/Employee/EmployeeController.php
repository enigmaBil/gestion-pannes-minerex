<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {

        return view('employee.index');
    }

    public function getAllPannes()
    {
        return view('employee.panne.index');
    }

    public function create()
    {
        return view('employee.panne.create');
    }

    public function store()
    {

    }

    public function show($id)
    {
        return view('employee.panne.show');
    }

    public function edit($id)
    {
        return view('employee.panne.edit');
    }

    public function update($id)
    {

    }

}
