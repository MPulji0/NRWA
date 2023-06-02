@extends('layouts.app')
 
@section('content')
 
    <div>
        <livewire:employee-show>
    </div>
 
@endsection
 
@section('script')
<script>
    window.addEventListener('close-modal', event => {
 
        $('#EmployeeModal').modal('hide');
        $('#updateEmployeeModal').modal('hide');
        $('#deleteEmployeeModal').modal('hide');
    })
</script>
@endsection