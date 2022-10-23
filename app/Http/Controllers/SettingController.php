<?php

namespace App\Http\Controllers;

use App\Boutique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('setting.app');
    }

    public function export_db()
    {
        $DbName = env('DB_DATABASE');
        $get_all_table_query = "SHOW TABLES ";
        $result = DB::select(DB::raw($get_all_table_query));

        $prep = "Tables_in_$DbName";
        foreach ($result as $res){
            $tables[] =  $res->$prep;
        }


        $connect = DB::connection()->getPdo();

        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();


        $output = "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\nSTART TRANSACTION;\nSET time_zone = '+00:00';\n";
        foreach($tables as $table)
        {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";
            $statement = $connect->prepare($show_table_query);
            $statement->execute();
            $show_table_result = $statement->fetchAll();

            foreach($show_table_result as $show_table_row)
            {
                $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }
            $select_query = "SELECT * FROM " . $table . "";
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();

            for($count=0; $count<$total_row; $count++)
            {
                $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);
                $table_value_array = array_values($single_result);

                if($count == 0)
                {
                    // dd($table_value_array);
                    $output .= "\nINSERT INTO $table (";
                    $output .= "`" . implode("`, `", $table_column_array) . "`) VALUES \n(";
                    // $output .= "'" . implode("','", $table_value_array) . "'),";
                    $output .= $this->myimplode($table_value_array) . ")";
                }else {
                    $output .= "\n(";
                    // $output .= "'" . implode("','", $table_value_array) . "'),";
                    $output .= $this->myimplode($table_value_array) . ")";
                }

                if($count >= $total_row - 1){
                    $output .= ";\n";
                }else{
                    $output .= ",";
                }
            }
        }

        $output .= "\n\nCOMMIT;";

        $file_name = 'database_backup_' . date('d-m-Y_h-i') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));
        ob_clean();
        flush();
        readfile($file_name);
        unlink($file_name);
    }

    public function myimplode($my_array, $spacing = ", ")
    {
        $r = "";
        for($i = 0; $i < count($my_array); $i ++)
        {
            if($i >= count($my_array) - 1)
            {
                $r .= $this->put_quote($my_array[$i]) ? "'".$my_array[$i]."'" : $my_array[$i] ;
            }else{
                $r .= $this->put_quote($my_array[$i]) ? "'".$my_array[$i]."'" : $my_array[$i];
                $r.= $spacing;
            }
        }
        return $r;
    }

    public function put_quote($value){
        return gettype($value) == "string" || gettype($value) == "NULL" || gettype($value) == "unknown type" ? true : false;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
