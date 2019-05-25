<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class SaveRooms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rooms:save {fileName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        function getCutNum($idCard){
            $num = sprintf('%02s', abs(crc32($idCard))%3);
            return $num;
        }

        $fileName = $this->argument('fileName');

        $filePath = 'F:\download\houseList\2000W\\' . $fileName . '.csv';

        if(!file_exists($filePath))return $this->show($filePath . ' not exists');

        $file = fopen($filePath , 'r');
        $row = 1;
        $key = 'roomsRows:' . $fileName;
        while (!feof($file)){

            $arr = fgetcsv($file) ;
//            echo $arr[4] . PHP_EOL;
            $idCard = $arr[4];
            $id = $arr[32];
            $name = $arr[0];
//            var_dump($arr);
            if(strlen($idCard) < 17 || strlen($idCard) > 18)continue;

            $rowNum = Redis::get($key);
            if($row <= $rowNum){
                if($row % 1000 == 0)$this->show($row , $rowNum);
                $row ++;
                continue;
            }


            Redis::setex( $key , 3600 * 24 ,  $row);
            if($row % 1000 == 0)$this->show($row , $id , $name , $idCard);
            $row ++;
            try{
                $ret = DB::table('test.rooms_' . getCutNum($idCard))->insert(
                    ['id' => $id, 'name' => $name , 'cardNo' => $idCard]
                );
            }catch (QueryException $e){

            }

        }
        echo $row;
        fclose($file);
    }

    protected function show($str1 , $str2 = '' , $str3 = '', $str4 = ''){
        echo $str1 . ' ' . $str2 .' ' . $str3 . ' ' . $str4 . ' '. PHP_EOL;
    }
}
