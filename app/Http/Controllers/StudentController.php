<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Contact;
use App\Models\Student;
use App\Models\AgentPayment;
use App\Models\CourseStudent;
use function PHPSTORM_META\map;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\PaymentsStudent;
use Faker\Provider\ar_EG\Payment;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Students/Index', [
            'filters' => Request::all('search', 'trashed'),
            'students' => Auth::user()->account->students()
                ->orderByName()
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($student) => [
                    'id' => $student->id,
                    'name' => $student->name,
                    'phone' => $student->phone,
                    'city' => $student->city,
                    'deleted_at' => $student->deleted_at,
                    'course_fees' => $student->myCourse,
                    'course' => count($student->course) > 0 ? $student->course->first() : null,
                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Students/Create', [
            'courses' => Auth::user()->account
                ->courses()
                ->orderBy('name')
                ->get()
                ->map
                ->only('id', 'name', 'fees'),
            'agents' => Auth::user()->account
                ->agents()
                ->orderBy('name')
                ->get()
                ->map
                ->only('id', 'name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {        
        DB::beginTransaction();
        /** Prepare common fields */
        $user_id = Auth::user()->id;
        $account_id = Auth::user()->account->id;
        $start = \Carbon\Carbon::parse($request['start'])->format('Y-m-d');
        $duration = empty($request['length']) ? 26 : $request['length'];
        $finish = \Carbon\Carbon::parse($start)->addWeeks($duration)->format('Y-m-d');
        /** Prepare CourseStudent */
        $fees = $request['fees']; //Course::findOrfail($request['course_id'])->fees;
        $netFees = $request['fees'];
        if(!empty($request['agent'])) {
            $netFees = $request['fees'] - $request['commission'];
        }

        try {
            /** Insert Student */
            $student = Auth::user()->account->students()->create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'city' => $request['city'],
                'region' => $request['region'],
                'country' => $request['country'],
                'postal_code' => $request['postal_code'],
                'dob' =>  \Carbon\Carbon::parse($request['dob'])->format('Y-m-d'),
                'user_id' => $user_id,
                'account_id' => $account_id,
            ]);
            /** Insert CourseStudent */
            $courseStudent = CourseStudent::create([
                'course_id' => $request["course_id"],
                'user_id' => $user_id,
                'account_id' => $account_id,
                'student_id' => $student->id,
                'fees' => $fees,
                'net_fees' => $netFees,
                'fees_received' => $request["fees_received"],
                'fees_escrow' => $request["fees_received"],
                'fees_disbursed' => 0,
                'start_date' => $start,
                'finish_date' => $finish,
                'duration' => $request['length']
            ]);

            PaymentsStudent::create([
                'account_id' => $account_id,
                'user_id' => $user_id,
                'course_id' => $request["course_id"],
                'student_id' => $student->id, 
                'course_student_id' => $courseStudent->id,
                'payment_date' => now()->format('Y-m-d'),
                'amount' => $request["fees_received"],
                'note' => json_encode([
                    "First payment at the time of registration"
                ])
            ]);

            /** Check if any commision */
            if(!empty($request['agent'])) {
                AgentPayment::create([
                    'account_id' => $account_id,
                    'user_id' => $user_id,
                    'agent_id' => $request['agent'],
                    'course_student_id' => $courseStudent->id,
                    'amount' => $request['commission'],
                    'paid' => 0,
                    'balance' => $request['commission'],
                    'note' => json_encode([
                        'Date' => now(), 
                        'Amount' =>$request['commission'], 
                        'Student' => $request['first_name'] . " " . $request['last_name']
                    ])
                ]);
            }
            DB::commit();
            return Redirect::route('students')->with('success', 'Student created.');
        } catch (\Throwable $throwable) {
            DB::rollBack();
            return Redirect::back()->with('error','Student Cannot be created this time please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        // Auth::user()->account->contacts()->create(
        //     Request::validate([
        //         'first_name' => ['required', 'max:50'],
        //         'last_name' => ['required', 'max:50'],
        //         'email' => ['nullable', 'max:50', 'email'],
        //         'phone' => ['nullable', 'max:50'],
        //         'address' => ['nullable', 'max:150'],
        //         'city' => ['nullable', 'max:50'],
        //         'region' => ['nullable', 'max:50'],
        //         'country' => ['nullable', 'max:2'],
        //         'postal_code' => ['nullable', 'max:25'],
        //     ])
        // );

        // return Redirect::route('contacts')->with('success', 'Contact created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return Inertia::render('Students/Edit', [
            'student' => [
                'id' => $student->id,
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'email' => $student->email,
                'phone' => $student->phone,
                'address' => $student->address,
                'city' => $student->city,
                'region' => $student->region,
                'country' => $student->country,
                'postal_code' => $student->postal_code,
                'deleted_at' => $student->deleted_at,
            ],
            'course' => $student->course,
            'my_course' => $student->myCourse,
            'payments' => $student->myPayments,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update(
            Request::validate([
                'first_name' => ['required', 'max:50'],
                'last_name' => ['required', 'max:50'],
                'organization_id' => [
                    'nullable',
                    Rule::exists('organizations', 'id')->where(fn ($query) => $query->where('account_id', Auth::user()->account_id)),
                ],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
            ])
        );

        return Redirect::back()->with('success', 'Contact updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return Redirect::back()->with('success', 'Student deleted.');
    }

    public function restore(Student $student)
    {
        $student->restore();

        return Redirect::back()->with('success', 'Student restored.');
    }
}
