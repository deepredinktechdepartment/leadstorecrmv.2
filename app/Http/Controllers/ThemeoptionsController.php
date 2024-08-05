<?php

namespace App\Http\Controllers\Organizations;
use App\Http\Controllers\Controller;
use App\Models\Themeoptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
Use Exception;
use Validator;
use Config;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\ConnectionFactory;
use App\Http\Controllers\Organizations\OrganizationController;

class ThemeoptionsController extends Controller
{

 public function replicateTable()
{

     // Fetch the structure of the existing table from the source database
     $existingTableName = 'users'; // Replace with the name of your existing table
     $existingTableStructure = DB::select("SHOW CREATE TABLE $existingTa0bleName")[0]->{'Create Table'};

     // Create the new table in the new database with the same structure
        $connectionFactory = new ConnectionFactory(app());
        $connectionConfig = [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'database' => 'db_63746825_1690525523',
        'username' => 'root',
        'password' => '',
        // Add other necessary connection parameters
        ];

        $connection = $connectionFactory->make($connectionConfig);
        $connection->beginTransaction();
        $connection->statement($existingTableStructure);


        // Data transfer from source table to destination table
        DB::connection('mysql')
        ->table($existingTableName)
        ->where('id',1)
        ->orderBy('id') // Adjust the ordering as needed to match your primary key column
        ->cursor()
        ->each(function ($row) use ($existingTableName,$connection) {
            $connection->table($existingTableName)
                ->insert((array) $row);
        });
        //$connection->commit();








}

