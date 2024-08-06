<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container">
      <h1 class="mb-4">Dashboard</h1>
      <div class="row">
        <div class="col-sm-3">
          <div class="dashboard-card-wrapper bg-primary">
            <p class="dashboard-heading text-white">Active Projects</p>
            <p class="dashboard-count text-white">34</p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="dashboard-card-wrapper bg-success">
            <p class="dashboard-heading text-white">Performing Well</p>
            <p class="dashboard-count text-white">0</p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="dashboard-card-wrapper bg-danger">
            <p class="dashboard-heading text-white">Underperforming</p>
            <p class="dashboard-count text-white">16</p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="dashboard-card-wrapper bg-warning">
            <p class="dashboard-heading text-white">Meeting Expectations</p>
            <p class="dashboard-count text-white">2</p>
          </div>
        </div>
      </div>
    </div>
@endsection
