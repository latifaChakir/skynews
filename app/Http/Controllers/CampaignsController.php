<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailQueueJob;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Group;
use App\Models\NewsLetter;
use App\Models\UserContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user()->id;
$campaigns = Campaign::join('contacts as CON', 'campaigns.contact_id', '=', 'CON.id')
                        ->join('newsletters as NEWS', 'campaigns.newsletter_id', '=', 'NEWS.id')
                        ->join('groups as G', 'CON.group_id', '=', 'G.id')
                        ->where('NEWS.user_id', '=', 1)
                        ->select('CON.*', 'G.name as group_name', 'NEWS.id as NEWS_id', 'NEWS.name as NEWS_name', 'NEWS.user_id', 'campaigns.created_at')
                        ->get();
                        //  dd($campaigns);

       return view('user.campaigns.campaigns',compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $news = NewsLetter::where('user_id', 1)->get();
        $groups = Group::select('groups.*')
                        ->join('contacts', 'contacts.group_id', '=', 'groups.id')
                        ->join('user_contacts', 'contacts.id', '=', 'user_contacts.contact_id')
                        ->where('user_contacts.user_id', '=', 1)
                        ->get();
       return view('user.campaigns.SendCamping',compact('news','groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'newsletter' => 'required',
            'emails' => 'required',
        ]);
        $newsLetter_id = $request->newsletter;
        $emails = $request->emails ; 
        $newsLette = NewsLetter::find($newsLetter_id);

      
        $this->sendEmail($emails,$newsLette->content,$newsLette->name);
         return redirect(route('Campaigns.create'));
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getContacts(){
        $jsonData = file_get_contents('php://input');
        $groubs = json_decode($jsonData, true);
        $emails = [];
        // dd($groubs);
    
        foreach($groubs as $item){
            $contacts = DB::select("SELECT C.* FROM skynews.contacts C INNER JOIN skynews.groups G 
                                    ON C.group_id = G.id
                                    INNER JOIN skynews.user_contacts U ON C.id = U.contact_id 
                                    WHERE U.user_id = 1 AND G.id  = ".$item['id']);
            $emails[] = $contacts;
     }
            $emails =  json_encode($emails);
            print_r($emails);
    }
    public function sendEmail($emails , $content , $subject){
      
        $delay = 60;
        foreach($emails as $item){
                dispatch(new SendEmailQueueJob($item , $content , $subject))->delay(now()->addSeconds($delay));
                $delay += 10; 
        }
    }
}
