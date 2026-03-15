<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceReportController extends Controller
{
    public function index()
    {
        return view('reports.invoices_report');
    }

    public function search_invoices(Request $request)
    {
        $rdio = $request->rdio;
        if ($rdio == 1) {
            if ($request->type && $request->start_at == '' && $request->end_at == '') {
                $invoices = Invoice::select('*')->where('Status', '=', $request->type)->get();
                $type = $request->type;
                return view('reports.invoices_report', compact('type'))->withDetails($invoices);
            } else {
                $start_at = Carbon::parse($request->start_at)->toDateString();
                $end_at = Carbon::parse($request->end_at)->toDateString();
                $type = $request->type;
                $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])->where('Status', $request->type)->get();
                return view('reports.invoices_report', compact('type', 'start_at', 'end_at','invoices'));
            }
        } else {
            $invoices = Invoice::select('*')->where('invoice_number', '=', $request->invoice_number)->get();
            return view('reports.invoices_report')->withDetails($invoices);

        }

    }
}
