<?php
require_once dirname(__DIR__) . '/models/ProductModel.php';

class SearchController {
    //truyền dữ liệu sang view
    private function loadViewWithData($viewFile, $pageTitle, $data = []) {
        global $title;
        $title = $pageTitle . " - MIJURAI";
        $base = dirname(__DIR__);
        if (!empty($data)) extract($data);
        require $base . '/views/' . $viewFile . '.php';
    }

    public function index() {
        $keyword = trim($_GET['keyword'] ?? '');
        
        $model = new ProductModel();
        $results = [];
        
        if (!empty($keyword)) {
            $keyword_lower = mb_strtolower($keyword, 'UTF-8');
            
            // Tìm kiếm theo tên sản phẩm
            $allProducts = $model->getAllProducts();
            foreach ($allProducts as $product) {
                $product_name_lower = mb_strtolower($product['TenSanPham'], 'UTF-8');
                // mb_strpos hỗ trợ tiếng Việt
               if ($product_name_lower === $keyword_lower) {
    $results[] = $product;
}
            }
        }
        
        $data = [
            'results' => $results,
            'keyword' => $keyword
        ];
        
        $pageTitle = !empty($keyword) ? "Kết quả tìm kiếm: " . htmlspecialchars($keyword) : "Tìm kiếm";
        $this->loadViewWithData('search/results', $pageTitle, $data);
    }
}
?>