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
                <h2 class="mb-3">A2AHome Land Lead Summary Notifications</h2>
                <p class="mb-4">Send lead notification emails and first response emails through your mail server. Enter the details below to setup your own mail server.</p>
                <!-- 1 -->
                <div class="mb-4">   
                    <div class="mb-2">
                        <p for="#" class="fw-bold">Need a daily report?</p>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="daily" id="dailyYes" onclick="toggleDailyForm(true)">
                        <label class="form-check-label" for="dailyYes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="daily" id="dailyNo" onclick="toggleDailyForm(false)" checked>
                        <label class="form-check-label" for="dailyNo">
                            No
                        </label>
                    </div>
                </div>
                <form>
                    <div class="row" id="notificationDailyForm" style="display: none;">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="control-label" for="course">Daily Specific Address <br><strong>Example:</strong></label>
                                <br><small>yourname:yourname@company.com , anothername:anothername@company.com</small>
                                <input type="text" name="daily_specific_address" value="" id="daily_specific_address" class="form-control" placeholder="Daily Lead Summary Notifications">
                            </div>
                        </div>
                    </div>
                </form>
                <!-- 1 -->
                <!-- 2 -->
                <div class="mb-4">   
                    <div class="mb-2">
                        <p for="#" class="fw-bold">Need a weekly report?</p>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="weekly" id="weeklyYes" onclick="toggleWeeklyForm(true)">
                        <label class="form-check-label" for="weeklyYes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="weekly" id="weeklyNo" onclick="toggleWeeklyForm(false)" checked>
                        <label class="form-check-label" for="weeklyNo">
                            No
                        </label>
                    </div>
                </div>
                <form>
                    <div class="row" id="notificationWeeklyForm" style="display: none;">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="control-label " for="course">Weekly Specific Address</label>
                                <br><strong>Example:</strong><br><small>yourname:yourname@company.com , anothername:anothername@company.com</small>
                                <input type="text" name="weekly_specific_address" value="" id="weekly_specific_address" class="form-control" placeholder="Weekly Lead Summary Notifications">
                            </div>
                        </div>
                    </div>
                </form>
                <!-- 2 -->
                <!-- 3 -->
                <div class="mb-4">   
                    <div class="mb-2">
                        <p for="#" class="fw-bold">Need a monthly report?</p>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="monthly" id="monthlyYes" onclick="toggleMonthlyForm(true)">
                        <label class="form-check-label" for="monthlyYes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="monthly" id="monthlyNo" onclick="toggleMonthlyForm(false)" checked>
                        <label class="form-check-label" for="monthlyNo">
                            No
                        </label>
                    </div>
                </div>
                <form>
                    <div class="row" id="notificationMonthlyForm" style="display: none;">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="control-label " for="course">Monthly Specific Address</label>
                                <br><strong>Example:</strong><br><small>yourname:yourname@company.com , anothername:anothername@company.com</small>
                                <input type="text" name="monthly_specific_address" value="" id="monthly_specific_address" class="form-control" placeholder="Monthly Lead Summary Notifications">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button id="send" type="submit" class="btn btn-danger">Update</button>
                    </div>
                </form>
                <!-- 3 -->
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDailyForm(isVisible) {
        const form = document.getElementById('notificationDailyForm');
        form.style.display = isVisible ? 'block' : 'none';
    }
</script>

<script>
    function toggleWeeklyForm(isVisible) {
        const form = document.getElementById('notificationWeeklyForm');
        form.style.display = isVisible ? 'block' : 'none';
    }
</script>

<script>
    function toggleMonthlyForm(isVisible) {
        const form = document.getElementById('notificationMonthlyForm');
        form.style.display = isVisible ? 'block' : 'none';
    }
</script>

@endsection
