<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceAttachments;
use App\Models\InvoiceDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceDetailsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(InvoiceDetails $invoiceDetails)
    {

    }

    public function edit($id)
    {
        $invoice = Invoice::find($id);
        $invoice_details = InvoiceDetails::where('invoice_id', $id)->get();
        $invoice_attachments = InvoiceAttachments::where('invoice_id', $id)->get();
        return view('Invoices.invoice_details', compact('invoice', 'invoice_details', 'invoice_attachments'));
    }

    public function update(Request $request, InvoiceDetails $invoiceDetails)
    {
        //
    }

    public function destroy(Request $request)
    {
        $invoice = InvoiceAttachments::find($request->id_file);
        $invoice->delete();
        storage::disk('public_uploads')->delete($request->invoice_number. '/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return redirect()->back();
    }

    public function getfile($invoice_number,$file_name){
        $path = $invoice_number . '/' . $file_name;
        $fullPath = Storage::disk('public_uploads')->path($path);
        return response()->download($fullPath);
    }
    public function open_file($invoice_number,$file_name){
        $path = $invoice_number . '/' . $file_name;
        $fullPath = Storage::disk('public_uploads')->path($path);
        return response()->file($fullPath);
    }
}
