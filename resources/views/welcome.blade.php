@extends('layouts.app')

@section('title', 'Registration form')


@section('content')
    <div class="container" style="min-height: 200vh;margin-top: 100px;">
    <div class="row" style="">
        <div class="col-md-10">
            <h2 >Registration Form</h2>
        </div>
        <div class="col-md-2">
            <a class="btn btn-info" href="{{url('login')}}">Admin Login</a>
        </div>
    </div>
    
    <form id="contact_us" method="post" action="javascript:void(0)" >
        <div class="alert alert-success d-none" id="msg_div">
              <span id="res_message"></span>
         </div>
      
      <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Please enter name" value="{{old('name')}}">
                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
            <div class="col-md-6">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email" placeholder="Please enter email" value="{{old('email')}}">
                <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
        </div>
      </div>
        <h3>Mailing Address</h3>
        <div class="row">
            <div class="col-md-3">
                <label for="division_id">Division</label>
                <select class="form-control" name="division_id" id="division_id" attr_url="{{url('combo-info')}}">
                    <option value="">Select Division</option>
                    @forelse($divisions as $division)
                        <option value="{{ $division->id }}">{!! $division->name ?? '' !!}</option>
                    @empty
                    @endforelse
                </select>
                <span class="text-danger">{{ $errors->first('division_id') }}</span>
            </div>
            <div class="col-md-3">
                <label for="district_id">District</label>
                <div class="district_section">
                    <select class="form-control" name="district_id" id="district_id" attr_url="{{url('combo-info')}}">
                        <option value="">Select District</option>
                        
                    </select>
                </div>
                <span class="text-danger">{{ $errors->first('district_id') }}</span>
            </div>
            <div class="col-md-3">
                    <label for="upazila_id">Upazila</label>
                    <div class="upazila_section">
                        <select class="form-control" name="upazila_id" id="upazila_id">
                            <option value="">Select Upazila</option>
                            
                        </select>
                    </div>
                    <span class="text-danger">{{ $errors->first('upazila_id') }}</span>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="address_details">Address Details</label>
                    <textarea class="form-control" name="address_details" id="address_details">{{old('address_details')}}</textarea>
                    <span class="text-danger">{{ $errors->first('address_details') }}</span>
                </div>
                
            </div>
      </div>
      <div class="form-group">
            <label for="address_details">Language Proficiency</label>
            @forelse($languages as $language)
                <input type="checkbox" name="language_proficiency[]" value="{!! $language->name ?? '' !!}" class="radio_button" > {!! $language->name ?? '' !!}
            @empty
            @endforelse
            <span class="text-danger">{{ $errors->first('language_proficiency') }}</span>
      </div>
      <div class="form-group">
          <h3> Education Qualification</h3>
          <table class="table">
              <thead>
                  <th>Exam Name</th>
                  <th>University</th>
                  <th>Board</th>
                  <th>Result</th>
                  <th>Action</th>
              </thead>
              <tbody class="educationDetails">
                  <tr>
                      <td>
                          <select class="form-control" name="exam_id[]">
                              <option value="">Select Exam Name</option>
                              @forelse($exams as $exam)
                                <option value="{{$exam->id}}">{!! $exam->name ?? '' !!}</option>
                              @empty
                              @endforelse
                          </select>
                      </td>
                      <td>
                          <select class="form-control" name="university_id[]">
                              <option value="">Select University</option>
                              @forelse($universites as $universite)
                                <option value="{{$universite->id}}">{!! $universite->name ?? '' !!}</option>
                              @empty
                              @endforelse
                          </select>
                      </td>
                      <td>
                          <select class="form-control" name="board_id[]">
                              <option value="">Select Board Name</option>
                              @forelse($boards as $board)
                                <option value="{{$board->id}}">{!! $board->name ?? '' !!}</option>
                              @empty
                              @endforelse
                          </select>
                      </td>
                      <td>
                          <input type="text" name="result[]" class="form-control">
                      </td>
                      <td>
                          <button type="button" class="btn btn-sm btn-info add_more_button">Add More</button>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>

      <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="photo">Photo (Only Allow Image jpg,jpeg,png)</label>
                <input type="file" class="form-control" name="photo" id="photo"></input>
                <span class="text-danger">{{ $errors->first('photo') }}</span>
            </div>
            <div class="col-md-6">
                <label for="cv_attachment">CV Attachment (Only Allow DOC/PDF)</label>
                <input type="file" class="form-control" name="cv_attachment" id="cv_attachment"></input>
                <span class="text-danger">{{ $errors->first('cv_attachment') }}</span> 
            </div>
        </div> 
      </div>


      <div class="form-group">
            <label for="is_training">Training</label>
            @php
            $yesNo = ['yes','no'];
            @endphp
            @forelse($yesNo as $yes)
                <input type="radio" name="is_training" value="{!! $yes ?? '' !!}" class="radio_button is_training" > {!! $yes ?? '' !!}
            @empty
            @endforelse
            <span class="text-danger">{{ $errors->first('is_training') }}</span> 
      </div>

      <div class="form-group trainingDetailsArea">
             <table class="table">
              <thead>
                  <th>Training Name</th>
                  <th>Training Details</th>
                  <th>Action</th>
              </thead>
              <tbody class="trainingDetails">
                  <tr>
                      <td>
                          <input type="text" name="traing_name[]" class="form-control" placeholder="Training Name">
                      </td>
                      <td>
                        <textarea name="traing_details[]" class="form-control" placeholder="Training Details"></textarea>
                      </td>
                      
                      <td>
                          <button type="button" class="btn btn-sm btn-info training_add_more_button">Add More</button>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
           
     
      <div class="form-group">
       <button type="submit" id="send_form" class="btn btn-success">Submit</button>
      </div>
    </form>
 
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script>
   if ($("#contact_us").length > 0) {
    $("#contact_us").validate({
     
    rules: {
      name: {
        required: true,
        maxlength: 50
      },
      division_id: {
        required: true
      },
      district_id: {
        required: true
      },
      upazila_id: {
        required: true
      },
      address_details: {
        required: true
      },
      photo: {
        required: true,
        extension: "jpg,jpeg,png",
      },
      cv_attachment: {
        required: true,
         extension: "doc,pdf,docx", 
      },
      is_training: {
        required: true
      },
      phone: {
            required: true,
            digits:true,
            minlength: 10,
            maxlength:12,
        },
        email: {
                required: true,
                maxlength: 50,
                email: true,
            },    
    },
    messages: {
       
      name: {
        required: "Please enter name",
        maxlength: "Name should be 50 characters long."
      },
      division_id: {
        required: "Please Select Division"
      },
      district_id: {
        required: "Please Select District"
      },
      upazila_id: {
        required: "Please Select District"
      },
      address_details: {
        required: "Please Enter Address Details"
      },
      photo: {
        required: "Please Select photo",
        extension: "Photo Must be jpg,jpeg", 
        filesize: "File size not more then 1 MB" 
      },
      cv_attachment: {
        required: "Please Select CV Attachment",
        extension:"File extension must be doc or pdf"
      },
      is_training: {
        required: "Please Select Training"
      },
      
      phone: {
        required: "Please enter contact number",
        minlength: "The contact number should be 10 digits",
        digits: "Please enter only numbers",
        maxlength: "The contact number should be 12 digits",
      },
      email: {
          required: "Please enter valid email",
          email: "Please enter valid email",
          maxlength: "The email name should less than or equal to 50 characters",
        },
        
    },
    submitHandler: function(form) {
        console.log(form)
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('#send_form').html('Sending..');
      
        var form = $("#contact_us").closest("form");
        var formData = new FormData(form[0]);
      $.ajax({
        url: "{{ url('registration-save')}}" ,
        type: "POST",
        data: formData,
         processData: false,
        contentType: false,
        success: function( response ) {
            $('#send_form').html('Submit');
            $('#res_message').show();
            $('#res_message').html(response);
            $('#msg_div').removeClass('d-none');

            document.getElementById("contact_us").reset(); 
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },10000);
        }
      });
    }
  })
}

