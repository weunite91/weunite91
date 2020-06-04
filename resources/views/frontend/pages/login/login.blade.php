@extends('frontend.layout.layout')
@section('content')
<div id="Content-Container">
    <div id="Content-Main">
        <div class="table-div">
            <div id="Content" class="table-cell">
                <article class="textMain ">


                    <div class="login-form">
                        <div class="table-div">						
                            <div class="table-cell form-l">
                                <h2>Sign In</h2>
                                <div id="errorSection" style="width:100% !important;">

                                @if (session('session_error'))
                                <div class="alert error alert-danger">
                                    {{ session('session_error') }}
                                    
                                </div>
                                @endif

                                @if (session('session_success'))
                                <div class="alert alert-success">
                                    {{ session('session_success') }}
                                    
                                </div>
                                @endif

                                @if (session('session_alert'))
                                <div class="alert alert-warning">
                                    {{ session('session_alert') }}
                                    
                                </div>
                                @endif
                            </div>
                                
                                <form action="" id="userlogin" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        
                                        <input class="form-control" type="email" name="email" id="email" placeholder="Email ID">
                                    </div>
                                    <div class="form-group">
                                        
                                        <input class="form-control" type="password" name="password" id="password" placeholder="Your Password">
                                    </div>
                                    <div class="form-group forgot-password">
                                        <p><a href="{{ route('forgot-password') }}">Forgot Password</a>
                                    </div>
                                    <div class="form-group full-blk">
                                        <input type="submit" class="form-submit submitbtn" value="Submit" >
                                    </div>
                                </form>


                            </div>
                            <div class="table-cell form-r">


                                <h2>Register</h2>
                                <form method="post" id="register" action="{{route('add-user')}}">
                                   @csrf
                                    
                                    <div class="form-group">
                                       
                                        <input class="form-control" type="text" name="firstname" placeholder="First Name" >
                                    </div>
                                    <div class="form-group">
                                        
                                        <input type="text" class="form-control" name="lastname" placeholder="Last Name" >
                                    </div>
                                    <div class="form-group">
                                        
                                        <input type="email" class="form-control" name="email" placeholder="Email ID" >
                                    </div>
                                   
                                   
                                   <div class="form-group" >
                                        
                                        <select  class="select form-control" name="published" style="padding-top:5px !important" >
                                            <option value="">Select User Type</option>
                                            <option value="FR">Fund Raiser</option>
                                            <option value="I">Investor</option>
                                            <option value="F">Franchise</option>
                                            {{-- <option value="P">Partners</option> --}}
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        
                                        <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Password" >
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control"  name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" >
                                    </div>


                                     <div class="form-group full-blk">
                                         <input type="submit" style="background:  #f9dc06" class="submitbtnregister form-submit" value="Submit" >
                                    </div>

                                </form>


                            </div>

                        </div>
                    </div>




                </article>
            </div>
        </div>
    </div>
</div>
@endsection
