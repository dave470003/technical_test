<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceHeader;
use App\Models\InvoiceLocation;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Controller to deal with invoices
 *
 * @author David Fox <djwfox@gmail.com>
 */
class InvoiceController extends Controller
{
    /**
     * Display Invoice reports
     *
     * @param Request $request
     * @return void
     *
     * @author David Fox <djwfox@gmail.com>
     */
    public function report(Request $request)
    {
        $action = $request->query('action', false);
        $status = $request->query('status', false);
        $location = $request->query('location', false);
        $dateFrom = $request->query('range-from', false);
        $dateTo = $request->query('range-to', false);

        if ($dateFrom) {
            $dateFrom = Carbon::parse($dateFrom);
        }

        if ($dateTo) {
            $dateTo = Carbon::parse($dateTo);
        }

        $showInvoiceReport = false;
        $showLocationReport = false;

        $invoiceQuery = InvoiceHeader::query();

        if ($action === 'invoice-form') {
            $showInvoiceReport = true;
            if ($status) {
                $invoiceQuery->where('status', $status);
            }
            if ($location) {
                $invoiceQuery->where('location_id', $location);
            }
            if ($dateFrom) {
                $invoiceQuery->where('date', '>=', $dateFrom->format('Y-m-d'));
            }
            if ($dateTo) {
                $invoiceQuery->where('date', '<=', $dateTo->format('Y-m-d'));
            }
        }

        $invoiceSumsByLocation = DB::table('invoice_lines')
            ->join('invoice_headers', 'invoice_header_id', '=', 'invoice_headers.id')
            ->groupBy('location_id')
            ->groupBy('status')
            ->select('status')
            ->selectRaw('SUM(value) as total');

        if ($action === 'location-form') {
            $showLocationReport = true;
            if ($location) {
                $invoiceSumsByLocation->where('location_id', '=', $location);
            }
        }

        $invoiceSumsByLocation = $invoiceSumsByLocation->get();
        $invoices = $invoiceQuery->get();
        $locations = InvoiceLocation::all();
        $invoicesByStatus = InvoiceHeader::all()->groupBy('status');

        return view('invoice.reports.main', [
            'showInvoiceReport' => $showInvoiceReport,
            'showLocationReport' => $showLocationReport,
            'invoices' => $invoices,
            'locations' => $locations,
            'invoicesByStatus' => $invoicesByStatus,
            'invoiceSumsByLocation' => $invoiceSumsByLocation,
            'submittedStatus' => $status,
            'submittedLocation' => $location,
            'submittedDateFrom' => $dateFrom,
            'submittedDateTo' => $dateTo
        ]);
    }
}
