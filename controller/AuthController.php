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
      // ĐĂNG KÝ
    public function register() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            require_once dirname(__DIR__) . '/models/UserModel.php';
            $userModel = new UserModel();

            $hoten    = trim($_POST['hoten'] ?? '');
            $ngaysinh = trim($_POST['ngaysinh'] ?? '');
            $sdt      = trim($_POST['sdt'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $matkhau  = trim($_POST['matkhau'] ?? '');

            // Email trùng
            if ($userModel->getUserByEmail($email)) {
                return $this->loadView("auth/register.php", "Đăng ký", [
                    "error" => "Email đã tồn tại!"
                ]);
            }

            $userModel->createUser($hoten, $ngaysinh, $sdt, $email, $matkhau);

            header("Location: /TNU/auth/login");
            exit;
        }

        $this->loadView("auth/register.php", "Đăng ký");
    }

 public function account() {

        if (empty($_SESSION['Email'])) {
            header("Location: /TNU/auth/login");
            exit;
        }

        require_once dirname(__DIR__) . '/models/UserModel.php';
        $userModel = new UserModel();

        $user = $userModel->getUserByEmail($_SESSION['Email']);

        $this->loadView("auth/account.php", "Tài khoản của bạn", [
            "user" => $user
        ]);
    }

     // ĐĂNG XUẤT
    public function logout() {
        session_destroy();
        header("Location: /testmnm/auth/login");
        exit;
    }

}
