<?php

namespace App\Http\Controllers;




use App\Exports\ContactsExport;
use App\Imports\ContactsImport;
use App\Models\Contact;
use App\Models\Group;
use App\Models\UserContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $contacts = Contact::join('user_contacts', 'user_contacts.contact_id', '=', 'contacts.id')
        ->join('users', 'user_contacts.user_id', '=', 'users.id')
        ->leftJoin('groups', 'contacts.group_id', '=', 'groups.id')
        ->where('user_id', $user_id)
        ->select('contacts.*', 'groups.name AS group_name')
        ->get();


        return view('user.contacts',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
    
        $user_id = auth()->user()->id;
        $contact = Contact::where('email', $request->email)->first();
    
        if ($contact) {
            $existingUserContact = UserContact::where('user_id', $user_id)
                                               ->where('contact_id', $contact->id)
                                               ->exists();
            if (!$existingUserContact) {
                UserContact::create([
                    'user_id' => $user_id,
                    'contact_id' => $contact->id,
                ]);
            }
        } else {
            $contact = new Contact();
            $contact->email = $request->email;
            $contact->save();
    
            UserContact::create([
                'user_id' => $user_id,
                'contact_id' => $contact->id,
            ]);
        }
    
        return redirect('/contacts')->with('success', 'Contact créé avec succès');
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

        $contact = Contact::find($id);
        return view('user.editcontact', compact('contact'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $request->validate([
            'email' => 'required',
        ]);

        $contact = Contact::find($id);
        $contact->email = $request->email;
        $contact->update();

        return redirect('/contacts')->with('success', 'contact updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {



        $contact = Contact::find($id);
        $contact->delete();
        return redirect('/contacts')->with('success', 'contact deleted successfully');
    }


    public function import(Request $request)
    {
        $user_id = auth()->user()->id;
        $request->validate([
            'name' => 'required|string',
        ]);
        $group = new Group();
        $group->name = $request->name;
        $group->save();

        $groupId = $group->id;

        if ($request->hasFile('excel_file')) {
            $filePath = $request->file('excel_file');

            Excel::import(new ContactsImport($groupId, $user_id), $filePath);

            return redirect('/contacts')->with('success', 'Importation réussie!');
        } else {
            return redirect('/')->with('error', 'Aucun fichier n\'a été téléchargé.');
        }
    }

    public function export(){
        return Excel::download(new ContactsExport, 'Contacts.xlsx');
    }


}
