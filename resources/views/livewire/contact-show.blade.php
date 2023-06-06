<div>
    @include('livewire.contactmodal')
    <div class="container">
    <a href="{{ url('/customers') }}" class="btn btn-primary me-3">{{ __('Customers') }}</a>
    <a href="{{ url('/employees') }}" class="btn btn-primary me-3">{{ __('Employees') }}</a>
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
 
                <div class="card">
                    <div class="card-header">
                        <h4>Contact CRUD 
                            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#contactModal">
                                Add New Contact
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderd table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>ModifiedDate</th>
                                    <th>Customer ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->title }}</td>
                                        <td>{{ $contact->customer->Name }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->ModifiedDate }}</td>
                                        <td>{{ $contact->customer_id }}</td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#updateContactModal" wire:click="editContact({{$contact->id}})" class="btn btn-primary">
                                                Edit
                                            </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteContactModal" wire:click="deleteContact({{$contact->id}})" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No Contact Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $contacts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</div> 