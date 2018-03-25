<?php
namespace BearClaw\Warehousing;
//namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseOrderService extends Controller
{
    private static $password = 'test123456';
    private static $username = 'interview-test@cartoncloud.com.au';
    private static $url = 'https://api.cartoncloud.com.au/CartonCloud_Demo/PurchaseOrders/{id}?version=5&associated=true';

    public function __construct()
    {

    }
    
    public function execute(Request $request){
        $response = array();
        $response['result'] = $this->calculateTotals($request->purchase_order_ids);       
        return $response;
    }

    public function calculateTotals($ids)
    {
        $res = $this->processData($ids);
        $response = array();
        foreach($res as $key=>$value)
        {
            $response[] = array('product_type_id' => $key, 'total' => array_sum($res[$key]));
        }
        return $response;
    }

    private function processData($ids)
    {
        $outArgs = array();
        foreach($ids as $id)
        {
            $res = $this->fetchData($id);
            $obj =  json_decode($res);
            $obj = (array) $obj;
            foreach($obj['data']->PurchaseOrderProduct as $key => $value){
                if(isset( $outArgs[ $obj['data']->PurchaseOrderProduct[$key]->product_type_id ] ))
                {
                    $outArgs[ $obj['data']->PurchaseOrderProduct[$key]->product_type_id ][] = $this->calProducType( $obj['data']->PurchaseOrderProduct[$key] );
            
                }else{
                    $outArgs[ $obj['data']->PurchaseOrderProduct[$key]->product_type_id ] = array();
                    $outArgs[ $obj['data']->PurchaseOrderProduct[$key]->product_type_id ][] = $this->calProducType( $obj['data']->PurchaseOrderProduct[$key] );
                }
                
            }
        }
        return $outArgs;
    }

    private function calProducType($product)
    {
        if ($product->product_type_id % 2 == 0) {
            // id 2 or even
            $res = $product->unit_quantity_initial * $product->Product->volume;
        }else{
           // id 1 & 3  
           $res = $product->unit_quantity_initial * $product->Product->weight;  
        }
        return $res;
    }

    private function fetchData($id)
    {
        $link = str_replace("{id}", $id, self::$url);
      
        $process = curl_init();
        curl_setopt($process, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json'));
        curl_setopt($process, CURLOPT_USERPWD, self::$username . ":" . self::$password);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_URL,$link);
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }    
    
}

?>