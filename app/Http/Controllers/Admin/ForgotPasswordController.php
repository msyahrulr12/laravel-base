<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordChangeRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use App\Service\MailService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ForgotPasswordController extends Controller
{
    public function requestForm(Request $request)
    {
        return view('pages.admin.forgot-password');
    }

    public function verifyEmail(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        if (!$user) {
            Alert::error('Email tidak ditemukan!', sprintf('Email %s tidak terdaftar', $request->get('email')));
            return back();
        }

        if ($user->forgot_password_tried > 3) {
            if (Carbon::now()->diffInHours($user->forgot_password_requested_at) < 1) {
                Alert::error('Anda Tidak Bisa Melakukan Lupa Password!', sprintf('Anda sudah melakukan lupa password sebanyak %d kali, lupa password aktif selama 1 jam kedepan', 3));
                return back();
            }

            $user->update([
                'forgot_password_tried' => 0,
                'forgot_password_requested_at' => null
            ]);
        }

        $user->update([
            'forgot_password_tried' => $user->forgot_password_tried + 1,
            'forgot_password_requested_at' => new \DateTime(),
            'forgot_password_expired_at' => Carbon::now()->addMinutes(30)
        ]);

        $token = $user->generateForgotPasswordToken();
        $user->forgot_password_token = $token;
        $user->update([
            'forgot_password_token' => $token
        ]);

        $link = route('admin.forgot-password.verify-token').'?token='.$token;

        MailService::forgotPassword($user->email, $user->name, $link);

        Alert::success('Verifikasi Lupa Password Berhasil!', sprintf('Silakan cek inbox pada akun email %s', $request->get('email')));
        return redirect()->route('admin.login');
    }

    public function verifyToken(Request $request)
    {
        $token = $request->query->get('token');
        $user = User::where('forgot_password_token', $token)->first();
        if (!$user) {
            Alert::error('Verifikasi Lupa Password Gagal!', 'Token yang Anda masukkan salah');
            return back();
        }

        if (Carbon::now()->diffInMinutes($user->forgot_password_expired_at) > 30) {
            Alert::error('Request Lupa Password Gagal!', 'Token telah kadaluwarsa');
            return back();
        }

        $verifyToken = $user->verifyForgotPasswordToken($token);
        if (!$verifyToken) {
            Alert::error('Verifikasi Lupa Password Gagal!', 'Token yang Anda masukkan salah');
            return back();
        }

        return view('pages.admin.forgot-password-change', [

        ]);
    }

    public function changePassword(ForgotPasswordChangeRequest $request)
    {
        $token = $request->get('token');
        if (!$token) {
            Alert::error('Ubah Password Gagal!', 'Token tidak boleh kosong');
            return back();
        }

        $user = User::where('forgot_password_token', $token)->first();
        if (!$user) {
            Alert::error('Verifikasi Lupa Password Gagal!', 'Token yang Anda masukkan salah');
            return back();
        }

        if (Carbon::now()->diffInMinutes($user->forgot_password_expired_at) > 30) {
            Alert::error('Request Lupa Password Gagal!', 'Token telah kadaluwarsa');
            return back();
        }

        $verifyToken = $user->verifyForgotPasswordToken($token);
        if (!$verifyToken) {
            Alert::error('Verifikasi Lupa Password Gagal!', 'Token yang Anda masukkan salah');
            return back();
        }

        $newPassword = $request->get('new_password');
        $reEnterNewPassword = $request->get('re_enter_new_password');
        if ($newPassword !== $reEnterNewPassword) {
            Alert::error('Ubah Password Gagal!', 'Password dengan ulangi password tidak sesuai');
            return back();
        }

        $user->update([
            'password' => bcrypt($newPassword),
            'forgot_password_requested_at' => null,
            'forgot_password_code' => null,
            'forgot_password_expired_at' => null,
            'forgot_password_tried' => 0
        ]);

        Alert::success('Ubah Password Berhasil!', 'Silakan melakukan login ulang');
        return redirect()->route('admin.login');
    }
}
