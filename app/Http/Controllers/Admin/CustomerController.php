<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', '!=', '1')
            ->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function destroy($id)
    {
        $customer = User::find($id);
        $customer->delete();

        return redirect('admin/customers')->with('success', 'Data berhasil dihapus');
    }

    public function print()
    {
        $customers = User::where('role', '!=', '1')
            ->get();

        return view('admin.customers.print', compact('customers'));
    }
}
