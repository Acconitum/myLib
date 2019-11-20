#!/bin/bash

name="$(getent passwd $(whoami) | awk -F: '{print $5}')"
out_dir='/root/module-signing'
mkdir ${out_dir}
openssl req -new -x509 -newkey rsa:2048 -keyout ${out_dir}/MOK.priv -outform DER -out ${out_dir}/MOK.der -days 36500 -subj "/CN=${name}/"
chmod 600 ${out_dir}/MOK*
