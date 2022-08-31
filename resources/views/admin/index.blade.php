@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
Dashboard

@stop

@section('content')

          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <x-adminlte-info-box title="{{ $userCount }}" text="User Registrations" icon="fas fa-lg fa-user-plus text-primary"
              theme="gradient-primary" icon-theme="white"/>
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">

              <x-adminlte-info-box title="Tasks" text="75/100" icon="fas fa-lg fa-tasks text-orange" theme="warning"
              icon-theme="dark" progress=75 progress-theme="dark"
              description="75% of the tasks have been completed"/>
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <x-adminlte-info-box title="Reputation" text="0/1000" icon="fas fa-lg fa-medal text-dark"
              theme="danger" id="ibUpdatable" progress=0 progress-theme="teal"
              description="0% reputation completed to reach next level"/>
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <x-adminlte-info-box title="Views" text="424" icon="fas fa-lg fa-eye text-dark" theme="gradient-teal"/>
            </div><!-- /.col -->

          </div><!-- /.row -->


{{-- <h1>Hello! . You are login as Admin</h1> --}}

@stop

@section('css')
    
@stop

@section('js')
    
@stop