<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Models\Customer;
use Livewire\Component;

class CustomerShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name, $email, $city, $customer_id;
    public $search = '';

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'email' => ['required','email'],
            'city' => 'required|string',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveCustomer()
    {
        $validatedData = $this->validate();

        Customer::create($validatedData);
        session()->flash('message','Customer Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editCustomer(int $customer_id)
    {
        $customer = Customer::find($customer_id);
        if($customer){

            $this->customer_id = $customer->id;
            $this->name = $customer->name;
            $this->email = $customer->email;
            $this->city = $customer->city;
        }else{
            return redirect()->to('/customers');
        }
    }

    public function updateCustomer()
    {
        $validatedData = $this->validate();

        Customer::where('id',$this->customer_id)->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'city' => $validatedData['city']
        ]);
        session()->flash('message','Customer Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteCustomer(int $customer_id)
    {
        $this->customer_id = $customer_id;
    }

    public function destroyCustomer()
    {
        Customer::find($this->customer_id)->delete();
        session()->flash('message','Customer Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->city = '';
    }

    public function render()
    {
        $customers = Customer::where('name', 'like', '%'.$this->search.'%')->orderBy('id','DESC')->paginate(6);
        return view('livewire.customer-show', ['customers' => $customers]);
    }
}