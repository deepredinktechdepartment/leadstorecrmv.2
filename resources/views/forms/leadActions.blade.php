@extends('layouts.app')
@section('content')
<h1 class="mb-4">Settings for {{ $client->client_name }}</h1>
<div class="lead_adds_sec">
    <div class="row">
        <div class="col-lg-3">
             <x-project-side-menu :client="$client" />
        </div>
        <div class="col-lg-9">
            <div class="lead_adds_main_wrapper py-5 px-4">
                <h2 class="mb-4">A2AHome Land Lead Actions</h2>
                <form action="https://leadstore.in/setting/save_leaddropdownactions/" class="form-horizontal form-label-left" name="emailgateway" id="emailgateway" method="post" accept-charset="utf-8">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label text-black" for="course">Action 1 <span class="text text-danger">*</span></label>
                                        <input type="text" name="action1" value="" id="action1" class="form-control" required="required" placeholder="Action Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Short Code <span class="text text-danger">*</span></label>
                                        <input type="text" name="short_code_1" value="" id="short_code_1" class="form-control" required="required" placeholder="Short Code">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label text-black" for="course">Action 2 <span class="text text-danger">*</span></label>
                                        <input type="text" name="action2" value="" id="action2" class="form-control" placeholder="Action Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Short Code <span class="text text-danger">*</span></label>
                                        <input type="text" name="short_code_2" value="" id="short_code_2" class="form-control" placeholder="Short Code">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label text-black" for="course">Action 3</label>
                                        <input type="text" name="action3" value="" id="action3" class="form-control" placeholder="Action Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Short Code</label>
                                        <input type="text" name="short_code_3" value="" id="short_code_3" class="form-control" placeholder="Short Code">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label text-black" for="course">Action 4</label>
                                        <input type="text" name="action4" value="" id="action4" class="form-control" placeholder="Action Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Short Code</label>
                                        <input type="text" name="short_code_4" value="" id="short_code_4" class="form-control" placeholder="Short Code">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label text-black" for="course">Action 5</label>
                                        <input type="text" name="action5" value="" id="action5" class="form-control" placeholder="Action Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Short Code</label>
                                        <input type="text" name="short_code_5" value="" id="short_code_5" class="form-control" placeholder="Short Code">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label text-black" for="course">Action 6</label>
                                        <input type="text" name="action6" value="" id="action6" class="form-control" placeholder="Action Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Short Code</label>
                                        <input type="text" name="short_code_6" value="" id="short_code_6" class="form-control" placeholder="Short Code">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label text-black" for="course">Action 7</label>
                                        <input type="text" name="action7" value="" id="action7" class="form-control" placeholder="Action Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Short Code</label>
                                        <input type="text" name="short_code_7" value="" id="short_code_7" class="form-control" placeholder="Short Code">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label text-black" for="course">Action 8</label>
                                        <input type="text" name="action8" value="" id="action8" class="form-control" placeholder="Action Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Short Code</label>
                                        <input type="text" name="short_code_8" value="" id="short_code_8" class="form-control" placeholder="Short Code">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label text-black" for="course">Action 9</label>
                                        <input type="text" name="action9" value="" id="action9" class="form-control" placeholder="Action Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Short Code</label>
                                        <input type="text" name="short_code_9" value="" id="short_code_9" class="form-control" placeholder="Short Code">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label text-black" for="course">Action 10</label>
                                        <input type="text" name="action10" value="" id="action10" class="form-control" placeholder="Action Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Short Code</label>
                                        <input type="text" name="short_code_10" value="" id="short_code_10" class="form-control" placeholder="Short Code">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button id="send" type="submit" class="btn btn-danger">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
