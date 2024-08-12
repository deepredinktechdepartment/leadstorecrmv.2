
    <div class="row leads_card_panel mb-2">
        <div class="col-md-12">


            <!-- Item 1 -->


            <div class="item item1">
                <div class="data_seperator1">
                  <a href="{{ route('projectLeads', ['projectID' => Crypt::encrypt($projectID ?? 0), 'start_date' => \Carbon\Carbon::now()->format('Y-m-d'), 'end_date' => \Carbon\Carbon::now()->format('Y-m-d')]) }}">

                    <h5 class="text-white">Leads for Today</h5>
                    <h1 class="number text-white">{{ $today_count??0 }}</h1>
                    </a>
                </div>

                <div class="data_seperator2">

                    <a href="{{ route('projectLeads', ['projectID' => Crypt::encrypt($projectID ?? 0), 'start_date' => \Carbon\Carbon::now()->format('Y-m-01'), 'end_date' => \Carbon\Carbon::now()->format('Y-m-t')]) }}">

                    <h5 class="text-white">Monthly Leads</h5>
                    <h2 class="number text-white">{{ $monthly_count??0 }}</h2>
                    </a>
                </div>
            </div>





            <!-- Item 2 -->
            <div class="item item2">
                <div class="data_seperator1">
                    <h5 class="text-white">Sales for Today</h5>
                    <h1 class="number text-white">0</h1>
                </div>

                <div class="data_seperator2">
                    <h5 class="text-white">Monthly Sales</h5>
                    <h2 class="number text-white">0</h2>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="item item3">

                <div class="data_seperator1">
                    <h5 class="text-white">Revenue for Today</h5>
                    <h1 class="number text-white">0</h1>
                </div>

                <div class="data_seperator2">
                    <h5 class="text-white">Monthly Revenue</h5>
                    <h2 class="number text-white">0</h2>
                </div>
            </div>
        </div>
    </div>
