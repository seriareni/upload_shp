<?php

namespace App\Http\Controllers;

use App\Models\File;
use GuzzleHttp\Psr7\FnStream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Integer;
use Zip;
use Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Pacuna\Schemas\Facades\PGSchema;

class UploadController extends Controller
{
    //
    public function index()
    {
        $schemas = DB::select("SELECT schema_name FROM information_schema.schemata where schema_name not like 'information_schema' and schema_name not like 'pg_%' and schema_name not like 'public'");
        return view('upload_data', ['schemas' => $schemas]);
    }

    public function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        return rmdir($dir);
    }

    public function uploadData(Request $request)
    {
        $schema = Input::get('data');
        $schemaName = str_replace(" ", "_", $schema);
        $schemaNameNew = $schemaName;
        $uploadedFile = $request->file('zip_file');
        $zipName = time() . '_' . $uploadedFile->getClientOriginalName();
        $uploadedFile->move('uploads/', $zipName);

        $zip = Zip::open(public_path('uploads/' . $zipName));
        //      $zip->extract(public_path().'uploads\\'.time().$uploadedFile->getClientOriginalName());
        $filenameZip = public_path('uploads/' . time() . $uploadedFile->getClientOriginalName());

        //ekstrak zip
        $zip->extract($filenameZip);
        $zip->close();

        //      Menghapus file zip pada public
        unlink(public_path() . '\\uploads\\' . $zipName);

        foreach (glob($filenameZip . "/*.prj") as $filename) {
            $file_prj = str_replace("/", "\\", $filename);
        }

        //proses mengambil nilai epsg pada data dengan fungsi python
//        $epsg = (int) shell_exec("python C:\Users\USER\Documents\Python\getEPSG.py ".$file_prj);
        $epsg = (int) shell_exec("python"." ".public_path()."\scripts\getEPSG.py ".$file_prj);

        // globe-> mengambil isi dari folder yang dipilih
        foreach (glob($filenameZip . "/*.shp") as $filename) {
            $filename_new = str_replace("/", "\\", $filename);
            $table_name = basename($filename_new, ".shp");
            $table_name_new = str_replace(" ", "_", $table_name);
        }

//        dd($epsg,$filename_new, $schemaNameNew,$table_name_new);

//      menyimpan ke database
       dd('shp2pgsql -I -s '. $epsg .' '. $filename_new . ' ' . $schemaNameNew . '.' . $table_name_new . ' | psql -U postgres -d sistem_upload');
       shell_exec('"shp2pgsql" -I -s '. $epsg .' '. $filename_new . ' ' . $schemaNameNew . '.' . $table_name_new . ' | "psql" -U postgres -W postgres -p 5432 -d sistem_upload');

        $this->deleteDirectory($filenameZip);

        return redirect('upload_data')->with('success','upload data success !!');
    }
}
