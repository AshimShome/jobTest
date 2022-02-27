@extends('master')


@section('content')
<form action="{{route('employee.store')}}" id="submit_employee" method="POST" enctype="multipart/form-datas">
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="hidden" name="id" id="id" value="{{$employee->id}}">
      <input type="text" class="form-control" value="{{$employee->name}}"  name="name" id="name" >
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" value="{{$employee->email}}" name="email" id="email" >
    </div>
    <div class="mb-3">
      <label for="phone_number" class="form-label">Phone Number</label>
      <input type="text" class="form-control" value="{{$employee->phone}}" name="phone" id="phone_number" >
    </div>
    <div class="mb-3">
        <img width="50" height="50" src="{{asset('images/'.$employee->image)}}" alt="">
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
      const id = $("#id").val();
      axios.post(`/employee/update/${id}`,formData)
           .then(response=>{
             console.log(response);
             window.location.href="{{route('employee.index')}}"
             alert("Employee has been added successfully");
           })
           .catch(error=>{
             console.log(error)
             alert('some error occured please try again!')
           })
    })
 })
 
</script>
@endpush