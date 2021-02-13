<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
  <style>
   .error{ color:red; } 
   .radio_button {
        width: 20px;
        height: 20px;
        margin-left: 30px;
    }

    .trainingDetailsArea{
        display: none;
    }
  </style>
  
</head>
 
<body>
    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="/dashboard">Navbar</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{{url('dashboard')}}">Applicant List</a>
              </li>
              <li class="nav-link" >
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
              </li>
              
            </ul>
            
          </div>
        </nav>
    </div>
       <div class="container">
        <form action="" method="GET" style="margin:20px;">
        <div class="row">
            <div class="col-md-2">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $request['name'] ?? ''}}" id="name" class="form-control" placeholder="Applicant's Name">
            </div>
            <div class="col-md-2">
                 <label for="email">Email Address</label>
                 <input type="text" name="email" value="{{ $request['email'] ?? ''}}" id="email" class="form-control" placeholder="Email Address">
            </div>
            <div class="col-md-2">
                <label for="division_id">Division</label>
                <select class="form-control" name="division_id" id="division_id" attr_url="{{url('combo-info')}}">
                    <option value="">Select Division</option>
                    @forelse($divisions as $division)
                        <option  value="{{ $division->id }}" @if(!empty($request['division_id'])) @if($request['division_id'] == $division->id) selected @endif  @endif>{!! $division->name ?? '' !!}</option>
                    @empty
                    @endforelse
                </select>
            </div>
            <div class="col-md-2">
                <label for="district_id">District</label>
                <div class="district_section">
                    <select class="form-control" name="district_id" id="district_id" attr_url="{{url('combo-info')}}">
                        <option value="">Select District</option>
                        @forelse($districts as $district)
                        <option  value="{{ $district->id }}" @if(!empty($request['district_id'])) @if($request['district_id'] == $district->id) selected @endif  @endif>{!! $district->name ?? '' !!}</option>
                        @empty
                        @endforelse
                        

                        
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <label for="upazila_id">Upazila</label>
                    <div class="upazila_section">
                        <select class="form-control" name="upazila_id" id="upazila_id">
                            <option value="">Select Upazila</option>
                            @forelse($upazilas as $upazila)
                        <option  value="{{ $upazila->id }}" @if(!empty($request['upazila_id'])) @if($request['upazila_id'] == $upazila->id) selected @endif  @endif>{!! $upazila->name ?? '' !!}</option>
                        @empty
                        @endforelse
                            
                        </select>
                    </div>
            </div>
            <div class="col-md-2">
                <label for="search">Action</label><br>
                 <button type="submit" id="search"  class="btn btn-success">Search</button>
            </div>
                
           
        </div>
        </form>
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">Applicant's Name</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Division</th>
                    <th scope="col">District </th>
                    <th scope="col">Upazila / Thana </th>
                    <th scope="col">Insert Date </th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($info as $key=>$data)
                <tr>
                    <th scope="row">{{ ($key+1) }}</th>
                    <td>{{ $data->name ?? '' }}</td>
                    <td>{{ $data->email ?? '' }}</td>
                    <td>{{ $data->division->name ?? '' }}</td>
                    <td>{{ $data->district->name ?? '' }}</td>
                    <td>{{ $data->upazila->name ?? '' }}</td>
                    <td>{{ $data->created_at ?? '' }}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-info" >Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-felx justify-content-center">
                {{ $info->links('pagination::bootstrap-4') }}
        </div>
        
           
        
    </div>    
        


   
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
