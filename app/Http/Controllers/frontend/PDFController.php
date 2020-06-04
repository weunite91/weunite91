<?php
namespace App\Http\Controllers\frontend;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Investor;
use App\Model\Invoice;
use PDF;
  
class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $customPaper = array(0,0,720,780);
        $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        $pdf = PDF::loadView('frontend.pages.home.myPDF', $data)
                ->setPaper( $customPaper, 'portrait');
        //return view('frontend.pages.home.myPDF');
        return $pdf->download('itsolutionstuff.pdf');
    }
    public function viewinveseterreciept($txnid)
    {
        $session = session()->all();
        $objOffered=new Investor(); 
        $result=$objOffered->getTransactionDetail($txnid);
        $customPaper = array(0,0,720,780);
        
        $data = ['title' => 'Welcome to WeUnite91'];
        $data['txnid'] =$txnid;
        $data['result']=$result[0];
        $data['userdetails']=$session;

        $date=$result[0]->active_date;
        $finaldate= date('d-M-Y', strtotime($date. ' + '.($result[0]->days-1).' days'));
        
    
        $data['revokedate']=$finaldate;

       // return view('frontend.pages.home.recieptPDF', $data);
        $pdf = PDF::loadView('frontend.pages.home.recieptPDF', $data)
                ->setPaper( $customPaper, 'portrait')
                ->setWarnings(false);
        
        return $pdf->download('weunite91_reciept.pdf');
    }

    public function view_invoice($txnid)
    {
        $session = session()->all();
        $user_id=$session['logindata'][0]['id'];
        $objInvoice=new Invoice();
        $result= $objInvoice->get_invoice($txnid,$user_id);
      
       
        
        $data = ['title' => 'Welcome to WeUnite91'];
        $data['invoice']=$result[0];
        $data['txnid'] =$txnid;
     
      
        return view('frontend.pages.home.invoicePDF', $data);
         $customPaper = array(0,0,720,780);
        $pdf = PDF::loadView('frontend.pages.home.invoicePDF', $data)
                ->setPaper( $customPaper, 'portrait')
                ->setWarnings(false);
        
        return $pdf->download('invoice.pdf');
    }
}
?>