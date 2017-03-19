#!/usr/bin/env bash

workspace_dir=/develop/workspace

progress_del() {
  if [ -e $workspace_dir"/PROGRESS"* ]; then
    rm -f $workspace_dir"/PROGRESS"*
  fi
  return 0
}

progress_start() {
  progress_del
  status_message="/PROGRESS_[START]"
  echo $status_message
  touch $workspace_dir$status_message
  return 0
}

progress() {
  progress_del
  status_message="/PROGRESS_"$1
  echo $status_message
  touch $workspace_dir$status_message
  return 0
}

progress_end() {
  progress_del
  status_message="/PROGRESS_[INSTALLATION_COMPLETE]"
  echo $status_message
  touch $workspace_dir$status_message
  return 0
}

case "$1" in
    start)
        progress_start
        ;;
    progress)
        progress $2
        ;;
    end)
        progress_end
        ;;
    *)
        echo "Usage: $0 {start|run|end}"
        exit 3
esac

exit $?
