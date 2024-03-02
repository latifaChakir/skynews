<?php

namespace App\Imports;

use App\Models\Contact;
use App\Models\UserContact;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class ContactsImport implements ToModel
{
    protected $groupId;
    private $userId;

    public function __construct($groupId, $userId)
    {
        $this->groupId = $groupId;
        $this->userId = $userId;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $contact = Contact::where('email', $row[0])->first();

        if ($contact) {
          
            $userContact = new UserContact();
            $userContact->contact_id = $contact->id;
            $userContact->user_id = $this->userId;
            $userContact->save();
        } else {
      
            $contact = Contact::create([
                'email' => $row[0],
                'group_id' => $this->groupId,
            ]);
                   $userContact = new UserContact();
            $userContact->contact_id = $contact->id;
            $userContact->user_id = $this->userId;
            $userContact->save();
        }
        
    
        return $contact;
    }
    
}
