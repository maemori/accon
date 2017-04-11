#----- プロジェクト情報 ----
# プロジェクト名
set(PROJECT_NAME load_image_sample_01)
# ビルドターゲットのソースを指定
set(SOURCE_FILES main.cpp)

#----- ビルド設定 -----
# プロジェクトの言語を指定
project(${PROJECT_NAME} CXX)

#----- OpenCVの設定 ----
# OpenCvのincludeディレクトリを指定（環境に合わせて変更）

# ソリューション名を指定
project(${PROJECT_NAME})
# 実行ファイル名とソース指定
add_executable(${PROJECT_NAME} ${SOURCE_FILES})


# OpenCVインストールパスを指定
set(OpenCV_DIR "/usr/local/share/OpenCV")
# OpenCVのパッケージを探す
find_package(OpenCV REQUIRED)
# OpenCVが見つかった場合のみ設定を行う
if(OpenCV_FOUND)
# インクルードパスを指定
include_directories(${OpenCV_INCLUDE_DIRS})
# リンクするライブラリ指定
target_link_libraries(${PROJECT_NAME} ${OpenCV_LIBS})
endif(OpenCV_FOUND)

#----- ビルド ----
