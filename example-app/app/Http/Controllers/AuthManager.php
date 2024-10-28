<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\LibUser;
use App\Models\Loan;
use App\Models\BookReturn;
 
use Illuminate\Support\Facades\Log;

use App\Models\Books;

use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\Paginator;

class AuthManager extends Controller
{
    function newlogin(){
        return view('newlogin');
    }

    function newregistration(){
        session()->put('manual_previous_url', url()->previous());
        return view('newregistration');
    }

    function newregistration2(){
        session()->put('manual_previous_url', url()->previous());
        return view('newregistration2');
    }

    function newhome(){
        $totalBooks = Books::count();
        $is_available = Books::where('is_available', 'yes')->count();
        $currentDate = Carbon::now()->format('Y-m-d');
        $total_user = LibUser::where('dbman', 'no')->count();
        $total_request = Libuser::whereNotNull('req_1')->count() 
              + Libuser::whereNotNull('req_2')->count() 
              + Libuser::whereNotNull('req_3')->count();

        return view('newhome', ['totalBooks' => $totalBooks,'currentDate' => $currentDate,
         'is_available' => $is_available, 'total_user' => $total_user,
          'total_request' => $total_request]);
        
      
    }

    function viewRequest(){
        $students = Libuser::whereNotNull('req_1')
        ->orWhereNotNull('req_2')
        ->orWhereNotNull('req_3')
        ->paginate(5);
        session()->put('manual_previous_url', url()->previous());
        return view('mainlayerr.viewallstudent', ['students' => $students, 'borrow_count' => $this->borrowCount($students)]);
    }

    function getStudentRequest(Libuser $student) {
        $books = [];
    
        if ($student->req_1) {
            $books['req_1'] = Books::find($student->req_1);
        }
        if ($student->req_2) {
            $books['req_2'] = Books::find($student->req_2);
        }
        if ($student->req_3) {
            $books['req_3'] = Books::find($student->req_3);
        }
        $books = collect($books);
        session()->put('manual_previous_url', url()->previous());
    
        $timeInit = $this->timeInitiator($books);
    
        $is_student = Auth::user()->dbman == 'yes' ? 'false' : 'true'; // Define or pass this appropriately
    
        // Return the view with data
        return view('mainlayerr.viewallbook', [
            'books' => $books,
            'is_student' => $is_student,
            'timeInit' => $timeInit
        ]);
    }
    

    function newhome2(){
        $user = Auth::user();
        $totalBooks = Books::count();
        $is_available = Books::where('is_available', 'yes')->count();
        $currentDate = Carbon::now()->format('Y-m-d');
        $total_user = LibUser::where('dbman', 'no')->count();
        $pending_books = Loan::where('user_id', $user->id)->count();
        $book_requested = 0;
        if($user->req_1){
            $book_requested++;
        }
        if($user->req_2){
            $book_requested++;
        }
        if($user->req_3){
            $book_requested++;
        }
        return view('newhome2', ['totalBooks' => $totalBooks,
        'currentDate' => $currentDate,
         'is_available' => $is_available, 
         'total_user' => $total_user,
         'pending_books' => $pending_books,
         'book_requested' => $book_requested]);
        
    }
// profile page
    public function viewprofile(){
        $user = Auth::user();
        return view('/mainlayerr/profile', ['user' => $user]);
    }

    public function getProfile($user){
        session()->put('manual_previous_url', url()->previous());
        $user = LibUser::findOrFail($user);
        return view('/mainlayerr/editprofile', ['user' => $user]);
    }

