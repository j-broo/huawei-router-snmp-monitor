#!/bin/bash
# Get SNMP stats from LTE Router

# To show meaningful MIB names, you will need to modify the SNMP config file. Open it with nano:
# sudo nano /etc/snmp/snmp.conf
# And comment out the first line:
# #mibs

# Connection variables
routerip=your_router_ip #replace with actual IP
snmpversion=2c
community=public
refreshtime=10
status=0

# Check if router is reachable
echo "Checking if router is reachable..."
while [ $status -ne 1 ]; do
        ping -c 1 $routerip > /dev/null
        if [ $? -eq  0 ]; then
                clear
		echo "Router Status: Online!"
                status=1
		sleep 2
        else
                clear
		echo "Router Status: Unreachable!"
		exit 1
        fi
done

#read -p "pause"

#sclear
echo -n "Fetching data, please wait..."

# Main loop
while true
do

# Get data from router and store in variables
model=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.1.1.0 | cut -d '"' -f 2)
enbid=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.3.2.0 | cut -d '"' -f 2)
pci=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.3.23.0 | cut -d '"' -f 2)
cellid=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.3.36.0 | cut -d '"' -f 2)
apn=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.6.1.3.0 | cut -d '"' -f 2)
sim=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.5.1.0 | cut -d '"' -f 2)
sinr=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.3.11.0 | cut -d '"' -f 2)
rsrq=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.3.17.0 | cut -d '"' -f 2)
rsrp=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.3.18.0 | cut -d '"' -f 2)
rssi=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.3.16.0 | cut -d '"' -f 2)
dspeed=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.3.6.0 | cut -d '"' -f 2)
uspeed=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.3.5.0 | cut -d '"' -f 2)
dtotal=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.3.33.0 | cut -d '"' -f 2)
utotal=$(snmpget -c $community -v $snmpversion $routerip SNMPv2-SMI::enterprises.10529.5200.3.31.0 | cut -d '"' -f 2)
now=$(date)

clear
echo "======= SNMP LTE Router Monitor ========"
echo "=== $now ==="
echo -n "Model:         " $model $'\n'
echo "============ Connection Info ==========="
echo -n "eNB ID:        " $enbid $'\n'
echo -n "PCI:           " $pci $'\n'
echo -n "Cell ID:       " $cellid $'\n'
echo -n "APN name:      " $apn $'\n'
echo -n "SIM status:    " $sim $'\n'
echo "================ Signal ================"
echo -n "SINR:          " $sinr "dB" $'\n'
echo -n "RSRQ:          " $rsrq "dB" $'\n'
echo -n "RSRP:          " $rsrp "dBm" $'\n'
echo -n "RSSI:          " $rssi "dBm" $'\n'
echo "============= Current Speed ============"
echo -n "Download:      " $dspeed $'\n'
echo -n "Upload:        " $uspeed $'\n'
echo "============== Total Usage ============="
echo -n "Download:      " $dtotal $'\n'
echo -n "Upload:        " $utotal $'\n'
echo "========================================"
echo  "Hold [CTRL+C] to exit..."
sleep $refreshtime
done
