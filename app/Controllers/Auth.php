<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use App\Models\UserModel;

class Auth extends Controller
{
    protected $helpers = ['url'];

    public function googleLogin()
    {
        $googleClient = Services::googleClient();
        $googleClient->setHttpClient(new \GuzzleHttp\Client([
            'verify' => 'D:\Laragon\laragon\etc\ssl\cacert.pem' // Đường dẫn tới tệp chứng chỉ CA
        ]));
        $authUrl = $googleClient->getAuthorizationUrl();
        session()->set('oauth2state', $googleClient->getState());
        return redirect()->to($authUrl);
    }

    public function googleCallback()
    {
        $googleClient = Services::googleClient();

          // Thiết lập chứng chỉ CA hoặc bỏ qua kiểm tra SSL
          $googleClient->setHttpClient(new \GuzzleHttp\Client([
            'verify' => 'D:\Laragon\laragon\etc\ssl\cacert.pem' // Đường dẫn tới tệp chứng chỉ CA
        ]));

        $state = $this->request->getGet('state');
        $code = $this->request->getGet('code');

        if ($state !== null && session()->get('oauth2state') === $state) {
            session()->remove('oauth2state');
            try {
                $token = $googleClient->getAccessToken('authorization_code', ['code' => $code]);
                $googleUser = $googleClient->getResourceOwner($token)->toArray();

                // Khởi tạo model
                $userModel = new UserModel();
                // Tìm người dùng trong database bằng google_id hoặc Username (email)
                $existingUser = $userModel->findUserByGoogleId($googleUser['sub']) ?? $userModel->findUserByUsername($googleUser['email']);

                if ($existingUser) {
                    // Người dùng đã tồn tại, hiển thị thông tin
                    $data = [
                        'username' => $existingUser['Username'], // Đổi tên trường nếu cần
                        // Thêm các dữ liệu khác cần thiết để truyền qua view
                    ];
                    return view('Home', $data);
                } else {
                    // Người dùng không tồn tại, tạo mới
                    $newUserData = [
                        'Username' => $googleUser['email'], // Sử dụng email làm Username
                        'Pass' => '', // Hoặc bất kỳ giá trị nào bạn muốn, có thể để trống
                        'google_id' => $googleUser['sub'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'role_id' => '5', // Hoặc giá trị phù hợp với hệ thống của bạn
                    ];

                    $userModel->insert($newUserData);
                    $data = [
                        'username' => $googleUser['email'], // Sử dụng email làm Username
                        // Thêm các dữ liệu khác cần thiết để truyền qua view
                    ];
                    return view('Home', $data);              
                }

            } catch (\Exception $e) {
                // Xử lý lỗi khi không lấy được token hoặc thông tin user
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            // Xử lý lỗi nếu state không khớp
            echo 'Invalid state';
        }
    }
}