    public function updateProfile($user, Request $request){
        $user = LibUser::findOrFail($user);
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'nullable|digits:11',
            'current_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            // 'phone_number' => (string) $request->phone_number,
            'phone_number' => $request->phone_number != null ? strval($request->phone_number) : null,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
        ];
        // $phone_number = intval($request->input('phone_number'));

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
            try {
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('user_image'), $imageName);
                $data['image'] = 'user_image/' . $imageName;
            } catch (\Exception $e) {
                Log::error('Image upload error: ' . $e->getMessage());
                return redirect(route('addbook'))->with('error', "Image upload failed. Please try again.");
            }
        } else {
            $data['image'] = $user->image; // or set a default image name
        }
        $user->update($data);
        return redirect()->route('viewprofile')->with('success', "Profile was successfully updated.");
    }

    function newregistrationp(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone_number' => 'nullable|digits:11',
            'current_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dbman' => "no",
            'phone_number' => $request->phone_number ? strval($request->phone_number) : null,
            'current_address' => $request->current_address ? $request->current_address : null,
            'permanent_address' => $request->permanent_address ? $request->permanent_address : null,
        ];

        if ($request->hasFile('image')) {
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('user_image'), $imageName);
                    $data['image'] = 'user_image/' . $imageName;
                } else {
                    $data['image'] = null;
                }

        $libuser = LibUser::create($data);

        if(!$libuser){
            return redirect(route('newregistration'))->with('error',"Unable to perform registration.");
        }

        return redirect(route('newhome'))->with('success',"Registration was successful.");
    }

    function newregistration2p(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone_number' => 'nullable|digits:11',
            'current_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
    

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dbman' => "yes",
            'phone_number' => $request->phone_number ? strval($request->phone_number) : null,
            'current_address' => $request->current_address ? $request->current_address : null,
            'permanent_address' => $request->permanent_address ? $request->permanent_address : null,
        ];

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('user_image'), $imageName);
            $data['image'] = 'user_image/' . $imageName;
        } else {
            $data['image'] = null;
        }


        $libuser = LibUser::create($data);

        if(!$libuser){
            return redirect(route('newregistration2'))->with('error',"Unable to perform registration.");
        }

        return redirect(route('newhome'))->with('success',"Registration was successful.");
    }


    public function newloginp(Request $request)
    { 
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->dbman == 'yes'){
                return redirect()->route('newhome')->with('success', 'Successfully logged in.');
            }else{
                return redirect()->route('newhome2')->with('success', 'Successfully logged in.');
            }
           
        } else {
            return redirect()->route('newlogin')->with('error', 'Validation unsuccessful. Please check your credentials and try again.');
        }
    }
    

    public function authenticate(Request $request)
    { 
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        
        $user = LibUser::where('email', $credentials['email'])->first();
        
        if ($user) {
            if (Hash::check($credentials['password'], $user->password)) {
                return redirect()->route('viewallstudent')->with('success', 'Successfully logged in.');
            }
        }
        return redirect()->route('newlogin')->with('error', 'Validation unsuccessful. Please check your credentials and try again.');
        
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('newlogin'));
    }

    public function back()
    {
        $previousUrl = session()->get('manual_previous_url');
        return redirect($previousUrl);
    }
    ///////////////////////////////

    // public function getSearchStudent(Request $request)
    // {
    //     $request->validate([
    //         'search' => 'required'
    //     ]);
    //     $students = LibUser::where('id', $request->search)->get();
        
    //     // $students = LibUser::where('name', $request['search']);
        
    //     return view('mainlayerr.viewallstudent', ['students' => $students]);
    // }

//     public function getSearchStudent(Request $request)
// {
//     // Check if search parameter is present and is an integer
//     if ($request->has('search') && filter_var($request->search, FILTER_VALIDATE_INT) !== false) {
//         $students = LibUser::where('id', $request->search)->paginate(5);
//     } else {
//         // If no search parameter or not an integer, get all students
//         $students = LibUser::where('dbman', 'no')->paginate(5);
//     }
    
//     return view('mainlayerr.viewallstudent', ['students' => $students, 'page' => request('page'), 'borrow_count' => $this->borrowCount($students)]);
// }

