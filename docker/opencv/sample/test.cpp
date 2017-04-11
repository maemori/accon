#include <opencv2/core.hpp>
#include <opencv2/imgcodecs.hpp>
#include <opencv2/highgui.hpp>
#include <iostream>
/*
 * g++ test.cpp -I/usr/local/include/opencv2 -I/usr/local/include/opencv -L/usr/local/lib -lopencv_core -lopencv_imgcodecs -lopencv_highgui
 */

int main(int argc, const char* argv[])
{
  // 画像データをファイルから読み込む
  cv::Mat src = cv::imread("sample_01.jpg", cv::IMREAD_COLOR);

  // 画像の読み込みに失敗したらエラー終了する
  if(src.empty())
  {
    std::cerr << "Failed to open image file." << std::endl;
    return -1;
  }

  cv::namedWindow("image", cv::WINDOW_AUTOSIZE);
  cv::imshow("image", src);
  cv::waitKey(0);
  cv::destroyAllWindows();

  return 0;
}
