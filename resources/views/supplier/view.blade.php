<!DOCTYPE html>
@extends('layout.layout')

@section('script')
    <script>
        //This script is used to update the data in the form of modal based on the chosen line
        $('#updateSupplier').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var supplier = button.data('supplier') // Extract info from data-* attributes
            var modal = $(this)
            $('#updateSupplier').find('#supplierName')[0].value = supplier.name
            $('#updateSupplier').find('#supplierTaxCode')[0].value = supplier.tax_code
            $('#updateSupplier').find('#supplierAddress')[0].value = supplier.address
            $('#updateSupplier').find('#supplierTelephone')[0].value = supplier.telephone
            $('#updateSupplier').find('#updateSupplierForm')[0].action = '/suppliers/'+ supplier.id
        })
    </script>
@endsection

@section('title', 'Configuration - Suppliers')

@section('content')
    <div class="container">
        {{-- End Data table--}}
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addNewSupplier" style="margin: 5px">
            Thêm mới
        </button>
        {{-- Data table --}}
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Tax Code</th>
                <th scope="col">Address</th>
                <th scope="col">Telephone</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($suppliers as $supplier)
            <tr>
                <th scope="row">{{ $supplier->id }}</th>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->tax_code }}</td>
                <td>{{ $supplier->address }}</td>
                <td>{{ $supplier->telephone }}</td>
                <td>{{ $supplier->created_at }}</td>
                <td>{{ $supplier->updated_at }}</td>
                <td class="align-top">
                    <div class="btn-group" role="group">
                        <div class="col-md-4 custom">
                            {{-- Update Supplier --}}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateSupplier" data-supplier="{{ $supplier }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                                    <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="col-md-4 custom">
                            {{-- Delete Supplier --}}
                            <form method="POST" action="/suppliers/{{ $supplier->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <svg width="1em" heighst="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        {{ $suppliers->links() }}
    </div>
@endsection
{{-- Modal to add new Supplier --}}
<div class="modal fade" id="addNewSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create new supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <form method="POST" action="/suppliers">
                    @csrf
                    <div class="form-group">
                        <label for="supplierName">Name</label>
                        <input name="name" type="text" class="form-control" id="supplierName" aria-describedby="">
                    </div>
                    <div class="form-group">
                        <label for="supplierTaxCode">Tax code</label>
                        <input name="taxCode" type="text" class="form-control" id="supplierTaxCode" aria-describedby="">
                    </div>
                    <div class="form-group">
                        <label for="supplierAddress">Address</label>
                        <input name="address" type="text" class="form-control" id="supplierAddress" aria-describedby="">
                    </div>
                    <div class="form-group">
                        <label for="supplierTelephone">Telephone</label>
                        <input name="telephone" type="text" class="form-control" id="supplierTelephone" aria-describedby="">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Modal to update Supplier --}}
<div class="modal fade" id="updateSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <form method="POST" id="updateSupplierForm" action="">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="supplierName">Name</label>
                        <input name="name" type="text" class="form-control" id="supplierName" aria-describedby="">
                    </div>
                    <div class="form-group">
                        <label for="supplierTaxCode">Tax code</label>
                        <input name="taxCode" type="text" class="form-control" id="supplierTaxCode" aria-describedby="" value="{{ $supplier->tax_code }}">
                    </div>
                    <div class="form-group">
                        <label for="supplierAddress">Address</label>
                        <input name="address" type="text" class="form-control" id="supplierAddress" aria-describedby="" value="{{ $supplier->address }}">
                    </div>
                    <div class="form-group">
                        <label for="supplierTelephone">Telephone</label>
                        <input name="telephone" type="text" class="form-control" id="supplierTelephone" aria-describedby="" value="{{ $supplier->telephone }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>