public function getSearchStudent(Request $request)
{
    $query = LibUser::query();

    // Check if search parameter is present and is an integer
    if ($request->has('search') && filter_var($request->search, FILTER_VALIDATE_INT) !== false) {
        // Search by user ID if it's an integer
        $query->where('id', $request->search);
    } else {
        // If no search parameter or not an integer, get all students where dbman is 'no'
        $query->where('dbman', 'no');
    }

    // Retrieve all the results first to determine if pagination is needed
    $students = $query->get();

    // If the number of results is greater than 5, apply pagination
    if ($students->count() > 5) {
        $students = $query->paginate(5);
    }

    return view('mainlayerr.viewallstudent', [
        'students' => $students,
        'page' => request('page'),
        'borrow_count' => $this->borrowCount($students),
    ]);
}



    ////////////////////////////////

    private function borrowCount($students){
        $borrowedBooksCount = [];
        // Handle if $students is a single object or a collection
        if ($students instanceof \Illuminate\Pagination\LengthAwarePaginator || is_iterable($students)) {
            foreach ($students as $student) {
                $borrowedBooksCount[$student->id] = Loan::where('user_id', $student->id)->count();
            }
        } else {
            $borrowedBooksCount[$students->id] = Loan::where('user_id', $students->id)->count();
        }
        return $borrowedBooksCount;
    }
    

    public function getStudents()
    {
        session()->put('manual_previous_url', url()->previous());
        // $students = LibUser::all();
        $students = LibUser::where('dbman', 'no')->paginate(5);
        return view('mainlayerr.viewallstudent', ['students' => $students, 'borrow_count' => $this->borrowCount($students)]);
    }

    public function getStudent($student){
        session()->put('manual_previous_url', url()->previous());
        $data = LibUser::findOrFail($student);
        return view('mainlayerr.studentprofile',['student' => $data]);
    }

    public function updateStudent(LibUser $student , Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'nullable|digits:11',
            'current_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            // 'phone_number' => (string) $request->phone_number,
            'phone_number' => $request->phone_number != null ? strval($request->phone_number) : null,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
        ];
        // $phone_number = intval($request->input('phone_number'));

        if ($request->hasFile('image')) {
            if ($student->image && file_exists(public_path($student->image))) {
                unlink(public_path($student->image));
            }
            try {
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('user_image'), $imageName);
                $data['image'] = 'user_image/' . $imageName;
            } catch (\Exception $e) {
                Log::error('Image upload error: ' . $e->getMessage());
                return redirect(route('viewstudent', ['student'=> $student, 'page' => request()->input('page', 1),'borrow_count' => $this->borrowCount($student)]))->with('error', "Image upload failed. Please try again.");
            }
        } else {
            $data['image'] = $student->image; // or set a default image name
        }
        $student->update($data);
        // return back()->with('success', "Student was successfully updated.");
        
        return redirect()->route('viewallstudent', ['page' => request()->input('page', 1), 'borrow_count' => $this->borrowCount($student)])->with('success', "Student was successfully updated.");
    }

    // public function updateProfile(Request $request){
    //     $user = Auth::user();
    //     $data = $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'phone_number' => 'nullable|digits:11',
    //         'current_address' => 'nullable|string|max:255',
    //         'permanent_address' => 'nullable|string|max:255',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    //     ]);

    //     $data = [
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         // 'phone_number' => (string) $request->phone_number,
    //         'phone_number' => $request->phone_number != null ? strval($request->phone_number) : null,
    //         'current_address' => $request->current_address,
    //         'permanent_address' => $request->permanent_address,
    //     ];
    //     // $phone_number = intval($request->input('phone_number'));

    //     if ($request->hasFile('image')) {
    //         if ($user->image && file_exists(public_path($user->image))) {
    //             unlink(public_path($user->image));
    //         }
    //         try {
    //             $imageName = time().'.'.$request->image->extension();
    //             $request->image->move(public_path('user_image'), $imageName);
    //             $data['image'] = 'user_image/' . $imageName;
    //         } catch (\Exception $e) {
    //             Log::error('Image upload error: ' . $e->getMessage());
    //             return redirect(route('addbook'))->with('error', "Image upload failed. Please try again.");
    //         }
    //     } else {
    //         $data['image'] = $user->image; // or set a default image name
    //     }
    //     $user->update($data);
    //     return redirect()->route('viewprofile')->with('success', "Student was successfully updated.");
    // }


    public function deleteStudent(LibUser $student){
        $student->delete();
        return redirect()->route('viewallstudent', ['page' => request()->input('page', 1)])->with('success', "Student was successfully updated.");

    }


    /////////////////////////
    private function timeInitiator($books){
        $timeInit = [];
        foreach($books as $book){
            $loan = Loan::where('book_id', $book->id)->first();
            if($loan){
                $timeInit[$book->id] = $loan->due_at;
            }else{
                $timeInit[$book->id] = 0;
            }
        }
        return $timeInit;
    }

    public function getBooks($is_student)
    { 
        session()->put('manual_previous_url', url()->previous());
        $books = Books::paginate(5);
        $timeInit = $this->timeInitiator($books);

        return view('mainlayerr.viewallbook', ['books' => $books, 'is_student' => $is_student, 'timeInit' => $timeInit]);
    }

    public function getStudentBorrow($student){
        session()->put('manual_previous_url', url()->previous());
        $loans = Loan::where('user_id', $student)->get();
        if ($loans->isEmpty()) {
            return redirect()->back()->with('message', 'No loans found.');
        }
        $bookIds = $loans->pluck('book_id');
        $books = Books::whereIn('id', $bookIds)->paginate(5);
        $timeInit = $this->timeInitiator($books);
        return view('mainlayerr.viewallbook', ['books' => $books, 'is_student' => 'false', 'timeInit' => $timeInit]); 
    }

    public function getBook($book){
        session()->put('manual_previous_url', url()->previous());
        $data = Books::findOrFail($book);
        return view('mainlayerr.bookinfo',['book' => $data]);
    }

    public function addBook(){
        session()->put('manual_previous_url', url()->previous());
        return view('mainlayerr.addnewbook');
    }

    // function addBookp(Request $request){
    //     $request->validate([
    //         'book_title' => 'required',
    //         'auther' => 'required',
    //         'edition' => 'required',
    //         'type' => 'required',
    //         'publisher' => 'required|string',
    //         'isbn' => 'required|integer',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $data['book_title'] = $request->book_title;
    //     $data['auther'] = $request->auther;
    //     $data['edition'] = $request->edition;
    //     $data['type'] = $request->type;
    //     $data['publisher'] = $request->publisher;
    //     $data['isbn'] = $request->isbn;
    //     $data['is_available'] = 'yes';
        
    //     // $imageName = time().'.'.$request->image->extension();
    //     // $request->image->move(public_path('book_image'), $imageName);

    //     if ($request->hasFile('image')) {
    //         $imageName = time().'.'.$request->image->extension();
    //         $request->image->move(public_path('book_image'), $imageName);
    //         $data['image'] = 'book_image/' . $imageName;
    //     } else {
    //         $data['image'] = null; // or set a default image name
    //     }

    //     $books = Books::create($data);

    //     if(!$books){
    //         return redirect(route('addbook'))->with('error',"Unable to perform registration.");
    //     }

    //     return redirect(route('newhome'))->with('success',"Registration was successful.");
    // }

     

