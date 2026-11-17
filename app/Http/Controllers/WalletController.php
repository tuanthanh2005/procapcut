<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    /**
     * Show Wallet / Top-up page
     */
    public function index()
    {
        $user = auth()->user();
        $bankId = Setting::getValue('bank_id', 'MB');
        $accountNo = Setting::getValue('bank_account_no', '0987654321');
        $accountName = Setting::getValue('bank_account_name', 'TRAN THI THUY TRANG');

        // Syntax: NAPW{user_id} or NAP {user_id}
        $transferContent = 'NAPW ' . $user->id;

        $transactions = DB::table('wallet_transactions')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $presets = [50000, 100000, 200000, 500000, 1000000, 2000000];

        return view('wallet', compact('user', 'bankId', 'accountNo', 'accountName', 'transferContent', 'transactions', 'presets'));
    }

    /**
     * Real-time balance check API for automatic live updating on wallet page
     */
    public function checkBalance()
    {
        $user = auth()->user()->fresh();

        return response()->json([
            'success' => true,
            'balance' => (int) ($user->balance ?? 0),
            'balance_formatted' => number_format((int) ($user->balance ?? 0), 0, ',', '.') . 'đ',
            'total_spent' => (int) ($user->total_spent ?? 0),
            'total_spent_formatted' => number_format((int) ($user->total_spent ?? 0), 0, ',', '.') . 'đ',
        ]);
    }
}
