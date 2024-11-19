<?php

namespace App\Modules\Organization\Http\Controllers;
use App\Modules\Configuration\ConfigurationHelper;
use App\Http\Controllers\Controller;
use App\Modules\Organization\Requests\Canteen;
use App\Modules\Survey\Models\Survey;
use App\Modules\SurveyItem\Models\SurveyItem;
use App\Modules\SurveyResult\Models\SurveyResult;
use Illuminate\Http\Request;

use App\Modules\Organization\Models\Organization;
use App\Modules\Organization\Models\Canteen as OrganizationCanteen;
use App\Modules\Organization\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Session;

use App;

class CanteenController extends Controller
{
    public function __construct()
    {
        $Language = ConfigurationHelper::Language();
    }

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ConfigurationHelper::Language();
        $ModuleTitle = __('Organization::ControllerMsg.ModuleTitle');
        $PageTitle = __('Organization::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Organization::ControllerMsg.TableTitle');

        $canteens = OrganizationCanteen::orderby('id','desc')->paginate(10);

        return view("Organization::canteen.index", compact('ModuleTitle','PageTitle','TableTitle','canteens'));
    }

    public function create(){
        $ModuleTitle = __('Organization::ControllerMsg.ModuleTitle');
        $PageTitle = __('Organization::ControllerMsg.PageTitleAdd');
        $TableTitle = __('Organization::ControllerMsg.TableTitle');
        $Organization = Organization::where('status','1')->pluck('name','id')->all();
        return view("Organization::canteen.create", compact('ModuleTitle','PageTitle','TableTitle','Organization'));
    }

    public function store(Canteen $request)
    {
        $input = $request->validated();

        DB::beginTransaction();
        try {
            if ($canteenData = OrganizationCanteen::create($input)) {
                $canteenData->save();
            }

            DB::commit();
            Session::flash('message',__('Organization::FormValidation.DataAdd'));
            return redirect()->route('admin.canteen.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }


    public function edit($id){
        $ModuleTitle = __('Organization::ControllerMsg.ModuleTitle');
        $PageTitle = __('Organization::ControllerMsg.PageTitleUpdateCanteen');
        $Organization = Organization::where('status','1')->pluck('name','id')->all();

        $data = OrganizationCanteen::where('status','1')->where('id',$id)->first();

        return view("Organization::canteen.edit", compact('data','ModuleTitle','PageTitle','Organization'));
    }


    public function update(Canteen $request,$id){
        $input = $request->validated();

        $UpdateModel = OrganizationCanteen::where('id',$id)->first();

        DB::beginTransaction();
        try {
            $UpdateModel->update($input);
            $UpdateModel->save();

            DB::commit();

            Session::flash('message', __('Organization::FormValidation.UpdateData'));
            return redirect()->route('admin.canteen.index');
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function inactive($id){
        DB::beginTransaction();
        try {
            $data = OrganizationCanteen::where('id',$id);
            $data->update([
                'status' => 0,
                'updated_by' => Auth::user()->id,
            ]);
            DB::commit();
            Session::flash('message', __('Organization::FormValidation.RemoveList'));
            return redirect()->back();
        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            $canteenExists = DB::table('sur_device')->where('canteen_id',$id)->count();
//            dd($organizationExists);
            if ($canteenExists == 0){
                $DeleteModel = App\Modules\Organization\Models\Canteen::where('id', $id)
                    ->select('*')
                    ->first();

                $DeleteModel->delete();
                Session::flash('delete', __('Organization::FormValidation.DeleteMsg'));
                DB::commit();
                return redirect()->back();
            }else{
//                Session::flash('delete', __('Organization::FormValidation.DeleteMsg'));
                Session::flash('delete', 'Already use this canteen');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public  function getorganizationdata(){
        $appUrl=env('APP_URL');
        $response = Http::withHeaders([
            'x-api-key' => 'survey',
            'x-api-value' => 'survey@123',
            'x-api-secret' => 'survey'
        ])->get($appUrl.'api/organization/getorganizationdata');
        $body = $response->getBody()->getContents();
        $allOrganization = json_decode($body);
        return $allOrganization;
    }

    public function reportWithGraph()
    {
        ConfigurationHelper::Language();

        $surveyInfo = Survey::with(
            array(
                'SurveyResult' => function ($query) {
                    $query->select('id','survey_id', 'item_id','organization_id','user_id','latitude','longitude')->with(
                        array(
                            'SurveyItem' => function ($q) {
                                $q->select('id','itemtexten','itemtextbn','itemvalueen','itemvaluebn');
                            }
                        )
                    );
                }
            )
        )->where('status',1);

        if (Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();
            $surveyInfo->join('sur_survey_organization','sur_survey_organization.survey_id','=','sur_survey.id');
            $surveyInfo->where('sur_survey_organization.organization_id',$userInfo->organization_id);
        }

        $surveyInfo=$surveyInfo->get();

        $surveySelect = Survey::join('sur_survey_organization','sur_survey_organization.survey_id','=','sur_survey.id')
            ->where('sur_survey.status',1);

        if (Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();
            $surveySelect->where('sur_survey_organization.organization_id',$userInfo->organization_id);
        }
        if(session()->get('locale') == 'en'){
            $surveySelect = $surveySelect->pluck('sur_survey.nameen','sur_survey.id')->all();
        }else{
            $surveySelect = $surveySelect->pluck('sur_survey.namebn','sur_survey.id')->all();
        }
        $surveySelect[''] = 'Choose Survey';
        ksort($surveySelect);

        $selectCanteen = \App\Modules\Organization\Models\Canteen::where('status','1')->pluck('name','name')->all();
        $selectCanteen[''] = 'Choose Canteen';
        ksort($selectCanteen);

        return view("Organization::canteen.report.canteen-wise-report", compact(['surveySelect','surveyInfo','selectCanteen']));

    }

    public function reportWithGraphValue(Request $request)
    {
        $input = $request->all();

        $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();

        $surveyItems = SurveyItem::where('survey_id',$input['survey_id']);
        if ($input['item_id'] != 'all'){
            $surveyItems->where('id', $input['item_id']);
        }

        $surveyItems=$surveyItems->get();

        $surveyResult = SurveyResult::select([
            DB::raw('count(sur_survey_result.id) as total'),
            'sur_item.id as surveyItemId',
            'sur_item.itemtexten',
            'sur_item.itemtextbn',
            'sur_survey_result.device_id',
        ])
            ->join('sur_item', 'sur_survey_result.item_id', '=', 'sur_item.id')
            ->join('sur_device', 'sur_survey_result.device_id', '=', 'sur_device.name')
            ->join('sur_canteen', 'sur_canteen.id', '=', 'sur_device.canteen_id')
            ->where('sur_survey_result.survey_id',$input['survey_id'])
            ->where('sur_canteen.name',$input['canteen_name'])
            ->where('sur_survey_result.date',date("d-m-Y", strtotime($input['date'])) );
        if(Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $surveyResult->where('sur_survey_result.organization_id',$userInfo->organization_id);
        }
        if ($input['item_id'] != 'all'){
            $surveyResult = $surveyResult->where('sur_survey_result.item_id', $input['item_id']);
        }

        $surveyResult = $surveyResult->groupBy('sur_survey_result.item_id')->get();

        $arraySurveyArray=[];
        foreach ($surveyResult as $value) {
            $arraySurveyArray[$value->surveyItemId]=$value;
        }


        // canteen wise total data
        $cantteenWiseData = [];
        if($surveyItems){
            foreach ($surveyItems as $item){
                if(isset($arraySurveyArray[$item->id])){
                    $cantteenWiseData[] = [
                        'item_en' => $arraySurveyArray[$item->id]->itemtexten,
                        'item_bn' => $arraySurveyArray[$item->id]->itemtextbn,
                        'value' => $arraySurveyArray[$item->id]->total
                    ];
                }else{
                    $cantteenWiseData[] = [
                        'item_en' => $item->itemtexten,
                        'item_bn' => $item->itemtextbn,
                        'value' => 0
                    ];
                }
            }
        }

        $surveySelect = Survey::join('sur_survey_organization','sur_survey_organization.survey_id','=','sur_survey.id')
            ->where('sur_survey.status',1);
        if(Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
            $surveySelect->where('sur_survey_organization.organization_id',$userInfo->organization_id);
        }
        if(session()->get('locale') == 'en'){
            $surveySelect = $surveySelect->pluck('sur_survey.nameen','sur_survey.id')->all();
        }else{
            $surveySelect = $surveySelect->pluck('sur_survey.namebn','sur_survey.id')->all();
        }

        $surveySelect[''] = 'Choose Survey';
        ksort($surveySelect);

        $survey = Survey::where('status',1)->where('id',$input['survey_id'])->first();

        $surveyItem = SurveyItem::where('survey_id',$input['survey_id']);
        if(session()->get('locale') == 'en'){
            $surveyItem = $surveyItem->pluck('itemtexten','id')->all();
        }else{
            $surveyItem = $surveyItem->pluck('itemtextbn','id')->all();
        }
        $surveyItem['all'] = 'All';

        $selectCanteen = \App\Modules\Organization\Models\Canteen::where('status','1')->pluck('name','name')->all();
        $selectCanteen[''] = 'Choose Canteen';
        ksort($selectCanteen);

        $result = array_map(function($cantteenWiseData) {
            return array("y" => $cantteenWiseData['value'], "label" => $cantteenWiseData['item_en']);
        }, $cantteenWiseData);

        $dataPoints = $result;
        return view("Organization::canteen.report.canteen-wise-report", compact(['surveySelect','survey','input','surveyItem','selectCanteen','cantteenWiseData','dataPoints']));

    }
}
