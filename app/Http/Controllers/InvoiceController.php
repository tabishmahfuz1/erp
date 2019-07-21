<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesOrder;
use App\Customer;

class InvoiceController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function newInvoice($order_id = 0) {
    	$orders = SalesOrder::where('is_invoiced', '<', 2)
    						->where('fulfilment_status', '>', 0)
    						->select('id', 'sales_order_no')
    						->get();
    	return view('invoice.new_invoice', compact('orders'));
    }

    public function getOrderDetails($order_id) {
    	$order = SalesOrder::find($order_id);
    	$order->customer_name 	= Customer::getNameById($order->customer_id);
        $order->Fulfilments 	= $order->FulfilmentsWithAmount(); 
        return response()->json($order);
    }

    public function getFulfilmentItems($fulfilment_id) {
    	$items = \App\FulfilmentItem::where('fulfilment_id', $fulfilment_id)
    				->join('sales_order_item_details AS soid', 'soid.id', '=', 'fulfilment_items.so_item_id')
    				->join('items', 'items.id', '=', 'soid.item_id')
    				->select('fulfilment_items.*', 'soid.item_price', 'soid.item_disc_amt', 'soid.item_rate', 'items.item_name')
    				->get();
    	return response()->json($items);
    }
}