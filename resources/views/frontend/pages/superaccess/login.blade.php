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
                                    
                                    <div class="form-group full-blk">
                                        <input type="submit" class="form-submit submitbtn" value="Submit" >
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
