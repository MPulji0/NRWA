<div>
    @include('livewire.customermodal')

    <div class="container">
        <a href="{{ url('/employees') }}" class="btn btn-primary">{{ ('Employees') }}</a>
        <a href="{{ url('/contacts') }}" class="btn btn-primary">{{ ('Contacts') }}</a>
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif

                @if ($errors->has('authorization'))
                    <div class="alert alert-danger">
                        {{ $errors->first('authorization') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Customer CRUD
                            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                            @if (auth()->user()->is_admin)
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#customerModal">
                                    Add New Customer
                                </button>
                            @endif
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderd table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->Name }}</td>
                                        <td>{{ $customer->Email }}</td>
                                        <td>{{ $customer->City }}</td>
                                        <td>
                                            @if (auth()->user()->is_admin)
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#updateCustomerModal" wire:click="editCustomer({{$customer->id}})" class="btn btn-primary">
                                                    Edit
                                                </button>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteCustomerModal" wire:click="deleteCustomer({{$customer->id}})" class="btn btn-danger">Delete</button>
                                            @else
                                                <button type="button" class="btn btn-primary" disabled>
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" disabled>Delete</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No Customer Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>