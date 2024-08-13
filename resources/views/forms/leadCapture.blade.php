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
                <h2 class="mb-4">A2AHome Land Custom Form Fields</h2>
                <form action="https://leadstore.in/setting/save_udfdefinations/" class="form-horizontal form-label-left" name="emailgateway" id="emailgateway" method="post" accept-charset="utf-8">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Name 1<span class="text text-danger">*</span></label>
                                        <input type="text" name="action1" value="Name" id="action1" class="form-control" readonly="readonly" placeholder="Name">
                                        </div>
                                        <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Label<span class="text text-danger">*</span></label>
                                        <input type="text" name="label_1" value="Name" id="label_1" class="form-control" placeholder="Label">
                                        </div>
                                        <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Input Type <span class="text text-danger">*</span></label>
                                        <select name="short_code_1" class="form-control">
                                            <option value="text">Text</option>
                                        </select>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Name 2 </label>
                                            <input type="text" name="action2" value="Email" id="action2" class="form-control" readonly="readonly" placeholder="Email">
                                            </div>
                                            <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Label</label>
                                            <input type="text" name="label_2" value="Email" id="label_2" class="form-control" placeholder="Label">
                                            </div>
                                            <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Input Type </label>
                                            <select name="short_code_2" class="form-control">
                                                <option value="email">Email</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Name 3</label>
                                            <input type="text" name="action3" value="Phone" id="action3" class="form-control" readonly="readonly" placeholder="Phone">
                                            </div>
                                            <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Label</label>
                                            <input type="text" name="label_3" value="Phone" id="label_3" class="form-control" placeholder="Label">
                                            </div>
                                            <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Input Type</label>
                                            <select name="short_code_3" class="form-control">
                                                <option value="text">Text</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Name 4</label>
                                            <input type="text" name="action4" value="UTM Source" id="action4" class="form-control" readonly="readonly" placeholder="UTM Source">
                                            </div>
                                            <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Label</label>
                                            <input type="text" name="label_4" value="" id="label_4" class="form-control" placeholder="Label">
                                            </div>
                                            <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Input Type</label>
                                            <select name="short_code_4" class="form-control">
                                                <option value="" selected="selected">Pick One</option>
                                                <option value="text">Text</option>
                                                <option value="dropdown">Dropdown</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Name 5</label>
                                            <input type="text" name="action5" value="UTM Medium" id="action5" readonly="readonly" class="form-control" placeholder="UTM Medium">
                                            </div>
                                            <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Label</label>
                                            <input type="text" name="label_5" value="" id="label_5" class="form-control" placeholder="Label">
                                            </div>
                                            <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Input Type</label>
                                            <select name="short_code_5" class="form-control">
                                                <option value="" selected="selected">Pick One</option>
                                                <option value="text">Text</option>
                                                <option value="dropdown">Dropdown</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Name 6</label>
                                            <input type="text" name="action6" value="UTM Campaign" id="action6" class="form-control" placeholder="UTM Campaign" readonly="readonly">
                                            </div>
                                            <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Label</label>
                                            <input type="text" name="label_6" value="" id="label_6" class="form-control" placeholder="Label">
                                            </div>
                                            <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Input Type</label>
                                            <select name="short_code_6" class="form-control">
                                                <option value="" selected="selected">Pick One</option>
                                                <option value="text">Text</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Name 7</label>
                                            <input type="text" name="action7" value="UTM Term" id="action7" class="form-control" readonly="readonly" placeholder="UTM Term">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Label</label>
                                            <input type="text" name="label_7" value="" id="label_7" class="form-control" placeholder="Label">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label text-black" for="course">Input Type</label>
                                            <select name="short_code_7" class="form-control">
                                            <option value="" selected="selected">Pick One</option>
                                            <option value="text">Text</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Name 8</label>
                                        <input type="text" name="action8" value="UTM Content" id="action8" class="form-control" placeholder="UTM Content" readonly="readonly">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Label</label>
                                        <input type="text" name="label_8" value="" id="label_8" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Input Type</label>
                                        <select name="short_code_8" class="form-control">
                                        <option value="" selected="selected">Pick One</option>
                                        <option value="text">Text</option>
                                        </select>

                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Name 9</label>
                                        <input type="text" name="action9" value="" id="action9" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Label</label>
                                        <input type="text" name="label_9" value="" id="label_9" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Input Type</label>
                                        <select name="short_code_9" class="form-control">
                                        <option value="" selected="selected">Pick One</option>
                                        <option value="text">Text</option>
                                        <option value="email">Email</option>
                                        <option value="dropdown">Dropdown</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="submit">Submit</option>
                                        </select>

                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Name 10</label>
                                        <input type="text" name="action10" value="" id="action10" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Label</label>
                                        <input type="text" name="label_10" value="" id="label_10" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Input Type</label>
                                        <select name="short_code_10" class="form-control">
                                        <option value="" selected="selected">Pick One</option>
                                        <option value="text">Text</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="submit">Submit</option>
                                        <option value="calendar">calendar</option>
                                        </select>

                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Name 11</label>
                                        <input type="text" name="action11" value="Save and Next" id="action11" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Label</label>
                                        <input type="text" name="label_11" value="" id="label_11" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-black" for="course">Input Type</label>
                                        <select name="short_code_11" class="form-control">
                                        <option value="submit">Submit</option>
                                        </select>

                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button id="send" type="submit" class="btn btn-md btn-danger">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>  
</div>

@endsection
