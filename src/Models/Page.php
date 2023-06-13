<?php

namespace ITHilbert\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = true;

    public static function getURL($page){
        //Domain Laden
        $url = env('APP_URL');
        if (substr($url, -1) !== '/') {
            $url .= '/';
        }
        //Domain soll mit / abschließen

        $prefix = config('pages.route_show_pages_prefix');
        //Prüfen ob es ein prefix gibt
        if($prefix != '' && $prefix != '/'){
            $url .= $prefix;
            //Prefix mit / abschließen
            if (substr($url, -1) !== '/') {
                $url .= '/';
            }
            //Domain + prefix + url aus DB
            $url .= $page->url;
        }else{
            //Domain + url aus DB
            $url .= $page->url;
        }

        return $url;
    }

}
