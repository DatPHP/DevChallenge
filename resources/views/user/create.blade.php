

<div class="pull-right">
      <a class="btn btn-primary" href="{{ route('user.list') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
</div>

   <h2> Information Account Login </h2>

   {!! Form::open(array('url' => 'user/create', 'class' => 'form-horizontal')) !!}
   {{ csrf_field() }}

       @if (isset($id))
       {!! Form::hidden('id', $id) !!}
       @endif
       {!! Form::hidden('level', 1) !!}

      <div class="form-group">
         {!! Form::label('name', 'Họ và tên', array('class' => 'col-sm-2 control-label')) !!}
         <div class="col-sm-10">
             {!! Form::text('name', $user->name ?? '', array('class' => 'form-control', 'placeholder' => 'Nhap Ho Va Ten')) !!}                      
         </div>

      </div>

      <div class="form-group">
         {!! Form::label('email', 'Địa chỉ email', array('class' => 'col-sm-2 control-label')) !!}
         <div class="col-sm-10">
            {!! Form::email('email', $user->email?? '', array('class' => 'form-control', 'placeholder' => 'Địa chỉ email thật để nhận phản hồi')) !!}
         </div>
      </div>

     
      <div class="form-group">
            {!! Form::label('password', 'NHap Password', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {{ Form::input('password', 'password', $user->password?? '',array('class' => 'form-control','placeholder' => 'Nhap password')) }}
            </div>
      </div>

      @if (isset($id))
      <h2> Information of personal </h2>
         <div class="row justify-content-between">
            <div class="col-6">
            <div class="form-group">
                        {!! Form::label('phone', 'Please input phone', array('class' => 'col-sm-4 control-label')) !!}
                        <div class="col-sm-10">
                           {!! Form::text('phone', $user->phone?? '' , array('class' => 'form-control', 'placeholder' => 'Nhap phone')) !!}                      
                        </div>
                     </div>

                     

            </div>
            <div class="col-6">
                   
                  <div class="form-group">
                     {!! Form::label('address', 'Please input address', array('class' => 'col-sm-4 control-label')) !!}
                     <div class="col-sm-10">
                        {!! Form::text('address', $user->address?? '' , array('class' => 'form-control', 'placeholder' => 'Nhap address')) !!}                      
                     </div>
                  </div>

            </div>
         </div>


      @endif

      <div class="form-group">
         {!! Form::label('active', 'Active', array('class' => 'col-sm-3 control-label')) !!}
         <div class="col-sm-3">

         @if (isset($user) && $user->status == 1)
            {!! Form::checkbox('active', 1, true) !!}
         @else
            {!! Form::checkbox('active', 0 , false) !!}
         @endif

         </div>
      </div>   

      

      
      <div class="form-group">
         <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit('Gửi tin nhắn', array('class' => 'btn btn-success')) !!}
         </div>
      </div>

   {!! Form::close() !!}

