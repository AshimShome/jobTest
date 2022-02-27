@extends('master')


@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">Sl</th>
        <th scope="col">Name</th>
        <th scope="col">Image</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
      <tr>
        <td scope="row">{{$employee->id}}</td>
        <td>{{$employee->name}}</td>
        <td><img width="50" height="50" src="{{asset('images/'.$employee->image)}}"/></td>
        <td>{{$employee->email}}</td>
        <td>{{$employee->phone}}</td>
        <td>
            <a href="{{route('employee.edit',$employee->id)}}" id="edit"  class="btn btn-warning">Edit</a>
            <a data-id="{{$employee->id}}"  
                href="{{route('employee.destroy',$employee->id)}}" 
                class="btn btn-danger delete_id">Delete</a>
        </td>
      </tr>
      @endforeach
     
    </tbody>
  </table>
@endsection

@push('js')
<script type="text/javascript">
 $(document).ready(function(){
    
    let delete_ids = document.querySelectorAll('.delete_id');
    console.log(delete_ids);
    delete_ids.forEach(delete_button=>{
        delete_button.addEventListener('click',function(event){
            event.preventDefault();
            // alert("this is running")
            const delete_id = event.target.dataset.id;
            axios.delete(`/employee/${delete_id}`)
                 .then(response=>{
                     alert("employee has been deleted successfully");
                     window.location.href="{{route('employee.index')}}"
                 })
                 .catch(error=>{
                     alert('some error occured Please Try Again!!');
                 })

        })
    })
      
 });
 
</script>
@endpush