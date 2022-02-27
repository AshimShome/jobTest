@extends('master')


@section('content')
<form action="{{route('employee.store')}}" id="submit_employee" method="POST" enctype="multipart/form-datas">
    <div class="mb-3">
      <label for="name" class="form-label">Name address</label>
      <input type="text" class="form-control"  name="name" id="name" >
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" name="email" id="email" >
    </div>
    <div class="mb-3">
      <label for="phone_number" class="form-label">Phone Number</label>
      <input type="text" class="form-control" name="phone" id="phone_number" >
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Image</label>
      <input type="file" class="form-control" name="image" id="image" >
    </div>
    <button type="submit"  class="btn btn-primary">Submit</button>
  </form>
@endsection

@push('js')
<script type="text/javascript">
 $(document).ready(function(){
    $("#submit_employee").on('submit',function(event){
      event.preventDefault();
      const formData = new FormData(event.target);
      axios.post('/employee',formData)
           .then(response=>{
             console.log(response);
             alert("Employee has been added successfully")
             window.location.href="{{route('employee.index')}}"
           })
           .catch(error=>{
             console.log(error)
             alert('some error occured please try again!')
           })
    })
 })
 
</script>
@endpush