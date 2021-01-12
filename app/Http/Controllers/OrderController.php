<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::query()
            ->with(['assign', 'from']);

        if ($request->has('type') && $request->type == 'in') {
            $orders->where('assign_id', Auth::id());
        } else if ($request->has('type') && $request->type == 'out') {
            $orders->where('from_id', Auth::id());
        }

        return datatables()->eloquent($orders)->toJson();
    }

    /**
     * Show the order
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function in()
    {
        return view('orders.in');
    }

    /**
     * Show the request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function out()
    {
        return view('orders.out');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create', [
            'users' => User::where('role', 'developer')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'       => 'required',
            'category'    => 'required|in:technical,nontechnical',
            'assign'      => 'required',
            'description' => 'required'
        ]);

        $latest = Order::orderBy('wo_number', 'desc')->first();

        if (! $latest) {
            $wo_number = 'WO-0001';
        } else {
            $number = preg_replace("/[^0-9\.]/", '', $latest->wo_number);
            $wo_number = 'WO-' . sprintf('%04d', $number + 1);
        }

        $order = new Order;
        $order->wo_number = $wo_number;
        $order->title = $request->title;
        $order->category = $request->category;
        $order->assign_id = $request->assign;
        $order->from_id = Auth::id();
        $order->description = $request->description;
        $order->status = 'open';
        $order->save();

        return back()->with('status', 'Work Order telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $woNumber
     * @return \Illuminate\Http\Response
     */
    public function show($woNumber)
    {
        $order = Order::query();

        $order->where(function($query) use ($woNumber) {
            $query->where('assign_id', Auth::id());
            $query->where('wo_number', $woNumber);
        });

        $order->orWhere(function($query) use ($woNumber) {
            $query->orWhere('from_id', Auth::id());
            $query->where('wo_number', $woNumber);
        });

        return view('orders.show', [
            'order' => $order->firstOrFail()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $woNumber
     * @return \Illuminate\Http\Response
     */
    public function editStatus($woNumber)
    {
        $order = Order::query();

        $order->where('assign_id', Auth::id());
        $order->where('wo_number', $woNumber);

        return view('orders.edit_status', [
            'order' => $order->firstOrFail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $woNumber
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $woNumber)
    {
        $this->validate($request, [
            'status' => 'required|in:open,progress,finish'
        ]);

        $order = Order::where('assign_id', Auth::id())->where('wo_number', $woNumber)->firstOrFail();

        $order->status = $request->status;

        $order->save();

        return redirect()->route('order.in')->with('status', 'Work Order telah diubah');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $woNumber
     * @return \Illuminate\Http\Response
     */
    public function edit($woNumber)
    {
        $order = Order::query();

        $order->where('from_id', Auth::id());
        $order->where('wo_number', $woNumber);

        return view('orders.edit', [
            'order' => $order->firstOrFail(),
            'users' => User::where('role', 'developer')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $woNumber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $woNumber)
    {
        $this->validate($request, [
            'title'       => 'required',
            'category'    => 'required|in:technical,nontechnical',
            'assign'      => 'required',
            'description' => 'required'
        ]);

        $order = Order::where('from_id', Auth::id())->where('wo_number', $woNumber)->firstOrFail();

        $order->title = $request->title;
        $order->category = $request->category;
        $order->assign_id = $request->assign;
        $order->description = $request->description;
        $order->save();

        return redirect()->route('order.out')->with('status', 'Work Order telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $woNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy($woNumber)
    {
        $order = Order::where('from_id', Auth::id())->where('wo_number', $woNumber)->firstOrFail();

        $order->delete();

        return redirect()->route('order.out')->with('status', 'Work Order telah dihapus');
    }
}
