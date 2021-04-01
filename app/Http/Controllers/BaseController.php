<?php
namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use app\Libraries\Core;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * our application library
     */
    public $core ;

    public function __construct(Request $request){
        
        /** define Core as global Library */
        $this->core = new Core();

    }
        
    /**
     * handling missing Method
     *
     * @return mixed
     */
    public function missingMethod(){

        return $this->core->setResponse();
    }

}