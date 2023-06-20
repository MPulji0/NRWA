<div>
    @include('livewire.employeemodal')

    <div class="container">
        <a href="{{ url('/customers') }}" class="btn btn-primary me-3">{{ ('Customers') }}</a>
        <a href="{{ url('/contacts') }}" class="btn btn-primary me-3">{{ ('Contacts') }}</a>
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
                        <h4>Employee CRUD
                            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                            @if (auth()->user()->is_admin)
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#employeeModal">
                                    Add New Employee
                                </button>
                            @endif
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
                                            @if (auth()->user()->is_admin)
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#updateEmployeeModal" wire:click="editEmployee({{$employee->id}})" class="btn btn-primary">
                                                    Edit
                                                </button>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal" wire:click="deleteEmployee({{$employee->id}})" class="btn btn-danger">Delete</button>
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