<?php
 
namespace App\Http\Livewire;
 
use Livewire\WithPagination;
use App\Models\Contact;
use Livewire\Component;
 
class ContactShow extends Component
{
    use WithPagination;
 
    protected $paginationTheme = 'bootstrap';
 
    public $title, $name, $phone, $ModifiedDate, $contact_id, $customer_id;
    public $search = '';
 
    protected function rules()
    {
        return [
            'title' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'ModifiedDate' => 'required|date',
            'customer_id' => 'required|integer',

        ];
    }
 
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
 
    public function saveContact()
    {
        $validatedData = $this->validate();
 
        Contact::create($validatedData);
        session()->flash('message','Contact Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
     
    public function editContact(int $contact_id)
    {
        $contact = Contact::find($contact_id);
        if($contact){
 
            $this->contact_id = $contact->id;
            $this->title = $contact->title;
            $this->name = $contact->name;
            $this->phone = $contact->phone;
            $this->ModifiedDate = $contact->ModifiedDate;
            $this->customer_id = $contact->customer_id;
        }else{
            return redirect()->to('/contacts');
        }
    }
 
    public function updateContact()
    {
        $validatedData = $this->validate();
 
        Contact::where('id',$this->contact_id)->update([
            'title' => $validatedData['title'],
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'ModifiedDate' => $validatedData['ModifiedDate'],
            'customer_id' => $validatedData['customer_id']
        ]);
        session()->flash('message','Contact Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
     
    public function deleteContact(int $contact_id)
    {
        $this->contact_id = $contact_id;
    }
 
    public function destroyContact()
    {
        Contact::find($this->contact_id)->delete();
        session()->flash('message','Contact Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }
 
    public function closeModal()
    {
        $this->resetInput();
    }
 
    public function resetInput()
    {
        $this->title = '';
        $this->name = '';
        $this->phone = '';
        $this->ModifiedDate = '';
        $this->customer_id = '';
    }
 
    public function render()
    {
        $contacts = Contact::where('name', 'like', '%'.$this->search.'%')->orderBy('id','DESC')->paginate(3);
        
        return view('livewire.contact-show', ['contacts' => $contacts]);
    }
}