    public function createDB_tables(Request $request)
    {
        try{



       // Get the columns and indexes from the existing table
        $tableName = 'intranet_ver3_1'; // Replace with the name of your existing table
        $columns = DB::connection()->getDoctrineSchemaManager()->listTableColumns($tableName);
        $indexes = DB::connection()->getDoctrineSchemaManager()->listTableIndexes($tableName);

        // Create the new table using the fetched structure
        Schema::create('db_63746825_1690525523', function (Blueprint $table) use ($columns, $indexes) {
            foreach ($columns as $column) {
                $columnDefinition = $column->toArray();
                $columnName = $columnDefinition['name'];
                unset($columnDefinition['name']);

                $table->{$columnDefinition['type']}($columnName, $columnDefinition['autoincrement'] ?? false, $columnDefinition);
            }

            foreach ($indexes as $index) {
                $indexDefinition = $index->toArray();
                $indexType = $indexDefinition['unique'] ? 'unique' : 'index';
                $table->{$indexType}($indexDefinition['columns'], $indexDefinition['name']);
            }
        });




            //$Users=DB::insert("CREATE TABLE db_63746825_1690525523.users SELECT * from intranet_ver3_1.users");


        }
        catch(\Exception $e){
            dd($e->getMessage());
            return false;
        }
    }
    public function createDB(Request $request)
    {
        try{
            $new_db_name = "DB_".rand()."_".time();



            $new_mysql_username = "root";
            $new_mysql_password = "";

            $conn = mysqli_connect(
                config('database.connections.mysql.host'),
                env('DB_USERNAME'),
                env('DB_PASSWORD')
            );
            if(!$conn ) {
                return false;
            }
            $sql = 'CREATE Database IF NOT EXISTS '.$new_db_name;
            $exec_query = mysqli_query( $conn, $sql);
            if(!$exec_query) {
                die('Could not create database: ' . mysqli_error($conn));
            }
            return 'Database created successfully with name '.$new_db_name;
        }
        catch(\Exception $e){
            dd($e->getMessage());
            return false;
        }
    }
    public function index()
    {

            $theme_options_data=Themeoptions::get()->first();
            $pageTitle="Theme Options";

            if(isset($theme_options_data) && $theme_options_data->count()>0){
                $addlink = '';
            }else{
                $addlink = url('theme_options/create');
            }

            return view('themeoptions.theme_options_list', compact('pageTitle','theme_options_data','addlink'))
            ->with('i', (request()->input('page', 1) - 1) * 5);



    }
    public function create_theme_options()
    {

            $pageTitle="Add New";
            return view('themeoptions.add_theme_options',compact('pageTitle'));

    }
    public function store_theme_options(Request $request)
    {

        $request->validate([
            'header_logo' => 'required|mimes:png,jpg,jpeg,svg,html',
            'favicon' => 'sometimes|nullable',

        ]);

        if ($request->hasFile('header_logo')) {
        $header_filename=uniqid().'_'.time().'.'.$request->header_logo->extension();

        $OrganizationController=new OrganizationController();
        $OrganizationController->putSessionsFoldersSturs(1);


         // Get session of folders
         $SessionsFolders=$OrganizationController->getSessionsFoldersSturs();

         $licencedOrgname=$SessionsFolders['licencedName']??null;
         $licencedOrgID=$SessionsFolders['licencedId']??null;
         $currentorgName=$SessionsFolders['currentOrg']??null;
         $currentorgID=$SessionsFolders['currentId']??null;
         $destinationPath=storage_path().'/app/uploads/'.$licencedOrgname.'_'.$licencedOrgID.'/'.$currentorgName.'_'.$currentorgID;
         $db_destinationPath='storage/app/uploads/'.$licencedOrgname.'_'.$licencedOrgID.'/'.$currentorgName.'_'.$currentorgID;




        $request->header_logo->move($destinationPath,$header_filename);
        }
        else{
            $header_filename="";
        }

        if ($request->hasFile('favicon')) {
        $favicon_filename=uniqid().'_'.time().'.'.$request->favicon->extension();

        $OrganizationController=new OrganizationController();
        $OrganizationController->putSessionsFoldersSturs(1);


         // Get session of folders
         $SessionsFolders=$OrganizationController->getSessionsFoldersSturs();

         $licencedOrgname=$SessionsFolders['licencedName']??null;
         $licencedOrgID=$SessionsFolders['licencedId']??null;
         $currentorgName=$SessionsFolders['currentOrg']??null;
         $currentorgID=$SessionsFolders['currentId']??null;
         $destinationPath=storage_path().'/app/uploads/'.$licencedOrgname.'_'.$licencedOrgID.'/'.$currentorgName.'_'.$currentorgID;
         $db_destinationPath='storage/app/uploads/'.$licencedOrgname.'_'.$licencedOrgID.'/'.$currentorgName.'_'.$currentorgID;



        $request->favicon->move($destinationPath,$favicon_filename);
        }
        else{
            $favicon_filename="";
        }
        Themeoptions::insert([
            [
                "header_logo"=>$db_destinationPath.'/'.$header_filename,
                "favicon"=>$db_destinationPath.'/'.$favicon_filename,
                "copyright"=>$request->copyright??'',
                "org_id"=>auth()->user()->org_id??0,
            ]
        ]);
        return redirect('theme_options')->with('success', "Success! Details are added successfully");
    }
    public function edit_theme_options($id)    {

            $theme_options_data=Themeoptions::get()->where("id",$id)->first();
            $pageTitle="Edit";
            return view('themeoptions.add_theme_options',compact('theme_options_data','pageTitle'));


    }
    public function update_theme_options(Request $request)
    {
        $request->validate([
            'header_logo' => 'mimes:png,jpg,jpeg,svg,html',
            'favicon' => 'sometimes|nullable',
        ]);
        if ($request->hasFile('header_logo')) {
        $header_logo=uniqid().'_'.time().'.'.$request->header_logo->extension();


        $OrganizationController=new OrganizationController();
        $OrganizationController->putSessionsFoldersSturs(1);


         // Get session of folders
         $SessionsFolders=$OrganizationController->getSessionsFoldersSturs();

         $licencedOrgname=$SessionsFolders['licencedName']??null;
         $licencedOrgID=$SessionsFolders['licencedId']??null;
         $currentorgName=$SessionsFolders['currentOrg']??null;
         $currentorgID=$SessionsFolders['currentId']??null;
         $destinationPath=storage_path().'/app/uploads/'.$licencedOrgname.'_'.$licencedOrgID.'/'.$currentorgName.'_'.$currentorgID;
         $db_destinationPath='storage/app/uploads/'.$licencedOrgname.'_'.$licencedOrgID.'/'.$currentorgName.'_'.$currentorgID;


        $request->header_logo->move($destinationPath,$header_logo);

        Themeoptions::where('id', $request->id)
        ->update(["header_logo"=>$db_destinationPath.'/'.$header_logo]);

        }
        else{
            $header_logo="";
        }
        if ($request->hasFile('favicon')) {

        $favicon=uniqid().'_'.time().'.'.$request->favicon->extension();

// Get session of folders
$SessionsFolders=$OrganizationController->getSessionsFoldersSturs();
$licencedOrgname=$SessionsFolders['licencedName']??null;
$licencedOrgID=$SessionsFolders['licencedId']??null;
$currentorgName=$SessionsFolders['currentOrg']??null;
$currentorgID=$SessionsFolders['currentId']??null;
$destinationPath=storage_path().'/app/uploads/'.$licencedOrgname.'_'.$licencedOrgID.'/'.$currentorgName.'_'.$currentorgID;
$db_destinationPath='storage/app/uploads/'.$licencedOrgname.'_'.$licencedOrgID.'/'.$currentorgName.'_'.$currentorgID;




        $request->favicon->move($destinationPath,$favicon);



        Themeoptions::where('id', $request->id)
        ->update(["favicon"=>$db_destinationPath."/".$favicon]);
        }
        else{
            $favicon="";
        }
        Themeoptions::where('id', $request->id)
            ->update(
            [


                "copyright"=>$request->copyright??'',
                "org_id"=>auth()->user()->org_id??0,
            ]
            );
        return redirect('theme_options')->with('success', "Success! Details are updated successfully");
    }
    public function delete_theme_options($id)
    {

            $data=Themeoptions::where('id',$id)->delete();
         return redirect()->back()->with('success','Success! Details are deleted successfully');

    }
}
