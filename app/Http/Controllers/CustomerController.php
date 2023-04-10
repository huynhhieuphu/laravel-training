<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public $data = [];
    private $customerModel;

    public function __construct()
    {
        $this->customerModel = new Customers();
    }

    public function index() {
        $this->data['title'] = 'Danh sách khách hàng';
        $this->data['customers'] = $this->customerModel->getAll();
        return view('customers.index', $this->data);
    }

    public function create() {
        $this->data['title'] = 'Tạo mới khách hàng';
        $this->data['error_validate'] = 'Vui lòng kiểm tra lại dữ liệu';

        return view('customers.create', $this->data);
    }

    public function add(Request $request) {
        $request->validate([
           'customer_fullname' => 'required|string|max:100',
           'customer_email' => 'required|email|max:100|unique:customers'
        ]);

        $data = [
            'customer_fullname' => $request->customer_fullname,
            'customer_email' => $request->customer_email,
            'customer_created_at' => time()
        ];

        $customer = $this->customerModel->insertRecord($data);
        if($customer) {
            return redirect()->route('customer.list')->with('suc_message', 'Insert Success');
        }
        return back()->withInput()->with('err_message', 'Insert Fail');
    }

    public function edit($id) {
        if(!empty($id)) {
            $customer = $this->customerModel->getDetail($id);
            if(!empty($customer)) {
                $this->data['title'] = 'Chi tiết khách hàng';
                $this->data['error_validate'] = 'Vui lòng kiểm tra lại dữ liệu';
                $this->data['customer'] = $customer[0];
                session(['customer_id' => $customer[0]->customer_id]);
//                dd($this->data);
                return view('customers.edit', $this->data);
            }
        }
        return redirect()->route('customer.list')->with('err_message', 'Not Found');
    }

    public function update(Request $request) {
        $customer_id = session('customer_id') ?? null;
        $customer = $this->customerModel->getDetail($customer_id);
        if(!empty($customer)) {
            $request->validate([
                'customer_fullname' => 'required|string|max:100',
                'customer_email' => 'required|email|max:100|unique:customers,customer_email,'.$customer[0]->customer_id.',customer_id'
            ]);
//            dd($request->all());
            $data = [
                'customer_id' => $customer[0]->customer_id,
                'customer_fullname' => $request->customer_fullname,
                'customer_email' => $request->customer_email,
                'customer_updated_at' => time()
            ];
            $customer = $this->customerModel->updateRecord($data);
            if($customer) {
                return redirect()->route('customer.list')->with('suc_message', 'Update Success');
            }
            return back()->withInput()->with('err_message', 'Update Fail');
        }
        return redirect()->route('customer.list')->with('err_message', 'Not Found');
    }

    public function delete(Request $request) {
        $id = $request->customer_id;
        if(!empty($id)) {
            $customer = $this->customerModel->getDetail($id);
            if(!empty($customer)) {
                $customer = $this->customerModel->deleteRecord($customer[0]->customer_id);
                if($customer) {
                    return redirect()->route('customer.list')->with('suc_message', 'Delete Success');
                }
                return redirect()->route('customer.list')->with('err_message', 'Delete Fail');
            }
        }
        return redirect()->route('customer.list')->with('err_message', 'Not Found');
    }
}
