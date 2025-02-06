@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success">
                <div class="card-header">Total Sales</div>
                <div class="card-body">
                    <h5 class="card-title">$15,350</h5>
                    <p class="card-text">This month</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-header">Total Products</div>
                <div class="card-body">
                    <h5 class="card-title">120</h5>
                    <p class="card-text">Total products listed</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info">
                <div class="card-header">Total Orders</div>
                <div class="card-body">
                    <h5 class="card-title">356</h5>
                    <p class="card-text">Orders received this month</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">Recent Orders</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#1001</td>
                                <td>John Doe</td>
                                <td>Shipped</td>
                                <td>$120</td>
                            </tr>
                            <tr>
                                <td>#1002</td>
                                <td>Jane Smith</td>
                                <td>Processing</td>
                                <td>$80</td>
                            </tr>
                            <tr>
                                <td>#1003</td>
                                <td>Bob Brown</td>
                                <td>Delivered</td>
                                <td>$50</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">Recent Transactions</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#TXN1001</td>
                                <td>2025-02-01</td>
                                <td>$200</td>
                                <td>Completed</td>
                            </tr>
                            <tr>
                                <td>#TXN1002</td>
                                <td>2025-02-01</td>
                                <td>$150</td>
                                <td>Pending</td>
                            </tr>
                            <tr>
                                <td>#TXN1003</td>
                                <td>2025-02-01</td>
                                <td>$300</td>
                                <td>Completed</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
