<?php
namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Lumen;

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
        
    /**
     * handling missing Method
     *
     * @return mixed
     */
    public function missingMethod(){

        return $this->lumen->setResponse();
    }

}