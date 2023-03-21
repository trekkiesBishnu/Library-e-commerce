<?php
namespace App\Http\Controllers;
use App\Repositories\AuthorRepositoryInterface;
use Illuminate\Http\Request;
class AuthorController extends Controller
{
    protected $authorRepo;
    public function __construct(AuthorRepositoryInterface $authorRepo) {
        $this->authorRepo= $authorRepo;
    }
    public function index(){
       $author= $this->authorRepo->all();
        return view('admin.author.index',compact('author'));
    }
    public function create(){
        return view('admin.author.create');
    }
    public function store(Request $request){
        $data=$request->validate([
            'name'=>'required|string',
            'description'=>'required',
            'address'=>'required',
            'phone'=>'required',
        ]);
        $this->authorRepo->store($data);
        return redirect()->route('author')->with('message','Author Added Successfully');

    }
    public function edit($id){
        $author=$this->authorRepo->find($id);
        return view('admin.author.edit',compact('author'));
    }
    public function update(Request $request,$id){
        $data=$request->validate([
            'name'=>'required|string',
            'description'=>'required',
            'address'=>'required',
            'phone'=>'required',
        ]);
        $this->authorRepo->update($data,$id);
        return redirect()->route('author')->with('message','Author Updated Successfully');

    }
    public function destroy($id){
        $this->authorRepo->destroy($id);
        return redirect()->route('author')->with('message','Author Deleted Successfully');

    }
}
