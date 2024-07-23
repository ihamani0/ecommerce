<?php

namespace App\Http\Controllers\Frontend;

use App\Constants\Constants;
use App\Contracts\Backend\OrderInterface;
use App\Contracts\Frontend\LandingPageInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;



class ProfileUserController extends Controller
{

    public function __construct( public OrderInterface $order)
    {}

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view("frontend.pages.account" , [
        ]);
    }

    public function dashboard_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view("frontend.pages.Profile.dashboard" , [
        ]);
    }



    public function track_orders_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view("frontend.pages.Profile.track-orders");
    }

    public function submit_track_order(Request $request)
    {
        $request->validate([
           "order_number" => ['required' , 'min:15' , 'max:15' , 'regex:/^Od[a-zA-Z0-9]{13}$/']
        ]);
        $order = $this->order->getOrdersDetailsByOrderNumber($request->order_number);

        Session::put("Order",$order);
        return redirect()->route(Constants::USER_ACCOUNT_Get_Track_Orders);
    }

    public function get_track_order()
    {
        $Order = Session::get('Order'); // this session put from the method up we send post and retrieve the data and put this data in session
        return view("frontend.pages.Profile.get-track-order" , [
            "Order" =>  $Order
        ]);
    }


    public function address_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view("frontend.pages.Profile.address-details");
    }


    public function account_detail_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view("frontend.pages.Profile.account-details");
    }

    public function change_password_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view("frontend.pages.Profile.change-password");
    }

    public function delete_account_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view("frontend.pages.Profile.delete-account");
    }


    /*Order*/
    public function orders_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        return view("frontend.pages.Profile.orders" , [
            'Orders' => $this->order->getOrdersPendingBelongsToUser(auth()->user()->id),
        ]);
    }

    public function getOrderDetails(Request $request): \Illuminate\Http\JsonResponse
    {
        $Order = $this->order->getOrdersDetailsByOrderNumber($request->orderId) ;
        $data = $Order->created_at->format('l, d-m-Y');
        $orderItems = $this->order->getOrdersItemsByOrderId($Order->id);
        return response()->json(['order'=>$Order , 'date' =>$data , 'orderItems' => $orderItems]);
    }

    public function orders_return_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view("frontend.pages.Profile.return-orders" , [
            'OrdersReturn' => $this->order->getOrdersReturnBelongsToUser(auth()->user()->id),
        ]);
    }
    public function orders_return(Request $request): RedirectResponse
    {
        //1- turn on flag in order table
            $this->order->changeReturnStatusOrder($request);
        //2- turn on flag in order item
            $this->order->changeReturnStatusOrderItems($request->ItemsReturn);
        //3- change status of order to return in user

        //4- change status order in admin dashboard and vendor
            return redirect()->route(Constants::USER_ACCOUNT_DASHBOARD);
         //dd($request->all());
    }


    public function CreateInvoice($orderId): \Illuminate\Http\Response
    {

        $Order = $this->order->getOrdersDetailsByOrderNumber($orderId);

        $data = $Order->created_at->format('l, d-m-Y');

        $orderItems = $this->order->getOrdersItemsByOrderId($Order->id);

        $pdf = Pdf::loadView('frontend.pages.Profile.InvoicePdf',['order'=>$Order , 'date' =>$data , 'OrderItems' => $orderItems]
        )->setPaper('a4')
        ->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);

        return $pdf->download(Carbon::now().'-Invoice.pdf');
    }





    /**
     * Display the user's profile form.
     */

    /*public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }*/

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        try {
            //make update
            $test = $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            event(new Registered($request->user()));
            $request->user()->save();

            return redirect()->intended(route('user.account'))->with(["success"=> "The Profile Has been update Successfully"]);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        if ( !  Hash::check( $request->password , auth()->user()->password)  ){
            return back()->with(["error"=> "The old password doesn't match"]);
        }

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
