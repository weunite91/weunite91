@extends('backend.layout.layout')
@section('content')
@php
    if($userdetalis[0]->roles == "I"){
        $usertype = 'Investor';
    }

    if($userdetalis[0]->roles == "FR"){
        $usertype = 'Fund Raiser';
    }

    if($userdetalis[0]->roles == "F"){
        $usertype = 'Franchise';
    }

    if($userdetalis[0]->roles == "P"){
        $usertype = 'Partners';
    }

@endphp
<style>
.slimScrollDiv{
    position: relative;
    overflow: hidden;
    width: 100% important;
}
</style>
 <!-- start page content -->
 <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Admin's Note</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Admin's Note</li>
                            </ol>
                        </div>
                    </div>
                     <div class="row">
                     <div class="col-sm-12">
                       <div class="card card-box">
                              <div class="card-head">
                                  <header>{{ $userdetalis[0]->firstname }} {{ $userdetalis[0]->lastname }}</header>
                                  <div class="tools">
                                    Profile Code : {{ $userdetalis[0]->profile_code }}
                                 </div>
                              </div>
                              <div class="card-body no-padding height-9">
                              	<div class="row">
                                        <ul class="chat nice-chat chat-page small-slimscroll-style" style="width:100%">
                                            @foreach($notelist as $key => $value)

                                            <li class="out">
                                                <div class="message">
                                                    <span class="arrow">
                                                        </span>

                                                            <a class="name" href="#">{{ $value->firstname }} {{ $value->lastname }} ( {{ $value->roles }} )</a>
                                                            <span class="datetime">at {{ date("M, d Y h:i:s",strtotime($value->created_at)) }}

                                                            <a href="#" data-toggle="modal" data-target="#deleteModel" data-id="{{ $value->noteId }}" class="deleteuser">
                                                                <i class="fa fa-trash-o"></i>
                                                            </a>
                                                        </span>
                                                    <span class="body"> {{ $value->note }}  </span>
                                                </div>
                                            </li>
                                            @endforeach


                                        </ul>
                                        <div class="box-footer chat-box-submit">
						                <form  method="post" id="comments">
						                  <div class="input-group">@csrf
						                    <input type="text" name="message" placeholder="Enter Chat" class="form-control">
						                    <span class="input-group-btn">
                                            <button type="submit" class="mdl-button btn  btn-warning" style="margin-left : 5px"> Add
                                                    <i class="fa fa-paper-plane-o"></i>
                                                </button>
						                    </span>
                                        </form>
                                   </div>
                                </div>
							</div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page content -->
@endsection
