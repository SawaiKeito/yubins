<?php

namespace App\Http\Controllers;

use App\Models\Yubin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;
use Log;

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
    
    public function destroy(Request $request)
    {
        $id = $request->id;
         // 指定されたIDのレコードを削除
        $deleteYubins = $this->yubins->deleteYubinsById($id);
        // 削除したら一覧画面にリダイレクト
        return redirect('/yubins');
    }
    
   public function upload(Request $request) {

    // 一旦アップロードされたCSVファイルを受け取り保存する
    $uploaded_file = $request->file('csvdata'); // inputのnameはcsvdataとする 
//    Log::debug('$uploaded_file:'.$uploaded_file);
    $orgName = date('YmdHis') ."_".$request->file('csvdata')->getClientOriginalName();
//    Log::debug('$orgName:'.$orgName);
    $spath = storage_path('app');
//    Log::debug('$spath:'.$spath);
    $path = $spath.'/'.$request->file('csvdata')->storeAs('',$orgName);
//    Log::debug('$path:'.$path);

    // CSVファイル（エクセルファイルも可）を読み込む
    //$result = (new FastExcel)->importSheets($path); //エクセルファイルをアップロードする時はこちら
    $result = (new FastExcel)->configureCsv(',')->importSheets($path); // カンマ区切りのCSVファイル時
    // DB登録処理
    $count = 0; // 登録件数確認用
    foreach ($result as $row) {
      foreach($row as $item){
        // ここでCSV内データとテーブルのカラムを紐付ける（左側カラム名、右側CSV１行目の項目名）
        $param = [
          'name' => $item["name"],
          'post7' => $item["post7"],
          'address' => $item["address"],
          'tell' => $item["tell"],
          'phone' => $item["phone"],
          'email' => $item["email"],
        ];
        $param = mb_convert_encoding($param, "UTF-8", "SJIS", "email");
        // 次にDBにinsertする（更新フラグなどに対応するため１行ずつinsertする）
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);
        DB::table('yubins')->insert($param);
        $count++;
      }
    }
    return redirect('/yubins');
  }
  
  public function csvexport(Request $request)
    {
        $headers = [ //ヘッダー情報
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=csvexport.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
 
        $callback = function() 
        {
            
            $createCsvFile = fopen('php://output', 'w'); //ファイル作成
            
            $columns = [ //1行目の情報
                'name',
                'post7',
                'address',
                'tell',
                'phone',
                'email',
            ];
 
            mb_convert_variables('SJIS-win', 'UTF-8', $columns); //文字化け対策
    
            fputcsv($createCsvFile, $columns); //1行目の情報を追記
 
            $bookingCurve = DB::table('yubins');  // データベースのテーブルを指定
 
            $bookingCurveResults = $bookingCurve  //データベースからデータ取得
                ->select(['name'
                , 'post7','address','tell','phone','email' 
                ,DB::raw('sum(email) as email')])
                ->groupby('name')
                ->get();
        
            foreach ($bookingCurveResults as $row) {  //データを1行ずつ回す
                $csv = [
                    $row->name,  //オブジェクトなので -> で取得
                    $row->post7,
                    $row->address,
                    $row->tell,
                    $row->phone,
                    $row->email,
                ];
 
                mb_convert_variables('SJIS-win', 'UTF-8', $csv); //文字化け対策
 
                fputcsv($createCsvFile, $csv); //ファイルに追記する
            }
            fclose($createCsvFile); //ファイル閉じる
        };
       
        return response()->stream($callback, 200, $headers); //ここで実行
        return redirect('/yubins'); 
    }
  
    
}
