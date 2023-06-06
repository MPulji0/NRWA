@extends('layouts.app')
 
@section('content')
 
    <div>
        <livewire:contact-show>
    </div>
 
@endsection
 
@section('script')
<script>
    window.addEventListener('close-modal', event => {
 
        $('#contactModal').modal('hide');
        $('#updateContactModal').modal('hide');
        $('#deleteContactModal').modal('hide');
    })
</script>
@endsection