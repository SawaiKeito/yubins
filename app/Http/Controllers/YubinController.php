<?php

namespace App\Http\Controllers;

use App\Models\Yubin;
use Illuminate\Http\Request;

class YubinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $yubins = Yubin::all();
        return view('yubins', [
            'yubins' => $yubins,
        ]);
        
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       return view('input');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $yubin = new Yubin;
        $name = request('name');
        $address = request('address');
        $results = $yubin->where('name','like','%'.$name.'%')->where('address', 'like', '%'.$address.'%')->get();
        return view('results', ['yubins' => $results]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Yubin  $yubin
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
          $validated = $request->validate([
        'name' => 'required|string|max:20',
        'post7' => 'required|numeric|digits_between:7,7',
        'address' => 'required|max:30',
        'tell' => 'required|numeric|digits_between:10,11',
        'email' => 'required|email:rfc,dns',
        'phone' => 'required|numeric|digits_between:10,11'
        ],[
            'required'=>'ご入力がされていません',
            'string'=>'ご入力が正しくありません',
            'post7.digits_between'=>'郵便番号が正しくありません',
            'numeric'=>'半角数字でご入力ください',
            'email'=>'メールアドレスが正しくありません',
            'tell.digits_between'=>'電話番号が正しくありません',
            'phone.digits_between'=>'電話番号が正しくありません'
            
       ]); 
        
        
        $yubins = new Yubin;
        $form = $request->all();
        unset($form['_token']);
        $yubins->fill($form)->save();
        return redirect('/yubins');
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Yubin  $yubin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $yubins = Yubin::find($id);
        


        return view('/edit',compact('yubins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Yubin  $yubin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         $validated = $request->validate([
        'name' => 'required|string|max:20',
        'post7' => 'required|numeric|digits_between:7,7',
        'address' => 'required|max:30',
        'tell' => 'required|numeric|digits_between:10,11',
        'email' => 'required|email:rfc,dns',
        'phone' => 'required|numeric|digits_between:10,11'
        ],[
            'required'=>'ご入力がされていません',
            'string'=>'ご入力が正しくありません',
            'post7.digits_between'=>'郵便番号が正しくありません',
            'numeric'=>'半角数字でご入力ください',
            'email'=>'メールアドレスが正しくありません',
            'tell.digits_between'=>'電話番号が正しくありません',
            'phone.digits_between'=>'電話番号が正しくありません'
            
       ]); 
        
         $yubins = Yubin::find($id);
        $updateYubin= $this->yubins->updateYubin($request, $yubins);
        
        

        return redirect('/yubins');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Yubin  $yubin
     * @return \Illuminate\Http\Response
     */
      public function __construct()
    {
        $this->yubins = new Yubin();
    }
    
    public function destroy($id)
    {
         // 指定されたIDのレコードを削除
        $deleteYubins = $this->yubins->deleteYubinsById($id);
        // 削除したら一覧画面にリダイレクト
        return redirect('/yubins');
    }
    
   
    
}
