@extends('layout')

@section('content')
    <section class="mt-5">
        <h1 class="mb-5">Invoice Reports</h1>
        <div class="mb-5">
            <h2>Individual Invoice Report</h2>
            <form name="invoice" class="mb-3">
                <div class="form-group">
                    <label class="form-label" for="range-from">Date From</label>
                    <input name="range-from" class="form-control" id="invoice_date_from"  value="{{ $submittedDateFrom ? $submittedDateFrom->format('Y-m-d') : '' }}" />
                </div>
                <div class="form-group">
                    <label class="form-label" for="range-to">Date To</label>
                    <input name="range-to" class="form-control" id="invoice_date_to" value="{{ $submittedDateTo ? $submittedDateTo->format('Y-m-d') : '' }}" />
                </div>
                <div class="form-group">
                    <label class="form-label" for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="">Any Status</option>
                        @foreach ($invoicesByStatus as $status => $invoiceCollection)
                            <option value="{{ $status }}"
                                @if ($status == $submittedStatus)
                                    selected
                                @endif
                            >{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="location">Location</label>
                    <select name="location" class="form-control">
                        <option value="">Any Location</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}"
                                @if (($location->id) == $submittedLocation)
                                    selected
                                @endif
                            >{{ $location->getName() }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="action" value="invoice-form" />
                <button type="submit" class="btn btn-primary">View Invoice Report</button>
            </form>
            @includeWhen($showInvoiceReport, 'invoice.reports.invoice')
        </div>
        <div>
            <h2>Aggregate Location Report</h2>
            <form name="location" class="mb-3">
                <div class="form-group">
                    <label class="form-label" for="location">Location</label>
                    <select name="location" class="form-control">
                        <option value="">Any Location</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}"
                                @if (($location->id) == $submittedLocation)
                                    selected
                                @endif
                            >{{ $location->getName() }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="action" value="location-form" />
                <button type="submit" class="btn btn-primary">View Location Report</button>
            </form>
            @includeWhen($showLocationReport, 'invoice.reports.location')
        </div>
    </section>
@endsection
