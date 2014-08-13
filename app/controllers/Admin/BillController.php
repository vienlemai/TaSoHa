<?php

namespace Admin;

use \AdminGroup;
use \View;
use \Response;
use \Lang;
use \Session;
use \Input;
use \AdminUser;
use \Redirect;
use \Bill;

class BillController extends AdminBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $bills = \Bill::with('creator', 'buyer')
            ->condition(Input::all())
            ->orderBy('created_at', 'desc')
            ->paginate();
        $this->layout->content = View::make('admin.bills.index', array(
                'bills' => $bills,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $members = \Member::get()->lists('name_uid', 'id');
        $this->layout->content = View::make('admin.bills.create', array(
                'members' => $members
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $bill = new Bill(Input::all());
        $bill->price = \Common::stringToInt($bill->price);
        $bill->score = \Common::stringToInt($bill->score);
        if ($bill->save()) {
            Session::flash('success', 'Nhập thành công hóa đơn');
            return Redirect::route('admin.bills.index');
        } else {
            return Redirect::back()->withInput()->withErrors($bill->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $bill = \Bill::with('buyer')
            ->findOrFail($id);
        $this->layout->content = View::make('admin.bills.show', array(
                'bill' => $bill,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $bill = Bill::findOrFail($id);
        $bill->delete();
        Session::flash('success', 'Xóa thành công 1 hóa đơn của khách hàng : <b>' . $bill->buyer->full_name . '</b>');
        return Redirect::route('admin.bills.index');
    }

    public function printBill($id) {
        $bill = Bill::with('buyer')
            ->findOrFail($id);
        $this->setPrintLayout();
        $this->layout->content = View::make('admin.bills.print', array(
                'bill' => $bill
        ));
    }

}
