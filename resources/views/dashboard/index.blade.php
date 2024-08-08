<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')


@php

use App\Models\Client;
// Count active clients
$activeClientCount = Client::where('active', true)->count();
@endphp
      <div class="row mb-5">

        <div class="col-sm-3">
            <a href="{{ URL::to('clients?active=true') }}">
            <div class="card bg-primary">
            <p class="dashboard-heading text-white">Active Projects</p>
            <p class="dashboard-count text-white">{{ $activeClientCount??0 }}</p>
            </div>
            </a>
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

      <div class="row mb-5">
        <div class="col-lg-12">
            <!-- Tabs Start-->
              <div class="common_tabs">
                <nav class="mb-5">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab" aria-controls="active" aria-selected="true">
                        Active
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive" type="button" role="tab" aria-controls="inactive" aria-selected="false">
                        Inactive
                      </button>
                    </li>
                  </ul>
                </nav>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                    <div class="mb-4">
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="card">
                            <div class="row">
                              <div class="col-lg-3">
                                <img src="assets/images/rmc_60.png" alt="company logo" class="img-fluid mb-3" width="70px" />
                              </div>
                              <div class="col-lg-8">
                                <div>
                                  <h6 class="mb-2">Aparna RMC</h6>
                                  <p class="mb-1">250/1000</p>
                                  <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">250%</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="card">
                            <div class="row">
                              <div class="col-lg-3">
                                <img src="assets/images/rmc_60.png" alt="company logo" class="img-fluid mb-3" width="70px" />
                              </div>
                              <div class="col-lg-8">
                                <div>
                                  <h6 class="mb-2">Aparna RMC</h6>
                                  <p class="mb-1">250/1000</p>
                                  <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">250%</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                    <div class="card">
                      <h4>Inactive</h4>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Tabs End-->
        </div>
      </div>


      <div class="row pb-5">
        <div class="col-lg-12">
          <h1 class="mb-4">Recently Active</h1>
            <div class="row recently_active_users">
              <div class="col-lg-6">
                <div class="card">
                  <h4 class="mb-4">From the Agency</h4>
                  <div class="row">
                    <div class="col-lg-3">
                      <div>
                        <img src="assets/images/suneel.png" alt="suneel garnepudi" class="mb-2 d-block mx-auto">
                        <h6 class="text-center">Suneel Garnepudi</h6>
                        <p class="italic text-center">21 Minutes Ago</p>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div>
                        <img src="assets/images/suneel.png" alt="suneel garnepudi" class="mb-2 d-block mx-auto">
                        <h6 class="text-center">Suneel Garnepudi</h6>
                        <p class="italic text-center">21 Minutes Ago</p>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div>
                        <img src="assets/images/suneel.png" alt="suneel garnepudi" class="mb-2 d-block mx-auto">
                        <h6 class="text-center">Suneel Garnepudi</h6>
                        <p class="italic text-center">21 Minutes Ago</p>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div>
                        <img src="assets/images/suneel.png" alt="suneel garnepudi" class="mb-2 d-block mx-auto">
                        <h6 class="text-center">Suneel Garnepudi</h6>
                        <p class="italic text-center">21 Minutes Ago</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card">
                  <h4 class="mb-4">From the Client</h4>
                  <div class="row">
                    <div class="col-lg-3">
                      <div>
                        <img src="assets/images/suneel.png" alt="suneel garnepudi" class="mb-2 d-block mx-auto">
                        <h6 class="text-center">Suneel Garnepudi</h6>
                        <p class="italic text-center">21 Minutes Ago</p>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div>
                        <img src="assets/images/suneel.png" alt="suneel garnepudi" class="mb-2 d-block mx-auto">
                        <h6 class="text-center">Suneel Garnepudi</h6>
                        <p class="italic text-center">21 Minutes Ago</p>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div>
                        <img src="assets/images/suneel.png" alt="suneel garnepudi" class="mb-2 d-block mx-auto">
                        <h6 class="text-center">Suneel Garnepudi</h6>
                        <p class="italic text-center">21 Minutes Ago</p>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div>
                        <img src="assets/images/suneel.png" alt="suneel garnepudi" class="mb-2 d-block mx-auto">
                        <h6 class="text-center">Suneel Garnepudi</h6>
                        <p class="italic text-center">21 Minutes Ago</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        </div>
      </div>


@endsection
