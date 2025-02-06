@extends('layouts.app')

@section('content')
    <h2>Transaction Management</h2>

    <div class="alert alert-success">
        Transaction successfully completed!
    </div>

    <div class="bg-white rounded p-4">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sample Name</td>
                    <td>Gcash</td>
                    <td>
                        <p class="m-0">100.00</p>
                        <p class="bg-success-subtle rounded px-2 py-1">Successfully!</p>
                    </td>
                    <td>Completed</td>
                    <td>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#orderDetails">View</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#updateStatus">Refund</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="orderDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
