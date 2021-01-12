<?php


namespace App\Models;


use App\core\Model;
use App\Helpers\Debugger;
use GuzzleHttp\Client;

class Rate extends Model
{
    protected static $tableName = 'rates';

    protected static $fillable = ['cur_id', 'on_date', 'rate'];

    public static function getCurRate($curId, $onDate)
    {
        $res = self::selectWithConditions([
            'cur_id' => $curId,
            'on_date' => $onDate
        ]);
        if (!$res) {
            $client = new Client();
            $res = $client->get('https://www.nbrb.by/api/exrates/rates/' . $curId, [
                'query' => [
                    'ondate' => $onDate
                ]
            ]);
            $res = json_decode($res->getBody()->getContents(), true);
            static::create([
                'cur_id' => $curId,
                'on_date' => $onDate,
                'rate' => $res['Cur_OfficialRate'],
            ]);
            Debugger::debug($res);
        }

    }
}