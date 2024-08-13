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
                <h2 class="mb-3">A2AHome Land Goals Setting</h2>
                <p class="mb-3">Goals will help you track the performance of the campaigns on a monthly basis. Select the month and assign a goal against it.</p>
                <div class="mb-3">
                    <table id="leadstable" border="0" class="table table-striped" style="width:100%">
                        <thead>
                            <tr class="info">
                                <th>S.No</th>
                                <th>Month</th>
                                <th>No.Of Leads</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>1</td>

                            <td>Aug'2024</td>
                            <td >150</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1429"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1429"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>2</td>

                            <td>Jul'2024</td>
                            <td >100</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1409"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1409"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>3</td>

                            <td>Jun'2024</td>
                            <td >100</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1379"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1379"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>4</td>

                            <td>May'2024</td>
                            <td >100</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1371"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1371"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>5</td>

                            <td>Apr'2024</td>
                            <td >150</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1365"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1365"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>6</td>

                            <td>Mar'2024</td>
                            <td >100</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1359"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1359"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>7</td>

                            <td>Feb'2024</td>
                            <td >200</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1355"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1355"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>8</td>

                            <td>Jan'2024</td>
                            <td >200</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1350"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1350"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>9</td>

                            <td>Dec'2023</td>
                            <td >150</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1346"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1346"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>10</td>

                            <td>Nov'2023</td>
                            <td >250</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1343"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1343"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>11</td>

                            <td>Oct'2023</td>
                            <td >200</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1340"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1340"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>12</td>

                            <td>Sep'2023</td>
                            <td >200</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1339"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1339"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>13</td>

                            <td>Aug'2023</td>
                            <td >200</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1334"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1334"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>14</td>

                            <td>Jul'2023</td>
                            <td >250</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1329"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1329"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>15</td>

                            <td>Jun'2023</td>
                            <td >250</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1326"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1326"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>16</td>

                            <td>May'2023</td>
                            <td >250</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1323"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1323"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>17</td>

                            <td>Apr'2023</td>
                            <td >200</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1320"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1320"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>18</td>

                            <td>Mar'2023</td>
                            <td >200</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1318"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1318"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>19</td>

                            <td>Feb'2023</td>
                            <td >500</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1316"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1316"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>20</td>

                            <td>Jan'2023</td>
                            <td >250</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1312"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1312"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>21</td>

                            <td>Dec'2022</td>
                            <td >250</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1308"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1308"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>22</td>

                            <td>Nov'2022</td>
                            <td >100</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1307"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1307"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>23</td>

                            <td>Oct'2022</td>
                            <td >300</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1302"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1302"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>24</td>

                            <td>Sep'2022</td>
                            <td >200</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1273"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1273"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>25</td>

                            <td>Sep'2022</td>
                            <td >200</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1244"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1244"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>26</td>

                            <td>Sep'2022</td>
                            <td >200</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1215"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1215"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>27</td>

                            <td>Sep'2022</td>
                            <td >200</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1186"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1186"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>28</td>

                            <td>Sep'2022</td>
                            <td >50</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1184"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1184"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <td>29</td>

                            <td>Aug'2022</td>
                            <td >250</td>
                            <td >
                                <a href="https://leadstore.in/setting/update_goal_setting/70/1181"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a onclick="return confirm('Are you sure delete?')" href="https://leadstore.in/setting/goal_remove/70/1181"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-3 bg-light p-3">
                    <div class="filters_panel">
                        <form action="https://leadstore.in/setting/save_goals/1409" class="form-inline" name="emailgateway" id="emailgateway" method="post" accept-charset="utf-8">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="Select a Month">Select a Month</label><br>
                                        <div class="input-group date" id="datetimepicker10">
                                        <input type="date" class="form-control" name="goals_date" id="goals_date" required="required" value="07/2024">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar">
                                            </span>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="No.of leads">No.of leads</label><br>
                                        <input type="number" name="noofleads" id="noofleads" class="item form-control" min="1" step="1" max="10000" required="required">
                                    </div>
                                </div>
                            </div>

                            

                            <div class="form-group">
                                <label for="Save"></label><br>
                                <button id="send" style="margin-top:3px;" type="submit" class="btn btn-danger">Save</button>
                            </div>

                            <input type="hidden" name="project_id" value="70">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
