/**
 * OpenCV3 描画サンプル： 画像の読み込みとリサイズを行って保存
*/

#include <opencv2/imgproc/imgproc.hpp>
#include <opencv2/highgui/highgui.hpp>

using namespace std;

int main( int argc, char** argv )
{
    // 入力画像のファイル
    string filename = "sample_01.jpg";

    // 画像を読み込み
    cv::Mat img = cv::imread(filename, cv::IMREAD_COLOR);

    // 画像を縮小（元の画像の20%）
    cv::Mat resizeImg(img.rows / 5, img.cols / 5, CV_8UC3, cv::Scalar::all(0));
    cv::resize(img, resizeImg, resizeImg.size(), cv::INTER_CUBIC);

    // 出力画像のファイル
    string outputFilename = "output.jpg";

    // 画像の保存
    cv::imwrite(outputFilename, resizeImg);

    // 終了
    return 0;
}
