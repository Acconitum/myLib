# get all enabled services
systemctl list-unit-files | grep enabled

# get all running services
systemctl | grep running

# enable/disable service
systemctl enable/disable dhcpcd # example

