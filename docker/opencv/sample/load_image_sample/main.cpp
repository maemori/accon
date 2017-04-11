/**
 * OpenCV3 描画サンプル： 画像の読み込みとリサイズ
*/

#include <opencv2/imgproc/imgproc.hpp>
#include <opencv2/highgui/highgui.hpp>

using namespace std;

int main( int argc, char** argv )
{
    // 画像のファイル
    string filename = "sample_01.jpg";

    // 画像を読み込み
    cv::Mat img = cv::imread(filename, cv::IMREAD_COLOR);

    // 画像を縮小（元の画像の20%）
    cv::Mat resizeImg(img.rows / 5, img.cols / 5, CV_8UC3, cv::Scalar::all(0));
    cv::resize(img, resizeImg, resizeImg.size(), cv::INTER_CUBIC);

    //　ウィンドウの生成
    string window_name = "TestWindow";
    cv::namedWindow(window_name, cv::WINDOW_AUTOSIZE);

    //　ウィンドウに画像を表示
    cv::imshow(window_name, resizeImg);

    // ユーザが入力するまで待機
    cv::waitKey(0);

    // ウィンドウの破棄（関連するメモリの解放）
    cv::destroyAllWindows();

    // 終了
    return 0;
}
