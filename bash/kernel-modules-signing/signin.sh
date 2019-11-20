#!/bin/sh

readonly hash_algo='sha256'
readonly key='/root/module-signing/MOK.priv'
readonly x509='/root/module-signing/MOK.der'

readonly name="$(basename $0)"
readonly esc='\\e'
readonly reset="${esc}[0m"

green() { local string="${1}"; echo "${esc}[32m${string}${reset}"; }
blue() { local string="${1}"; echo "${esc}[34m${string}${reset}"; }
log() { local string="${1}"; echo "[$(blue $name)] ${string}"; }

# The exact location of `sign-file` might vary depending on your platform.

[ -z "${KBUILD_SIGN_PIN}" ] && read -p "Passphrase for ${key}: " KBUILD_SIGN_PIN
export KBUILD_SIGN_PIN

for module in $(dirname $(modinfo -n vboxdrv))/*.ko; do
  /usr/src/kernels/5.3.11-200.fc30.x86_64/scripts/sign-file  "${hash_algo}" "${key}" "${x509}" "${module}"
done
