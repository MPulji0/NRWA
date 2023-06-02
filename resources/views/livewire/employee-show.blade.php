<div>
    @include('livewire.employeemodal')
    
    <div class="container">
    <a href="{{ url('/customers') }}" class="btn btn-primary me-3">{{ __('Customers') }}</a>
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
 
                <div class="card">
                    <div class="card-header">
                        <h4>Employee CRUD
                            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#employeeModal">
                                Add New Employee
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderd table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NationalIDnumber</th>
                                    <th>Title</th>
                                    <th>BirthDate</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->id }}</td>
                                        <td>{{ $employee->nationalidnumber }}</td>
                                        <td>{{ $employee->title }}</td>
                                        <td>{{ $employee->birthdate }}</td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#updateEmployeeModal" wire:click="editEmployee({{$employee->id}})" class="btn btn-primary">
                                                Edit
                                            </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal" wire:click="deleteEmployee({{$employee->id}})" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No Employee Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $employees->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</div> 