$(document).on('change','.is_training',function(){
    var is_training = $(this).val();
    console.log(is_training)
    if( is_training == 'yes' ){
        $(document).find('.trainingDetailsArea').show();
    }else{
        $(document).find('.trainingDetailsArea').hide();
    }

})


$(document).on('click','.training_add_more_button',function(){
    $(this).removeClass("btn-info").removeClass('training_add_more_button').addClass('training_remove_button').addClass('btn-danger').html('Remove');
    var new_row = `<tr>
                      <td>
                          <input type="text" name="traing_name[]" class="form-control" placeholder="Training Name">
                      </td>
                      <td>
                        <textarea name="traing_details[]" class="form-control" placeholder="Training Details"></textarea>
                      </td>
                      
                      <td>
                          <button type="button" class="btn btn-sm btn-info training_add_more_button">Add More</button>
                      </td>
                  </tr>`;
    $(document).find('.trainingDetails').prepend(new_row);

})

$(document).on('click','.training_remove_button',function(){
    $(this).parent().parent().remove();
});

$(document).on('click','.add_more_button',function(){
    $(this).removeClass("btn-info").removeClass('add_more_button').addClass('remove_button').addClass('btn-danger').html('Remove');
    var new_row =  `<tr>
                      <td>
                          <select class="form-control" name="exam_id[]">
                              <option value="">Select Exam Name</option>
                              @forelse($exams as $exam)
                                <option value="{{$exam->id}}">{!! $exam->name ?? '' !!}</option>
                              @empty
                              @endforelse
                          </select>
                      </td>
                      <td>
                          <select class="form-control" name="university_id[]">
                              <option value="">Select University</option>
                              @forelse($universites as $universite)
                                <option value="{{$universite->id}}">{!! $universite->name ?? '' !!}</option>
                              @empty
                              @endforelse
                          </select>
                      </td>
                      <td>
                          <select class="form-control" name="board_id[]">
                              <option value="">Select Board Name</option>
                              @forelse($boards as $board)
                                <option value="{{$board->id}}">{!! $board->name ?? '' !!}</option>
                              @empty
                              @endforelse
                          </select>
                      </td>
                      <td>
                          <input type="text" name="result[]" class="form-control">
                      </td>
                      <td>
                          <button type="button" class="btn btn-sm btn-info add_more_button">Add More</button>
                      </td>
                  </tr> `;
    $(document).find('.educationDetails').prepend(new_row);
});


$(document).on('click','.remove_button',function(){
    $(this).parent().parent().remove();
});












</script>

@endsection
 