function addBookp(Request $request){
    $request->validate([
        'book_title' => 'required',
        'auther' => 'required',
        'edition' => 'required',
        'type' => 'required',
        'publisher' => 'required|string',
        'isbn' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $data = $request->only(['book_title', 'auther', 'edition', 'type', 'publisher', 'isbn']);
    $data['is_available'] = 'yes';

    if ($request->hasFile('image')) {
        try {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('book_image'), $imageName);
            $data['image'] = 'book_image/' . $imageName;
        } catch (\Exception $e) {
            Log::error('Image upload error: ' . $e->getMessage());
            return redirect(route('addbook'))->with('error', "Image upload failed. Please try again.");
        }
    } else {
        $data['image'] = null; // or set a default image name
    }

    $books = Books::create($data);

    if (!$books) {
        return redirect(route('addbook'))->with('error', "Unable to perform registration.");
    }

    return redirect(route('newhome'))->with('success', "Registration was successful.");
}

public function updateBook(Books $book , Request $request){
    session()->put('manual_previous_url', url()->previous());
    $request->validate([
        'book_title' => 'required',
        'auther' => 'required',
        'edition' => 'required',
        'type' => 'required',
        'publisher' => 'required|string',
        'isbn' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

        $data['book_title'] = $request->book_title;
        $data['auther'] = $request->auther;
        $data['edition'] = $request->edition;
        $data['type'] = $request->type;
        $data['publisher'] = $request->publisher;
        $data['isbn'] = $request->isbn;
        $data['is_available'] = 'yes';

    if ($request->hasFile('image')) {
        if ($book->image && file_exists(public_path($book->image))) {
            unlink(public_path($book->image));
        }
        try {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('book_image'), $imageName);
            $data['image'] = 'book_image/' . $imageName;
        } catch (\Exception $e) {
            Log::error('Image upload error: ' . $e->getMessage());
            return redirect(route('addbook'))->with('error', "Image upload failed. Please try again.");
        }
    } else {
        $data['image'] = $book->image; // or set a default image name
    }
    $book->update($data);
    return redirect()->route('viewallbookadmn', ['is_student' => 'false'])->with('success', "Book was successfully updated.");
}


    public function searchBookadv(Request $request, $is_student){
         // Validate the incoming request data
         $request->validate([
            'auther' => 'nullable|string',
            'book_title' => 'nullable|string',
            'type' => 'nullable|string',
            'edition' => 'nullable|integer'
        ]);

        // Retrieve the query parameters
        $auther = $request->input('auther');
        $book_title = $request->input('book_title');
        $type = $request->input('type');
        $edition = $request->input('edition');

        // Build the query
        $query = Books::query();

        if ($auther) {
            $query->where('auther', $auther);
        }
        if ($book_title) {
            $query->where('book_title', $book_title);
        }

        if ($type) {
            $query->where('type', $type);
        }

        if ($edition) {
            $query->where('edition', $edition);
        }

        // Execute the query
        // $books = $query->get();
           $books = $query->paginate(5);
           $timeInit = $this->timeInitiator($books);
        // Return the view with the books data checking if the request is from student or not
            return view('mainlayerr.viewallbook', ['books' => $books, 'is_student' => $is_student, 'page' => request('page'), 'timeInit' => $timeInit]);
         
        
        // return view('your-view-name', compact('books'));
    }

    public function searchBook(Request $request, $is_student)
{
    // Check if search parameter is present and is an integer
    if ($request->has('search') && filter_var($request->search, FILTER_VALIDATE_INT) !== false) {
        $books = Books::where('id', $request->search)->paginate(5);
    } else {
        // If no search parameter or not an integer, get all students
        $books = Books::paginate(5);
    }
    $timeInit = $this->timeInitiator($books);
    return view('mainlayerr.viewallbook', ['books' => $books, 'is_student' => $is_student, 'page' => request('page'), 'timeInit' => $timeInit]);
    
}

public function deleteBook(Books $book){
    $book->delete();
    return redirect()->route('viewallbookadmn', ['is_student' => "false", 'page' => request('page')])->with('success', "Student was successfully updated.");

}

public function getBookDescription(Books $book){
    session()->put('manual_previous_url', url()->previous());
    $is_student = Auth::user()->dbman == 'yes' ? 'false' : 'true';
    return view('mainlayerr.bookdesc', ['book' => $book, 'is_student' => $is_student]);
}

public function requestBook(Books $book){
    $user = Auth::user();
    if($user -> req_1 == null){
        $user->update(['req_1' => $book->id]);
    }else if($user -> req_2 == null){
        $user->update(['req_2' => $book->id]);
    }else if($user -> req_3 == null){
        $user->update(['req_3' => $book->id]);
    }else{
        return redirect()->route('viewallbookstd', ['is_student' => "true", 'page' => request('page')])->with('req_max', "You can't request for anymore books.");
    }
    return redirect()->route('viewallbookstd', ['is_student' => "true", 'page' => request('page')])->with('success_req', "Successfully Requested.");
}

public function removeRequest(Books $book){
    $user = Auth::user();
    if($user -> req_1 != null){
        $user->update(['req_1' => null]);
    }else if($user -> req_2 != null){
        $user->update(['req_2' => null]);
    }else if($user -> req_3 != null){
        $user->update(['req_3' => null]);
    }else{
        return redirect()->route('viewallbookstd', ['is_student' => "true", 'page' => request('page')])->with('no_req', "No book was requested to remove");
    } return redirect()->route('viewallbookstd', ['is_student' => "true", 'page' => request('page')])->with('success_remove', "Successfully Removed.");
}

public function test(){
    return 4;
    // <p>The result of the test function is: {{ app(\App\Managers\Authmanager::class)->test() }}</p>
}

/////////////////////////////////Borrow and lent //////////////////////////////

public function borrow(Request $request, Books $book)
    {
        // Check if the book is already borrowed
        if ($book->is_available == 'no') {
            return redirect()->route('viewallbookadmn', ['is_student' => "false", 'page' => request('page')])->with('fail', "Book was unable to borrow.");
        }

        $borrowedBooksCount = Loan::where('user_id', $request->id)
        ->whereNull('returned_at') // Assuming there's a 'returned_at' column to track returns
        ->count();

if ($borrowedBooksCount >= 3) {
return redirect()->route('viewallbookadmn', ['is_student' => "false", 'page' => request('page')])->with('fail', "You cannot borrow more than 3 books.");
}

        // Create a new loan record
        Loan::create([
            'user_id' => $request->id,
            'book_id' => $book->id,
            'borrowed_at' => Carbon::now(),
            'due_at' => Carbon::now()->addDays(14), // Example: 2 weeks due date
        ]);
        $book->update(['is_available' => 'no']);

        return redirect()->route('viewallbookadmn', ['is_student' => "false", 'page' => request('page')])->with('success2', "Books was successfully borrowed.");
    }

//     public function return(Books $book)
// {

//     $loan = Loan::where('book_id', $book->id)->first();
//     if ($loan) {
//         $loan->delete();
//         $book->update(['is_available' => 'yes']);
//         return redirect()->route('viewallbookadmn', ['is_student' => "false", 'page' => request('page')])
//                          ->with('success', "Book was successfully returned.");
//     } else {
//         return redirect()->route('viewallbookadmn', ['is_student' => "false", 'page' => request('page')])
//                          ->with('fail', "Could not return book.");
//     }
// }

public function return(Request $request, Books $book){
    $request->validate([
        'book_condition' => 'string|max:255|nullable',
        'notes' => 'string|nullable'
    ]);

    $returnDate = Carbon::now();
    $loan = Loan::where('book_id', $book->id)->first();
    
    $data['book_id'] = $loan->book_id;
    $data['returned_by'] = $loan->user_id;
    $data['returned_time'] = $returnDate;
    $data['in_time'] = $returnDate->lessThanOrEqualTo($loan->due_at);
    $data['book_condition'] = $request->book_condition ?? 'Good';
    $data['notes'] = $request->notes ?? 'In excelent condition.';

    $user = LibUser::find($loan->user_id);

    $book->update(['is_available' => 'yes']);
    $loan->delete();
    $bookret = BookReturn::create($data);
    if($bookret){
        return redirect()->route('viewallbookadmn', ['is_student' => "false", 'page' => request('page')])
        ->with([
            'success' => "Book was successfully returned.",
            'user' => $user,
            'book' => $book
        ]);
      }else{ return redirect()->route('viewallbookadmn', ['is_student' => "false", 'page' => request('page')])
                             ->with('fail', "Could not return book.");

    }

}

    // public function return(Request $request, Books $book)
    // {
    //     // Find the loan record
    //     $loan = $book->loans()->where('user_id', $request->user()->id)->whereNull('returned_at')->first();

    //     if (!$loan) {
    //         return response()->json(['message' => 'Loan record not found'], 400);
    //     }

    //     // Update the loan record with the return date
    //     $loan->update([
    //         'returned_at' => Carbon::now(),
    //     ]);

    //     return response()->json(['message' => 'Book returned successfully'], 200);
    // }

    ////////////////////////////test///////////////////////

    public function t(){
        return view('pagelayout.testt');
    }

    ////////////pagination/////////////////
    public function i()
{
    $books = Books::paginate(10); // Adjust the number 10 to whatever number of books you want per page.
    return view('your-view-name', compact('books'));  // The compact function creates an array from the elements but it is not needed here as I am already passing an array.
}
}
