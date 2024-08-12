<?php
namespace App\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Session;
use DB;




class ActiveOrgaization implements Scope
{

	 public function __construct($table=false)
    {

	   $this->active_table=$table??'';
    }


    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {


        $Session_OrgID=Session::get('OrganizationID');

        $Licence_ID=Session::get('Licence_OrganizationID');



		if($this->active_table=="menus"){
			if(isset($Session_OrgID)) {
				$builder->where('menus.org_id', '=',$Session_OrgID??0)->where('menus.licence_id', '=',$Licence_ID??0);
			}
		}elseif($this->active_table=="customers"){
            if(isset($Session_OrgID)) {
                $builder->where('customers.org_id', '=',$Session_OrgID??0)->where('customers.licence_id', '=',$Licence_ID??0);
            }
        }elseif($this->active_table=="contacts"){
            if(isset($Session_OrgID)) {
                $builder->where('contacts.org_id', '=',$Session_OrgID??0)->where('contacts.licence_id', '=',$Licence_ID??0);
            }
        }elseif($this->active_table=="licences"){
            if(isset($Session_OrgID)) {
                $builder->where('licences.org_id', '=',$Session_OrgID??0)->where('licences.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="activity_groups"){
            if(isset($Session_OrgID)) {
                $builder->where('activity_groups.org_id', '=',$Session_OrgID??0)->where('activity_groups.licence_id', '=',$Licence_ID??0);
            }
        }

        elseif($this->active_table=="activities"){
            if(isset($Session_OrgID)) {

                $builder->where('activities.org_id', '=',$Session_OrgID??0)->where('activities.licence_id', '=',$Licence_ID??0);
            }
        }

        elseif($this->active_table=="departments"){
            if(isset($Session_OrgID)) {
                $builder->where('departments.org_id', '=',$Session_OrgID??0)->where('departments.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="blogs"){
            if(isset($Session_OrgID)) {
                $builder->where('blogs.org_id', '=',$Session_OrgID??0)->where('blogs.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="sm_static_posts"){
            if(isset($Session_OrgID)) {
                $builder->where('sm_static_posts.org_id', '=',$Session_OrgID??0)->where('sm_static_posts.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="sm_outdoor_creatives"){
            if(isset($Session_OrgID)) {
                $builder->where('sm_outdoor_creatives.org_id', '=',$Session_OrgID??0)->where('sm_outdoor_creatives.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="sm_whatsapp_posts"){
            if(isset($Session_OrgID)) {
                $builder->where('sm_whatsapp_posts.org_id', '=',$Session_OrgID??0)->where('sm_whatsapp_posts.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="tasks_list"){
            if(isset($Session_OrgID)) {
                $builder->where('tasks_list.org_id', '=',$Session_OrgID??0)->where('tasks_list.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="projects"){
            if(isset($Session_OrgID)) {
                $builder->where('projects.org_id', '=',$Session_OrgID??0)->where('projects.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="employees"){
            if(isset($Session_OrgID)) {
                $builder->where('employees.org_id', '=',$Session_OrgID??0)->where('employees.licence_id', '=',$Licence_ID??0);
            }
        }
		elseif($this->active_table=="activities_users_mapped"){
                $builder->where('activities_users_mapped.org_id', '=',$Session_OrgID??0)->where('activities_users_mapped.licence_id', '=',$Licence_ID??0);
        }

        elseif($this->active_table=="themeoptions"){

        }

        elseif($this->active_table=="reminders_settings"){
                $builder->where('reminders_settings.org_id', '=',$Session_OrgID??0)->where('reminders_settings.licence_id', '=',$Licence_ID??0);
        }

		elseif($this->active_table=="users"){
            if(isset($Session_OrgID)) {
                $builder->where('users.is_active',true)->where('users.org_id', '=',$Session_OrgID??0);
            }
            else{
                $builder->where('users.is_active',true);
            }

        }
        elseif($this->active_table=="customer_contacts"){
            if(isset($Session_OrgID)) {
                $builder->where('customer_contacts.org_id', '=',$Session_OrgID??0);
            }
        }
		elseif($this->active_table=="projects_scopes"){
            if(isset($Session_OrgID)) {
                $builder->where('projects_scopes.org_id', '=',$Session_OrgID??0)->where('projects_scopes.licence_id', '=',$Licence_ID??0);
            }
        }
		elseif($this->active_table=="scopes_of_deliverablse"){
            if(isset($Session_OrgID)) {
                $builder->where('scopes_of_deliverablse.org_id', '=',$Session_OrgID??0)->where('scopes_of_deliverablse.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="kyc_documents"){
            if(isset($Session_OrgID)) {
                $builder->where('kyc_documents.org_id', '=',$Session_OrgID??0)->where('kyc_documents.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="permissions"){
            if(isset($Session_OrgID)) {
                $builder->where('permissions.org_id', '=',$Session_OrgID??0)->where('permissions.licence_id', '=',$Licence_ID??0);
            }
        }

        elseif($this->active_table=="roles"){

            if(isset($Session_OrgID)) {
                $builder->where('roles.org_id', '=',$Session_OrgID??0)->where('roles.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="roles_permissions"){
            if(isset($Session_OrgID)) {
                $builder->where('roles_permissions.org_id', '=',$Session_OrgID??0)->where('roles_permissions.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="ratecards"){
            if(isset($Session_OrgID)) {
                $builder->where('ratecards.org_id', '=',$Session_OrgID??0)->where('ratecards.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="deliverables"){
            if(isset($Session_OrgID)) {
                $builder->where('deliverables.org_id', '=',$Session_OrgID??0)->where('deliverables.licence_id', '=',$Licence_ID??0);
            }
        }
        elseif($this->active_table=="emp_departments"){
            if(isset($Session_OrgID)) {
                $builder->where('emp_departments.org_id', '=',$Session_OrgID??0)->where('emp_departments.licence_id', '=',$Licence_ID??0);
            }
        }
        else{

        }

    }
}
