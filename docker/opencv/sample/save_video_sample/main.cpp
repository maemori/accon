/**
 * OpenCV3 描画サンプル： 動画を読み込みリサイズ＆モノクロ変換して保存
*/
#include <opencv2/imgproc/imgproc.hpp>
#include <opencv2/highgui/highgui.hpp>

using namespace std;

int main( int argc, char** argv )
{
    // 動画の入力ファイル
    string filename = "sample_01.mp4";

    //　動画の読み込み
    cv::VideoCapture capture(filename);
    if(!capture.isOpened())
        return -1;

    // 動画から取得するフレーム
    cv::Mat frame;

    // 表示用フレーム
    cv::Mat gray;

    //【動画の出力】ビデオライターの取得
    cv::VideoWriter writer;

    //【動画の出力】出力ファイル名
    string outputFilename = "output.mp4";

    //【動画の出力】FPSの設定
    double outputFps = capture.get(cv::CAP_PROP_FPS);

    //【動画の出力】書き込み画像サイズの取得
    cv::Size outputSize = cv::Size(
            capture.get(cv::CAP_PROP_FRAME_WIDTH) / 2,
            capture.get(cv::CAP_PROP_FRAME_HEIGHT) / 2
    );

    //【動画の出力】コーデックをMPEG-4に指定(mp4)
    int outputFourcc = cv::VideoWriter::fourcc('M','J','P','G');

    //【動画の出力】カラーはグレースケールに設定
    bool outputIsColor = false;

    /**
     * 【動画の出力】ビデオライターを開く
     *    outputFilename - 出力ファイル名
     *    outputFourcc - コーデック
     *    outputFps - 1秒あたりのフレーム数
     *    outputSize - ビデオフレームのサイズ
     *    outputIsColor - ビデオストリームがカラーか，グレースケールかを指定
     */
    writer.open(outputFilename, outputFourcc, outputFps, outputSize, outputIsColor);

    // ビデオライターの初期化を確認
    if (!writer.isOpened())
        return -1;

    // 動画の再生
    while(true) {
        // 動画から新しいフレームを取得
        capture >> frame;

        // 再生するフレームがなくなったら終了
        if(frame.empty()) break;

        // 画像を縮小（元の画像の50%）
        cv::Mat resizeFrame(outputSize.height, outputSize.width, CV_8UC3, cv::Scalar::all(0));
        cv::resize(frame, resizeFrame, resizeFrame.size(), cv::INTER_CUBIC);

        // フレームをグレースケールに変換
        cv::cvtColor(resizeFrame, gray, cv::COLOR_BGR2GRAY);

        //【動画の出力】動画にフレームを追加
        writer << gray;
    }

    // 終了
    return 0;
}
