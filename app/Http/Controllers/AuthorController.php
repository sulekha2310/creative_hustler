<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        
        $authorlist = Author::orderBy('id','DESC')->get();
        $booklist = Book::orderBy('id','DESC')->get();
        foreach($booklist as $bookkey => $bookValue){
            $author =  Author::where('id',$bookValue['author_id'])->first();
            $booklist[$bookkey]['author_name'] = $author->firstname. $author->lastname; 
        }
        // dd($authorlist->toArray());

        return view('author.index',compact('authorlist','booklist'));
    }

    public function addbook(Request $request)
    {
        $this->validate($request, [
            'add_author_id' => 'required',            
            'add_bookname' => 'required',            
            'add_publishername' => 'required',            
            'add_price' => 'required',  
            'add_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',          
        ]);

        $postData = $request->all() ;
        

       $submitArray = [
            "author_id" => $postData['add_author_id'],
            "bookname" => $postData['add_bookname'],
            "publishername" => $postData['add_publishername'],
            "price" => $postData['add_price'],
        ];

        if($request->add_image){
            $imageName = time() . '.png';
            $request->add_image->move(storage_path(). '/app/public/uploads/book/', $imageName);   
            $submitArray['image'] = $imageName;
        }
         
        if(Book::create($submitArray)){
            return response()->json(['success'=>'Book added Successfully']);
        }else{
            return response()->json(['error'=>'Something went wrong, Please try again later.']); 
        }
    }

    public function getbookdetails(Request $request)
    {
        $bookdetail = Book::where('id',$request['id'])->first()->toArray();
        return $bookdetail ;
    }

    public function updatebook(Request $request)
    {
        $this->validate($request, [
            'edit_book_id' => 'required',            
            'edit_author_id' => 'required',            
            'edit_bookname' => 'required',            
            'edit_publishername' => 'required',            
            'edit_price' => 'required',  
                   
        ]);

        $postData = $request->all() ;
        

       $submitArray = [
            "author_id" => $postData['edit_author_id'],
            "bookname" => $postData['edit_bookname'],
            "publishername" => $postData['edit_publishername'],
            "price" => $postData['edit_price'],
        ];

        if($request->edit_image){
            $imageName = time() . '.png';
            $request->edit_image->move(storage_path(). '/app/public/uploads/book/', $imageName);   
            $submitArray['image'] = $imageName;
        }
         
        if(Book::where('id',$request['edit_book_id'])->update($submitArray)){
            return response()->json(['success'=>'Book added Successfully']);
        }else{
            return response()->json(['error'=>'Something went wrong, Please try again later.']); 
        }
    }

    public function searchbook(Request $request)
    {
        $postData = $request->all();
        $searchbooklist = Book::orderBy('id','DESC');
        if($request->input('author_id')){
            $searchbooklist->where('author_id',$request->input('author_id'));
        }
        if($request->input('publishername')){
            $searchbooklist = $searchbooklist->Where('publishername', 'like', '%' . $request->input('publishername') . '%');
        }
        if($request->input('min_price')){
            $searchbooklist->where('price' , '>=', (int) $request->input('min_price'));
        }

        if($request->input('max_price')){
            $searchbooklist->where('price' , '<=', (int) $request->input('max_price'));
        }
        $searchbooklist = $searchbooklist->get()->toArray();
        foreach($searchbooklist as $bookkey => $bookValue){
            $author =  Author::where('id',$bookValue['author_id'])->first();
            $searchbooklist[$bookkey]['author_name'] = $author->firstname. $author->lastname; 
        }
        
        // dd($searchbooklist);
        return response()->json(['success'=>'Search List', 'data' => $searchbooklist]);
        
    }

    public function allbook(Request $request)
    {
        $searchbooklist = Book::orderBy('id','DESC');
        $searchbooklist = $searchbooklist->get()->toArray();
        foreach($searchbooklist as $bookkey => $bookValue){
            $author =  Author::where('id',$bookValue['author_id'])->first();
            $searchbooklist[$bookkey]['author_name'] = $author->firstname. $author->lastname; 
        }
        
        // dd($searchbooklist);
        return response()->json(['success'=>'Search List', 'data' => $searchbooklist]);
        
    }

    public function deletebook(Request $request){
        $postData = $request->all();
        $deleteid = $postData['id'];

        if(Book::where('id',$deleteid)->delete()){
            return response()->json(['success'=>"Deleted Successfully"]);
        }else{
            return response()->json(['error'=>'Something went wrong, Please try again later.']); 
        }


    }
}
