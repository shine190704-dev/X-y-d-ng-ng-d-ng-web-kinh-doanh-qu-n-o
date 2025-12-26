<?php

class AuthController {


    // HÀM LOAD VIEW
    private function loadView($viewFile, $pageTitle = '', $data = []) {
        global $title;
        $title = $pageTitle ? "$pageTitle - MIJURAI" : "MIJURAI";

        extract($data);
        require dirname(__DIR__) . '/views/' . $viewFile;
    }


    // ĐĂNG NHẬP
    public function login() {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            require_once dirname(__DIR__) . '/models/UserModel.php';
            $userModel = new UserModel();

            $email    = trim($_POST['email'] ?? '');
            $matkhau  = trim($_POST['matkhau'] ?? '');
            $user     = $userModel->getUserByEmail($email);
      
            if ($user) {
                $dbPass = $user['MatKhau'];
                $match = password_verify($matkhau, $dbPass) || ($dbPass === $matkhau);
                   
                if ($match) {
                    $_SESSION['KhachHangID'] = $user['KhachHangID'];
                    $_SESSION['Email']       = $user['Email'];
                    $_SESSION['HoTen']       = $user['HoTen'];

                    header("Location: /TNU");
                     
                    exit;
                } else {
                    $error = "Sai email hoặc mật khẩu!";
                }

            } else {
                $error = "Tài khoản không tồn tại!";
            }
        }

        $this->loadView("auth/login.php", "Đăng nhập", [
            "error" => $error
        ]);
    }


 
}
