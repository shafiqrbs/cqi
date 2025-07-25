
@extends('frontend.layouts.app')

@section('content')
    <div class="table-wrapper">
        <table class="table table-bordered custom-table">
            <thead>
            <tr>
                <th></th>
                <th>Russel Garments</th>
                <th>Integra Dresses Ltd.</th>
                <th>TM Jeans Ltd.</th>
                <th>Newage</th>
                <th>Space Sweater Ltd.</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="highlight-cell">Training and Capacity Building</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="highlight-cell">SBCC Approach</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="highlight-cell">Training and Capacity Building</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="highlight-cell">Promotional Campaign</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="highlight-cell">FPS Sales Performance</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection

@push('CustomStyle')
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
        }
        .title-text {
            font-weight: bold;
            color: #d10000;
            text-align: center;
            font-size: 1.6rem;
        }
        .organization-logo {
            height: 70px;
        }
        .gain-logo {
            height: 50px;
        }
        .custom-table thead th {
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 1rem;
        }
        .custom-table td, .custom-table th {
            vertical-align: middle;
            text-align: center;
        }
        .highlight-cell {
            background-color: #a3e635;
            font-weight: bold;
            border: 2px solid #d0d0d0;
            border-radius: 8px;
            padding: 12px;
        }
        .table-wrapper {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }
    </style>
@endpush
