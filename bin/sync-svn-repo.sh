#!/bin/bash

rsync -avz ./signal-flags/* ../signal-flags-wp-svn/trunk/ --del
