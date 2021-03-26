<?php
namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Libraries\Lumen;

class BaseController extends Controller 
{
    /**
     * our application library
     */
    public $lumen ;

    public function __construct(Request $request){
        
        /** define Lumen as global Library */
        $this->lumen = new Lumen();

    }

}