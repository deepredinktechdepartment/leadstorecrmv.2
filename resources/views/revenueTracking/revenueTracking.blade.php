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
                <h2 class="mb-4">A2AHome Land Revenue Tracking Forms</h2>
                <form action="https://leadstore.in/setting/save_revenueform/" class="form-horizontal form-label-left" name="emailgateway" id="emailgateway" method="post" accept-charset="utf-8">
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Name1<span class="text text-danger">*</span></label>
                                    <input type="text" name="action1" value="Revenue" id="action1" class="form-control" required="required" placeholder="Revenue" readonly="readonly">
                                    </div>
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Label<span class="text text-danger">*</span></label>
                                    <input type="text" name="label_1" value="" id="label_1" class="form-control" required="required" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Input Type<span class="text text-danger">*</span> </label>
                                    <select name="short_code_1" class="form-control">
                                        <option value="number" selected="selected">Number</option>
                                    </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Name2 </label>
                                    <input type="text" name="action2" value="" id="action2" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Label</label>
                                    <input type="text" name="label_2" value="" id="label_2" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Input Type </label>
                                    <select name="short_code_2" class="form-control">
                                        <option value="" selected="selected">Pick One</option>
                                        <option value="text">Text</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="submit">Submit</option>
                                        <option value="calendar">Calendar</option>
                                    </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Name3</label>
                                    <input type="text" name="action3" value="" id="action3" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Label</label>
                                    <input type="text" name="label_3" value="" id="label_3" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Input Type</label>
                                    <select name="short_code_3" class="form-control">
                                        <option value="" selected="selected">Pick One</option>
                                        <option value="text">Text</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="submit">Submit</option>
                                        <option value="calendar">Calendar</option>
                                    </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Name4</label>
                                    <input type="text" name="action4" value="" id="action4" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Label</label>
                                    <input type="text" name="label_4" value="" id="label_4" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Input Type</label>
                                    <select name="short_code_4" class="form-control">
                                        <option value="" selected="selected">Pick One</option>
                                        <option value="text">Text</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="submit">Submit</option>
                                        <option value="calendar">Calendar</option>
                                    </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Name5</label>
                                    <input type="text" name="action5" value="" id="action5" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Label</label>
                                    <input type="text" name="label_5" value="" id="label_5" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                    <label class="control-label" for="course">Input Type</label>
                                    <select name="short_code_5" class="form-control">
                                        <option value="" selected="selected">Pick One</option>
                                        <option value="text">Text</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="submit">Submit</option>
                                        <option value="calendar">Calendar</option>
                                    </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Name 6</label>
                                        <input type="text" name="action6" value="" id="action6" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Label</label>
                                        <input type="text" name="label_6" value="" id="label_6" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Input Type</label>
                                        <select name="short_code_6" class="form-control">
                                        <option value="" selected="selected">Pick One</option>
                                        <option value="text">Text</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="submit">Submit</option>
                                        <option value="calendar">Calendar</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Name 7</label>
                                        <input type="text" name="action7" value="" id="action7" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Label</label>
                                        <input type="text" name="label_7" value="" id="label_7" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Input Type</label>
                                        <select name="short_code_7" class="form-control">
                                        <option value="" selected="selected">Pick One</option>
                                        <option value="text">Text</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="submit">Submit</option>
                                        <option value="calendar">Calendar</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Name 8</label>
                                        <input type="text" name="action8" value="" id="action8" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Label</label>
                                        <input type="text" name="label_8" value="" id="label_8" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Input Type</label>
                                        <select name="short_code_8" class="form-control">
                                        <option value="" selected="selected">Pick One</option>
                                        <option value="text">Text</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="submit">Submit</option>
                                        <option value="calendar">Calendar</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Name 9</label>
                                        <input type="text" name="action9" value="" id="action9" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Label</label>
                                        <input type="text" name="label_9" value="" id="label_9" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Input Type</label>
                                        <select name="short_code_9" class="form-control">
                                        <option value="" selected="selected">Pick One</option>
                                        <option value="text">Text</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="submit">Submit</option>
                                        <option value="calendar">Calendar</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Name 10</label>
                                        <input type="text" name="action10" value="" id="action10" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Label</label>
                                        <input type="text" name="label_10" value="" id="label_10" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Input Type</label>
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
                                        <label class="control-label" for="course">Name 11</label>
                                        <input type="text" name="action11" value="Save" id="action11" class="form-control" placeholder="Label" readonly="readonly">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Label</label>
                                        <input type="text" name="label_11" value="" id="label_11" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="course">Input Type</label>
                                        <select name="short_code_11" class="form-control">
                                        <option value="submit">Submit</option>
                                        </select>

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
