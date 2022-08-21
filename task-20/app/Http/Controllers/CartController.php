<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function index()
    {
        $cart = Session::get('cart', []);
        $totalCost = Session::get('totalCost', 0.0);

        foreach ($cart as &$order) {
            $order = json_decode($order);
        }

        return view('cart')
            ->with(compact('cart'))
            ->with(compact('totalCost'));
    }

    public function removeFromCart()
    {
        Session::flush();

        return redirect('/');
    }

    public function addToCart(Request $request)
    {
        $product = Product::query()->where('id', $request->get('productID'))->first()->toArray();

        $services = [];
        if ($request->get('servicesID') !== null) {
            foreach ($request->get('servicesID') as $serviceID) {
                $services[] = Service::query()->where('id', $serviceID)->first()->toArray();
            }
        }

        $order = new Order($product, $services);

        $this->updateCart($order);

        return redirect()->back();
    }

    public function updateCart(Order $order): void
    {
        $this->updateTotalCost($order);

        Session::push('cart', json_encode($order));
    }

    public function updateTotalCost(Order $order): void
    {
        $totalCost = Session::get('totalCost', 0.0);
        $totalCost += $order->getCost();

        Session::put('totalCost', $totalCost);
    }

}
