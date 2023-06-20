<?php
 
namespace App\Http\Livewire;
 
use Livewire\WithPagination;
use App\Models\Employee;
use Livewire\Component;
 
class EmployeeShow extends Component
{
    use WithPagination;
 
    protected $paginationTheme = 'bootstrap';
 
    public $nationalidnumber, $title, $birthdate, $employee_id;
    public $search = '';
 
    protected function rules()
    {
        return [
            'nationalidnumber' => 'required|string',
            'title' => ['required','string'],
            'birthdate' => 'required|date',
        ];
    }
 
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
 
    public function saveEmployee()
{
    // Check if the current user is an admin
    if (auth()->user()->is_admin) {
        $validatedData = $this->validate();

        Employee::create($validatedData);
        session()->flash('message', 'Employee Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    } else {
        // User is not authorized, show forbidden popup or handle the situation accordingly
        // For example, you can display an error message or redirect back
        session()->flash('error', 'You are not authorized to perform this action.');
    }
}
     
    public function editEmployee(int $employee_id)
    {
        $employee = Employee::find($employee_id);
        if($employee){
 
            $this->employee_id = $employee->id;
            $this->nationalidnumber = $employee->nationalidnumber;
            $this->title = $employee->title;
            $this->birthdate = $employee->birthdate;
        }else{
            return redirect()->to('/employees');
        }
    }
 
    public function updateEmployee()
{
    // Check if the current user is an admin
    if (auth()->user()->is_admin) {
        $validatedData = $this->validate();

        Employee::where('id', $this->employee_id)->update([
            'nationalidnumber' => $validatedData['nationalidnumber'],
            'title' => $validatedData['title'],
            'birthdate' => $validatedData['birthdate']
        ]);
        session()->flash('message', 'Employee Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    } else {
        // User is not authorized, show forbidden popup or handle the situation accordingly
        // For example, you can display an error message or redirect back
        session()->flash('error', 'You are not authorized to perform this action.');
    }
}
     
    public function deleteEmployee(int $employee_id)
    {
        $this->employee_id = $employee_id;
    }
 
    public function destroyEmployee()
{
    // Check if the current user is an admin
    if (auth()->user()->is_admin) {
        Employee::find($this->employee_id)->delete();
        session()->flash('message', 'Employee Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    } else {
        // User is not authorized, show forbidden message
        $this->addError('authorization', 'You are not authorized to perform this action.');
    }
}
 
    public function closeModal()
    {
        $this->resetInput();
    }
 
    public function resetInput()
    {
        $this->nationalidnumber = '';
        $this->title = '';
        $this->birthdate = '';
    }
 
    public function render()
    {
        $employees = Employee::where('title', 'like', '%'.$this->search.'%')->orderBy('id','DESC')->paginate(3);
        
        return view('livewire.employee-show', ['employees' => $employees]);
    }
}